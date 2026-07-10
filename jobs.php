<?php 
$page_title = "Careers | PrimePath HR";
include 'includes/db.php';
include 'includes/header.php'; 
$jobs = get_jobs();

// Filter by search query
$q = trim($_GET['q'] ?? '');
if ($q) {
    $jobs = array_filter($jobs, fn($j) =>
        stripos($j['title'], $q) !== false || stripos($j['company'], $q) !== false
    );
}

// Filter by location
$loc = trim($_GET['location'] ?? '');
if ($loc) {
    $jobs = array_filter($jobs, fn($j) =>
        stripos($j['location'], $loc) !== false
    );
}

// Filter by type checkboxes
$types = $_GET['type'] ?? [];
if (!empty($types)) {
    $jobs = array_filter($jobs, fn($j) =>
        in_array(strtolower($j['type']), array_map('strtolower', $types))
    );
}

// Filter by industry
$industries = $_GET['industry'] ?? [];
if (!empty($industries)) {
    $jobs = array_filter($jobs, fn($j) =>
        isset($j['industry']) && in_array(strtolower($j['industry']), array_map('strtolower', $industries))
    );
}

// Sort logic
$sort = $_GET['sort'] ?? 'new';
if ($sort === 'salary') {
    usort($jobs, fn($a, $b) => 
        (int)preg_replace('/[^0-9]/', '', $b['salary'] ?? '0') <=> (int)preg_replace('/[^0-9]/', '', $a['salary'] ?? '0')
    );
} else {
    usort($jobs, fn($a, $b) => $b['id'] <=> $a['id']);
}
?>

<!-- Premium Hero -->
<section class="jobs-hero animate-up">
    <div class="container">
        <span class="badge-tag" style="background: rgba(255,255,255,0.15); color: white; padding: 5px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; display: inline-block; margin-bottom: 10px;">Open Roles in Malta</span>
        <h1>Careers in Malta</h1>
        <p style="opacity: 0.9; margin-top: 10px; font-size: 17px;">Hospitality, retail, and construction roles with employers across Malta — every listing is trade-tested and visa-supported through PrimePath HR.</p>
    </div>
</section>

<div class="container jobs-search-wrapper animate-up delay-1">
    <div class="jobs-search-card">
        <form action="jobs.php" method="GET" style="display: flex; gap: 15px; width: 100%; flex-wrap: wrap;">
            <input type="text" name="q" placeholder="Job Title, Keyword or Company..." style="flex: 2; min-width: 250px;">
            <select name="location" style="flex: 1; min-width: 150px;">
                <option value="">All Locations</option>
                <option value="valletta" <?= $loc === 'valletta' ? 'selected' : '' ?>>Valletta</option>
                <option value="sliema" <?= $loc === 'sliema' ? 'selected' : '' ?>>Sliema</option>
                <option value="st. julian's" <?= $loc === "st. julian's" ? 'selected' : '' ?>>St. Julian's</option>
                <option value="qawra" <?= $loc === 'qawra' ? 'selected' : '' ?>>Qawra</option>
            </select>
            <button type="submit" class="btn btn-primary" style="flex: 0 0 150px;">Search</button>
        </form>
    </div>
</div>

