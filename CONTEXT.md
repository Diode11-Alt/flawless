# PrimePath HR - Project Context & Memory

## Project Overview
PrimePath HR is a web application designed for a premier HR outsourcing and executive search agency based in Malta. The project focuses on a high-end, professional UI inspired by FortuneFirst.

## Architectural Decisions
- **Stack:** PHP, HTML, CSS, JavaScript (Vanilla).
- **Styling:** Custom CSS with a centralized `style.css` file utilizing CSS variables for theme consistency. No external CSS frameworks (like Bootstrap or Tailwind) are used.
- **Theme:** "FortuneFirst" inspired. Professional, navy blue (`#1B264F`) and teal/secondary blue (`#00B4D8`) color scheme. Employs "glassmorphism" carefully, utilizing solid readable backgrounds for forms while retaining modern, clean grid structures.
- **Structure:** Common header and footer included via PHP (`includes/header.php`, `includes/footer.php`) across all public pages.
- **Data:** Job listings are stored in JSON format (`data/jobs.json`) and retrieved via helper functions (`includes/helpers.php`).
- **Database (Pending):** A `db.php` file exists for future MySQL/database integration.

## Current State
- **Homepage (`index.php`):** Fully redesigned with real content (Jobsplus compliance, Executive Search, CEO endorsement, stats).
- **Jobs Portal (`jobs.php`):** Features a 30/70 split layout with a sticky sidebar for filters and a main job listing area.
- **Job Details (`job-detail.php`):** Dynamic page that reads from JSON and displays specific job responsibilities and requirements.
- **Authentication:** Registration (`register.php`) and Admin Login (`admin/login.php`) pages are stylized consistently with the main theme.
- **Health & Monitoring:** Bash script (`health_checker.sh`) developed to ping routes and ensure 200 OK statuses.
- **Version Control:** Git initialized, `.gitignore` created, and pushed to `main` branch on GitHub (`https://github.com/Diode11-Alt/flawless.git`).

## Next Steps / Roadmap
- **Dashboard & CRM Integration:** Develop the internal dashboard for job management and integrate Zoho CRM API for handling incoming inquiries (from the registration and contact forms).
- **Database Migration:** Move from JSON-based job data to a relational database (MySQL/PostgreSQL) managed via `db.php`.
- **Dynamic Content:** Connect the "Apply Now" and "Contact" forms to backend processors to capture leads.
