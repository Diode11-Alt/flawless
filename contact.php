<?php
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = 'data/contacts.json';
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $current[] = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'subject' => $_POST['subject'] ?? '',
        'message' => $_POST['message'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'date' => date('Y-m-d H:i:s')
    ];
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
    $message = "Thanks! We'll be in touch soon.";
}

$page_title = "Contact Us | PrimePath HR";
require_once 'includes/header.php';
?>
<div class="auth-wrapper">
    <div class="auth-sidebar" style="background: linear-gradient(135deg, var(--primary-navy-dark), var(--primary-navy));">
        <h1 style="color: white; font-size: 42px; margin-bottom: 20px;">Contact Us</h1>
        <p style="font-size: 18px; opacity: 0.9; line-height: 1.6; margin-bottom: 40px;">Reach out to our team for inquiries, executive search requirements, or HR consulting.</p>
        
        <div style="display: flex; flex-direction: column; gap: 25px;">
            <div style="display: flex; align-items: flex-start; gap: 15px;">
                <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--secondary-blue);"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <h4 style="color: white; margin-bottom: 5px;">Our Office</h4>
                    <span style="color: rgba(255,255,255,0.7);">Business Village, Block B - Office 923<br>Deira, Dubai - UAE</span>
                </div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 15px;">
                <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--secondary-blue);"><i class="fas fa-phone-alt"></i></div>
                <div>
                    <h4 style="color: white; margin-bottom: 5px;">Phone</h4>
                    <span style="color: rgba(255,255,255,0.7);">+971 54 548 0972</span>
                </div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 15px;">
                <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--secondary-blue);"><i class="fas fa-envelope"></i></div>
                <div>
                    <h4 style="color: white; margin-bottom: 5px;">Email</h4>
                    <span style="color: rgba(255,255,255,0.7);">info@primepathuae.com</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="auth-form-container">
        <div class="auth-form">
            <div style="margin-bottom: 30px; text-align: center;">
                <h2 style="font-size: 28px; margin-bottom: 10px;">Get in Touch</h2>
                <p style="color: var(--text-muted);">Send us a message and we'll reply shortly.</p>
            </div>
            
            <?php if($message): ?>
            <div style="background: rgba(10, 132, 255, 0.1); color: var(--secondary-blue); padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 500;">
                <?= htmlspecialchars($message) ?>
            </div>
            <?php endif; ?>
            
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <input type="text" name="name" id="contact_name" required placeholder=" ">
                    <label for="contact_name">Full Name</label>
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" id="contact_email" required placeholder=" ">
                    <label for="contact_email">Email Address</label>
                </div>
                
                <div class="form-group">
                    <input type="tel" name="phone" id="contact_phone" placeholder=" ">
                    <label for="contact_phone">Phone Number</label>
                </div>

                <div class="form-group">
                    <textarea name="message" id="contact_message" rows="4" required placeholder=" " style="width: 100%; padding: 16px 20px; border: 2px solid #E2E8F0; border-radius: 12px; font-family: var(--font-body); font-size: 15px; background-color: transparent; transition: all 0.3s ease; resize: vertical;"></textarea>
                    <label for="contact_message" style="top: 25px;">Message</label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Send Inquiry</button>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
