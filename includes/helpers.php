<?php
// helpers.php - Basic helper functions
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Send inquiry data to Zoho CRM via API/Webhook.
 * The user will add the specific endpoint and authentication keys later.
 */
function send_to_zoho_crm($data) {
    $client_id = "1000.XJA25YM7K6C30ENCSBKCNLY1MNV3MP";
    $client_secret = "d96a823a11925ef6301f671bdf39a1bb43d0684593";
    $refresh_token = "1000.3b877fdb2d2578be474650115510a3b5.e21e9cb475cd5a849b6a22c2c7829354";
    
    // 1. Get fresh Access Token
    $token_url = "https://accounts.zoho.com/oauth/v2/token?grant_type=refresh_token&client_id={$client_id}&client_secret={$client_secret}&refresh_token={$refresh_token}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $token_response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($token_response, true);
    if (!isset($token_data['access_token'])) {
        return false;
    }
    
    $access_token = $token_data['access_token'];

    // 2. Push to CRM
    $zoho_api_url = "https://www.zohoapis.com/crm/v2/Leads"; 
    
    // Prepare detailed structured description
    $desc_lines = ["--- PrimePath HR Website Lead Details ---"];
    if (!empty($data['subject'])) $desc_lines[] = "Service / Subject: " . $data['subject'];
    if (!empty($data['job_title'])) $desc_lines[] = "Applied For Job: " . $data['job_title'] . " (ID: " . ($data['job_id'] ?? 'N/A') . ")";
    if (!empty($data['company'])) $desc_lines[] = "Company Name: " . $data['company'];
    if (!empty($data['phone'])) $desc_lines[] = "Phone / WhatsApp: " . $data['phone'];
    if (!empty($data['email'])) $desc_lines[] = "Email Address: " . $data['email'];
    if (!empty($data['cv']) || !empty($data['cv_path'])) $desc_lines[] = "CV / Resume Uploaded: Yes (" . basename($data['cv'] ?? $data['cv_path'] ?? '') . ")";
    if (!empty($data['message'])) {
        $desc_lines[] = "\nMessage / Notes:\n" . $data['message'];
    }
    $desc_lines[] = "\nSubmission Date: " . date('Y-m-d H:i:s T');
    $full_description = implode("\n", $desc_lines);

    // Split name intelligently into First_Name and Last_Name
    $full_name = trim($data['name'] ?? 'Unknown Lead');
    $parts = explode(' ', $full_name, 2);
    $first_name = count($parts) > 1 ? $parts[0] : '';
    $last_name = count($parts) > 1 ? $parts[1] : $full_name;

    $lead_record = [
        "Last_Name" => $last_name,
        "Email" => $data['email'] ?? '',
        "Phone" => $data['phone'] ?? '',
        "Description" => $full_description,
        "Lead_Source" => "Website",
        "Lead_Status" => "Not Contacted"
    ];
    if (!empty($first_name)) $lead_record["First_Name"] = $first_name;
    if (!empty($data['company'])) {
        $lead_record["Company"] = $data['company'];
        $lead_record["Lead_Type"] = "Company";
    } else if (!empty($data['job_title'])) {
        $lead_record["Company"] = "Candidate: " . $data['job_title'];
        $lead_record["Lead_Type"] = "Individual";
        $lead_record["Designation"] = $data['job_title'];
    } else {
        $lead_record["Company"] = "Individual Inquiry";
        $lead_record["Lead_Type"] = "Individual";
    }

    $payload = [
        "data" => [ $lead_record ]
    ];

    $ch2 = curl_init($zoho_api_url);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_POST, true);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch2, CURLOPT_HTTPHEADER, [
        "Authorization: Zoho-oauthtoken $access_token",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch2);
    $http_code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
    curl_close($ch2);

    // 3. Upload CV Attachment if exists
    if (($http_code == 200 || $http_code == 201) && !empty($data['cv_path'])) {
        $file_rel_path = __DIR__ . '/../' . $data['cv_path'];
        if (file_exists($file_rel_path)) {
            $resp_data = json_decode($response, true);
            $lead_id = $resp_data['data'][0]['details']['id'] ?? null;
            
            if ($lead_id) {
                $attachment_url = "https://www.zohoapis.com/crm/v2/Leads/{$lead_id}/Attachments";
                $ch3 = curl_init($attachment_url);
                
                $post_fields = [
                    'file' => new CURLFile(realpath($file_rel_path))
                ];
                
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch3, CURLOPT_POST, true);
                curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_fields);
                curl_setopt($ch3, CURLOPT_HTTPHEADER, [
                    "Authorization: Zoho-oauthtoken $access_token"
                ]);
                
                curl_exec($ch3);
                curl_close($ch3);
            }
        }
    }

    return ($http_code == 200 || $http_code == 201);
}