<section class="section pt-0">
    <div class="container">
        <div class="jobs-layout">
            
            <!-- Sidebar Filters (Bot 1's High Density) -->
            <aside class="filters-sidebar animate-up delay-2">
                <form action="jobs.php" method="GET">
                    <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">
                    <input type="hidden" name="location" value="<?= htmlspecialchars($loc) ?>">
                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                    <h4>Filters</h4>
                    
                    <div class="filter-group">
                        <label><strong>Job Type</strong></label>
                        <label><input type="checkbox" name="type[]" value="full-time" <?= in_array('full-time', $types) ? 'checked' : '' ?>> Full Time</label>
                        <label><input type="checkbox" name="type[]" value="part-time" <?= in_array('part-time', $types) ? 'checked' : '' ?>> Part Time</label>
                        <label><input type="checkbox" name="type[]" value="contract" <?= in_array('contract', $types) ? 'checked' : '' ?>> Contract</label>
                    </div>
                    
                    <div class="filter-group">
                        <label><strong>Industry</strong></label>
                        <label><input type="checkbox" name="industry[]" value="hospitality" <?= in_array('hospitality', $industries) ? 'checked' : '' ?>> Hospitality</label>
                        <label><input type="checkbox" name="industry[]" value="retail" <?= in_array('retail', $industries) ? 'checked' : '' ?>> Retail</label>
                        <label><input type="checkbox" name="industry[]" value="construction" <?= in_array('construction', $industries) ? 'checked' : '' ?>> Construction</label>
                    </div>
                    
                    <button type="submit" class="btn btn-outline" style="width: 100%; margin-top: 10px;">Apply Filters</button>
                </form>
            </aside>
            
            <!-- Jobs Feed (Bot 2's Premium Aesthetics) -->
            <main class="jobs-feed">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <p style="color: var(--text-muted);">Showing <?= count($jobs) ?> premium roles</p>
                    <select onchange="const url = new URL(window.location); url.searchParams.set('sort', this.value); window.location = url;" style="padding: 8px 15px; border-radius: 5px; border: 1px solid #E2E8F0;">
                        <option value="new" <?= $sort == 'new' ? 'selected' : '' ?>>Sort by: Newest</option>
                        <option value="salary" <?= $sort == 'salary' ? 'selected' : '' ?>>Sort by: Salary (High-Low)</option>
                    </select>
                </div>

                <div class="job-list">
                    <?php 
                    $delay = 1;
                    foreach($jobs as $job): ?>
                    <div class="job-card animate-up delay-<?= min($delay++, 3) ?>">
                        <div class="job-card-header">

                            <div class="job-card-top-info">
                                <span class="job-type-badge <?= strtolower(str_replace(' ', '-', $job['type'])) ?>">
                                    <?= htmlspecialchars($job['type']) ?>
                                </span>
                                <span class="job-id-label">REF: PRM-<?= $job['id'] ?></span>
                            </div>
                        </div>
                        <div class="job-info" style="margin-top: 16px;">
                            <h3>
                                <a href="job-detail.php?id=<?= $job['id'] ?>" style="color: var(--primary-navy); text-decoration: none;">
                                    <?= htmlspecialchars($job['title']) ?>
                                </a>
                            </h3>
                            <div class="job-meta" style="margin-top: 12px; display: flex; flex-wrap: wrap; gap: 10px;">
                                <span class="meta-tag"><i class="fas fa-building"></i> <?= htmlspecialchars($job['company']) ?></span>
                                <span class="meta-tag"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['location']) ?></span>
                                <span class="meta-tag"><i class="far fa-clock"></i> <?= htmlspecialchars(get_time_ago($job['posted_date'] ?? '')) ?></span>
                            </div>
                        </div>
                        <div class="job-card-footer">
                            <div class="salary-display">
                                <span class="salary-label">Package</span>
                                <strong><?= htmlspecialchars($job['salary']) ?></strong>
                            </div>
                            <a href="job-detail.php?id=<?= $job['id'] ?>" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px;">
                                View & Apply <i class="fas fa-arrow-right" style="margin-left: 6px;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- SEO Schema Markup -->
                    <script type="application/ld+json">
                    {
                      "@context": "https://schema.org/",
                      "@type": "JobPosting",
                      "title": "<?= htmlspecialchars($job['title']) ?>",
                      "datePosted": "<?= htmlspecialchars($job['posted_date'] ?? date('Y-m-d')) ?>",
                      "employmentType": "<?= htmlspecialchars(strtoupper(str_replace('-', '_', $job['type']))) ?>",
                      "hiringOrganization": {
                        "@type": "Organization",
                        "name": "<?= htmlspecialchars($job['company']) ?>"
                      },
                        "jobLocation": {
                        "@type": "Place",
                        "address": {
                          "@type": "PostalAddress",
                          "addressLocality": "<?= htmlspecialchars($job['location']) ?>",
                          "addressCountry": "MT"
                        }
                      }
                    }
                    </script>
                    <?php endforeach; ?>
                </div>
            </main>
            
        </div>
    </div>
</section>

<div class="container" style="text-align: center; margin-bottom: 60px;">
    <p style="font-size: 16px; color: var(--text-muted);">
        Hiring instead of job hunting? &rarr; <a href="requirement.php" style="color: var(--secondary-blue); font-weight: 600; text-decoration: underline;">Tell us your requirement</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>
