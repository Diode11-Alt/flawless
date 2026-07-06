<?php
require_once __DIR__ . '/auth.php';
if (!check_admin_auth()) {
    die('Unauthorized access.');
}
require_once __DIR__ . '/../includes/helpers.php';

$file = basename($_GET['file'] ?? '');
if (empty($file)) {
    die('Error: File not specified.');
}

$upload_dir = get_upload_dir_path();
$filepath = $upload_dir . $file;

if (!file_exists($filepath)) {
    // Check local project uploads folder as fallback
    $local_path = __DIR__ . '/../uploads/' . $file;
    if (file_exists($local_path)) {
        $filepath = $local_path;
    } else {
        die('Error: File not found.');
    }
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));
readfile($filepath);
exit;
?>
