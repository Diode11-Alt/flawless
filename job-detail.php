<?php 
include 'includes/db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$job = get_job_by_id($id);
$page_title = ($job ? $job['title'] . " | PrimePath HR" : "Job Not Found");
$job_desc_schema = $job && !empty($job['description']) ? implode(" ", is_array($job['description']) ? $job['description'] : [$job['description']]) : "Details in description.";
$page_description = $job ? "Apply for " . $job['title'] . " in " . $job['location'] . " with PrimePath HR. Salary: " . ($job['salary'] ?? 'Competitive') . ". Trade-tested placements in the UAE." : "Find jobs in the UAE with PrimePath HR.";
include 'includes/header.php'; 

if(!$job) {
    echo "<div class='container section'><h2>Job not found</h2></div>";
    include 'includes/footer.php';
    exit;
}

// Share parameters
$current_url = urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$share_title = urlencode("Check out this job opening: " . $job['title'] . " at " . $job['company']);
?>

<!-- Structured Data (JobPosting Schema) -->
<script type="application/ld+json">
{
  "@context" : "https://schema.org/",
  "@type" : "JobPosting",
  "title" : "<?= htmlspecialchars($job['title']) ?>",
  "description" : "<?= htmlspecialchars($job_desc_schema) ?>",
  "identifier": {
    "@type": "PropertyValue",
    "name": "<?= htmlspecialchars($job['company']) ?>",
    "value": "PRM-<?= $job['id'] ?>"
  },
  "datePosted" : "<?= !empty($job['posted_date']) ? htmlspecialchars($job['posted_date']) : date('Y-m-d') ?>",
  "validThrough" : "<?= date('Y-m-d\TH:i', strtotime('+6 months')) ?>",
  "employmentType" : "<?= htmlspecialchars(str_replace(' ', '_', strtoupper($job['type'] ?? 'FULL_TIME'))) ?>",
  "hiringOrganization" : {
    "@type" : "Organization",
    "name" : "<?= htmlspecialchars($job['company']) ?>",
    "sameAs" : "<?= SITE_URL ?>",
    "logo" : "<?= SITE_URL ?>/assets/images/logo.png"
  },
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "<?= htmlspecialchars($job['location']) ?>",
      "addressCountry": "AE"
    }
  },
  "baseSalary": {
    "@type": "MonetaryAmount",
    "currency": "AED",
    "value": {
      "@type": "QuantitativeValue",
      "value": "<?= htmlspecialchars($job['salary']) ?>",
      "unitText": "MONTH"
    }
  }
}
</script>

<div class="bg-gradient-minimal animate-up" style="padding: 80px 0; position: relative; overflow: hidden; border-bottom: 1px solid var(--border-color);">
    <!-- Decorative background elements -->
    <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(10,132,255,0.05) 0%, transparent 70%);"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <a href="jobs.php" style="color: var(--text-muted); font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 20px;">
            <i class="fas fa-arrow-left"></i> All Positions
        </a>
        <h1 style="color: var(--primary-navy); font-size: 42px; margin-bottom: 15px;" class="animate-up delay-1"><?= htmlspecialchars($job['title']) ?></h1>
        <div style="display: flex; gap: 20px; font-size: 16px; color: var(--text-muted);" class="animate-up delay-2">
            <span>🏢 <?= htmlspecialchars($job['company']) ?></span>
            <span>📍 <?= htmlspecialchars($job['location']) ?></span>
            <span>💰 <?= htmlspecialchars($job['salary']) ?></span>
            <span style="background: rgba(10,132,255,0.1); color: var(--secondary-blue); padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 600; text-transform: uppercase;"><?= htmlspecialchars($job['type']) ?></span>
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
                <p style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--text-muted); margin-bottom: 0;">Reference ID: PRM-<?= $job['id'] ?></p>
                
                <div style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 25px;">
                    <h4 style="margin-bottom: 15px; font-size: 16px; color: var(--primary-navy);">Share this position</h4>
                    <div style="display: flex; gap: 12px;">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $current_url ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline" style="flex: 1; padding: 10px 10px; font-size: 12px; text-align: center; border-color: #0077b5; color: #0077b5; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="https://wa.me/?text=<?= $share_title ?>%20<?= $current_url ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline" style="flex: 1; padding: 10px 10px; font-size: 12px; text-align: center; border-color: #25D366; color: #25D366; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
// E-3: Related Jobs
$related_jobs = array_filter(get_jobs(), fn($j) => 
    isset($j['industry']) && isset($job['industry']) &&
    $j['industry'] === $job['industry'] && 
    (int)$j['id'] !== (int)$job['id']
);
if (empty($related_jobs)) {
    $related_jobs = array_filter(get_jobs(), fn($j) => (int)$j['id'] !== (int)$job['id']);
}
$related_jobs = array_slice($related_jobs, 0, 3);
?>
<?php if (!empty($related_jobs)): ?>
<section style="background: var(--bg-light); padding: 80px 0; border-top: 1px solid var(--border-color);">
    <div class="container">
        <h2 style="margin-bottom: 30px; font-size: 28px; font-family: var(--font-heading); color: var(--primary-navy);">Related <span>Positions</span></h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
            <?php foreach ($related_jobs as $r_job): ?>
            <div class="job-card" style="background: white; border-radius: var(--border-radius); padding: 30px; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between; border: 1px solid #e2e8f0; transition: transform 0.3s, box-shadow 0.3s;">
                <div>
                    <span class="job-type-badge <?= strtolower(str_replace(' ', '-', $r_job['type'])) ?>" style="font-size: 12px; margin-bottom: 12px; display: inline-block;">
                        <?= htmlspecialchars($r_job['type']) ?>
                    </span>
                    <h3 style="font-size: 18px; margin-bottom: 10px;">
                        <a href="job-detail.php?id=<?= $r_job['id'] ?>" style="color: var(--primary-navy); text-decoration: none;">
                            <?= htmlspecialchars($r_job['title']) ?>
                        </a>
                    </h3>
                    <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 15px;">🏢 <?= htmlspecialchars($r_job['company']) ?> &bull; 📍 <?= htmlspecialchars($r_job['location']) ?></p>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 15px; margin-top: 15px;">
                    <span style="font-weight: 700; color: var(--secondary-blue); font-size: 14px;"><?= htmlspecialchars($r_job['salary']) ?></span>
                    <a href="job-detail.php?id=<?= $r_job['id'] ?>" style="font-size: 14px; font-weight: 600; color: var(--primary-navy); text-decoration: none;">Apply <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
