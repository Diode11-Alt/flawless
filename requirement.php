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

<!-- Page Header (Inherited from Homepage DNA) -->
<section class="page-hero">
    <div class="container reveal" style="text-align: center; max-width: 850px;">
        <span style="display: inline-block; padding: 6px 16px; border-radius: 20px; background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.3); color: var(--secondary-blue); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px;">For Employers</span>
        <h1 class="page-hero-title">Tell Us Your Hiring Requirement</h1>
        <p class="page-hero-subtitle">Partner with PrimePath to source, vet, and recruit the high-caliber talent your business needs across the UAE and GCC region.</p>
    </div>
</section>

<!-- Requirement Form Section -->
<section class="section" style="padding: 100px 0; background: #f8fafc; border-bottom: 1px solid rgba(0,0,0,0.05);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1100px; margin: 0 auto; align-items: start;">
            
            <!-- Left Info Column -->
            <div class="animate-up delay-1">
                <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy-dark); margin-bottom: 20px; font-weight: 800;">Are you Hiring?</h2>
                <h3 style="font-size: 22px; color: var(--secondary-blue); margin-bottom: 30px; font-weight: 600;">Send your requirement to our overseas employment agency</h3>
                
                <p style="color: var(--text-dark); font-size: 16px; margin-bottom: 25px; line-height: 1.7;">PrimePath HR is a premier recruitment consultancy sourcing top talent for employers across the UAE, the broader GCC region, and Europe. Every candidate is trade-tested and thoroughly vetted before you ever see a profile.</p>
                <p style="font-size: 16px; color: var(--text-dark); line-height: 1.8; margin-bottom: 35px;">
                    To get started, simply share your hiring requirement with us—include job titles, number of positions, required qualifications, and expected timeline. We streamline the process and ensure you receive quality candidates quickly.
                </p>
                
                <div class="bawaal-glass" style="padding: 25px; display: flex; align-items: center; gap: 20px; border-left: 4px solid var(--secondary-blue);">
                    <div style="width: 50px; height: 50px; background: rgba(37,99,235,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 24px;">
                        <i data-lucide="phone"></i>
                    </div>
                    <div>
                        <span style="display: block; font-size: 14px; color: var(--text-dark); font-weight: 500; margin-bottom: 5px;">Prefer to speak directly?</span>
                        <a href="tel:+971545480972" style="font-family: var(--font-heading); font-size: 20px; font-weight: 700; color: var(--primary-navy-dark); text-decoration: none;">+971 54 548 0972</a>
                    </div>
                </div>
            </div>

            <!-- Right Form Column -->
            <div class="bawaal-glass animate-up delay-2" style="padding: 40px; border-top: 4px solid var(--secondary-blue);">
                <form action="requirement.php" method="POST" id="requirementForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Full Name *</label>
                            <input type="text" name="name" required class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Company Name *</label>
                            <input type="text" name="company" required class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Email Address *</label>
                            <input type="email" name="email" required class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Phone Number *</label>
                            <input type="tel" name="phone" required class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Job Titles Needed *</label>
                        <input type="text" name="job_titles" placeholder="e.g. Mechanical Engineer, Sous Chef, IT Support" required class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Total Vacancies</label>
                            <select name="vacancies" class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                                <option value="1-5">1 - 5</option>
                                <option value="6-20">6 - 20</option>
                                <option value="21-50">21 - 50</option>
                                <option value="50+">50+</option>
                            </select>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label class="shadcn-label" style="color: var(--primary-navy-dark); font-weight: 600;">Expected Timeline *</label>
                            <select name="timeline" required class="shadcn-input" style="background: rgba(0,0,0,0.02); color: var(--text-dark); border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; padding: 12px 16px;">
                                <option value="Immediately">Immediately</option>
                                <option value="Within 1 Month">Within 1 Month</option>
                                <option value="1-3 Months">1-3 Months</option>
                                <option value="Planning Phase">Planning Phase</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-secondary" style="width: 100%; padding: 16px; font-size: 16px; font-weight: 700; border-radius: 8px; text-transform: uppercase; letter-spacing: 1px; display: flex; justify-content: center; align-items: center; gap: 10px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(37,99,235,0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        Submit Requirement <i data-lucide="arrow-right"></i>
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<!-- Industries Section -->
<section class="section" style="background: transparent; padding: 80px 0;">
    <div class="container" style="max-width: 900px; margin: 0 auto; text-align: center;">
        <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy-dark); margin-bottom: 40px; font-weight: 800;">Industries We Place Talent In</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
            <div class="bawaal-glass" style="padding: 24px; border-radius: 16px;">
                <i data-lucide="utensils" style="width: 32px; height: 32px; color: var(--secondary-blue); margin: 0 auto 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0; color: var(--primary-navy-dark); font-weight: 600;">Hospitality & F&B</h4>
            </div>
            <div class="bawaal-glass" style="padding: 24px; border-radius: 16px;">
                <i data-lucide="shopping-bag" style="width: 32px; height: 32px; color: var(--secondary-blue); margin: 0 auto 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0; color: var(--primary-navy-dark); font-weight: 600;">Retail & Sales</h4>
            </div>
            <div class="bawaal-glass" style="padding: 24px; border-radius: 16px;">
                <i data-lucide="hard-hat" style="width: 32px; height: 32px; color: var(--secondary-blue); margin: 0 auto 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0; color: var(--primary-navy-dark); font-weight: 600;">Construction</h4>
            </div>
            <div class="bawaal-glass" style="padding: 24px; border-radius: 16px;">
                <i data-lucide="truck" style="width: 32px; height: 32px; color: var(--secondary-blue); margin: 0 auto 15px;"></i>
                <h4 style="font-size: 18px; margin-bottom: 0; color: var(--primary-navy-dark); font-weight: 600;">Logistics & Warehousing</h4>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section" style="padding: 80px 0; background: #f8fafc; border-top: 1px solid rgba(0,0,0,0.05);">
    <div class="container" style="max-width: 900px; margin: 0 auto;">
        <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy-dark); margin-bottom: 40px; text-align: center; font-weight: 800;">Why Employers Work With PrimePath</h2>
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="bawaal-glass" style="display: flex; gap: 20px; align-items: flex-start; padding: 25px; border-radius: 16px; border-left: 4px solid var(--secondary-blue);">
                <div style="min-width: 40px; height: 40px; background: rgba(37,99,235,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 18px;"><i data-lucide="check"></i></div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 8px; color: var(--primary-navy-dark); font-weight: 700;">Trade-Tested Quality</h4>
                    <p style="color: var(--text-dark); font-size: 15px; margin: 0; line-height: 1.6;">All candidates are physically tested and vetted before shortlisting, ensuring immediate productivity.</p>
                </div>
            </div>
            <div class="bawaal-glass" style="display: flex; gap: 20px; align-items: flex-start; padding: 25px; border-radius: 16px; border-left: 4px solid var(--secondary-blue);">
                <div style="min-width: 40px; height: 40px; background: rgba(37,99,235,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 18px;"><i data-lucide="check"></i></div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 8px; color: var(--primary-navy-dark); font-weight: 700;">Turnkey Visa Processing</h4>
                    <p style="color: var(--text-dark); font-size: 15px; margin: 0; line-height: 1.6;">We manage the entire Work Permit application process locally, removing the administrative burden from your team.</p>
                </div>
            </div>
            <div class="bawaal-glass" style="display: flex; gap: 20px; align-items: flex-start; padding: 25px; border-radius: 16px; border-left: 4px solid var(--secondary-blue);">
                <div style="min-width: 40px; height: 40px; background: rgba(37,99,235,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 18px;"><i data-lucide="check"></i></div>
                <div>
                    <h4 style="font-size: 18px; margin-bottom: 8px; color: var(--primary-navy-dark); font-weight: 700;">Speed to Deployment</h4>
                    <p style="color: var(--text-dark); font-size: 15px; margin: 0; line-height: 1.6;">By sourcing through our global networks, we bypass the complexities of unstructured recruitment, significantly reducing deployment times.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section" style="background: transparent; padding: 80px 0; border-top: 1px solid rgba(0,0,0,0.05);">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-family: var(--font-heading); font-size: 32px; color: var(--primary-navy-dark); margin-bottom: 40px; text-align: center; font-weight: 800;">Frequently Asked Questions</h2>
        
        <div class="bawaal-glass" style="margin-bottom: 20px; padding: 28px; border-radius: 16px;">
            <h4 style="font-size: 18px; color: var(--primary-navy-dark); font-weight: 700; margin-bottom: 10px;">How long does deployment take to the UAE?</h4>
            <p style="color: var(--text-dark); line-height: 1.6; margin: 0;">Once the MOHRE Work Permit is approved, deployment generally takes 15-30 days, including final exit formalities and flights.</p>
        </div>
        
        <div class="bawaal-glass" style="margin-bottom: 20px; padding: 28px; border-radius: 16px;">
            <h4 style="font-size: 18px; color: var(--primary-navy-dark); font-weight: 700; margin-bottom: 10px;">Do you guarantee the skills of the candidates?</h4>
            <p style="color: var(--text-dark); line-height: 1.6; margin: 0;">Yes. Our 95%+ success rate is driven by mandatory practical trade testing conducted at our partner facilities before any candidate is presented to you.</p>
        </div>
        
        <div class="bawaal-glass" style="margin-bottom: 20px; padding: 28px; border-radius: 16px;">
            <h4 style="font-size: 18px; color: var(--primary-navy-dark); font-weight: 700; margin-bottom: 10px;">Can you handle large volume requests?</h4>
            <p style="color: var(--text-dark); line-height: 1.6; margin: 0;">Absolutely. We regularly process cohorts of 300+ candidates for hospitality and construction projects, managing everything from bulk interviews to synchronized visa applications.</p>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
