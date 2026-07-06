<?php
session_start();
require_once 'includes/helpers.php';
$message = '';
$job_id = $_GET['job_id'] ?? ($_POST['job_id'] ?? '');
$job_title = $_GET['job_title'] ?? ($_POST['job_title'] ?? '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $cv_path = '';
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $filename = time() . '_' . basename($_FILES['cv']['name']);
        $target_file = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $target_file)) {
            $cv_path = $target_file;
        }
    }

    $file = 'data/registrations.json';
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $registration_data = [
        'name' => htmlspecialchars(strip_tags(trim($_POST['name'] ?? ''))),
        'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'job_id' => htmlspecialchars(strip_tags(trim($_POST['job_id'] ?? ''))),
        'job_title' => htmlspecialchars(strip_tags(trim($_POST['job_title'] ?? ''))),
        'cv' => $cv_path,
        'date' => date('Y-m-d H:i:s')
    ];
    $current[] = $registration_data;
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
    
    // Format data for Zoho CRM
    $zoho_data = [
        'name' => $registration_data['name'],
        'email' => $registration_data['email'],
        'phone' => $registration_data['phone'],
        'message' => "Career Application for Job: " . ($registration_data['job_title'] ?: 'General Application'),
        'cv_path' => $registration_data['cv']
    ];
    send_to_zoho_crm($zoho_data);
    header("Location: thankyou.php");
    exit;
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
                <h2 style="font-size: 28px; margin-bottom: 10px;">
                    <?= $job_title ? 'Apply for ' . htmlspecialchars($job_title) : 'Submit Your Inquiry' ?>
                </h2>
                <p style="color: var(--text-muted);">Join PrimePath to discover opportunities.</p>
            </div>
            
            <?php if($message): ?>
            <div style="background: rgba(10, 132, 255, 0.1); color: var(--secondary-blue); padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 500;">
                <?= htmlspecialchars($message) ?>
            </div>
            <?php endif; ?>
            
            <form action="register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateFileSize()">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                <input type="hidden" name="job_id" value="<?= htmlspecialchars($job_id) ?>">
                <input type="hidden" name="job_title" value="<?= htmlspecialchars($job_title) ?>">
                
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

                <div class="form-group">
                    <input type="file" name="cv" id="reg_cv" accept=".pdf,.doc,.docx"
                           style="padding: 12px; border: 2px dashed #E2E8F0; border-radius: 12px; width: 100%;">
                    <label style="position: static; font-size: 12px; color: var(--text-muted); margin-top: 4px; display: block;">
                        Upload CV (PDF or Word, max 5MB)
                    </label>
                    <div id="file_error" style="color: red; font-size: 13px; margin-top: 5px; display: none;">File is too large. Maximum size is 5MB.</div>
                </div>
                
                <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
                    <input type="checkbox" id="accept_terms_reg" name="accept_terms" required style="margin-top: 5px;">
                    <label for="accept_terms_reg" style="font-size: 13px; color: var(--text-muted); cursor: pointer; position: static; transform: none; color: var(--text-muted); pointer-events: auto; line-height: 1.4;">
                        I agree to the <a href="terms.php" target="_blank" style="color: var(--secondary-blue); text-decoration: underline;">Terms & Conditions</a> and <a href="privacy.php" target="_blank" style="color: var(--secondary-blue); text-decoration: underline;">Privacy Policy</a>, and acknowledge that PrimePath HR does not charge candidates any recruitment fees (MOHRE compliant).
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Submit Application</button>
            </form>
            
            <script>
            function validateFileSize() {
                var fileInput = document.getElementById('reg_cv');
                var errorDiv = document.getElementById('file_error');
                if (fileInput.files.length > 0) {
                    var fileSize = fileInput.files[0].size; // in bytes
                    var maxSize = 5 * 1024 * 1024; // 5MB
                    if (fileSize > maxSize) {
                        errorDiv.style.display = 'block';
                        return false; // Prevent form submission
                    }
                }
                errorDiv.style.display = 'none';
                return true;
            }
            </script>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
