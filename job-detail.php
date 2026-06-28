<?php 
include 'includes/db.php';
include 'includes/header.php'; 

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$job = get_job($id);

if(!$job) {
    echo "<div class='container section'><h2>Job not found</h2></div>";
    include 'includes/footer.php';
    exit;
}
?>

<div style="background-color: var(--primary-navy-dark); padding: 80px 0; color: white; position: relative; overflow: hidden;" class="animate-up">
    <!-- Decorative background elements -->
    <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(10,132,255,0.2) 0%, transparent 70%);"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <h1 style="color: white; font-size: 42px; margin-bottom: 15px;" class="animate-up delay-1"><?= $job['title'] ?></h1>
        <div style="display: flex; gap: 20px; font-size: 16px; opacity: 0.9;" class="animate-up delay-2">
            <span>🏢 <?= $job['company'] ?></span>
            <span>📍 <?= $job['location'] ?></span>
            <span>💰 <?= $job['salary'] ?></span>
            <span style="background: var(--secondary-blue); padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?= $job['type'] ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container" style="display: flex; gap: 40px; flex-wrap: wrap;">
        
        <div style="flex: 3; min-width: 300px; background: white; padding: 50px; border-radius: var(--border-radius); box-shadow: var(--shadow-card);" class="animate-up delay-1">
            <div class="single-blog-content">
                <h2>Job Description</h2>
                <p>We are looking for an experienced <?= $job['title'] ?> to join our team at <?= $job['company'] ?>. You will be responsible for overseeing various projects, collaborating with cross-functional teams, and driving innovation.</p>
                
                <h3>Key Responsibilities</h3>
                <ul style="margin-left: 20px; margin-top: 15px; line-height: 1.8;">
                    <li>Lead the development and implementation of key strategies.</li>
                    <li>Collaborate closely with internal stakeholders.</li>
                    <li>Ensure compliance with company standards and industry regulations.</li>
                </ul>
                
                <h3>Requirements</h3>
                <ul style="margin-left: 20px; margin-top: 15px; line-height: 1.8;">
                    <li>Minimum 5 years of experience in a similar role.</li>
                    <li>Excellent communication and leadership skills.</li>
                    <li>Bachelor's degree in a relevant field.</li>
                </ul>
            </div>
        </div>

        <div style="flex: 1; min-width: 250px;" class="animate-up delay-2">
            <div style="background: var(--bg-light); padding: 40px 30px; border-radius: var(--border-radius); border: 1px solid #e2e8f0; position: sticky; top: 100px; box-shadow: var(--shadow-sm);">
                <h3 style="margin-bottom: 15px;">Interested?</h3>
                <p style="margin-bottom: 25px; color: var(--text-muted);">Apply now to be considered for this exciting opportunity.</p>
                <a href="register.php" class="btn btn-primary" style="display: block; width: 100%;">Apply Now</a>
                <p style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--text-muted);">Reference ID: PRM-<?= $job['id'] ?></p>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
