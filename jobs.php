<?php 
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

// Filter by type checkboxes
$types = $_GET['type'] ?? [];
if (!empty($types)) {
    $jobs = array_filter($jobs, fn($j) =>
        in_array(strtolower($j['type']), array_map('strtolower', $types))
    );
}

$page_title = "Careers | PrimePath HR";
?>

<!-- Premium Hero -->
<section class="jobs-hero animate-up">
    <div class="container">
        <h1>Available Positions</h1>
        <p style="opacity: 0.9; margin-top: 15px; font-size: 18px;">Find your next career defining moment with PrimePath UAE.</p>
    </div>
</section>

<div class="container jobs-search-wrapper animate-up delay-1">
    <div class="jobs-search-card">
        <form action="jobs.php" method="GET" style="display: flex; gap: 15px; width: 100%; flex-wrap: wrap;">
            <input type="text" name="q" placeholder="Job Title, Keyword or Company..." style="flex: 2; min-width: 250px;">
            <select name="location" style="flex: 1; min-width: 150px;">
                <option value="">All Locations</option>
                <option value="dubai">Dubai</option>
                <option value="abudhabi">Abu Dhabi</option>
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
                <h4>Filters</h4>
                
                <div class="filter-group">
                    <label><strong>Job Type</strong></label>
                    <label><input type="checkbox" name="type[]" value="full-time"> Full Time</label>
                    <label><input type="checkbox" name="type[]" value="part-time"> Part Time</label>
                    <label><input type="checkbox" name="type[]" value="contract"> Contract</label>
                </div>
                
                <div class="filter-group">
                    <label><strong>Industry</strong></label>
                    <label><input type="checkbox" name="industry[]" value="tech"> Technology</label>
                    <label><input type="checkbox" name="industry[]" value="finance"> Finance</label>
                    <label><input type="checkbox" name="industry[]" value="healthcare"> Healthcare</label>
                </div>
                
                <button class="btn btn-outline" style="width: 100%; margin-top: 10px;">Apply Filters</button>
            </aside>
            
            <!-- Jobs Feed (Bot 2's Premium Aesthetics) -->
            <main class="jobs-feed">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <p style="color: var(--text-muted);">Showing <?= count($jobs) ?> premium roles</p>
                    <select style="padding: 8px 15px; border-radius: 5px; border: 1px solid #E2E8F0;">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Salary (High-Low)</option>
                    </select>
                </div>

                <div class="job-list">
                    <?php 
                    $delay = 1;
                    foreach($jobs as $job): ?>
                    <div class="job-card animate-up delay-<?= min($delay++, 3) ?>">
                        <div class="job-info">
                            <h3><a href="job-detail.php?id=<?= $job['id'] ?>" style="color: var(--primary-navy); text-decoration: none;"><?= htmlspecialchars($job['title']) ?></a></h3>
                            <div class="job-meta" style="margin-top: 15px;">
                                <span style="background: var(--bg-light); padding: 5px 12px; border-radius: 20px; font-size: 13px;">🏢 <?= htmlspecialchars($job['company']) ?></span>
                                <span style="background: var(--bg-light); padding: 5px 12px; border-radius: 20px; font-size: 13px;">📍 <?= htmlspecialchars($job['location']) ?></span>
                                <span class="job-tag" style="background: rgba(0, 180, 216, 0.1); color: var(--secondary-blue);"><?= htmlspecialchars($job['type']) ?></span>
                            </div>
                        </div>
                        <div class="job-action" style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                            <span style="color: var(--primary-navy); font-weight: 700; font-size: 18px;"><?= htmlspecialchars($job['salary']) ?></span>
                            <a href="job-detail.php?id=<?= $job['id'] ?>" class="btn btn-primary" style="padding: 10px 25px;">Apply Now</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </main>
            
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
