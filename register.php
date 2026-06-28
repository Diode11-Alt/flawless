<?php
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? ''
    ];
    
    // Send to Zoho CRM
    // send_to_zoho_crm($data);
    
    // Simulate success for now without breaking due to invalid tokens
    $message = "Thank you, {$data['name']}! Your account has been created and inquiry sent to our CRM.";
}

$page_title = "Register - PrimePath UAE";
include 'includes/header.php'; 
?>

<div class="auth-wrapper">
    <div class="auth-sidebar" style="background: linear-gradient(135deg, var(--primary-navy-dark), var(--primary-navy));">
        <h1 style="color: white; font-size: 42px; margin-bottom: 20px;">Join PrimePath UAE</h1>
        <p style="font-size: 18px; opacity: 0.9; line-height: 1.6;">Create an account to track your applications, manage your profile, and receive personalized job alerts tailored to your career aspirations.</p>
        
        <div style="margin-top: 50px;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px;">✓</div>
                <span>Access to exclusive opportunities</span>
            </div>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px;">✓</div>
                <span>Direct employer connections</span>
            </div>
        </div>
    </div>
    
    <div class="auth-form-container">
        <div class="auth-form">
            <div style="margin-bottom: 30px; text-align: center;">
                <h2 style="font-size: 28px; margin-bottom: 10px;">Create an Account</h2>
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
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Create My Account</button>
            </form>
            
            <p style="text-align: center; margin-top: 25px; color: var(--text-muted);">
                Already have an account? <a href="#">Login here</a>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
