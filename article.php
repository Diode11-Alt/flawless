<?php
require_once 'includes/markdown.php';

$slug = $_GET['slug'] ?? '';
$file = __DIR__ . '/content/' . basename($slug) . '.md';

if (empty($slug)) {
    header("Location: blog.php");
    exit;
}
if (!file_exists($file)) {
    header("HTTP/1.0 404 Not Found");
    $page_title = "Article Not Found | PrimePath HR";
    include 'includes/header.php';
    echo '<section class="section" style="padding:150px 0 100px; text-align:center;"><div class="container" style="max-width: 600px;"><div class="glass-card" style="padding: 50px;"><h2 style="color: #fff; font-family: var(--font-heading); margin-bottom: 16px;">Article Not Found</h2><p style="color: rgba(255,255,255,0.7); margin-bottom: 30px;">The requested corporate article or research report does not exist.</p><a href="blog.php" class="btn btn-secondary" style="padding: 12px 28px;">Return to Executive Blog</a></div></div></section>';
    include 'includes/footer.php';
    exit;
}

$content_raw = file_get_contents($file);
$title = ucwords(str_replace('-', ' ', $slug));
if (preg_match('/^# (.*)$/m', $content_raw, $matches)) {
    $title = trim($matches[1]);
}

$page_title = htmlspecialchars($title) . " | PrimePath HR";
$page_description = substr(strip_tags(parse_basic_markdown($content_raw)), 0, 160);
include 'includes/header.php';

$parsed_content = parse_basic_markdown($content_raw);
// Remove the first h1 since we render it in the header
$parsed_content = preg_replace('/<h1>.*?<\/h1>/i', '', $parsed_content, 1);

$article_image_path = "assets/images/articles/{$slug}.jpg";
$article_image_url = file_exists(__DIR__ . '/' . $article_image_path) ? SITE_URL . '/' . $article_image_path : SITE_URL . '/assets/images/logo.png';
?>

<!-- Structured Data (Article Schema) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?= htmlspecialchars($title) ?>",
  "image": "<?= $article_image_url ?>",
  "author": {
    "@type": "Organization",
    "name": "PrimePath HR Services",
    "url": "<?= SITE_URL ?>/"
  },
  "publisher": {
    "@type": "Organization",
    "name": "PrimePath HR Services",
    "logo": {
      "@type": "ImageObject",
      "url": "<?= SITE_URL ?>/assets/images/logo.png"
    }
  },
  "datePublished": "<?= date('c', filemtime($file)) ?>",
  "dateModified": "<?= date('c', filemtime($file)) ?>",
  "description": "<?= htmlspecialchars($page_description) ?>"
}
</script>

<!-- Page Header (Inherited from Homepage DNA) -->
<section class="page-hero">
    <div class="container reveal" style="text-align: center; max-width: 850px;">
        <span style="display: inline-block; padding: 6px 16px; border-radius: 20px; background: rgba(14,165,233,0.15); border: 1px solid rgba(14,165,233,0.3); color: var(--secondary-blue); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px;">Intelligence Briefing</span>
        <h1 class="page-hero-title"><?= htmlspecialchars($title) ?></h1>
        <p class="page-hero-subtitle">Published: <?= date('F j, Y', filemtime($file)) ?></p>
    </div>
</section>

<!-- Article Briefing Content -->
<section class="section" style="padding: 100px 0; background: transparent;">
    <div class="container" style="max-width: 880px; margin: 0 auto;">
        <div class="glass-card reveal" style="padding: 56px; border-radius: 24px; color: rgba(255, 255, 255, 0.85); font-size: 17px; line-height: 1.8;">
            <div class="article-content">
                <?= $parsed_content ?>
            </div>
            
            <div style="margin-top: 60px; padding-top: 32px; border-top: 1px solid rgba(255, 255, 255, 0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <a href="blog.php" style="color: var(--secondary-blue); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;"><i class="fas fa-arrow-left"></i> Back to Intelligence Briefings</a>
                <div style="display: flex; gap: 16px; align-items: center;">
                    <span style="color: rgba(255,255,255,0.6); font-weight: 500;">Share Briefing:</span>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" target="_blank" style="color: #00B4D8; font-size: 18px;"><i class="fab fa-linkedin"></i></a>
                    <a href="https://wa.me/?text=<?= urlencode("Check out this intelligence briefing: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" target="_blank" style="color: #25D366; font-size: 18px;"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Global CTA Banner (Inherited from Homepage DNA) -->
<section class="cta-banner-section reveal">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="cta-banner-box">
            <h2 style="font-family: var(--font-heading); font-size: 40px; color: #ffffff; margin-bottom: 20px; font-weight: 800; letter-spacing: -1px;">Request Strategic Consultation</h2>
            <p style="color: rgba(255,255,255,0.75); font-size: 18px; line-height: 1.6; max-width: 650px; margin: 0 auto 40px;">Speak with PrimePath's executive advisory team to align your workforce deployment strategy.</p>
            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php" class="btn btn-secondary" style="padding: 16px 36px; font-size: 15px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">
                    Consult Our Team
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.article-content h2 { color: #ffffff; margin: 40px 0 20px; font-size: 28px; font-weight: 800; font-family: var(--font-heading); }
.article-content h3 { color: #ffffff; margin: 30px 0 15px; font-size: 22px; font-weight: 700; font-family: var(--font-heading); }
.article-content p { margin-bottom: 24px; color: rgba(255, 255, 255, 0.85); }
.article-content ul, .article-content ol { margin-bottom: 24px; padding-left: 24px; }
.article-content li { margin-bottom: 12px; color: rgba(255, 255, 255, 0.85); }
.article-content a { color: var(--secondary-blue); text-decoration: none; font-weight: 600; }
.article-content a:hover { text-decoration: underline; }
.article-content strong { color: #ffffff; font-weight: 700; }
</style>

<?php include 'includes/footer.php'; ?>
