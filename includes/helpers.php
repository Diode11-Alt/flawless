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
    
    $payload = [
        "data" => [
            [
                "Last_Name" => $data['name'] ?? 'Unknown',
                "Email" => $data['email'] ?? '',
                "Phone" => $data['phone'] ?? '',
                "Description" => "Inquiry from PrimePath Website:\n" . ($data['message'] ?? ''),
                "Lead_Source" => "Website Inquiry"
            ]
        ]
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
?>
