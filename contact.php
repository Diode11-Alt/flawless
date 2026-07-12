<?php
session_start();
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Log incoming POST for debugging
    error_log("CONTACT.PHP POST received from: " . ($_SERVER['HTTP_REFERER'] ?? 'unknown'));
    error_log("POST data: " . json_encode($_POST));
    
    // CSRF Check
    verify_csrf_token();

    $file = get_data_file_path('contacts.json');
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    

    // Sanitization
    $lead_data = [
        'name' => htmlspecialchars(strip_tags(trim($_POST['name'] ?? (!empty($_POST['company']) ? 'Employer Contact' : 'Anonymous')))),
        'company' => htmlspecialchars(strip_tags(trim($_POST['company'] ?? ''))),
        'job_title' => htmlspecialchars(strip_tags(trim($_POST['job_title'] ?? ''))),
        'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'subject' => htmlspecialchars(strip_tags(trim($_POST['subject'] ?? (!empty($_POST['company']) ? 'Employer Callback Request' : 'General Inquiry')))),
        'message' => htmlspecialchars(strip_tags(trim($_POST['message'] ?? (!empty($_POST['company']) ? 'Callback requested by employer company: ' . $_POST['company'] : '')))),

        'date' => date('Y-m-d H:i:s')
    ];
    $current[] = $lead_data;
    
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
    
    // Also push to Zoho CRM
    $result = send_to_zoho_crm($lead_data);
    error_log("ZOHO CRM PUSH RESULT: " . ($result ? "SUCCESS" : "FAILED"));
    header("Location: thankyou.php");
    exit;
}

