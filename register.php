<?php
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = 'data/registrations.json';
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $current[] = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'date' => date('Y-m-d H:i:s')
    ];
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
    $message = "Registration successful! Your profile has been created.";
}

$page_title = "Submit an Inquiry | PrimePath HR";
require_once 'includes/header.php'; 
?>

<div class="auth-wrapper">
    <div class="auth-sidebar" style="background: linear-gradient(135deg, var(--primary-navy-dark), var(--primary-navy));">
        <h1 style="color: white; font-size: 40px; margin-bottom: 20px;">Start Your Journey</h1>
        <p style="font-size: 18px; opacity: 0.9; line-height: 1.6;">Submit your details and a PrimePath consultant will be in touch within 24 hours to discuss your needs.</p>
    </div>
    
    <div class="auth-form-container">
        <div class="auth-form">
            <div style="margin-bottom: 30px; text-align: center;">
                <h2 style="font-size: 28px; margin-bottom: 10px;">Submit Your Inquiry</h2>
                <p style="color: var(--text-muted);">Join PrimePath to discover opportunities.</p>
            </div>
            
            <?php if($message): ?>
            <div style="background: rgba(10, 132, 255, 0.1); color: var(--secondary-blue); padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 500;">
                <?= htmlspecialchars($message) ?>
            </div>
            <?php endif; ?>
            
            <form action="register.php" method="POST">
                <div class="form-group">
                    <input type="text" name="name" id="reg_name" required placeholder=" ">
                    <label for="reg_name">Full Name</label>
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" id="reg_email" required placeholder=" ">
                    <label for="reg_email">Email Address</label>
                </div>
                
                <div class="form-group">
                    <input type="tel" name="phone" id="reg_phone" required placeholder=" ">
                    <label for="reg_phone">Phone Number</label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit Inquiry</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
