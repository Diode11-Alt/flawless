<?php
require_once __DIR__ . '/auth.php';
if (check_admin_auth()) {
    header('Location: dashboard.php');
    exit;
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Brute force protection
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt'] = time();
    }
    
    if ($_SESSION['login_attempts'] >= 5) {
        if (time() - $_SESSION['last_attempt'] < 30) {
            $error = "Too many failed attempts. Please wait 30 seconds.";
            sleep(3); // Slow down
        } else {
            $_SESSION['login_attempts'] = 0;
        }
    }

    if (empty($error)) {
        if ($username === ADMIN_USER && password_verify($password, ADMIN_HASH)) {
            session_regenerate_id(true); // Prevent session fixation
            login_admin();
            $_SESSION['login_attempts'] = 0; // Reset on success
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid credentials";
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt'] = time();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - PrimePath HR</title>
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
