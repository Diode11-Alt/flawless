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
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        "streetAddress": "Business Village, Block B - Office 923, Deira",
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

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "tertiary-container": "#939bb3",
                    "inverse-primary": "#89ceff",
                    "on-background": "#171c1f",
                    "primary": "#006591",
                    "on-primary-fixed": "#001e2f",
                    "on-surface-variant": "#3e4850",
                    "inverse-on-surface": "#edf1f5",
                    "on-secondary": "#ffffff",
                    "tertiary": "#565e74",
                    "secondary": "#0051d5",
                    "on-primary-fixed-variant": "#004c6e",
                    "on-secondary-fixed-variant": "#003ea8",
                    "surface-sky": "#EFF6FF",
                    "outline-variant": "#bec8d2",
                    "on-surface": "#171c1f",
                    "on-tertiary-fixed-variant": "#3f465c",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#fefcff",
                    "secondary-fixed-dim": "#b4c5ff",
                    "on-error-container": "#93000a",
                    "on-tertiary": "#ffffff",
                    "surface": "#f6fafe",
                    "outline": "#6e7881",
                    "secondary-container": "#316bf3",
                    "surface-dim": "#d6dade",
                    "primary-fixed-dim": "#89ceff",
                    "deep-navy": "#1D2547",
                    "border-slate": "#E2E8F0",
                    "secondary-fixed": "#dbe1ff",
                    "on-tertiary-fixed": "#131b2e",
                    "primary-container": "#0ea5e9",
                    "surface-variant": "#dfe3e7",
                    "surface-container-lowest": "#ffffff",
                    "inverse-surface": "#2c3134",
                    "surface-bright": "#f6fafe",
                    "tertiary-fixed-dim": "#bec6e0",
                    "on-primary-container": "#003751",
                    "surface-container-highest": "#dfe3e7",
                    "on-tertiary-container": "#2b3347",
                    "surface-container-low": "#f0f4f8",
                    "surface-container": "#eaeef2",
                    "tertiary-fixed": "#dae2fd",
                    "error-container": "#ffdad6",
                    "on-primary": "#ffffff",
                    "error": "#ba1a1a",
                    "surface-tint": "#006591",
                    "background": "var(--bg-light)",
                    "primary-fixed": "#c9e6ff",
                    "surface-container-high": "#e4e9ed",
                    "on-secondary-fixed": "#00174b",
                    "navy": "var(--navy)",
                    "teal": "var(--teal)",
                    "navy-deep": "var(--primary-navy-dark)",
                    "primary": "var(--navy)",
                    "surface": "var(--bg-white)"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "spacing": {
                    "diagonal-offset": "48px",
                    "overlap-sm": "24px",
                    "overlap-md": "80px",
                    "gutter": "32px",
                    "margin-mobile": "24px",
                    "margin-desktop": "100px"
            },
            "fontFamily": {
                    "headline-sm": ["Playfair Display"],
                    "stats-number": ["JetBrains Mono"],
                    "body-md": ["Inter"],
                    "display-lg-mobile": ["Playfair Display"],
                    "body-lg": ["Inter"],
                    "headline-md": ["Playfair Display"],
                    "display-lg": ["Playfair Display"],
                    "label-caps": ["Inter"]
            },
            "fontSize": {
                    "headline-sm": ["24px", {"lineHeight": "1.4", "fontWeight": "600", "letterSpacing": "0.01em"}],
                    "stats-number": ["36px", {"lineHeight": "1", "letterSpacing": "-0.03em", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "1.8", "fontWeight": "400"}],
                    "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700", "letterSpacing": "0.02em"}],
                    "body-lg": ["18px", {"lineHeight": "1.8", "fontWeight": "400"}],
                    "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "600", "letterSpacing": "0.02em"}],
                    "display-lg": ["56px", {"lineHeight": "1.15", "letterSpacing": "0.03em", "fontWeight": "700"}],
                    "label-caps": ["12px", {"lineHeight": "1", "letterSpacing": "0.08em", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
    <style>
        .diagonal-cut {
            clip-path: polygon(0 0, 100% 0, 100% 95%, 0% 100%);
        }
        .diagonal-cut-reverse {
            clip-path: polygon(0 5%, 100% 0, 100% 100%, 0% 100%);
        }
        .premium-shadow {
            box-shadow: 0 4px 20px rgba(13, 148, 136, 0.04), 0 2px 4px rgba(0, 0, 0, 0.01);
        }
        .premium-shadow-hover:hover {
            box-shadow: 0 10px 30px rgba(0, 101, 145, 0.06);
        }
        .header-gradient-border {
            position: relative;
        }
        .header-gradient-border::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, rgba(14, 165, 233, 0.1), rgba(37, 99, 235, 0.1));
        }
        .bg-sky-gradient-light {
            background: linear-gradient(180deg, #F0F9FF 0%, #FFFFFF 100%);
        }
        .btn-primary-gradient {
            background: linear-gradient(to right, #0EA5E9, #2563EB);
            transition: all 0.3s ease;
        }
        .btn-primary-gradient:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
        }
    </style>
</head>
<body class="font-body-md">
    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
    <!-- TopNavBar -->
    <header class="header sticky top-0 z-50 flex justify-between items-center px-6 md:px-12 py-3 w-full bg-white/95 backdrop-blur-md border-b transition-all duration-300" style="border-color: var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        <a href="index.php" style="text-decoration:none; display: flex; align-items: center;">
            <img src="/assets/images/prime-path-logo.png" alt="PrimePath HR Logo" style="height: 48px; width: auto; object-fit: contain;">
        </a>
        
        <nav class="hidden md:flex items-center gap-10">
            <a class="<?= $current_page === 'index.php' ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-600 hover:text-primary transition-colors' ?> font-body-md text-sm font-medium" href="index.php">Home</a>
            <a class="<?= $current_page === 'about.php' ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-600 hover:text-primary transition-colors' ?> font-body-md text-sm font-medium" href="about.php">About</a>
            <a class="<?= $current_page === 'solutions.php' ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-600 hover:text-primary transition-colors' ?> font-body-md text-sm font-medium" href="solutions.php">Solutions</a>
            <a class="text-gray-600 hover:text-primary transition-colors font-body-md text-sm font-medium" href="index.php#process">How We Work</a>
            <a class="<?= $current_page === 'jobs.php' ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-600 hover:text-primary transition-colors' ?> font-body-md text-sm font-medium" href="jobs.php">Careers</a>
            <a class="<?= $current_page === 'contact.php' ? 'text-primary font-semibold border-b-2 border-primary pb-1' : 'text-gray-600 hover:text-primary transition-colors' ?> font-body-md text-sm font-medium" href="contact.php">Contact</a>
        </nav>
        
        <div class="hidden md:flex items-center gap-6">
            <a href="requirement.php" class="text-sm font-medium transition-colors" style="color: var(--text-dark);">Hire Talent</a>
            <a href="contact.php" class="px-5 py-2.5 rounded text-white text-sm font-medium transition-all" style="background: var(--teal); box-shadow: 0 4px 10px rgba(0,180,216,0.2);">
                GET IN TOUCH
            </a>
        </div>
        
        <button class="md:hidden text-on-surface mobile-menu-toggle">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenu" class="fixed inset-0 bg-white z-40 flex flex-col pt-24 px-6 gap-6 transform translate-x-full transition-transform duration-300 md:hidden">
        <a class="text-xl font-semibold border-b pb-2" href="index.php">Home</a>
        <a class="text-xl font-semibold border-b pb-2" href="about.php">About</a>
        <a class="text-xl font-semibold border-b pb-2" href="solutions.php">Solutions</a>
        <a class="text-xl font-semibold border-b pb-2" href="index.php#process">How We Work</a>
        <a class="text-xl font-semibold border-b pb-2" href="jobs.php">Careers</a>
        <a class="text-xl font-semibold border-b pb-2" href="contact.php">Contact</a>
        <div class="mt-4 flex flex-col gap-4">
            <a href="requirement.php" class="text-center font-semibold text-primary py-3 rounded-lg border border-primary">Hire Talent</a>
            <a href="jobs.php" class="text-center font-semibold text-white bg-primary py-3 rounded-lg">Find Jobs</a>
        </div>
    </div>

    <!-- Global Animated Background Canvas is removed to respect light theme -->

    <script>
        window.addEventListener('scroll', () => {
            document.querySelector('.header').classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
    <style>
        .header.scrolled {
            background: var(--bg-white) !important;
            box-shadow: 0 2px 12px rgba(27,43,107,0.10) !important;
        }
    </style>
