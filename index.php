<?php 
$page_title = "International Staffing & Global Mobility | PrimePath HR";
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); padding: 120px 0 80px; text-align: center; color: white;">
    <div class="container" style="max-width: 900px;">
        <span style="display: inline-block; padding: 6px 16px; background: rgba(255,255,255,0.1); border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.2);">Malta's Premier Staffing Partner</span>
        <h1 style="font-family: var(--font-heading); font-size: 48px; margin-bottom: 20px; font-weight: 700; line-height: 1.2;">
            Connecting Malta with Great Global Talent
        </h1>
        <p style="font-size: 20px; opacity: 0.9; margin-bottom: 40px; line-height: 1.6;">
            We take the stress out of international hiring so you can focus on building your business. From sourcing to visas and flights, we handle everything.
        </p>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="requirement.php" class="btn btn-primary" style="background: white; color: var(--primary-navy); padding: 16px 36px; font-size: 18px; font-weight: 700; border-radius: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                Tell Us Your Requirement &rarr;
            </a>
            <a href="solutions.php" class="btn btn-outline" style="border: 1px solid rgba(255,255,255,0.5); color: white; padding: 16px 36px; font-size: 18px; font-weight: 600; border-radius: 30px;">
                Our Services
            </a>
        </div>
    </div>
</section>

<!-- Core Services -->
<section class="section section-bg-light" style="padding: 100px 0;">
    <div class="container">
        <div class="section-title text-center" style="margin-bottom: 60px;">
            <h2 style="font-family: var(--font-heading); font-size: 36px; color: var(--primary-navy);">Simple Solutions for Growing Teams</h2>
            <p style="color: var(--text-muted); font-size: 18px; max-width: 600px; margin: 0 auto;">Everything you need to hire, relocate, and onboard international staff in Malta.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            
            <div class="value-card animate-up delay-1" style="background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center;">
                <div style="width: 70px; height: 70px; background: rgba(14, 165, 233, 0.1); color: var(--secondary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 20px auto;">
                    <i class="fas fa-users"></i>
                </div>
                <h3 style="font-family: var(--font-heading); font-size: 22px; color: var(--primary-navy); margin-bottom: 15px;">Volume Staffing</h3>
                <p style="color: var(--text-muted); font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    We recruit pre-vetted, trade-tested staff for hospitality, retail, and construction directly from our global sourcing hubs.
                </p>
            </div>
            
            <div class="value-card animate-up delay-2" style="background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center;">
                <div style="width: 70px; height: 70px; background: rgba(14, 165, 233, 0.1); color: var(--secondary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 20px auto;">
                    <i class="fas fa-passport"></i>
                </div>
                <h3 style="font-family: var(--font-heading); font-size: 22px; color: var(--primary-navy); margin-bottom: 15px;">Visa & Immigration</h3>
                <p style="color: var(--text-muted); font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    We manage Identity Malta Single Permit applications and coordinate embassy appointments so you don't have to.
                </p>
            </div>
            
            <div class="value-card animate-up delay-3" style="background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center;">
                <div style="width: 70px; height: 70px; background: rgba(14, 165, 233, 0.1); color: var(--secondary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 20px auto;">
                    <i class="fas fa-plane-arrival"></i>
                </div>
                <h3 style="font-family: var(--font-heading); font-size: 22px; color: var(--primary-navy); margin-bottom: 15px;">Relocation Logistics</h3>
                <p style="color: var(--text-muted); font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    We arrange flights, medicals, and arrival logistics, ensuring your new team members arrive ready to work on day one.
                </p>
            </div>
            
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section animate-scale" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); color: white; text-align: center; padding: 100px 0;">
    <div class="container" style="max-width: 800px;">
        <h2 style="font-family: var(--font-heading); font-size: 42px; margin-bottom: 20px;">Ready to grow your team?</h2>
        <p style="font-size: 18px; opacity: 0.9; margin-bottom: 40px;">Tell us what you need, and we'll handle the rest.</p>
        <a href="requirement.php" class="btn btn-primary" style="background: white; color: var(--primary-navy); padding: 18px 40px; font-size: 18px; font-weight: 700; border-radius: 50px; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">Tell Us Your Requirement</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