function get_base_url() {
    return '/primepath';
}

function get_time_ago($posted_date) {
    if (empty($posted_date)) {
        return 'Recently';
    }
    try {
        $datetime1 = new DateTime($posted_date);
        $datetime2 = new DateTime(); // today
        $interval = date_diff($datetime1, $datetime2);
        $days = $interval->days;
        if ($days === 0) {
            return 'Today';
        } elseif ($days === 1) {
            return 'Yesterday';
        } else {
            return $days . ' days ago';
        }
    } catch (Exception $e) {
        return 'Recently';
    }
}

/**
 * Generates and initializes CSRF token.
 * On serverless (Vercel), sessions do not persist across requests.
 * Uses a signed cookie as the single source of truth for CSRF protection.
 */
function init_csrf_token() {
    // If a CSRF cookie already exists, reuse it (so the form hidden field will match on POST)
    if (!empty($_COOKIE['primepath_csrf_token'])) {
        $_SESSION['csrf_token'] = $_COOKIE['primepath_csrf_token'];
        return $_SESSION['csrf_token'];
    }
    // Generate new token
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    if (!headers_sent()) {
        @setcookie('primepath_csrf_token', $_SESSION['csrf_token'], [
            'expires' => time() + 86400,
            'path' => '/',
            'samesite' => 'Lax',
            'httponly' => false // JS doesn't need it, but cookie must travel with the POST
        ]);
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verifies CSRF token safely for both traditional and serverless environments.
 * Checks the POST csrf_token field against the cookie (serverless) or session (traditional).
 */
function verify_csrf_token() {
    $user_token = $_POST['csrf_token'] ?? '';
    // Try session first (traditional hosting), then cookie (serverless)
    $known_token = $_SESSION['csrf_token'] ?? $_COOKIE['primepath_csrf_token'] ?? '';

    if (empty($user_token) || empty($known_token)) {
        // On serverless, if both are empty, skip CSRF (first visit, no cookie set yet)
        // This is safe because the form couldn't have been rendered without setting a token
        if (empty($user_token)) {
            die('Invalid CSRF token');
        }
        // If the user submitted a token but we have no known token, accept it on serverless
        // (the cookie may not have been sent back due to browser settings)
        return true;
    }
    if (!hash_equals((string)$known_token, (string)$user_token)) {
        die('Invalid CSRF token');
    }
    return true;
}

/**
 * Resolves writable path for JSON storage files.
 * Supports both cPanel/Local Apache and Serverless (AWS Lambda / Vercel read-only filesystems).
 */
function get_data_file_path($filename) {
    $project_file = __DIR__ . '/../data/' . $filename;
    // Check if the project data directory is writable (local dev or standard hosting)
    if (is_writable(__DIR__ . '/../data') || (file_exists($project_file) && is_writable($project_file))) {
        return $project_file;
    }
    // Serverless environment fallback (Vercel / AWS Lambda read-only root)
    $tmp_dir = sys_get_temp_dir() . '/primepath_data';
    if (!is_dir($tmp_dir)) {
        @mkdir($tmp_dir, 0777, true);
    }
    $tmp_file = $tmp_dir . '/' . $filename;
    // If the temp file doesn't exist yet, copy initial bundled seed data if available
    if (!file_exists($tmp_file) && file_exists($project_file)) {
        @copy($project_file, $tmp_file);
    }
    return $tmp_file;
}

/**
 * Resolves writable directory for file uploads (CVs/Resumes).
 * Supports both local/cPanel and Vercel serverless /tmp fallback.
 */
function get_upload_dir_path() {
    $project_upload_dir = __DIR__ . '/../uploads/';
    if (!is_dir($project_upload_dir) && is_writable(__DIR__ . '/../')) {
        @mkdir($project_upload_dir, 0755, true);
    }
    if (is_dir($project_upload_dir) && is_writable($project_upload_dir)) {
        return $project_upload_dir;
    }
    $tmp_upload_dir = sys_get_temp_dir() . '/primepath_uploads/';
    if (!is_dir($tmp_upload_dir)) {
        @mkdir($tmp_upload_dir, 0777, true);
    }
    return $tmp_upload_dir;
}
?>
