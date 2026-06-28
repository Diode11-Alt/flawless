<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    die('Unauthorized');
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF Check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $action = $_POST['action'] ?? '';
    if ($action == 'add' || $action == 'edit') {
        function sanitize($val) {
            return htmlspecialchars(strip_tags(trim($val)));
        }
        
        // Convert textarea text to array of strings separated by newlines
        $description = array_filter(array_map('sanitize', explode("\n", $_POST['description'] ?? '')));
        $responsibilities = array_filter(array_map('sanitize', explode("\n", $_POST['responsibilities'] ?? '')));
        $requirements = array_filter(array_map('sanitize', explode("\n", $_POST['requirements'] ?? '')));

        $data = [
            'title' => sanitize($_POST['title'] ?? ''),
            'company' => sanitize($_POST['company'] ?? ''),
            'location' => sanitize($_POST['location'] ?? ''),
            'type' => sanitize($_POST['type'] ?? ''),
            'salary' => sanitize($_POST['salary'] ?? ''),
            'industry' => sanitize($_POST['industry'] ?? ''),
            'description' => array_values($description),
            'responsibilities' => array_values($responsibilities),
            'requirements' => array_values($requirements)
        ];

        if ($action == 'add') {
            add_job($data);
        } else {
            $id = $_POST['id'] ?? 0;
            if ($id) {
                update_job($id, $data);
            }
        }
    } elseif ($action == 'delete') {
        $id = $_POST['id'] ?? 0;
        if ($id) {
            delete_job($id);
        }
    }
}
header('Location: dashboard.php');
exit;
