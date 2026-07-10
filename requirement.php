<?php
session_start();
require_once 'includes/helpers.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF Check
    verify_csrf_token();

    $file = get_data_file_path('contacts.json');
    $current = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    
    // Sanitization
    $lead_data = [
        'name' => htmlspecialchars(strip_tags(trim($_POST['name'] ?? 'Employer Contact'))),
        'company' => htmlspecialchars(strip_tags(trim($_POST['company'] ?? ''))),
        'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'job_titles' => htmlspecialchars(strip_tags(trim($_POST['job_titles'] ?? ''))),
        'vacancies' => htmlspecialchars(strip_tags(trim($_POST['vacancies'] ?? ''))),
        'timeline' => htmlspecialchars(strip_tags(trim($_POST['timeline'] ?? ''))),
        'subject' => 'Hiring Requirement Submitted by ' . htmlspecialchars(strip_tags(trim($_POST['company'] ?? ''))),
        'message' => 'Hiring Requirement details: Jobs - ' . htmlspecialchars(strip_tags(trim($_POST['job_titles'] ?? ''))) . 
                     ' | Vacancies - ' . htmlspecialchars(strip_tags(trim($_POST['vacancies'] ?? ''))) . 
                     ' | Timeline - ' . htmlspecialchars(strip_tags(trim($_POST['timeline'] ?? ''))),
        'date' => date('Y-m-d H:i:s')
    ];
    $current[] = $lead_data;
    
    file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));
    
    // Push to Zoho CRM
    send_to_zoho_crm($lead_data);
    header("Location: thankyou.php");
    exit;
}

$page_title = "Tell Us Your Requirement | PrimePath HR";
require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header"
    style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); padding: 120px 0 80px; text-align: center; color: white;">
    <div class="container">
        <h1 style="font-family: var(--font-heading); font-size: 42px; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">Tell Us Your Hiring Requirement
        </h1>
        <p style="font-size: 18px; opacity: 0.9; max-width: 600px; margin: 0 auto;">Partner with our overseas recruitment agency for expert foreign worker recruitment and deployment solutions.</p>
    </div>
</section>

<!-- Requirement Form Section -->
<section class="section section-bg-light" style="padding: 100px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1100px; margin: 0 auto; align-items: start;">
            
            <!-- Left Info Column -->
            <div class="animate-up delay-1">
                <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy); margin-bottom: 20px;">Are you Hiring?</h2>
                <h3 style="font-size: 22px; color: var(--secondary-blue); margin-bottom: 30px;">Send your requirement to our overseas employment agency</h3>
                
                <p style="font-size: 16px; color: var(--text-dark); line-height: 1.8; margin-bottom: 25px;">
                    PrimePath HR is a leading international recruiting agency sourcing skilled talent for employers in Malta. We exclusively source trade-tested, visa-ready talent from our strategic hub in the United Arab Emirates.
                </p>
                <p style="font-size: 16px; color: var(--text-dark); line-height: 1.8; margin-bottom: 35px;">
                    To get started, simply share your hiring requirement with us—include job titles, number of positions, required qualifications, and expected timeline. We streamline the process and ensure you receive quality candidates quickly.
                </p>
                
                <div style="background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 20px;">
                    <div style="width: 50px; height: 50px; background: rgba(14, 165, 233, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 24px;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <span style="display: block; font-size: 14px; color: var(--text-muted); margin-bottom: 5px;">Prefer to speak directly?</span>
                        <a href="tel:+971545480972" style="font-family: var(--font-heading); font-size: 20px; font-weight: 600; color: var(--primary-navy); text-decoration: none;">+971 54 548 0972</a>
                    </div>
                </div>
            </div>

            <!-- Right Form Column -->
            <div class="animate-up delay-2" style="background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <form action="requirement.php" method="POST" id="requirementForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Full Name *</label>
                            <input type="text" name="name" required style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; transition: border-color 0.3s;">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Company Name *</label>
                            <input type="text" name="company" required style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; transition: border-color 0.3s;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Email Address *</label>
                            <input type="email" name="email" required style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; transition: border-color 0.3s;">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Phone Number *</label>
                            <input type="tel" name="phone" required style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; transition: border-color 0.3s;">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Required Job Titles *</label>
                        <textarea name="job_titles" required rows="3" placeholder="e.g. 5 Masons, 3 Electricians, 10 Retail Associates" style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; transition: border-color 0.3s; resize: vertical;"></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group" style="margin-bottom: 25px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Total Vacancies</label>
                            <select name="vacancies" style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; background: white;">
                                <option value="1-5">1 - 5</option>
                                <option value="6-20">6 - 20</option>
                                <option value="21-50">21 - 50</option>
                                <option value="50+">50+</option>
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 25px;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: var(--primary-navy); margin-bottom: 8px;">Expected Timeline</label>
                            <select name="timeline" style="width: 100%; padding: 14px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 12px; font-size: 15px; outline: none; background: white;">
                                <option value="Immediate (ASAP)">Immediate (ASAP)</option>
                                <option value="Within 1 Month">Within 1 Month</option>
                                <option value="1-3 Months">1 - 3 Months</option>
                                <option value="More than 3 Months">More than 3 Months</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 16px; font-size: 16px; font-weight: 600; border-radius: 12px;">Submit Requirement</button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<!-- Industries Section -->
