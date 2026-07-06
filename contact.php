<?php
session_start();
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF Check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $file = 'data/contacts.json';
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    
    // Sanitization
    $lead_data = [
        'name' => htmlspecialchars(strip_tags(trim($_POST['name'] ?? ''))),
        'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'subject' => htmlspecialchars(strip_tags(trim($_POST['subject'] ?? ''))),
        'message' => htmlspecialchars(strip_tags(trim($_POST['message'] ?? ''))),
        'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'date' => date('Y-m-d H:i:s')
    ];
    $current[] = $lead_data;
    
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
    
    // Also push to Zoho CRM
    send_to_zoho_crm($lead_data);
    header("Location: thankyou.php");
    exit;
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
                    <span style="color: rgba(255,255,255,0.7);">primepathhrservices@gmail.com</span>
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
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                
                <div class="form-group">
                    <input type="text" name="name" id="contact_name" required placeholder=" " autocomplete="name">
                    <label for="contact_name">Full Name</label>
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" id="contact_email" required placeholder=" " autocomplete="email">
                    <label for="contact_email">Email Address</label>
                </div>
                
                <div class="form-group">
                    <input type="tel" name="phone" id="contact_phone" placeholder=" " autocomplete="tel">
                    <label for="contact_phone">Phone Number</label>
                </div>
                
                <?php
                $requested_service = $_GET['service'] ?? '';
                ?>
                <div class="form-group">
                    <select name="subject" id="contact_subject" style="width: 100%; padding: 16px 20px; border: 2px solid #E2E8F0; border-radius: 12px; font-family: var(--font-body); font-size: 15px; background-color: transparent; outline: none; appearance: none; color: var(--text-dark);">
                        <option value="" disabled <?= empty($requested_service) ? 'selected' : '' ?>>Select a Service</option>
                        <option value="Executive Search" <?= $requested_service === 'Executive Search' ? 'selected' : '' ?>>Executive Search & Recruitment</option>
                        <option value="Payroll Outsourcing" <?= $requested_service === 'Payroll Outsourcing' ? 'selected' : '' ?>>HR Outsourcing & Payroll</option>
                        <option value="Corporate Training" <?= $requested_service === 'Corporate Training' ? 'selected' : '' ?>>Corporate Training & Development</option>
                        <option value="HR Compliance" <?= $requested_service === 'HR Compliance' ? 'selected' : '' ?>>HR Compliance & Labour Law</option>
                        <option value="Emiratization" <?= $requested_service === 'Emiratization' ? 'selected' : '' ?>>Emiratization (Tawteen) Solutions</option>
                        <option value="Transformation Modules" <?= $requested_service === 'Transformation Modules' ? 'selected' : '' ?>>Transformation Modules</option>
                        <option value="Other">Other Consulting Services</option>
                    </select>
                    <label for="contact_subject" style="top: 25px; display: none;">Service Required</label>
                </div>

                <div class="form-group">
                    <textarea name="message" id="contact_message" rows="4" required placeholder=" " style="width: 100%; padding: 16px 20px; border: 2px solid #E2E8F0; border-radius: 12px; font-family: var(--font-body); font-size: 15px; background-color: transparent; transition: all 0.3s ease; resize: vertical;"></textarea>
                    <label for="contact_message">Message</label>
                </div>
                
                <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
                    <input type="checkbox" id="accept_terms" name="accept_terms" required style="margin-top: 5px;">
                    <label for="accept_terms" style="font-size: 13px; color: var(--text-muted); cursor: pointer; position: static; transform: none; color: var(--text-muted); pointer-events: auto;">
                        I agree to the <a href="terms.php" target="_blank" style="color: var(--secondary-blue); text-decoration: underline;">Terms & Conditions</a> and <a href="privacy.php" target="_blank" style="color: var(--secondary-blue); text-decoration: underline;">Privacy Policy</a>.
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Send Inquiry</button>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
