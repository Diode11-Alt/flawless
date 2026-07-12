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
    $meta_desc = isset($page_description) ? htmlspecialchars($page_description) : 'Premier HR consultancy in the UAE providing Cross-Border Workforce Deployment, UAE Staffing, and Work Permit visa solutions.';
    $meta_title = isset($page_title) ? htmlspecialchars($page_title) : 'International Staffing & Global Mobility | PrimePath HR';
    $meta_img = isset($page_image) ? $protocol . "://" . $host . $page_image : $protocol . "://" . $host . "/assets/images/logo.png";
    ?>
    <title><?= $meta_title ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php' || $_SERVER['PHP_SELF'] === '/'): ?>
    <link rel="preload" as="image" href="/assets/images/hero-bg.jpg">
    <?php endif; ?>
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">

    <!-- SEO Schema Markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": ["EmploymentAgency", "LocalBusiness"],
      "name": "PrimePath HR Services",
      "description": "Leading HR consultancy based in the UAE. We specialize in executive search, Emiratization (Tawteen), and MOHRE compliant workforce solutions.",
      "image": "<?= SITE_URL ?>/assets/images/logo.png",
      "@id": "<?= SITE_URL ?>",
      "url": "<?= SITE_URL ?>",
      "telephone": "+971545480972",
      "email": "info@primepathuae.com",
      "priceRange": "$$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Sharjah and Dubai",
        "addressLocality": "Dubai",
        "addressCountry": "AE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 25.2048,
        "longitude": 55.2708
      },
      "areaServed": ["United Arab Emirates", "GCC", "Middle East"],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "HR & Consulting Services",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Executive Search & Specialist Recruitment"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Emiratization (Tawteen)"
            }
          }
        ]
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday"
        ],
        "opens": "09:00",
        "closes": "18:00"
      },
      "sameAs": [
        "https://www.facebook.com/PrimePathHR",
        "https://www.linkedin.com/company/primepathhr/"
      ]
    }
    </script>
