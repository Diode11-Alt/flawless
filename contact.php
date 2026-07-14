<?php
session_start();
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("CONTACT.PHP POST received from: " . ($_SERVER['HTTP_REFERER'] ?? 'unknown'));
    error_log("POST data: " . json_encode($_POST));
    
    verify_csrf_token();

    $file = get_data_file_path('contacts.json');
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    
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
    
    $result = send_to_zoho_crm($lead_data);
    error_log("ZOHO CRM PUSH RESULT: " . ($result ? "SUCCESS" : "FAILED"));
    header("Location: thankyou.php");
    exit;
}

$page_title = "Contact Us | PrimePath HR";
require_once 'includes/header.php';
?>

<!-- Premium Page Hero with Map Background effect -->
<section class="page-hero" style="position: relative; overflow: hidden; padding: 120px 0 80px;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); mix-blend-mode: overlay;"></div>
    <div class="container reveal" style="text-align: center; max-width: 900px; position: relative; z-index: 2;">
        <span style="display: inline-block; padding: 6px 16px; border-radius: 20px; background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.3); color: var(--secondary-blue); font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px;">Get in Touch</span>
        <h1 class="page-hero-title" style="font-size: 56px; margin-bottom: 24px;">Let's Build Your Team</h1>
        <p class="page-hero-subtitle" style="font-size: 20px;">Reach out to our experts in Dubai for executive search, volume staffing, Emiratization services, or HR Outsourcing assistance across the GCC and Europe.</p>
    </div>
</section>

