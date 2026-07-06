<?php 
include_once 'includes/db.php';
$recent_jobs = array_slice(get_jobs(), 0, 3);
include 'includes/header.php'; 
?>

<!-- Hero Section (Split Layout) -->
<section class="hero-split">
    <!-- Floating Background Orbs -->
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>
    <div class="container">
        <div class="hero-content animate-up delay-1">
            <h1>Premier HR Consultancy &<br>Talent Acquisition in Dubai</h1>
            <p>Elevating organizations across the UAE and GCC. We connect visionary leaders with forward-thinking enterprises through strategic executive search and HR outsourcing.</p>
            <div style="margin-top: 30px;">
                <a href="contact.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); font-size: 18px; padding: 18px 40px; min-width: 250px;">
                    <i class="fas fa-calendar-check" style="margin-right: 10px;"></i>
                    Book Consultation
                </a>
                <p style="margin-top: 15px; font-size: 14px; opacity: 0.8;">Looking for a job? <a href="jobs.php" style="color: var(--secondary-blue); text-decoration: underline;">View open roles</a></p>
            </div>
        </div>
        <!-- Stats Card (Glassmorphism) -->
        <div class="hero-form-card animate-up delay-2">
            <div class="stats-card">
                <div class="stat-item">
                    <div class="stat-number" data-target="100" data-suffix="%">100%</div>
                    <div class="stat-label">MOHRE Compliance</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number" data-target="5" data-suffix="">5</div>
                    <div class="stat-label">Core HR Pillars</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number" data-target="90" data-suffix="-Day">90-Day</div>
                    <div class="stat-label">Replacement Guarantee</div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Brief Overview Section -->
<section class="section" style="background-color: var(--bg-light); padding: 100px 0;">
    <div class="container text-center">
        <span style="color: var(--secondary-blue); font-weight: 600; text-transform: uppercase; font-size: 14px; margin-bottom: 10px; display: block;">Discover PrimePath</span>
        <h2 style="font-size: 36px; margin-bottom: 20px;">Comprehensive HR & Talent Solutions</h2>
        <p style="color: var(--text-muted); max-width: 700px; margin: 0 auto 40px auto; font-size: 16px;">
            From bespoke talent mapping and executive search to fully compliant workforce deployment, we bridge the gap between organizational ambitions and exceptional human capital.
        </p>
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="about.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-navy-dark) 100%);">Learn About Us</a>
            <a href="solutions.php" class="btn btn-outline" style="border-color: var(--primary-navy); color: var(--primary-navy);">Explore Solutions</a>
            <a href="process.php" class="btn btn-outline" style="border-color: var(--primary-navy); color: var(--primary-navy);">How We Work</a>
        </div>
    </div>
</section>

<!-- CORE PRINCIPLES ROW -->
<section style="background: var(--primary-navy); padding: 60px 0;">
    <div class="container">
        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; text-align: center; color: white;">
            <div>
                <i class="fas fa-certificate" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <div style="font-size: 18px; font-weight: 600;">MOHRE Licensed</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 8px;">Fully compliant operations in the UAE</div>
            </div>
            <div>
                <i class="fas fa-globe-europe" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <div style="font-size: 18px; font-weight: 600;">Direct EU Placements</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 8px;">Direct connections with European employers</div>
            </div>
            <div>
                <i class="fas fa-handshake" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <div style="font-size: 18px; font-weight: 600;">Verified Employers</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 8px;">We only work with trusted organizations</div>
            </div>
            <div>
                <i class="fas fa-users" style="font-size: 32px; color: var(--secondary-blue); margin-bottom: 15px;"></i>
                <div style="font-size: 18px; font-weight: 600;">1-on-1 Guidance</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 8px;">Personalized support for every candidate</div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICE PREVIEW -->