<section class="section" style="background: white; padding: 80px 0;">
    <div class="container" style="max-width: 900px; margin: 0 auto; text-align: center;">
        <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy); margin-bottom: 40px;">Industries We Place Talent In</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
            <div style="padding: 20px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--border-color);">
                <i class="fas fa-utensils" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0;">Hospitality & F&B</h4>
            </div>
            <div style="padding: 20px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--border-color);">
                <i class="fas fa-shopping-bag" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0;">Retail & Sales</h4>
            </div>
            <div style="padding: 20px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--border-color);">
                <i class="fas fa-hard-hat" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0;">Construction</h4>
            </div>
            <div style="padding: 20px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--border-color);">
                <i class="fas fa-truck-loading" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0;">Logistics & Warehousing</h4>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section" style="background: var(--bg-light); padding: 80px 0; border-top: 1px solid var(--border-color);">
    <div class="container" style="max-width: 900px; margin: 0 auto;">
        <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy); margin-bottom: 40px; text-align: center;">Why Employers Work With PrimePath</h2>
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; gap: 20px; align-items: flex-start; background: white; padding: 25px; border-radius: 16px; box-shadow: var(--shadow-sm);">
                <div style="min-width: 40px; height: 40px; background: rgba(14, 165, 233, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 18px;"><i class="fas fa-check"></i></div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 8px;">Trade-Tested Quality</h4>
                    <p style="color: var(--text-muted); font-size: 15px; margin: 0;">All candidates are physically tested and vetted in the UAE before shortlisting, ensuring immediate productivity.</p>
                </div>
            </div>
            <div style="display: flex; gap: 20px; align-items: flex-start; background: white; padding: 25px; border-radius: 16px; box-shadow: var(--shadow-sm);">
                <div style="min-width: 40px; height: 40px; background: rgba(14, 165, 233, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 18px;"><i class="fas fa-check"></i></div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 8px;">Turnkey Visa Processing</h4>
                    <p style="color: var(--text-muted); font-size: 15px; margin: 0;">We manage the entire Identity Malta Single Permit application process locally, removing the administrative burden from your team.</p>
                </div>
            </div>
            <div style="display: flex; gap: 20px; align-items: flex-start; background: white; padding: 25px; border-radius: 16px; box-shadow: var(--shadow-sm);">
                <div style="min-width: 40px; height: 40px; background: rgba(14, 165, 233, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 18px;"><i class="fas fa-check"></i></div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 8px;">Speed to Deployment</h4>
                    <p style="color: var(--text-muted); font-size: 15px; margin: 0;">By sourcing from the UAE, we bypass the complexities of direct-from-Asia recruitment, significantly reducing deployment times.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section" style="background: white; padding: 80px 0; border-top: 1px solid var(--border-color);">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy); margin-bottom: 40px; text-align: center;">Frequently Asked Questions</h2>
        
        <div style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #e2e8f0;">
            <h4 style="font-size: 18px; color: var(--primary-navy); margin-bottom: 10px;">How long does deployment take from the UAE to Malta?</h4>
            <p style="color: var(--text-muted); line-height: 1.6; margin: 0;">Once the Identity Malta Single Permit is approved, deployment generally takes 15-30 days, including final exit formalities and flights.</p>
        </div>
        
        <div style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #e2e8f0;">
            <h4 style="font-size: 18px; color: var(--primary-navy); margin-bottom: 10px;">Do you guarantee the skills of the candidates?</h4>
            <p style="color: var(--text-muted); line-height: 1.6; margin: 0;">Yes. Our 95%+ success rate is driven by mandatory practical trade testing conducted at our UAE facilities before any candidate is presented to you.</p>
        </div>
        
        <div style="margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #e2e8f0;">
            <h4 style="font-size: 18px; color: var(--primary-navy); margin-bottom: 10px;">Can you handle large volume requests?</h4>
            <p style="color: var(--text-muted); line-height: 1.6; margin: 0;">Absolutely. We regularly process cohorts of 300+ candidates for hospitality and construction projects, managing everything from bulk interviews to synchronized visa applications.</p>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
