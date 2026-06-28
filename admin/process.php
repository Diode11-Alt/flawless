<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    die('Unauthorized');
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action == 'add') {
        function sanitize($val) {
            return htmlspecialchars(strip_tags(trim($val)));
        }
        $data = [
            'title' => sanitize($_POST['title'] ?? ''),
            'company' => sanitize($_POST['company'] ?? ''),
            'location' => sanitize($_POST['location'] ?? ''),
            'type' => sanitize($_POST['type'] ?? ''),
            'salary' => sanitize($_POST['salary'] ?? '')
        ];
        add_job($data);
    } elseif ($action == 'delete') {
        $id = $_POST['id'] ?? 0;
        if ($id) {
            delete_job($id);
        }
    }
}
header('Location: dashboard.php');
exit;
