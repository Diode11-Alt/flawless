<?php
header("Content-Type: application/xml; charset=utf-8");
require_once __DIR__ . '/includes/db.php';

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Core Pages -->
    <url>
        <loc>https://primepathuae.com/</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/about.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/solutions.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/employers.php</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/process.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/jobs.php</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/blog.php</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/methodology.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/contact.php</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/privacy.php</loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc>https://primepathuae.com/terms.php</loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>

    <!-- Dynamic Jobs -->
    <?php
    $jobs = get_jobs();
    foreach ($jobs as $job):
        if (isset($job['id'])):
    ?>
    <url>
        <loc>https://primepathuae.com/job-detail.php?id=<?= $job['id'] ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php 
        endif;
    endforeach; 
    ?>

    <!-- Dynamic Articles -->
    <?php
    $articles = glob('content/*.md');
    if ($articles):
        foreach ($articles as $article):
            $slug = basename($article, '.md');
    ?>
    <url>
        <loc>https://primepathuae.com/article.php?slug=<?= urlencode($slug) ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php
        endforeach;
    endif;
    ?>
</urlset>
