<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';
init_csrf_token();
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
    $meta_desc = isset($page_description) ? htmlspecialchars($page_description) : 'Premier HR consultancy in Dubai providing Cross-Border Workforce Deployment, European Staffing, and Identity Malta visa solutions.';
    $meta_title = isset($page_title) ? htmlspecialchars($page_title) : 'International Staffing & Global Mobility | PrimePath HR';
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

    
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <!-- Top Utility Bar -->
    <div class="top-bar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <div class="top-bar-left" style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                <a href="mailto:primepathhrservices@gmail.com" style="display: flex; align-items: center; gap: 6px;"><i class="fas fa-envelope" style="color: var(--secondary-blue);"></i> primepathhrservices@gmail.com</a>
                <a href="tel:+971545480972" style="display: flex; align-items: center; gap: 6px;"><i class="fas fa-phone-alt" style="color: var(--secondary-blue);"></i> +971 54 548 0972</a>
                <span style="opacity: 0.8; font-size: 12px; display: flex; align-items: center; gap: 5px;"><i class="fas fa-map-marker-alt" style="color: #FBBF24;"></i> Business Village, Block B - Office 923, Deira, Dubai</span>
            </div>
            <div class="top-bar-right" style="display: flex; align-items: center; gap: 14px;">
                <span style="font-size: 12px; font-weight: 600; color: #67E8F9; text-transform: uppercase; letter-spacing: 0.5px;">International Workforce Consultancy</span>
                <a href="https://www.facebook.com/PrimePathHR" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/company/primepathhr/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
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
                    <span style="font-size: 22px; font-weight: 800; color: var(--primary-navy); letter-spacing: -0.5px; line-height: 1;">Prime<span style="color: var(--secondary-blue);">Path</span></span>
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
                    <li>
                        <a href="index.php" class="<?= $current_page === 'index.php' ? 'active' : '' ?>">
                            <i class="fas fa-home mobile-only-icon"></i> Home
                        </a>
                    </li>
                    <li class="has-dropdown">
                        <a href="solutions.php" class="<?= $current_page === 'solutions.php' ? 'active' : '' ?>">
                            <i class="fas fa-cogs mobile-only-icon"></i> Solutions <i class="fas fa-chevron-down dropdown-arrow" style="font-size: 10px; margin-left: 4px;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="solutions.php"><i class="fas fa-briefcase" style="margin-right: 8px; color: var(--secondary-blue);"></i> All Staffing Solutions</a></li>
                            <li><a href="solutions.php"><i class="fas fa-users" style="margin-right: 8px; color: var(--secondary-blue);"></i> Volume Sourcing</a></li>
                            <li><a href="solutions.php"><i class="fas fa-passport" style="margin-right: 8px; color: var(--secondary-blue);"></i> Visa & Immigration</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="about.php" class="<?= in_array($current_page, ['about.php', 'process.php']) ? 'active' : '' ?>">
                            <i class="fas fa-building mobile-only-icon"></i> Company <i class="fas fa-chevron-down dropdown-arrow" style="font-size: 10px; margin-left: 4px;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="about.php"><i class="fas fa-info-circle" style="margin-right: 8px; color: var(--secondary-blue);"></i> About PrimePath HR</a></li>
                            <li><a href="process.php"><i class="fas fa-tasks" style="margin-right: 8px; color: var(--secondary-blue);"></i> Our Process</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="requirement.php" class="<?= $current_page === 'requirement.php' ? 'active' : '' ?>">
                            <i class="fas fa-clipboard-list mobile-only-icon"></i> Tell Us Your Requirement
                        </a>
                    </li>
                    <li>
                        <a href="contact.php" class="<?= $current_page === 'contact.php' ? 'active' : '' ?>">
                            <i class="fas fa-envelope mobile-only-icon"></i> Contact
                        </a>
                    </li>
                    <li class="mobile-only drawer-footer">
                        <div class="drawer-quick-contacts">
                            <p class="drawer-section-title">Client Advisory Desk</p>
                            <a href="tel:+971545480972" class="drawer-contact-link"><i class="fas fa-phone-alt"></i> +971 54 548 0972</a>
                            <a href="https://wa.me/971545480972" target="_blank" class="drawer-contact-link whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp Advisory</a>
                            <a href="mailto:info@primepathuae.com" class="drawer-contact-link"><i class="fas fa-envelope"></i> Employer Inquiry</a>
                            <a href="requirement.php" class="btn btn-primary drawer-cta">Tell Us Your Requirement &rarr;</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="requirement.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); padding: 12px 26px; border-radius: 30px; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 180, 216, 0.25);">Tell Us Your Requirement &rarr;</a>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <i class="fas fa-bars"></i>
                <span class="toggle-text">Menu</span>
            </button>
        </div>
    </header>
