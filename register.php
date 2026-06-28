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
    $current[] = [
        'name' => htmlspecialchars(strip_tags(trim($_POST['name'] ?? ''))),
        'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'job_id' => htmlspecialchars(strip_tags(trim($_POST['job_id'] ?? ''))),
        'job_title' => htmlspecialchars(strip_tags(trim($_POST['job_title'] ?? ''))),
        'cv' => $cv_path,
        'date' => date('Y-m-d H:i:s')
    ];
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
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
            
            <form action="register.php" method="POST" enctype="multipart/form-data">
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
                    <input type="file" name="cv" accept=".pdf,.doc,.docx"
                           style="padding: 12px; border: 2px dashed #E2E8F0; border-radius: 12px; width: 100%;">
                    <label style="position: static; font-size: 12px; color: var(--text-muted); margin-top: 4px; display: block;">
                        Upload CV (PDF or Word, max 5MB)
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit Application</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
