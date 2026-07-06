# PrimePath HR

PrimePath HR is a premier Human Resources Outsourcing and Executive Search agency based in Dubai, UAE. We specialize in strategic talent acquisition, payroll management, and comprehensive HR solutions tailored to forward-thinking enterprises.

This repository contains the source code for the PrimePath HR official website, built with PHP, CSS, and modern web design principles to reflect professionalism, trust, and compliance with the UAE Ministry of Human Resources and Emiratisation (MOHRE) regulations.

## Features

- **Modern Glassmorphism UI:** A professional and contemporary aesthetic featuring clean layouts, smooth animations, and responsive components.
- **Dynamic Routing & Modularity:** Reusable header, footer, and helper components across standard PHP files for maintainability.
- **SEO & Performance Optimized:** Structured data (JSON-LD) for job listings, semantic HTML, and fast-loading assets.
- **MOHRE Compliant:** Explicitly compliant Terms and Privacy pages protecting candidate rights, with clear distinctions between free core recruitment services and optional premium candidate services.
- **Content Management:** Markdown-based article rendering system for blogs and insights.
- **Security Best Practices:** Secure form handling, path traversal prevention in routing, and robust admin login protection.

## Technology Stack

- **Frontend:** HTML5, Vanilla CSS3 (Glassmorphism design language), JavaScript.
- **Backend:** PHP 8+ (Routing, JSON parsing, Markdown parsing).
- **Deployment:** Vercel (via `vercel.json` routing configuration).

## Local Development

To run this project locally, you will need PHP installed on your machine.

1. **Clone the repository**
   ```bash
   git clone https://github.com/Diode11-Alt/flawless.git
   cd flawless
   ```

2. **Start the PHP built-in web server**
   ```bash
   php -S localhost:8081
   ```

3. **View the site**
   Open your browser and navigate to `http://localhost:8081`.

## Deployment

This project is configured for seamless deployment on **Vercel** using the Serverless PHP runtime.

1. Ensure the Vercel CLI is installed (`npm i -g vercel`).
2. Run `vercel --prod` to deploy to production.
3. The `vercel.json` file handles routing all `.php` files and serving static assets from the `assets/` directory.

## Compliance & Legal

The Terms and Conditions, Privacy Policy, and fee structures embedded in this site have been meticulously crafted to comply with UAE Federal Decree-Law No. 45 of 2021 on Personal Data Protection and MOHRE recruitment regulations. PrimePath HR strictly prohibits charging candidates for core recruitment services.

## License

All rights reserved. PrimePath HR.
