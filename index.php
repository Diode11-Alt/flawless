<?php include 'includes/header.php'; ?>

<!-- Hero Section (Split Layout) -->
<section class="hero-split">
    <!-- Floating Background Orbs -->
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>
    <div class="container">
        <div class="hero-content animate-up delay-1">
            <h1>Dubai's Premier<br><span id="typed-text"></span></h1>
            <p>Elevating organizations across the UAE and GCC. As the top recruitment agency in the Middle East, we connect visionary leaders with forward-thinking enterprises through strategic executive search.</p>
            <div class="dual-cta-block">
                <p style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.7; margin-bottom: 16px;">I am looking for...</p>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="contact.php" class="btn btn-primary dual-cta" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); min-width: 200px;">
                        <i class="fas fa-briefcase" style="margin-right: 10px;"></i>
                        Hire Top Talent
                        <span style="display: block; font-size: 11px; font-weight: 400; opacity: 0.85; margin-top: 2px;">For Employers</span>
                    </a>
                    <a href="jobs.php" class="btn btn-outline dual-cta" style="border-color: white; color: white; min-width: 200px;">
                        <i class="fas fa-search" style="margin-right: 10px;"></i>
                        Find a Job
                        <span style="display: block; font-size: 11px; font-weight: 400; opacity: 0.85; margin-top: 2px;">For Candidates</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Stats Card (Glassmorphism) -->
        <div class="hero-form-card animate-up delay-2">
            <div class="stats-card">
                <div class="stat-item">
                    <div class="stat-number" data-target="500" data-suffix="+">0</div>
                    <div class="stat-label">Executive Placements</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number" data-target="50" data-suffix="+">0</div>
                    <div class="stat-label">Enterprise Clients</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number" data-target="6" data-suffix="">0</div>
                    <div class="stat-label">Core Industries</div>
                </div>
            </div>
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.15);">
                <h3 style="font-size: 18px; margin-bottom: 15px;">Quick Inquiry</h3>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder=" " required>
                        <label for="name">Full Name</label>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder=" " required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone" name="phone" placeholder=" " required>
                        <label for="phone">Phone Number</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); border-radius: 8px;">ENQUIRE NOW</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Client Logo Strip -->
<section style="background: white; padding: 30px 0; border-bottom: 1px solid var(--border-color);">
    <div class="container">
        <p style="text-align: center; font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted); margin-bottom: 24px;">Trusted by leading organizations across the UAE & GCC</p>
        <div class="logo-strip">
            <!-- Replace these with real client logos when available -->
            <div class="logo-item">Emirates Group</div>
            <div class="logo-item">ADNOC</div>
            <div class="logo-item">Emaar Properties</div>
            <div class="logo-item">Majid Al Futtaim</div>
            <div class="logo-item">DP World</div>
            <div class="logo-item">DEWA</div>
        </div>
        <p style="text-align: center; font-size: 12px; color: var(--text-muted); margin-top: 16px; opacity: 0.6;">* Illustrative. Replace with actual client logos.</p>
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

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/971545480972" target="_blank" class="floating-whatsapp" aria-label="Contact us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

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
                    How quickly can you fill a senior position?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>For most executive and senior roles, we deliver a qualified shortlist of 3–5 candidates within 14 business days. Specialist or highly niche roles may take 21–28 days. Our active talent pipeline means we rarely start from scratch.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What is your placement guarantee?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>We offer a 90-day replacement guarantee on all permanent placements. If a candidate leaves or doesn't meet expectations within 90 days, we replace them at no additional charge.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Do you help with Emiratisation (Tawteen) compliance?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes. PrimePath is MOHRE-licensed and specializes in Emiratisation strategy and sourcing. We help organizations meet their national talent quotas while finding high-quality UAE National candidates aligned to their business needs.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What industries do you specialize in?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Our core industries are Financial Services & Banking, Technology, Construction & Real Estate, Healthcare, Hospitality, and FMCG. We operate across the UAE and the broader GCC region.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How is PrimePath different from other recruitment agencies?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Three key differentiators: (1) We are MOHRE-licensed with deep UAE regulatory expertise. (2) Our Precision Placement Matrix uses active headhunting — we reach passive candidates not on job boards. (3) Our 98% post-placement retention rate is a direct result of cultural fit being central to every search.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Can you handle payroll and HR outsourcing, not just recruitment?
                    <i class="fas fa-plus faq-icon"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely. Payroll outsourcing, full HR operations management, and employee lifecycle management are core service lines alongside executive search. Contact us to discuss a tailored HR outsourcing package.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
