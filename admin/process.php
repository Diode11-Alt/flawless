<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    die('Unauthorized');
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action == 'add') {
        $data = [
            'title' => $_POST['title'] ?? '',
            'company' => $_POST['company'] ?? '',
            'location' => $_POST['location'] ?? '',
            'type' => $_POST['type'] ?? '',
            'salary' => $_POST['salary'] ?? ''
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
