<?php
require_once 'helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Home | PrimePath HR' ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- SEO Meta -->
    <meta name="description" content="PrimePath HR: Dubai's Premier Executive Search & HR Outsourcing Agency. Providing top-tier talent and Tawteen compliance across the UAE and Middle East.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Home | PrimePath HR">
    <meta property="og:description" content="PrimePath HR: Dubai's Premier Executive Search & HR Outsourcing Agency.">
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
</head>
<body>
    
    <!-- Top Utility Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <a href="mailto:info@primepathuae.com"><i class="fas fa-envelope"></i> info@primepathuae.com</a>
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
                <a href="index.php">PrimePath<span>HR</span></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#solutions">Solutions</a></li>
                    <li><a href="jobs.php">Careers</a></li>
                    <li><a href="index.php#about">About Us</a></li>
                    <li><a href="index.php#why-us">Why Choose Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="contact.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); padding: 12px 28px; border-radius: 30px;">Get Started</a>
            </div>
            <button class="mobile-menu-toggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
