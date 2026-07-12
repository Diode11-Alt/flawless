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
<section class="hero-careers perspective-container" style="padding: 180px 0 140px;">
    <div class="container" style="text-align: center;">
        <span style="display: inline-block; padding: 4px 12px; border: 1px solid var(--secondary-blue); color: var(--secondary-blue); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px;">Active Mandates</span>
        <h1 style="font-family: var(--font-heading); font-size: 56px; color: var(--primary-navy); font-weight: 800; margin-bottom: 16px; letter-spacing: -1.5px;">UAE Deployment</h1>
        <p style="color: var(--primary-navy); font-weight: 400; font-size: 20px; max-width: 600px; margin: 0 auto; line-height: 1.5;">Exclusive placement mandates for UAE enterprise. Every listing represents a verified, visa-sponsored corporate vacancy.</p>
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
                            <?php if (!empty($job['salary'])): ?>
                            <div class="salary-display">
                                <span class="salary-label">Package</span>
                                <strong><?= htmlspecialchars($job['salary']) ?></strong>
                            </div>
                            <?php else: ?>
                            <div style="flex-grow: 1;"></div>
                            <?php endif; ?>
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

<!-- Pathway to the GCC SEO Expansion -->
<section class="section perspective-container" style="padding: 100px 0; background: var(--bg-light); border-top: 1px solid var(--border-color);">
    <div class="container">
        <div class="reveal text-center" style="margin-bottom: 60px;">
            <span style="display: inline-block; padding: 6px 14px; background: rgba(0, 86, 179, 0.1); color: var(--secondary-blue); border-radius: 4px; font-size: 13px; font-weight: 600; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.5px;">Your Pathway to the GCC</span>
            <h2 class="fluid-h2" style="font-family: var(--font-heading); font-weight: 700; color: var(--primary-navy); margin-bottom: 16px;">Legal, Secure, and Supported Relocation</h2>
            <p style="color: var(--text-muted); font-size: 16px; max-width: 700px; margin: 0 auto; line-height: 1.7;">
                Relocating to the UAE is a major career milestone. At PrimePath HR, we ensure that every step of your journey is fully legal, strictly compliant with MOHRE regulations, and completely transparent. We protect candidates from predatory practices and manage the entire visa process securely.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <!-- Process Step 1 -->
            <div class="glass-panel reveal delay-100" style="padding: 40px; border-radius: 12px;">
                <div style="font-family: var(--font-heading); font-size: 48px; font-weight: 800; color: var(--secondary-blue); opacity: 0.2; line-height: 1; margin-bottom: 20px;">01</div>
                <h3 style="font-family: var(--font-heading); color: var(--primary-navy); margin-bottom: 16px; font-size: 20px; font-weight: 600;">Apply & Trade Test</h3>
                <p style="color: var(--text-muted); font-size: 15px; line-height: 1.6;">
                    Submit your application for verified roles. Upon shortlisting, you will undergo rigorous trade testing and vetting to ensure your skills align perfectly with UAE employer expectations.
                </p>
            </div>
            
            <!-- Process Step 2 -->
            <div class="glass-panel reveal delay-200" style="padding: 40px; border-radius: 12px;">
                <div style="font-family: var(--font-heading); font-size: 48px; font-weight: 800; color: var(--secondary-blue); opacity: 0.2; line-height: 1; margin-bottom: 20px;">02</div>
                <h3 style="font-family: var(--font-heading); color: var(--primary-navy); margin-bottom: 16px; font-size: 20px; font-weight: 600;">MOHRE Processing</h3>
                <p style="color: var(--text-muted); font-size: 15px; line-height: 1.6;">
                    Once selected, our compliance team handles the entire Work Permit application process with MOHRE. We ensure all documents are attested, translated, and legally filed to prevent delays.
                </p>
            </div>

            <!-- Process Step 3 -->
            <div class="glass-panel reveal delay-300" style="padding: 40px; border-radius: 12px;">
                <div style="font-family: var(--font-heading); font-size: 48px; font-weight: 800; color: var(--secondary-blue); opacity: 0.2; line-height: 1; margin-bottom: 20px;">03</div>
                <h3 style="font-family: var(--font-heading); color: var(--primary-navy); margin-bottom: 16px; font-size: 20px; font-weight: 600;">Secure Relocation</h3>
                <p style="color: var(--text-muted); font-size: 15px; line-height: 1.6;">
                    From booking your commercial flights to providing comprehensive cultural pre-departure briefings, we guarantee your physical relocation to the UAE is safe, organized, and stress-free.
                </p>
            </div>
        </div>
    </div>
</section>
<div class="container" style="text-align: center; margin-bottom: 60px;">
    <p style="font-size: 16px; color: var(--text-muted);">
        Hiring instead of job hunting? &rarr; <a href="requirement.php" style="color: var(--secondary-blue); font-weight: 600; text-decoration: underline;">Tell us your requirement</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>
