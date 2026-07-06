<?php
session_start();
$page_title = "For Employers | HR Consultancy & Executive Search in Dubai";
$meta_description = "PrimePath HR provides premium executive search, strategic HR, and payroll outsourcing services for employers in the UAE and GCC.";
include 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); padding: 120px 0 80px; text-align: center; color: white;">
    <div class="container">
        <h1 style="font-size: 42px; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">HR Consultancy & Executive Search in Dubai</h1>
        <p style="font-size: 18px; opacity: 0.9; max-width: 700px; margin: 0 auto;">Partner with the leading recruitment agency in the Middle East to find top talent and streamline your HR operations.</p>
    </div>
</section>

<!-- Employer Services -->
<section class="section" style="padding: 80px 0; background-color: var(--bg-light);">
    <div class="container">
        <div class="section-title text-center" style="margin-bottom: 50px;">
            <h2>Bespoke <span>B2B Services</span></h2>
            <p style="color: var(--text-muted); max-width: 600px; margin: 15px auto 0;">Comprehensive solutions tailored for enterprise clients across the GCC.</p>
        </div>
        
        <div class="service-cards" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <div class="value-card animate-up delay-1" style="background: white; padding: 40px 30px; border-radius: 16px; box-shadow: var(--shadow-sm); border-bottom: 4px solid var(--secondary-blue);">
                <div class="value-icon" style="color: var(--secondary-blue); font-size: 40px; margin-bottom: 20px;"><i class="fas fa-user-tie"></i></div>
                <h3 style="font-size: 22px; margin-bottom: 15px;">Executive Search</h3>
                <p style="color: var(--text-muted); margin-bottom: 20px;">We leverage a vast global network to identify and recruit C-suite executives and senior leaders who align perfectly with your corporate vision.</p>
                <a href="contact.php?service=executive" style="color: var(--primary-navy); font-weight: 600;">Start a Search <i class="fas fa-arrow-right" style="margin-left: 5px;"></i></a>
            </div>
            
            <div class="value-card animate-up delay-2" style="background: white; padding: 40px 30px; border-radius: 16px; box-shadow: var(--shadow-sm); border-bottom: 4px solid var(--primary-navy);">
                <div class="value-icon" style="color: var(--primary-navy); font-size: 40px; margin-bottom: 20px;"><i class="fas fa-chart-line"></i></div>
                <h3 style="font-size: 22px; margin-bottom: 15px;">Strategic HR</h3>
                <p style="color: var(--text-muted); margin-bottom: 20px;">From organizational restructuring to talent mapping and performance management, we optimize your human capital for long-term growth.</p>
                <a href="contact.php?service=strategic" style="color: var(--primary-navy); font-weight: 600;">Consult with Us <i class="fas fa-arrow-right" style="margin-left: 5px;"></i></a>
            </div>
            
            <div class="value-card animate-up delay-3" style="background: white; padding: 40px 30px; border-radius: 16px; box-shadow: var(--shadow-sm); border-bottom: 4px solid var(--secondary-blue);">
                <div class="value-icon" style="color: var(--secondary-blue); font-size: 40px; margin-bottom: 20px;"><i class="fas fa-file-invoice-dollar"></i></div>
                <h3 style="font-size: 22px; margin-bottom: 15px;">Payroll Outsourcing</h3>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Fully compliant, error-free payroll management ensuring timely processing aligned with MOHRE regulations and WPS requirements.</p>
                <a href="contact.php?service=payroll" style="color: var(--primary-navy); font-weight: 600;">Get a Quote <i class="fas fa-arrow-right" style="margin-left: 5px;"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section" style="padding: 80px 0;">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size: 32px; margin-bottom: 20px;">Why Enterprise Clients Choose PrimePath</h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 15px; display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fas fa-check-circle" style="color: var(--secondary-blue); margin-top: 5px;"></i>
                        <div>
                            <strong>Extensive Talent Pool</strong>
                            <p style="color: var(--text-muted); margin: 5px 0 0; font-size: 15px;">Access to highly vetted professionals ready to relocate or start immediately.</p>
                        </div>
                    </li>
                    <li style="margin-bottom: 15px; display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fas fa-check-circle" style="color: var(--secondary-blue); margin-top: 5px;"></i>
                        <div>
                            <strong>MOHRE Compliance</strong>
                            <p style="color: var(--text-muted); margin: 5px 0 0; font-size: 15px;">Strict adherence to UAE labor laws and regulations.</p>
                        </div>
                    </li>
                    <li style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fas fa-check-circle" style="color: var(--secondary-blue); margin-top: 5px;"></i>
                        <div>
                            <strong>Dedicated Account Managers</strong>
                            <p style="color: var(--text-muted); margin: 5px 0 0; font-size: 15px;">Single point of contact for seamless communication and delivery.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="flex: 1; min-width: 300px; background: var(--primary-navy); color: white; padding: 40px; border-radius: 16px;">
                <h3 style="color: white; margin-bottom: 20px;">Ready to hire?</h3>
                <p style="margin-bottom: 30px; opacity: 0.9;">Drop us a message and our B2B team will contact you within 24 hours.</p>
                <form action="contact.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    <div style="margin-bottom: 15px;">
                        <input type="text" name="company" placeholder="Company Name" required style="width: 100%; padding: 12px; border-radius: 8px; border: none;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <input type="email" name="email" placeholder="Business Email" required style="width: 100%; padding: 12px; border-radius: 8px; border: none;">
                    </div>
                    <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: rgba(255,255,255,0.9); text-align: left;">
                        <input type="checkbox" id="accept_terms_emp" name="accept_terms" required style="margin-top: 3px; cursor: pointer;">
                        <label for="accept_terms_emp" style="cursor: pointer;">I agree to the <a href="terms.php" target="_blank" style="color: white; text-decoration: underline;">Terms & Conditions</a> and <a href="privacy.php" target="_blank" style="color: white; text-decoration: underline;">Privacy Policy</a>.</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; background: var(--secondary-blue);">Request Callback</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
