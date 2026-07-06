<?php
require_once 'includes/markdown.php';

$slug = $_GET['slug'] ?? '';
$file = __DIR__ . '/content/' . basename($slug) . '.md';

if (empty($slug) || !file_exists($file)) {
    header("HTTP/1.0 404 Not Found");
    $page_title = "Article Not Found | PrimePath HR";
    include 'includes/header.php';
    echo '<div style="padding:150px 0; text-align:center;"><h2>Article Not Found</h2><p>The requested article does not exist. <a href="blog.php">Return to Blog</a></p></div>';
    include 'includes/footer.php';
    exit;
}

$content_raw = file_get_contents($file);
$title = ucwords(str_replace('-', ' ', $slug));
if (preg_match('/^# (.*)$/m', $content_raw, $matches)) {
    $title = trim($matches[1]);
}

$page_title = htmlspecialchars($title) . " | PrimePath HR";
$meta_description = substr(strip_tags(parse_basic_markdown($content_raw)), 0, 160);
include 'includes/header.php';

$parsed_content = parse_basic_markdown($content_raw);
// Remove the first h1 since we render it in the header
$parsed_content = preg_replace('/<h1>.*?<\/h1>/i', '', $parsed_content, 1);
?>

<section class="page-header" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); padding: 120px 0 80px; text-align: center; color: white;">
    <div class="container">
        <h1 style="font-size: 38px; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2); max-width: 900px; margin: 0 auto;"><?= htmlspecialchars($title) ?></h1>
        <p style="font-size: 16px; opacity: 0.8; margin-top: 15px;">Published: <?= date('F j, Y', filemtime($file)) ?></p>
    </div>
</section>

<section class="section section-bg-white" style="padding: 80px 0;">
    <div class="container" style="max-width: 800px; margin: 0 auto; line-height: 1.8; color: var(--text-dark); font-size: 17px;">
        <div class="article-content" style="
            --h2-color: var(--primary-navy);
            --link-color: var(--secondary-blue);
        ">
            <?= $parsed_content ?>
        </div>
        
        <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <a href="blog.php" style="color: var(--text-muted); text-decoration: none; font-weight: 500;"><i class="fas fa-arrow-left"></i> Back to Articles</a>
            <div style="display: flex; gap: 15px;">
                <span style="color: var(--text-muted); font-weight: 500;">Share:</span>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" target="_blank" style="color: #0077b5;"><i class="fab fa-linkedin fa-lg"></i></a>
                <a href="https://wa.me/?text=<?= urlencode("Check out this article: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" target="_blank" style="color: #25D366;"><i class="fab fa-whatsapp fa-lg"></i></a>
            </div>
        </div>
    </div>
</section>

<style>
.article-content h2 { color: var(--h2-color); margin: 40px 0 20px; font-size: 28px; }
.article-content h3 { color: var(--h2-color); margin: 30px 0 15px; font-size: 22px; }
.article-content p { margin-bottom: 25px; }
.article-content ul { margin-bottom: 25px; padding-left: 20px; }
.article-content li { margin-bottom: 10px; }
.article-content a { color: var(--link-color); text-decoration: none; font-weight: 500; }
.article-content a:hover { text-decoration: underline; }
.article-content strong { color: var(--primary-navy); }
</style>

<?php include 'includes/footer.php'; ?>
