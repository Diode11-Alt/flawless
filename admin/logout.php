<?php
require_once __DIR__ . '/auth.php';
logout_admin();
header('Location: login.php');
exit;
?>