</head>
<body>

    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <!-- Top Utility Bar -->
    <div class="top-bar" style="background: var(--primary-navy); border-bottom: none; color: var(--bg-white); padding: 8px 0;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <div class="top-bar-left" style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
                <a href="mailto:info@primepathuae.com" style="display: flex; align-items: center; gap: 8px; color: var(--bg-white); font-size: 13px; text-decoration: none;"><i class="fas fa-envelope" style="color: var(--secondary-blue-light);"></i> info@primepathuae.com</a>
                <a href="tel:+971545480972" style="display: flex; align-items: center; gap: 8px; color: var(--bg-white); font-size: 13px; text-decoration: none;"><i class="fas fa-phone-alt" style="color: var(--secondary-blue-light);"></i> +971 54 548 0972</a>
            </div>
            <div class="top-bar-right" style="display: flex; align-items: center; gap: 16px;">
                <span style="font-size: 12px; font-weight: 500; color: var(--bg-white); text-transform: uppercase; letter-spacing: 0.5px;">Global Staffing Solutions - UAE</span>
                <a href="https://www.linkedin.com/company/primepathhr/" target="_blank" rel="noopener noreferrer" style="color: var(--bg-white); font-size: 14px;"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="site-header" style="background: var(--bg-white); border-bottom: 1px solid var(--border-color); padding: 15px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); position: sticky; top: 0; z-index: 1000;">
        <div class="mobile-menu-overlay" aria-hidden="true"></div>
        <div class="container header-inner" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="logo">
                <a href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <img src="/assets/images/logo.png" alt="PrimePath HR" style="height: 40px; width: auto;" onerror="this.style.display='none'">
                    <span style="font-size: 22px; font-weight: 700; color: var(--primary-navy); letter-spacing: -0.5px; line-height: 1;">Prime<span class="text-primary">Path</span> HR</span>
                </a>
            </div>
            <nav>
                <ul class="nav-links" style="display: flex; list-style: none; gap: 28px; margin: 0; padding: 0; align-items: center;">
                    <li>
                        <a href="index.php" class="<?= $current_page === 'index.php' ? 'active' : '' ?>" style="color: <?= $current_page === 'index.php' ? 'var(--secondary-blue)' : 'var(--text-dark)' ?>; font-weight: 600; font-size: 14px; text-decoration: none;">Home</a>
                    </li>
                    <li class="has-dropdown">
                        <a href="solutions.php" class="<?= in_array($current_page, ['solutions.php']) ? 'active' : '' ?>" style="color: <?= in_array($current_page, ['solutions.php']) ? 'var(--secondary-blue)' : 'var(--text-dark)' ?>; font-weight: 600; font-size: 14px; text-decoration: none;">Solutions <i class="fas fa-chevron-down" style="font-size: 9px; margin-left: 4px; opacity: 0.5;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="solutions.php#executive-search"><i class="fas fa-user-tie" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Executive Search</a></li>
                            <li><a href="solutions.php#hr-outsourcing"><i class="fas fa-users-cog" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> HR Outsourcing</a></li>
                            <li><a href="solutions.php#corporate-training"><i class="fas fa-chalkboard-teacher" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Corporate Training</a></li>
                            <li><a href="solutions.php#hr-compliance"><i class="fas fa-clipboard-check" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> HR Compliance</a></li>
                            <li><a href="solutions.php#emiratization"><i class="fas fa-hands-helping" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Emiratization</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="about.php" class="<?= in_array($current_page, ['about.php', 'process.php', 'team.php', 'case-studies.php']) ? 'active' : '' ?>" style="color: <?= in_array($current_page, ['about.php', 'process.php', 'team.php', 'case-studies.php']) ? 'var(--secondary-blue)' : 'var(--text-dark)' ?>; font-weight: 600; font-size: 14px; text-decoration: none;">About <i class="fas fa-chevron-down" style="font-size: 9px; margin-left: 4px; opacity: 0.5;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.php"><i class="fas fa-building" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Our Story</a></li>
                            <li><a href="team.php"><i class="fas fa-user-tie" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Leadership Team</a></li>
                            <li><a href="process.php"><i class="fas fa-project-diagram" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Our Process</a></li>
                            <li><a href="case-studies.php"><i class="fas fa-chart-line" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Case Studies</a></li>
                        </ul>
                    </li>
                    <li><a href="jobs.php" class="<?= in_array($current_page, ['jobs.php','job-detail.php']) ? 'active' : '' ?>" style="color: <?= in_array($current_page, ['jobs.php','job-detail.php']) ? 'var(--secondary-blue)' : 'var(--text-dark)' ?>; font-weight: 600; font-size: 14px; text-decoration: none;">Careers</a></li>
                    <li class="has-dropdown">
                        <a href="blog.php" class="<?= in_array($current_page, ['blog.php','article.php','resources.php','faq.php']) ? 'active' : '' ?>" style="color: <?= in_array($current_page, ['blog.php','article.php','resources.php','faq.php']) ? 'var(--secondary-blue)' : 'var(--text-dark)' ?>; font-weight: 600; font-size: 14px; text-decoration: none;">Insights <i class="fas fa-chevron-down" style="font-size: 9px; margin-left: 4px; opacity: 0.5;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="blog.php"><i class="fas fa-newspaper" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Blog & Articles</a></li>
                            <li><a href="resources.php"><i class="fas fa-download" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> Guides & Resources</a></li>
                            <li><a href="faq.php"><i class="fas fa-question-circle" style="width: 20px; color: var(--secondary-blue); margin-right: 10px;"></i> FAQ</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php" class="<?= $current_page === 'contact.php' ? 'active' : '' ?>" style="color: <?= $current_page === 'contact.php' ? 'var(--secondary-blue)' : 'var(--text-dark)' ?>; font-weight: 600; font-size: 14px; text-decoration: none;">Contact</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="requirement.php" style="background: var(--secondary-blue); color: #fff; padding: 10px 24px; border-radius: 6px; font-weight: 600; text-decoration: none; font-size: 14px; transition: all 0.3s; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);">Request Talent</a>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle navigation" aria-expanded="false" style="color: var(--primary-navy); display: none;">
                <i class="fas fa-bars" style="font-size: 24px;"></i>
            </button>
        </div>
    </header>