<section class="section" style="padding: 60px 0 100px; background: #f8fafc; border-bottom: 1px solid rgba(0,0,0,0.05);">
    <div class="container">
        
        <?php if($message): ?>
        <div style="background: rgba(37,99,235,0.1); color: var(--secondary-blue); padding: 20px; border-radius: 12px; margin-bottom: 40px; text-align: center; font-weight: 500; font-size: 18px; border: 1px solid rgba(37,99,235,0.2);">
            <?= htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>

        <!-- Wide Interactive Grid -->
        <div class="grid-2" style="gap: 40px; align-items: stretch;">
            
            <!-- Left Side: Interactive Contact Info & Map Card -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                
                <div class="bawaal-glass reveal delay-100" style="padding: 40px; height: 100%; display: flex; flex-direction: column;">
                    <h3 style="font-family: var(--font-heading); font-size: 28px; color: var(--primary-navy-dark); font-weight: 700; margin-bottom: 30px;">Contact Information</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 30px; margin-bottom: 40px; flex-grow: 1;">
                        <div style="display: flex; align-items: flex-start; gap: 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                            <div style="width: 56px; height: 56px; background: rgba(37,99,235,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--secondary-blue); flex-shrink: 0;">
                                <i data-lucide="map-pin"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--primary-navy-dark); margin-bottom: 8px; font-weight: 700; font-size: 18px;">Global Headquarters</h4>
                                <span style="color: var(--text-dark); line-height: 1.6; display: block; font-size: 15px;">
                                    Census Travel & Tourism<br>
                                    Business Village, Block B - Office 923<br>
                                    Deira, Dubai<br>
                                    United Arab Emirates
                                </span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                            <div style="width: 56px; height: 56px; background: rgba(37,99,235,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--secondary-blue); flex-shrink: 0;">
                                <i data-lucide="phone"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--primary-navy-dark); margin-bottom: 8px; font-weight: 700; font-size: 18px;">Phone / WhatsApp</h4>
                                <a href="tel:+971545480972" style="color: var(--text-dark); font-size: 15px; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--secondary-blue)'" onmouseout="this.style.color='var(--text-dark)'">+971 54 548 0972</a>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 20px; transition: transform 0.3s;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                            <div style="width: 56px; height: 56px; background: rgba(37,99,235,0.1); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--secondary-blue); flex-shrink: 0;">
                                <i data-lucide="mail"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--primary-navy-dark); margin-bottom: 8px; font-weight: 700; font-size: 18px;">Email Address</h4>
                                <a href="mailto:info@primepathuae.com" style="color: var(--text-dark); font-size: 15px; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--secondary-blue)'" onmouseout="this.style.color='var(--text-dark)'">info@primepathuae.com</a>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Google Map Block -->
                    <div style="width: 100%; height: 250px; border-radius: 16px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.2709230554256!2d55.32162597514194!3d25.2614995776735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5cc114fc823d%3A0xe54fb1d21f8a846f!2sBusiness%20Village%20-%20Block%20B!5e0!3m2!1sen!2sae!4v1708455123456!5m2!1sen!2sae" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <!-- Right Side: The Premium Form -->
            <div class="bawaal-glass reveal delay-200" style="padding: 50px; border-top: 4px solid var(--secondary-blue);">
                <h3 style="font-family: var(--font-heading); font-size: 28px; color: var(--primary-navy-dark); font-weight: 700; margin-bottom: 10px;">Send an Inquiry</h3>
                <p style="color: var(--text-dark); margin-bottom: 30px; font-size: 15px;">Fill out the form below and our recruitment consultants will get back to you within 24 hours.</p>
                
                <form action="contact.php" method="POST" enctype="multipart/form-data" id="inquiryForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="shadcn-label" for="contact_name" style="color: var(--primary-navy-dark); font-weight: 600;">Full Name</label>
                            <input type="text" name="name" id="contact_name" required class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px;" autocomplete="name">
                        </div>
                        
                        <div class="form-group">
                            <label class="shadcn-label" for="contact_phone" style="color: var(--primary-navy-dark); font-weight: 600;">Phone / WhatsApp</label>
                            <input type="tel" name="phone" id="contact_phone" required class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px;" autocomplete="tel">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label class="shadcn-label" for="contact_email" style="color: var(--primary-navy-dark); font-weight: 600;">Email Address</label>
                        <input type="email" name="email" id="contact_email" required class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px;" autocomplete="email">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 25px; padding: 15px; background: rgba(37,99,235,0.03); border-radius: 12px; border: 1px solid rgba(37,99,235,0.1);">
                        <p class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600; margin-bottom: 12px;">I am a:</p>
                        <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 15px; color: var(--primary-navy-dark); font-weight: 500;">
                                <input type="radio" name="inquiry_type" value="employer" onchange="toggleFields()" checked style="width: 18px; height: 18px; accent-color: var(--secondary-blue);"> Employer / Company
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 15px; color: var(--text-dark);">
                                <input type="radio" name="inquiry_type" value="employee" onchange="toggleFields()" style="width: 18px; height: 18px; accent-color: var(--secondary-blue);"> Candidate / Job Seeker
                            </label>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group" id="company_group">
                            <label class="shadcn-label" for="contact_company" style="color: var(--primary-navy-dark); font-weight: 600;">Company Name</label>
                            <input type="text" name="company" id="contact_company" class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px;">
                        </div>

                        <div class="form-group" id="job_title_group" style="display: none;">
                            <label class="shadcn-label" for="contact_job_title" style="color: var(--primary-navy-dark); font-weight: 600;">Job Title / Role</label>
                            <input type="text" name="job_title" id="contact_job_title" class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px;">
                        </div>
                        
                        <?php $requested_service = $_GET['service'] ?? ''; ?>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="shadcn-label" for="contact_subject" style="color: var(--primary-navy-dark); font-weight: 600;">Topic / Service Required</label>
                            <select name="subject" id="contact_subject" class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px;">
                                <option value="" disabled <?= empty($requested_service) ? 'selected' : '' ?>>Select a Service</option>
                                <option value="Executive Search" <?= $requested_service === 'Executive Search' ? 'selected' : '' ?>>Executive Search & Specialist Recruitment</option>
                                <option value="HR Outsourcing" <?= $requested_service === 'HR Outsourcing' ? 'selected' : '' ?>>Comprehensive HR Outsourcing</option>
                                <option value="Corporate Training" <?= $requested_service === 'Corporate Training' ? 'selected' : '' ?>>Corporate Training & Development</option>
                                <option value="HR Compliance" <?= $requested_service === 'HR Compliance' ? 'selected' : '' ?>>HR Compliance & Legal Structuring</option>
                                <option value="Emiratization" <?= $requested_service === 'Emiratization' ? 'selected' : '' ?>>Emiratization (Tawteen)</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <?php
                    $calc_msg = '';
                    if (($_GET['source'] ?? '') === 'calculator') {
                        $sal = htmlspecialchars($_GET['salary'] ?? '');
                        $tot = htmlspecialchars($_GET['total'] ?? '');
                        $calc_msg = "Inquiry via Deployment Calculator:\n- Base Salary: € {$sal}\n- Estimated Total Monthly Budget: € {$tot}\nWe would like to request an official proposal & consultation.";
                    }
                    ?>
                    <div class="form-group" style="margin-bottom: 25px;">
                        <label class="shadcn-label" for="contact_message" style="color: var(--primary-navy-dark); font-weight: 600;">Message</label>
                        <textarea name="message" id="contact_message" rows="5" required class="shadcn-input" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.1); color: var(--text-dark); border-radius: 8px; padding: 12px 16px; resize: vertical;"><?= $calc_msg ?></textarea>
                    </div>
                    
                    <div style="margin-bottom: 30px; display: flex; align-items: flex-start; gap: 12px;">
                        <input type="checkbox" id="accept_terms" name="accept_terms" required style="margin-top: 4px; width: 16px; height: 16px; accent-color: var(--secondary-blue);">
                        <label for="accept_terms" style="font-size: 14px; color: var(--text-dark); cursor: pointer; line-height: 1.5;">
                            I agree to the <a href="terms.php" target="_blank" style="color: var(--secondary-blue); text-decoration: none; font-weight: 500;">Terms & Conditions</a> and <a href="privacy.php" target="_blank" style="color: var(--secondary-blue); text-decoration: none; font-weight: 500;">Privacy Policy</a>.
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-secondary" style="width: 100%; padding: 16px; font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; border-radius: 8px; transition: all 0.3s; display: flex; justify-content: center; align-items: center; gap: 10px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(37,99,235,0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        Send Inquiry <i data-lucide="send" style="width: 18px;"></i>
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<script>
function toggleFields() {
    const type = document.querySelector('input[name="inquiry_type"]:checked').value;
    const companyGroup = document.getElementById('company_group');
    const jobGroup = document.getElementById('job_title_group');
    const labels = document.querySelectorAll('input[name="inquiry_type"]');
    
    labels.forEach(radio => {
        const parent = radio.parentElement;
        if(radio.checked) {
            parent.style.color = 'var(--primary-navy-dark)';
            parent.style.fontWeight = '500';
        } else {
            parent.style.color = 'var(--text-dark)';
            parent.style.fontWeight = '400';
        }
    });

    const serviceGroup = document.getElementById('contact_subject').parentElement;

    if (type === 'employer') {
        companyGroup.style.display = 'block';
        companyGroup.style.gridColumn = 'span 2';
        jobGroup.style.display = 'none';
        serviceGroup.style.display = 'block';
    } else {
        companyGroup.style.display = 'none';
        jobGroup.style.display = 'block';
        jobGroup.style.gridColumn = 'span 2';
        serviceGroup.style.display = 'none';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
