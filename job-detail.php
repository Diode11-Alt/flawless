<?php 
include 'includes/db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$job = get_job_by_id($id);
$page_title = ($job ? $job['title'] . " | PrimePath HR" : "Job Not Found");
include 'includes/header.php'; 

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
        <a href="jobs.php" style="color: rgba(255,255,255,0.7); font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 20px;">
            <i class="fas fa-arrow-left"></i> All Positions
        </a>
        <h1 style="color: white; font-size: 42px; margin-bottom: 15px;" class="animate-up delay-1"><?= htmlspecialchars($job['title']) ?></h1>
        <div style="display: flex; gap: 20px; font-size: 16px; opacity: 0.9;" class="animate-up delay-2">
            <span>🏢 <?= htmlspecialchars($job['company']) ?></span>
            <span>📍 <?= htmlspecialchars($job['location']) ?></span>
            <span>💰 <?= htmlspecialchars($job['salary']) ?></span>
            <span style="background: var(--secondary-blue); padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?= htmlspecialchars($job['type']) ?></span>
        </div>
    </div>
</div>

<div style="background: white; border-bottom: 1px solid var(--border-color); padding: 12px 0;">
    <div class="container">
        <nav aria-label="Breadcrumb" style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-muted);">
            <a href="index.php" style="color: var(--text-muted);">Home</a>
            <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
            <a href="jobs.php" style="color: var(--text-muted);">Careers</a>
            <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
            <span style="color: var(--primary-navy); font-weight: 600;">
                <?= htmlspecialchars($job['title']) ?>
            </span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container" style="display: flex; gap: 40px; flex-wrap: wrap;">
        
        <div style="flex: 3; min-width: 300px; background: white; padding: 50px; border-radius: var(--border-radius); box-shadow: var(--shadow-card);" class="animate-up delay-1">
            <div class="single-blog-content">
                <h3 style="margin-bottom: 20px;">Job Description</h3>
                <?php 
                if (!empty($job['description'])) {
                    $desc = is_array($job['description']) ? $job['description'] : [$job['description']];
                    foreach ($desc as $line) {
                        echo "<p>" . htmlspecialchars($line) . "</p>";
                    }
                } else {
                    echo "<p>Description not available.</p>";
                }
                ?>
                
                <?php if (!empty($job['responsibilities'])): ?>
                <h3 style="margin-top: 30px; margin-bottom: 20px;">Key Responsibilities</h3>
                <ul style="margin-bottom: 20px; padding-left: 20px; line-height: 1.6;">
                    <?php 
                    $resp = is_array($job['responsibilities']) ? $job['responsibilities'] : [$job['responsibilities']];
                    foreach ($resp as $line) {
                        echo "<li>" . htmlspecialchars($line) . "</li>";
                    }
                    ?>
                </ul>
                <?php endif; ?>

                <?php if (!empty($job['requirements'])): ?>
                <h3 style="margin-top: 30px; margin-bottom: 20px;">Requirements</h3>
                <ul style="margin-bottom: 20px; padding-left: 20px; line-height: 1.6;">
                    <?php 
                    $req = is_array($job['requirements']) ? $job['requirements'] : [$job['requirements']];
                    foreach ($req as $line) {
                        echo "<li>" . htmlspecialchars($line) . "</li>";
                    }
                    ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>

        <div style="flex: 1; min-width: 250px;" class="animate-up delay-2">
            <div style="background: var(--bg-light); padding: 40px 30px; border-radius: var(--border-radius); border: 1px solid #e2e8f0; position: sticky; top: 100px; box-shadow: var(--shadow-sm);">
                <h3 style="margin-bottom: 15px;">Interested?</h3>
                <p style="margin-bottom: 25px; color: var(--text-muted);">Apply now to be considered for this exciting opportunity.</p>
                <a href="register.php?job_id=<?= $job['id'] ?>&job_title=<?= urlencode($job['title']) ?>" class="btn btn-primary" style="display: block; width: 100%;">Apply Now</a>
                <p style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--text-muted);">Reference ID: PRM-<?= $job['id'] ?></p>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