<section class="section section-bg-white" style="padding: 100px 0;">
    <div class="container">
        <div class="section-title">
            <h2>Our <span>Job Seeker Services</span></h2>
            <p>We guide expats and residents to their next career milestone.</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 50px;">
            <div class="value-card animate-up delay-1">
                <div class="icon"><i class="fas fa-globe-europe"></i></div>
                <h3>Europe Direct Placement</h3>
                <p style="color:var(--text-muted);font-size:14px;">Secure high-paying jobs in Europe. We handle interview scheduling, employer matching, and offer negotiation.</p>
                <a href="contact.php" style="color:var(--secondary-blue);font-weight:600;font-size:14px;margin-top:16px;display:inline-block;">Apply Now →</a>
            </div>
            <div class="value-card animate-up delay-2">
                <div class="icon"><i class="fas fa-city"></i></div>
                <h3>UAE Local Recruitment</h3>
                <p style="color:var(--text-muted);font-size:14px;">Looking to switch roles within Dubai or Abu Dhabi? We connect you with top enterprise employers in the GCC.</p>
                <a href="jobs.php" style="color:var(--secondary-blue);font-weight:600;font-size:14px;margin-top:16px;display:inline-block;">View Jobs →</a>
            </div>
            <div class="value-card animate-up delay-3">
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <h3>Resume & Profile Optimization</h3>
                <p style="color:var(--text-muted);font-size:14px;">Stand out to international recruiters with an optimized ATS-friendly CV and LinkedIn profile makeover.</p>
                <a href="contact.php" style="color:var(--secondary-blue);font-weight:600;font-size:14px;margin-top:16px;display:inline-block;">Learn More →</a>
            </div>
            <div class="value-card animate-up delay-1">
                <div class="icon"><i class="fas fa-passport"></i></div>
                <h3>Relocation & Visa Guidance</h3>
                <p style="color:var(--text-muted);font-size:14px;">Comprehensive guidance on work permit requirements, credential verification, and smooth relocation to Europe.</p>
                <a href="contact.php" style="color:var(--secondary-blue);font-weight:600;font-size:14px;margin-top:16px;display:inline-block;">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED JOBS -->
<section class="section" style="background: var(--bg-light); padding: 100px 0;">
    <div class="container">
        <div class="section-title">
            <h2>Featured <span>Positions</span></h2>
            <p>Explore some of our recently added roles.</p>
        </div>
        <div class="job-list" style="margin-top: 40px;">
            <?php foreach($recent_jobs as $job): ?>
            <div class="job-card animate-up">
                <div class="job-card-header">
                    <div class="job-title-row">
                        <h3><?= htmlspecialchars($job['title']) ?></h3>
                        <span class="job-type"><?= htmlspecialchars($job['type']) ?></span>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-building"></i> <?= htmlspecialchars($job['company']) ?></span>
                        <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['location']) ?></span>
                        <span><i class="fas fa-money-bill-wave"></i> <?= htmlspecialchars($job['salary']) ?></span>
                    </div>
                </div>
                <div class="job-card-body">
                    <p><?= htmlspecialchars(is_array($job['description']) ? $job['description'][0] : substr($job['description'], 0, 150) . '...') ?></p>
                </div>
                <div class="job-card-footer">
                    <a href="job-detail.php?id=<?= $job['id'] ?>" class="btn btn-outline" style="border-color: var(--secondary-blue); color: var(--secondary-blue); padding: 8px 20px; font-size: 14px;">View Details</a>
                    <span class="job-date"><i class="far fa-clock"></i> <?= htmlspecialchars(get_time_ago($job['posted_date'] ?? '')) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="jobs.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%);">View All Positions</a>
        </div>
    </div>
</section>

