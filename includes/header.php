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
    <?php
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'] ?? 'primepath-tan.vercel.app';
    $current_url = $protocol . "://" . $host . ($_SERVER['REQUEST_URI'] ?? '/');
    $meta_desc = isset($page_description) ? htmlspecialchars($page_description) : 'Leading Dubai recruitment agency helping UAE expats secure AI, Healthcare, Project Management, and skilled jobs in the UAE and Europe with visa sponsorship. 100% MOHRE Compliant.';
    $meta_title = isset($page_title) ? htmlspecialchars($page_title) : 'Find Tech, Healthcare & Skilled Trades Jobs | PrimePath HR';
    $meta_img = isset($page_image) ? $protocol . "://" . $host . $page_image : $protocol . "://" . $host . "/assets/images/logo.png";
    ?>
    <title><?= $meta_title ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php' || $_SERVER['PHP_SELF'] === '/'): ?>
    <link rel="preload" as="image" href="/assets/images/hero-bg.jpg">
    <?php endif; ?>
    <!-- SEO Meta & Social Tags -->
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <meta name="description" content="<?= $meta_desc ?>">
    <link rel="canonical" href="<?= htmlspecialchars($current_url) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_desc ?>">
    <meta property="og:url" content="<?= htmlspecialchars($current_url) ?>">
    <meta property="og:image" content="<?= $meta_img ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $meta_title ?>">
    <meta name="twitter:description" content="<?= $meta_desc ?>">
    <meta name="twitter:image" content="<?= $meta_img ?>">
    <!-- Structured Data: EmploymentAgency & LocalBusiness Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EmploymentAgency",
      "name": "PrimePath HR Services",
      "alternateName": "PrimePath HR UAE",
      "url": "https://primepathuae.com/",
      "logo": "https://primepathuae.com/assets/images/logo.png",
      "image": "https://primepathuae.com/assets/images/logo.png",
      "description": "<?= $meta_desc ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Business Village, Block B - Office 923",
        "addressLocality": "Deira",
        "addressRegion": "Dubai",
        "addressCountry": "AE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 25.2532,
        "longitude": 55.3283
      },
      "telephone": "+971 54 548 0972",
      "email": "primepathhrservices@gmail.com",
      "priceRange": "$$",
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
          "opens": "09:00",
          "closes": "18:00"
        }
      ],
      "sameAs": [
        "https://www.facebook.com/PrimePathHR",
        "https://www.linkedin.com/company/primepathhr/"
      ]
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
        <div class="mobile-menu-overlay" aria-hidden="true"></div>
        <div class="container header-inner">
            <div class="logo">
                <a href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <img src="/assets/images/logo.png" alt="PrimePath HR Services" class="logo-img">
                    <span style="font-size: 21px; font-weight: 800; color: var(--primary-navy); letter-spacing: -0.5px; line-height: 1;">Prime<span style="color: var(--secondary-blue);">Path</span></span>
                </a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li class="mobile-only drawer-header">
                        <a href="index.php" style="display: flex; align-items: center; gap: 8px; text-decoration: none;">
                            <img src="/assets/images/logo.png" alt="PrimePath HR Services" style="height: 32px; width: auto;">
                            <span style="font-size: 18px; font-weight: 800; color: var(--primary-navy); letter-spacing: -0.5px; line-height: 1;">Prime<span style="color: var(--secondary-blue);">Path</span></span>
                        </a>
                        <button class="drawer-close-btn" aria-label="Close Menu"><i class="fas fa-times"></i></button>
                    </li>
                    <li><a href="index.php"><i class="fas fa-home mobile-only-icon"></i> Home</a></li>
                    <li><a href="employers.php"><i class="fas fa-building mobile-only-icon"></i> For Employers</a></li>
                    <li><a href="jobs.php"><i class="fas fa-briefcase mobile-only-icon"></i> Careers <span class="nav-badge"><?= count(get_jobs()) ?></span></a></li>
                    <li class="has-dropdown">
                        <a href="#"><i class="fas fa-users mobile-only-icon"></i> Company <i class="fas fa-chevron-down dropdown-arrow" style="font-size: 10px; margin-left: auto;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="process.php">How We Work</a></li>
                            <li><a href="methodology.php">Methodology</a></li>
                            <li><a href="blog.php">Insights & News</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php"><i class="fas fa-envelope mobile-only-icon"></i> Contact Us</a></li>
                    <li class="mobile-only drawer-footer">
                        <div class="drawer-quick-contacts">
                            <p class="drawer-section-title">Quick Actions</p>
                            <a href="tel:+971545480972" class="drawer-contact-link"><i class="fas fa-phone-alt"></i> +971 54 548 0972</a>
                            <a href="https://wa.me/971545480972" target="_blank" class="drawer-contact-link whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
                            <a href="mailto:info@primepathuae.com" class="drawer-contact-link"><i class="fas fa-envelope"></i> Email Support</a>
                            <a href="employers.php" class="btn btn-primary drawer-cta">Hire Talent &rarr;</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="employers.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); padding: 12px 28px; border-radius: 30px; font-weight: 600;">Hire Talent &rarr;</a>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <i class="fas fa-bars"></i>
                <span class="toggle-text">Menu</span>
            </button>
        </div>
    </header>
