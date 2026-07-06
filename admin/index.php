<?php
require_once __DIR__ . '/auth.php';
if (check_admin_auth()) {
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
