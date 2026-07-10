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
    
    // Handle Visiting Card upload if provided
    $visiting_card_path = '';
    if (isset($_FILES['visiting_card']) && $_FILES['visiting_card']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/uploads/visiting_cards/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $ext = strtolower(pathinfo($_FILES['visiting_card']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];
        if (in_array($ext, $allowed)) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['visiting_card']['name']));
            if (move_uploaded_file($_FILES['visiting_card']['tmp_name'], $upload_dir . $filename)) {
                $visiting_card_path = 'uploads/visiting_cards/' . $filename;
            }
        }
    }

    // Sanitization
    $lead_data = [
        'name' => htmlspecialchars(strip_tags(trim($_POST['name'] ?? (!empty($_POST['company']) ? 'Employer Contact' : 'Anonymous')))),
        'company' => htmlspecialchars(strip_tags(trim($_POST['company'] ?? ''))),
        'job_title' => htmlspecialchars(strip_tags(trim($_POST['job_title'] ?? ''))),
        'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'subject' => htmlspecialchars(strip_tags(trim($_POST['subject'] ?? (!empty($_POST['company']) ? 'Employer Callback Request' : 'General Inquiry')))),
        'message' => htmlspecialchars(strip_tags(trim($_POST['message'] ?? (!empty($_POST['company']) ? 'Callback requested by employer company: ' . $_POST['company'] : '')))),
        'visiting_card' => $visiting_card_path,
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
    <div class="auth-sidebar" style="background: linear-gradient(135deg, var(--primary-navy-dark), var(--primary-navy));">
        <h1 style="color: white; font-size: 42px; margin-bottom: 20px;">Contact Us</h1>
        <p style="font-size: 18px; opacity: 0.9; line-height: 1.6; margin-bottom: 40px;">Reach out to our team for volume staffing inquiries, European relocation services, or Identity Malta visa assistance.</p>
        
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
            
            <form action="contact.php" method="POST" enctype="multipart/form-data" id="inquiryForm">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                
                <!-- Visiting Card AI OCR Upload Box -->
                <div style="margin-bottom: 28px; border: 2px dashed #CBD5E1; border-radius: 14px; padding: 22px; text-align: center; background: linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(241, 245, 249, 0.6)); transition: all 0.3s ease; position: relative;" id="visitingCardDropZone">
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(10, 132, 255, 0.12); color: var(--secondary-blue); display: flex; align-items: center; justify-content: center; font-size: 22px;">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--primary-navy); margin: 0;">Auto-fill from business card</h4>
                        <p style="font-size: 13px; color: var(--text-muted); margin: 0; max-width: 320px;">
                            Upload or snap your business card and we'll read and auto-fill your details instantly.
                        </p>
                        <label for="visiting_card_input" style="margin-top: 6px; display: inline-block; padding: 8px 18px; background: var(--primary-navy); color: white; font-size: 13px; font-weight: 600; border-radius: 8px; cursor: pointer; transition: 0.2s;">
                            <i class="fas fa-upload" style="margin-right: 6px;"></i> Select Card Image
                        </label>
                        <input type="file" name="visiting_card" id="visiting_card_input" accept="image/*,.pdf" style="display: none;" onchange="handleVisitingCardScan(this)">
                    </div>
                    <div id="ocrStatusBar" style="display: none; margin-top: 14px; padding: 10px 14px; border-radius: 8px; background: rgba(16, 185, 129, 0.1); color: #065F46; font-size: 13px; font-weight: 600; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fas fa-spinner fa-spin"></i> <span>Scanning card...</span>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="name" id="contact_name" required placeholder=" " autocomplete="name">
                    <label for="contact_name">Full Name</label>
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" id="contact_email" required placeholder=" " autocomplete="email">
                    <label for="contact_email">Email Address</label>
                </div>
                
                <div class="form-group">
                    <input type="tel" name="phone" id="contact_phone" required placeholder=" " autocomplete="tel">
                    <label for="contact_phone">Phone / WhatsApp Number</label>
                </div>
                
                <div class="form-group" style="margin-bottom: 25px;">
                    <p style="margin-bottom: 10px; font-size: 14px; color: var(--text-dark); font-weight: 600;">Inquiry Type:</p>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 15px; position: static; transform: none; pointer-events: auto; font-weight: 600; color: var(--primary-navy);">
                            <input type="radio" name="inquiry_type" value="employer" onchange="toggleFields()" checked style="margin: 0; width: auto; height: auto;"> Malta Employer / Hiring Manager (Volume Staffing)
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 15px; position: static; transform: none; pointer-events: auto; color: var(--text-muted);">
                            <input type="radio" name="inquiry_type" value="employee" onchange="toggleFields()" style="margin: 0; width: auto; height: auto;"> Candidate / Professional (European Relocation)
                        </label>
                    </div>
                </div>

                <div class="form-group" id="company_group">
                    <input type="text" name="company" id="contact_company" placeholder=" ">
                    <label for="contact_company">Company Name</label>
                </div>

                <div class="form-group" id="job_title_group" style="display: none;">
                    <input type="text" name="job_title" id="contact_job_title" placeholder=" ">
                    <label for="contact_job_title">Job Title (Optional)</label>
                </div>
                
                <?php
                $requested_service = $_GET['service'] ?? '';
                ?>
                <div class="form-group">
                    <select name="subject" id="contact_subject" style="width: 100%; padding: 16px 20px; border: 2px solid #E2E8F0; border-radius: 12px; font-family: var(--font-body); font-size: 15px; background-color: transparent; outline: none; appearance: none; color: var(--text-dark);">
                        <option value="" disabled <?= empty($requested_service) ? 'selected' : '' ?>>Select a Service</option>
                        <option value="Volume Sourcing" <?= $requested_service === 'Volume Sourcing' ? 'selected' : '' ?>>Volume Sourcing</option>
                        <option value="Trade Testing" <?= $requested_service === 'Trade Testing' ? 'selected' : '' ?>>Trade Testing & Vetting</option>
                        <option value="Visa Processing" <?= $requested_service === 'Visa Processing' ? 'selected' : '' ?>>Identity Malta Visa Processing</option>
                        <option value="Relocation Services" <?= $requested_service === 'Relocation Services' ? 'selected' : '' ?>>Relocation & Logistics</option>
                        <option value="Candidate Inquiry" <?= $requested_service === 'Candidate Inquiry' ? 'selected' : '' ?>>I'm a Candidate / Job Seeker</option>
                        <option value="Other">Other</option>
                    </select>
                    <label for="contact_subject" style="top: 25px; display: none;">Service Required</label>
                </div>

                <?php
                $calc_msg = '';
                if (($_GET['source'] ?? '') === 'calculator') {
                    $sal = htmlspecialchars($_GET['salary'] ?? '');
                    $tot = htmlspecialchars($_GET['total'] ?? '');
                    $calc_msg = "Inquiry via Deployment Calculator:\n- Base Salary: € {$sal}\n- Estimated Total Monthly Budget: € {$tot}\nWe would like to request an official proposal & consultation.";
                }
                ?>
                <div class="form-group">
                    <textarea name="message" id="contact_message" rows="4" required placeholder=" " style="width: 100%; padding: 16px 20px; border: 2px solid #E2E8F0; border-radius: 12px; font-family: var(--font-body); font-size: 15px; background-color: transparent; transition: all 0.3s ease; resize: vertical;"><?= $calc_msg ?></textarea>
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

async function handleVisitingCardScan(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    if (!file.type.startsWith('image/')) return;

    const statusEl = document.getElementById('ocrStatusBar');
    const dropZone = document.getElementById('visitingCardDropZone');
    statusEl.style.display = 'flex';
    statusEl.innerHTML = `<i class="fas fa-spinner fa-spin"></i> <span>AI Vision Scanning Business Card...</span>`;

    try {
        const result = await Tesseract.recognize(file, 'eng', {
            logger: m => {
                if (m.status === 'recognizing text') {
                    statusEl.innerHTML = `<i class="fas fa-spinner fa-spin"></i> <span>AI OCR Reading Text (${Math.round(m.progress * 100)}%)...</span>`;
                }
            }
        });

        const text = result.data.text || '';
        const lines = text.split(/\r?\n/).map(l => l.trim()).filter(Boolean);

        const emailRegex = /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9_-]+)/i;
        const phoneRegex = /(\+?\d[\d\s\-\(\)\.]{7,15}\d)/;
        const titleKeywords = ['ceo', 'director', 'manager', 'founder', 'president', 'vp', 'head', 'lead', 'executive', 'consultant', 'engineer', 'officer', 'specialist', 'partner', 'supervisor', 'hr', 'proprietor', 'general manager'];
        const companyKeywords = ['llc', 'ltd', 'limited', 'inc', 'corp', 'group', 'enterprises', 'solutions', 'services', 'consulting', 'trading', 'tourism', 'co.', 'company', 'holidays', 'census', 'manpower'];

        let email = '', phone = '', company = '', jobTitle = '', name = '';

        lines.forEach(line => {
            if (!email) {
                const em = line.match(emailRegex);
                if (em) { email = em[1]; return; }
            }
            if (!phone) {
                const ph = line.match(phoneRegex);
                if (ph && (line.includes('+') || line.replace(/\D/g, '').length >= 8)) {
                    phone = ph[1].trim(); return;
                }
            }
            const lower = line.toLowerCase();
            if (!jobTitle && titleKeywords.some(t => lower.includes(t))) {
                jobTitle = line; return;
            }
            if (!company && companyKeywords.some(c => lower.includes(c))) {
                company = line; return;
            }
            if (!name && line.split(' ').length >= 2 && line.split(' ').length <= 4 && !line.includes('@') && !/\d/.test(line) && !line.toLowerCase().includes('www')) {
                name = line;
            }
        });

        const highlightField = (el, val) => {
            if (el && val) {
                el.value = val;
                el.style.borderColor = '#10B981';
                el.style.backgroundColor = 'rgba(16, 185, 129, 0.08)';
                setTimeout(() => {
                    el.style.backgroundColor = 'transparent';
                }, 2500);
            }
        };

        highlightField(document.getElementById('contact_name'), name);
        highlightField(document.getElementById('contact_email'), email);
        highlightField(document.getElementById('contact_phone'), phone);
        highlightField(document.getElementById('contact_company'), company);
        highlightField(document.getElementById('contact_job_title'), jobTitle);

        statusEl.style.backgroundColor = 'rgba(16, 185, 129, 0.15)';
        statusEl.style.color = '#065F46';
        statusEl.innerHTML = `<i class="fas fa-check-circle"></i> <span>✨ Visiting Card Scanned & Form Auto-Filled!</span>`;
        dropZone.style.borderColor = '#10B981';
    } catch (e) {
        console.error('OCR error:', e);
        statusEl.style.backgroundColor = 'rgba(239, 68, 68, 0.1)';
        statusEl.style.color = '#B91C1C';
        statusEl.innerHTML = `<i class="fas fa-exclamation-circle"></i> <span>Card uploaded! Please review details below.</span>`;
    }
}
</script>

<?php include 'includes/footer.php'; ?>
