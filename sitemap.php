<?php
header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

$base_url = 'https://primepathuae.com';
$pages = [
    '/' => 1.0,
    '/requirement.php' => 1.0,
    '/solutions.php' => 0.9,
    '/jobs.php' => 0.8,
    '/about.php' => 0.7,
    '/process.php' => 0.7,
    '/blog.php' => 0.7,
    '/contact.php' => 0.6,
    '/privacy.php' => 0.3,
    '/terms.php' => 0.3
];

foreach ($pages as $url => $priority) {
    echo "  <url>\n";
    echo "    <loc>" . $base_url . $url . "</loc>\n";
    echo "    <changefreq>weekly</changefreq>\n";
    echo "    <priority>" . $priority . "</priority>\n";
    echo "  </url>\n";
}

// Add dynamic jobs
$jobs_file = __DIR__ . '/data/jobs.json';
if (file_exists($jobs_file)) {
    $jobs = json_decode(file_get_contents($jobs_file), true);
    if (is_array($jobs)) {
        foreach ($jobs as $job) {
            echo "  <url>\n";
            echo "    <loc>" . $base_url . "/job-detail.php?id=" . $job['id'] . "</loc>\n";
            echo "    <changefreq>weekly</changefreq>\n";
            echo "    <priority>0.7</priority>\n";
            echo "  </url>\n";
        }
    }
}

// Add dynamic articles
$articles = glob(__DIR__ . '/content/*.md');
foreach ($articles as $article) {
    $slug = basename($article, '.md');
    echo "  <url>\n";
    echo "    <loc>" . $base_url . "/article.php?slug=" . $slug . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.6</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>';
