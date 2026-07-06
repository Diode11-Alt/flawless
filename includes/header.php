<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
require_once 'db.php';
require_once 'helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Find Tech, Healthcare & Skilled Trades Jobs | PrimePath HR' ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preload" as="image" href="/assets/images/hero-bg.jpg">
    <!-- SEO Meta -->
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <meta property="og:image" content="https://primepathuae.com/assets/images/og-image.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Find Tech, Healthcare & Skilled Trades Jobs | PrimePath HR">
    <meta name="description" content="Leading Dubai recruitment agency helping UAE expats secure AI, Healthcare, Project Management, and skilled Blue-Collar jobs in the UAE and Europe with visa sponsorship.">
    <meta name="keywords" content="Jobs in Dubai for expats, Europe work visa from UAE, DHA healthcare jobs Dubai, Tech jobs UAE, AI jobs Dubai, skilled trades jobs UAE, blue-collar jobs Dubai to Europe, recruitment agency Dubai, ATS optimized CV UAE">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Find Tech, Healthcare & Skilled Trades Jobs | PrimePath HR">
    <meta property="og:description" content="Leading Dubai recruitment agency helping UAE expats secure AI, Healthcare, Project Management, and skilled Blue-Collar jobs in the UAE and Europe with visa sponsorship.">
    <meta property="og:url" content="https://primepathuae.com/">
    <link rel="canonical" href="https://primepathuae.com/">
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "PrimePath HR",
      "url": "https://primepathuae.com/",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+971 54 548 0972",
        "contactType": "customer service"
      }
    }
    </script>
    <!-- Typed.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
</head>
<body>

    
    <!-- Top Utility Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <a href="mailto:primepathhrservices@gmail.com"><i class="fas fa-envelope"></i> primepathhrservices@gmail.com</a>
                <a href="tel:+971545480972"><i class="fas fa-phone-alt"></i> +971 54 548 0972</a>
                <span style="opacity: 0.7; font-size: 12px;"><i class="fas fa-map-marker-alt"></i> Business Village, Block B - Office 923, Deira, Dubai</span>
            </div>
            <div class="top-bar-right">
                <a href="https://www.facebook.com/PrimePathHR" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/company/primepathhr/" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="site-header">
        <div class="container header-inner">
            <div class="logo">
                <a href="index.php"><img src="/assets/images/logo.png" alt="PrimePath HR Services" class="logo-img"></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="employers.php">For Employers</a></li>
                    <li><a href="jobs.php">Careers <span class="nav-badge"><?= count(get_jobs()) ?></span></a></li>
                    <li class="has-dropdown">
                        <a href="#">Company <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="process.php">How We Work</a></li>
                            <li><a href="testimonials.php">Methodology</a></li>
                            <li><a href="blog.php">Insights & News</a></li>
                        </ul>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="employers.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); padding: 12px 28px; border-radius: 30px; font-weight: 600;">Hire Talent &rarr;</a>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
