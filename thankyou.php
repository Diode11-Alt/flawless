<?php
$page_title = "Thank You | PrimePath HR";
include 'includes/header.php';
?>

<section class="section" style="background: linear-gradient(135deg, #0b1528 0%, #1a2a4a 100%); min-height: 80vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; padding: 80px 0;">
    <!-- Floating background orbs -->
    <div style="position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(0, 194, 255, 0.15) 0%, transparent 70%); top: -100px; right: -100px; z-index: 1;"></div>
    <div style="position: absolute; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(10, 132, 255, 0.1) 0%, transparent 70%); bottom: -150px; left: -150px; z-index: 1;"></div>

    <div class="container" style="max-width: 800px; position: relative; z-index: 2; padding: 0 20px;">
        <!-- Glassmorphism Card -->
        <div class="glass-card" style="border-radius: 24px; padding: 50px 40px; text-align: center; color: white;">
            
            <!-- Animated Success Checkmark -->
            <div class="success-checkmark" style="width: 80px; height: 80px; margin: 0 auto 30px; background: rgba(14, 165, 233, 0.2); border: 2px solid var(--secondary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 24px rgba(0, 194, 255, 0.4); animation: scaleUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;">
                <i class="fas fa-check" style="font-size: 36px; color: var(--secondary-blue);"></i>
            </div>

            <h1 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 15px; font-family: var(--font-heading);">Submission Received!</h1>
            <p style="font-size: 16px; opacity: 0.85; max-width: 550px; margin: 0 auto 40px; line-height: 1.6;">Thank you for reaching out. A PrimePath partner has been assigned to your request and will contact you within the next 24 hours.</p>
            
            <!-- What Happens Next Timeline -->
            <div style="text-align: left; margin-bottom: 45px;">
                <h3 style="color: var(--secondary-blue); font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 25px; text-align: center;">What Happens Next</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    
                    <!-- Step 1 -->
                    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 25px; transition: transform 0.3s;" class="timeline-step">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(14, 165, 233, 0.2); border: 1px solid var(--secondary-blue); color: var(--secondary-blue); display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 15px;">1</div>
                        <h4 style="color: white; margin-bottom: 8px; font-size: 16px; font-family: var(--font-heading); font-weight: 700;">Initial Review</h4>
                        <p style="font-size: 13px; opacity: 0.75; line-height: 1.5; margin: 0;">We analyze your requirements or career application against current market data.</p>
                    </div>

                    <!-- Step 2 -->
                    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 25px; transition: transform 0.3s;" class="timeline-step">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(14, 165, 233, 0.2); border: 1px solid var(--secondary-blue); color: var(--secondary-blue); display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 15px;">2</div>
                        <h4 style="color: white; margin-bottom: 8px; font-size: 16px; font-family: var(--font-heading); font-weight: 700;">Discovery Call</h4>
                        <p style="font-size: 13px; opacity: 0.75; line-height: 1.5; margin: 0;">A 15-minute alignment call to dive deeper into goals, culture, and timelines.</p>
                    </div>

                    <!-- Step 3 -->
                    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 25px; transition: transform 0.3s;" class="timeline-step">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(14, 165, 233, 0.2); border: 1px solid var(--secondary-blue); color: var(--secondary-blue); display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 15px;">3</div>
                        <h4 style="color: white; margin-bottom: 8px; font-size: 16px; font-family: var(--font-heading); font-weight: 700;">Strategic Match</h4>
                        <p style="font-size: 13px; opacity: 0.75; line-height: 1.5; margin: 0;">We present curated candidates or outline customized consulting solutions.</p>
                    </div>

                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="index.php" class="btn btn-secondary" style="padding: 14px 32px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 13px;">Return to Homepage</a>
                <a href="jobs.php" class="btn btn-outline" style="border: 1px solid rgba(255, 255, 255, 0.3); color: white; padding: 14px 32px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 13px;">Browse Careers</a>
            </div>

        </div>
    </div>
</section>

<style>
@keyframes scaleUp {
    0% { transform: scale(0.5); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
.timeline-step:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.12) !important;
    border-color: rgba(0, 194, 255, 0.4) !important;
}
</style>

<?php include 'includes/footer.php'; ?>
