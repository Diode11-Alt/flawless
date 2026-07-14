<?php
$page_title = "Career Insights & HR News | PrimePath HR";
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/markdown.php';

$articles = get_all_articles();
?>

<!-- Page Header (Inherited from Homepage DNA) -->
<section class="page-hero">
    <div class="container reveal" style="text-align: center; max-width: 850px;">
        <span style="display: inline-block; padding: 6px 16px; border-radius: 20px; background: rgba(14,165,233,0.15); border: 1px solid rgba(14,165,233,0.3); color: var(--secondary-blue); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px;">Research &amp; Insights</span>
        <h1 class="page-hero-title">GCC Human Capital Intelligence</h1>
        <p class="page-hero-subtitle">Expert analysis on workforce deployment, UAE labor compliance, executive talent dynamics, and regional hiring benchmarks.</p>
    </div>
</section>

<!-- Blog Articles Grid -->
<section class="section" style="padding: 100px 0; background: transparent;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 32px;">
            <?php foreach ($articles as $article): ?>
            <div class="glass-card reveal" style="border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; padding: 36px;">
                <span style="color: var(--secondary-blue); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; display: block;"><?= htmlspecialchars($article['date']) ?></span>
                <h3 style="font-family: var(--font-heading); font-size: 22px; margin-bottom: 16px; line-height: 1.4; font-weight: 800;">
                    <a href="article.php?slug=<?= urlencode($article['slug']) ?>" style="color: #ffffff; text-decoration: none;"><?= htmlspecialchars($article['title']) ?></a>
                </h3>
                <p style="color: rgba(255,255,255,0.8); font-size: 15px; line-height: 1.7; margin-bottom: 24px; flex-grow: 1;"><?= htmlspecialchars($article['excerpt']) ?></p>
                <a href="article.php?slug=<?= urlencode($article['slug']) ?>" style="color: var(--secondary-blue); font-weight: 700; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                    Read Intelligence Briefing <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
            
            <?php if (empty($articles)): ?>
            <div class="glass-card" style="grid-column: 1 / -1; text-align: center; padding: 60px; border-radius: 20px;">
                <p style="color: rgba(255,255,255,0.8); font-size: 18px;">No briefings currently published. Check back soon for updated market analysis.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Global CTA Banner (Inherited from Homepage DNA) -->
<section class="cta-banner-section reveal">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="cta-banner-box">
            <h2 style="font-family: var(--font-heading); font-size: 40px; color: #ffffff; margin-bottom: 20px; font-weight: 800; letter-spacing: -1px;">Need tailored HR advisory?</h2>
            <p style="color: rgba(255,255,255,0.75); font-size: 18px; line-height: 1.6; max-width: 650px; margin: 0 auto 40px;">Contact our enterprise consulting desk for customized talent mapping and compensation benchmarking across the UAE.</p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php" class="btn btn-secondary" style="padding: 16px 36px; font-size: 15px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">
                    Contact Consulting Desk
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