<!-- LEADERSHIP PRINCIPLE / METHODOLOGY PREVIEW -->
<section class="section" style="background: white; padding: 80px 0;">
    <div class="container" style="max-width: 800px; text-align: center;">
        <div class="quote-icon" style="font-size: 36px; color: var(--secondary-blue); opacity: 0.4; margin-bottom: 20px;">
            <i class="fas fa-quote-left"></i>
        </div>
        <p style="font-size: 20px; font-style: italic; color: var(--primary-navy); line-height: 1.8; margin-bottom: 30px;">
            "At PrimePath, we built our consultancy on a simple principle: hiring should be a milestone, not a complication. Whether you need C-suite leaders, Emiratisation programs, or full-scale staff outsourcing, our team delivers with transparency, speed, and outstanding service."
        </p>
        <div style="display:flex; align-items:center; justify-content:center; gap:14px;">
            <img src="assets/images/ceo.webp" alt="Shishir Yogi - CEO" onerror="this.src='https://ui-avatars.com/api/?name=Shishir+Yogi&size=100&background=1B264F&color=fff&bold=true'" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; object-position: top; border: 2px solid var(--secondary-blue);">
            <div style="text-align:left;">
                <strong style="color:var(--primary-navy); display:block;">Shishir Yogi</strong>
                <span style="color:var(--text-muted); font-size:14px;">CEO, PrimePath HR Services</span>
            </div>
        </div>
        <a href="methodology.php" style="display:inline-block; margin-top:30px; color:var(--secondary-blue); font-weight:600;">
            Explore Our 3-Phase Methodology →
        </a>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Typed !== 'undefined') {
        new Typed('#typed-text', {
            strings: ['HR Outsourcing', 'Executive Search', 'Tawteen Compliance', 'Talent Acquisition'],
            typeSpeed: 50,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            showCursor: true,
            cursorChar: '|'
        });
    }
});
</script>

<!-- FAQ Section -->
<section class="section section-bg-white" style="padding: 100px 0;">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked <span>Questions</span></h2>
            <p>Everything you need to know about working with PrimePath HR.</p>
        </div>
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How long does the recruitment process typically take?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Placement timelines vary by industry, seniority, and visa processing requirements. Generally, we aim to present a qualified shortlist to employers within 2-4 weeks. For specialized roles or international relocations, the process may take longer to ensure full compliance and perfect fit.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Do you guarantee job placements for candidates?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>While we actively match optimized profiles with prospective employers, we cannot guarantee employment. Final hiring decisions rest entirely with the employer. We commit to fairly representing your skills and providing honest feedback throughout the process.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Do you provide visa sponsorship for jobs in Europe?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>PrimePath HR works with international employers who often provide visa sponsorship for successful candidates. However, visa issuance is subject to the immigration laws and processing timelines of the destination country. We facilitate the recruitment process but do not issue visas directly.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What industries do you specialize in?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>We source talent across a broad spectrum of industries in the UAE and GCC, with strong focuses on Technology, Healthcare, Construction & Real Estate, Hospitality, and specialized Blue-Collar trades.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do you handle data privacy?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>We take data privacy very seriously. Candidate CVs and personal data are strictly processed in compliance with the UAE Federal Decree-Law No. 45 of 2021 on Personal Data Protection. We only share your profile with verified employers with your explicit consent.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Can you manage our company's Emiratisation requirements?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes. As a MOHRE-licensed agency, we assist companies in meeting their Tawteen (Emiratisation) quotas by sourcing qualified UAE National talent that aligns with their operational needs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Structured Data (FAQPage Schema) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Do you provide visa sponsorship for jobs in Europe?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "PrimePath HR works with international employers who often provide visa sponsorship for successful candidates. However, visa issuance is subject to the immigration laws and processing timelines of the destination country. We facilitate the recruitment process but do not issue visas directly."
      }
    },
    {
      "@type": "Question",
      "name": "What industries do you specialize in?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We source talent across a broad spectrum of industries in the UAE and GCC, with strong focuses on Technology, Healthcare, Construction & Real Estate, Hospitality, and specialized Blue-Collar trades."
      }
    },
    {
      "@type": "Question",
      "name": "How do you handle data privacy?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We take data privacy very seriously. Candidate CVs and personal data are strictly processed in compliance with the UAE Federal Decree-Law No. 45 of 2021 on Personal Data Protection. We only share your profile with verified employers with your explicit consent."
      }
    },
    {
      "@type": "Question",
      "name": "Can you manage our company's Emiratisation requirements?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. As a MOHRE-licensed agency, we assist companies in meeting their Tawteen (Emiratisation) quotas by sourcing qualified UAE National talent that aligns with their operational needs."
      }
    }
  ]
}
</script>

<?php include 'includes/footer.php'; ?>
