<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
} else {
    require_once __DIR__ . '/config.example.php';
}

function check_admin_auth() {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        return true;
    }
    // Serverless Vercel persistence check via HMAC cookie
    if (isset($_COOKIE['primepath_admin_auth']) && defined('ADMIN_HASH')) {
        $expected = hash_hmac('sha256', 'admin_logged_in', ADMIN_HASH);
        if (hash_equals($expected, $_COOKIE['primepath_admin_auth'])) {
            $_SESSION['admin_logged_in'] = true;
            return true;
        }
    }
    return false;
}

function login_admin() {
    $_SESSION['admin_logged_in'] = true;
    if (defined('ADMIN_HASH')) {
        $token = hash_hmac('sha256', 'admin_logged_in', ADMIN_HASH);
        $is_secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
        setcookie('primepath_admin_auth', $token, time() + 86400 * 7, '/', '', $is_secure, true);
    }
}

function logout_admin() {
    $_SESSION = [];
    if (session_id() !== '' || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    session_destroy();
    setcookie('primepath_admin_auth', '', time() - 3600, '/', '', false, true);
}
?>
