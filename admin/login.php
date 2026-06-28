<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

define('ADMIN_USER', 'admin');
define('ADMIN_HASH', '$2y$12$8.euxuNX3ZLIHBQhwv5BgODDFUhHIFZBQawJuOUl8RG9FP.9eo4eK');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === ADMIN_USER && password_verify($password, ADMIN_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - PrimePath UAE</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background: var(--bg-light); display: flex; align-items: center; justify-content: center; height: 100vh;">
    <div style="background: white; padding: 40px; border-radius: var(--border-radius); box-shadow: var(--shadow-card); max-width: 400px; width: 100%;">
        <div style="text-align: center; margin-bottom: 30px;">
            <div class="logo">Prime<span>Path</span> <span style="font-size: 14px; color: var(--text-muted); display: block; margin-top: 5px;">Admin Portal</span></div>
        </div>
        <?php if($error): ?><div style="color: red; margin-bottom: 15px; text-align: center; font-weight: 500;"><?= $error ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" required placeholder=" ">
                <label>Username</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" required placeholder=" ">
                <label>Password</label>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>
    </div>
</body>
</html>
