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
    // TODO: Replace with your actual Zoho CRM API Webhook URL or Endpoint
    $zoho_api_url = "https://www.zohoapis.com/crm/v2/Leads"; 
    
    // TODO: Replace with your actual OAuth Token or API Key
    $auth_token = "YOUR_ZOHO_AUTH_TOKEN"; 

    // Format the payload according to Zoho's Lead/Inquiry structure
    $payload = [
        "data" => [
            [
                "Last_Name" => $data['name'] ?? 'Unknown',
                "Email" => $data['email'] ?? '',
                "Phone" => $data['phone'] ?? '',
                "Description" => "Inquiry from PrimePath Website"
            ]
        ]
    ];

    $ch = curl_init($zoho_api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Zoho-oauthtoken $auth_token",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Return true if successful, false otherwise.
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