$page_title = "Contact Us | PrimePath HR";
require_once 'includes/header.php';
?>
<div class="auth-wrapper">
    <div class="auth-sidebar" style="background: linear-gradient(135deg, var(--bg-light) 0%, #e0f2fe 100%); color: var(--text-dark);">
        <h1 style="color: var(--primary-navy); font-size: 42px; margin-bottom: 20px;">Contact Us</h1>
        <p style="font-size: 18px; color: var(--text-muted); line-height: 1.6; margin-bottom: 40px;">Reach out to our team for volume staffing inquiries, Emiratization services, or HR Outsourcing assistance.</p>
        
        <div style="display: flex; flex-direction: column; gap: 25px;">
            <div style="display: flex; align-items: flex-start; gap: 15px;">
                <div style="width: 45px; height: 45px; background: rgba(0, 86, 179, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--secondary-blue); flex-shrink: 0;"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <h4 style="color: var(--primary-navy); margin-bottom: 5px;">Our Office</h4>
                    <span style="color: var(--text-muted);">Sharjah, UAE</span>
                </div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 15px;">
                <div style="width: 45px; height: 45px; background: rgba(0, 86, 179, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--secondary-blue); flex-shrink: 0;"><i class="fas fa-phone-alt"></i></div>
                <div>
                    <h4 style="color: var(--primary-navy); margin-bottom: 5px;">Phone</h4>
                    <span style="color: var(--text-muted);">+971 54 548 0972</span>
                </div>
            </div>
            <div style="display: flex; align-items: flex-start; gap: 15px;">
                <div style="width: 45px; height: 45px; background: rgba(0, 86, 179, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--secondary-blue); flex-shrink: 0;"><i class="fas fa-envelope"></i></div>
                <div>
                    <h4 style="color: var(--primary-navy); margin-bottom: 5px;">Email</h4>
                    <span style="color: var(--text-muted);">info@primepathuae.com</span>
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
            
            <form action="contact.php" method="POST" enctype="multipart/form-data" id="inquiryForm">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_name">Full Name</label>
                    <input type="text" name="name" id="contact_name" required class="shadcn-input" autocomplete="name">
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_email">Email Address</label>
                    <input type="email" name="email" id="contact_email" required class="shadcn-input" autocomplete="email">
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_phone">Phone / WhatsApp Number</label>
                    <input type="tel" name="phone" id="contact_phone" required class="shadcn-input" autocomplete="tel">
                </div>
                
                <div class="form-group" style="margin-bottom: 25px;">
                    <p class="shadcn-label">Inquiry Type:</p>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 15px; position: static; transform: none; pointer-events: auto; font-weight: 600; color: var(--primary-navy);">
                            <input type="radio" name="inquiry_type" value="employer" onchange="toggleFields()" checked style="margin: 0; width: auto; height: auto;"> UAE Employer / Hiring Manager
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 15px; position: static; transform: none; pointer-events: auto; color: var(--text-muted);">
                            <input type="radio" name="inquiry_type" value="employee" onchange="toggleFields()" style="margin: 0; width: auto; height: auto;"> Candidate / Professional
                        </label>
                    </div>
                </div>

                <div class="form-group" id="company_group" style="margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_company">Company Name</label>
                    <input type="text" name="company" id="contact_company" class="shadcn-input">
                </div>

                <div class="form-group" id="job_title_group" style="display: none; margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_job_title">Job Title (Optional)</label>
                    <input type="text" name="job_title" id="contact_job_title" class="shadcn-input">
                </div>
                
                <?php
                $requested_service = $_GET['service'] ?? '';
                ?>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_subject">Service Required</label>
                    <select name="subject" id="contact_subject" class="shadcn-input">
                        <option value="" disabled <?= empty($requested_service) ? 'selected' : '' ?>>Select a Service</option>
                        <option value="Executive Search" <?= $requested_service === 'Executive Search' ? 'selected' : '' ?>>Executive Search & Specialist Recruitment</option>
                        <option value="HR Outsourcing" <?= $requested_service === 'HR Outsourcing' ? 'selected' : '' ?>>Comprehensive HR Outsourcing</option>
                        <option value="Corporate Training" <?= $requested_service === 'Corporate Training' ? 'selected' : '' ?>>Corporate Training & Development</option>
                        <option value="HR Compliance" <?= $requested_service === 'HR Compliance' ? 'selected' : '' ?>>HR Compliance & Legal Structuring</option>
                        <option value="Emiratization" <?= $requested_service === 'Emiratization' ? 'selected' : '' ?>>Emiratization (Tawteen)</option>
                        <option value="Candidate Inquiry" <?= $requested_service === 'Candidate Inquiry' ? 'selected' : '' ?>>I'm a Candidate / Job Seeker</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <?php
                $calc_msg = '';
                if (($_GET['source'] ?? '') === 'calculator') {
                    $sal = htmlspecialchars($_GET['salary'] ?? '');
                    $tot = htmlspecialchars($_GET['total'] ?? '');
                    $calc_msg = "Inquiry via Deployment Calculator:\n- Base Salary: € {$sal}\n- Estimated Total Monthly Budget: € {$tot}\nWe would like to request an official proposal & consultation.";
                }
                ?>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="shadcn-label" for="contact_message">Message</label>
                    <textarea name="message" id="contact_message" rows="4" required class="shadcn-input" style="resize: vertical;"><?= $calc_msg ?></textarea>
                </div>
                
                <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
                    <input type="checkbox" id="accept_terms" name="accept_terms" required style="margin-top: 5px;">
                    <label for="accept_terms" style="font-size: 13px; color: var(--text-muted); cursor: pointer; position: static; transform: none; color: var(--text-muted); pointer-events: auto;">
                        I agree to the <a href="terms.php" target="_blank" style="color: var(--secondary-blue); text-decoration: underline;">Terms & Conditions</a> and <a href="privacy.php" target="_blank" style="color: var(--secondary-blue); text-decoration: underline;">Privacy Policy</a>.
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary border-beam-btn" style="width: 100%; margin-top: 10px;">Send Inquiry</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>
<script>
function toggleFields() {
    const type = document.querySelector('input[name="inquiry_type"]:checked').value;
    const companyGroup = document.getElementById('company_group');
    const jobGroup = document.getElementById('job_title_group');
    
    if (type === 'employer') {
        companyGroup.style.display = 'block';
        jobGroup.style.display = 'none';
    } else {
        companyGroup.style.display = 'none';
        jobGroup.style.display = 'block';
    }
}

</script>

<?php include 'includes/footer.php'; ?>
