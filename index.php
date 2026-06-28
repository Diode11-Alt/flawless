<?php include 'includes/header.php'; ?>

<!-- Hero Section (Split Layout) -->
<section class="hero-split">
    <div class="container">
        <div class="hero-content animate-up delay-1">
            <h1>Dubai's Premier<br><span>HR Outsourcing</span></h1>
            <p>Elevating organizations across the UAE and GCC. As the top recruitment agency in the Middle East, we connect visionary leaders with forward-thinking enterprises through strategic executive search.</p>
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="contact.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%);">Find Top Talent <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
                <a href="jobs.php" class="btn btn-outline" style="border-color: white; color: white;">Explore Careers</a>
            </div>
        </div>
        <!-- Stats Card (Glassmorphism) -->
        <div class="hero-form-card animate-up delay-2">
            <div class="stats-card">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Executive Placements</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Enterprise Clients</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">6</div>
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

<!-- Who We Are Section -->
<section id="about" class="section" style="background-color: var(--bg-light); padding: 120px 0;">
    <div class="container">
        <div class="split-section">
            <div class="split-image animate-up delay-1" style="position: relative;">
                <div style="position: absolute; inset: 0; background: var(--secondary-blue); opacity: 0.1; transform: translate(16px, 16px); border-radius: 16px;"></div>
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="PrimePath HR Team" style="border-radius: 16px; position: relative; z-index: 2;">
            </div>
            <div class="split-content animate-up delay-2">
                <span style="color: var(--secondary-blue); font-weight: 600; text-transform: uppercase; font-size: 14px; margin-bottom: 10px; display: block;">Who We Are</span>
                <div style="width: 64px; height: 4px; background: var(--secondary-blue); margin-bottom: 20px; transform: skewX(-12deg);"></div>
                <h2 style="font-size: 36px; margin-bottom: 20px;">Your Premier HR Partner in the UAE</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; font-size: 16px;">
                    PrimePath HR is a MOHRE-licensed human resource consultancy operating across Dubai and the wider GCC. We bridge the gap between organizational ambitions and exceptional human capital through specialized workforce solutions built for long-term resilience.
                </p>
                <p style="color: var(--text-muted); margin-bottom: 30px; font-size: 16px;">
                    From bespoke talent mapping and executive search to fully compliant workforce deployment, our strategies integrate seamlessly with your corporate culture — powered by our proprietary SmartHR Enterprise Platform.
                </p>
                <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                    <a href="index.php#about" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%);">Our Full Story <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 45px; height: 45px; background: var(--bg-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
                            <i class="fas fa-building" style="color: var(--primary-navy);"></i>
                        </div>
                        <span style="font-weight: 600; color: var(--primary-navy); font-size: 14px;">Licensed by MOHRE UAE</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="section" style="background: var(--primary-navy); padding: 120px 0; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; opacity: 0.05;">
        <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
            <line stroke="white" stroke-width="40" x1="0" x2="100%" y1="100%" y2="0"></line>
        </svg>
    </div>
    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div class="mission-card animate-up delay-1">
                <div class="mission-icon"><i class="fas fa-flag"></i></div>
                <h3>Our Mission</h3>
                <p>To elevate organizational performance by deploying sustainable, high-impact HR solutions rooted in deep industry expertise and absolute transparency — leveraging innovative technology to give our partners a distinctive competitive edge.</p>
            </div>
            <div class="mission-card animate-up delay-2">
                <div class="mission-icon"><i class="fas fa-eye"></i></div>
                <h3>Our Vision</h3>
                <p>To be the premier benchmark for strategic talent acquisition and HR advisory in the GCC — recognized for redefining workplace cultures and optimizing corporate potential across the region.</p>
            </div>
        </div>
    </div>
</section>

<!-- What Sets Us Apart -->
<section id="values" class="section section-bg-white" style="padding: 120px 0;">
    <div class="container">
        <div class="section-title">
            <h2>What Sets Us <span>Apart</span></h2>
            <p>A results-driven approach backed by regional expertise and advanced technology.</p>
        </div>
        <div class="value-grid">
            <div class="value-card animate-up delay-1">
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
                <h3>MOHRE Compliant</h3>
                <p style="color: var(--text-muted); font-size: 14px;">Full regulatory alignment with UAE labor law, WPS processing, and Emiratisation quotas — ensuring zero compliance risk for your operations.</p>
            </div>
            <div class="value-card animate-up delay-2">
                <div class="icon"><i class="fas fa-bolt"></i></div>
                <h3>Rapid Turnaround</h3>
                <p style="color: var(--text-muted); font-size: 14px;">Our Precision Placement Matrix delivers qualified executive shortlists within 14 days — without sacrificing cultural fit or technical competency.</p>
            </div>
            <div class="value-card animate-up delay-3">
                <div class="icon"><i class="fas fa-desktop"></i></div>
                <h3>SmartHR Platform</h3>
                <p style="color: var(--text-muted); font-size: 14px;">Our proprietary technology platform gives you real-time visibility into talent pipelines, payroll status, and compliance dashboards.</p>
            </div>
            <div class="value-card animate-up delay-4">
                <div class="icon"><i class="fas fa-handshake"></i></div>
                <h3>98% Retention</h3>
                <p style="color: var(--text-muted); font-size: 14px;">Our placements stick. With a 98% post-placement retention rate, our candidates become long-term assets — not short-term fixes.</p>
            </div>
        </div>
    </div>
</section>

<!-- CEO Endorsement -->
<section class="section" style="background: var(--bg-light); padding: 100px 0;">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 60px; flex-wrap: wrap;">
            <div class="animate-up delay-1" style="flex: 0 0 280px; position: relative;">
                <div style="position: absolute; inset: -16px; background: var(--secondary-blue); opacity: 0.05; border-radius: 50%; filter: blur(20px);"></div>
                <img src="assets/images/ceo.webp" alt="Shishir Yogi, CEO of PrimePath HR Services" 
                     onerror="this.src='https://ui-avatars.com/api/?name=Shishir+Yogi&size=280&background=1B264F&color=fff&rounded=true'"
                     style="width: 280px; height: 280px; object-fit: cover; border-radius: 50%; border: 4px solid white; box-shadow: var(--shadow-card); position: relative; z-index: 2;">
            </div>
            <div class="animate-up delay-2" style="flex: 1; min-width: 300px;">
                <span style="color: var(--secondary-blue); font-weight: 600; text-transform: uppercase; font-size: 14px; display: block; margin-bottom: 8px;">A Message from Our CEO</span>
                <h2 style="font-size: 28px; margin-bottom: 5px;">Shishir Yogi, <span style="color: var(--secondary-blue);">CEO</span></h2>
                <div style="color: var(--text-muted); font-size: 16px; line-height: 1.8; margin-top: 20px;">
                    <p style="font-style: italic; font-size: 18px; border-left: 3px solid var(--secondary-blue); padding-left: 20px;">"At PrimePath, we built our consultancy on a simple principle: hiring should be a milestone, not a complication. Whether you need C-suite leaders, Emiratisation programs, or full-scale staff outsourcing, our team delivers with transparency, speed, and outstanding service."</p>
                </div>
                <a href="index.php#about" style="color: var(--secondary-blue); font-weight: 600; margin-top: 20px; display: inline-block; text-decoration: none;">Read the full leadership perspective <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Strategic Solutions -->
<section id="solutions" class="section section-bg-white" style="padding: 120px 0;">
    <div class="container">
        <div class="section-title">
            <h2>Strategic <span>Solutions</span></h2>
            <p>Comprehensive HR services designed to align your human capital with your long-term corporate objectives.</p>
        </div>
        <div class="service-cards">
            <div class="service-card-image animate-up delay-1">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Executive Search">
                <div class="service-card-content">
                    <span class="subtitle"><i class="fas fa-search" style="margin-right: 5px;"></i> Executive Search</span>
                    <h3>Executive Search</h3>
                    <p>Identifying and securing visionary C-suite leaders who drive organizational transformation.</p>
                </div>
            </div>
            <div class="service-card-image animate-up delay-2">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Strategic HR">
                <div class="service-card-content">
                    <span class="subtitle"><i class="fas fa-chess" style="margin-right: 5px;"></i> Strategic HR</span>
                    <h3>Strategic HR</h3>
                    <p>Bespoke consulting to optimize organizational structures, performance, and culture.</p>
                </div>
            </div>
            <div class="service-card-image animate-up delay-3">
                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Payroll Outsourcing">
                <div class="service-card-content">
                    <span class="subtitle"><i class="fas fa-file-invoice-dollar" style="margin-right: 5px;"></i> Payroll Outsourcing</span>
                    <h3>Payroll Outsourcing</h3>
                    <p>Ensuring precise, compliant, and seamless payroll processing across the GCC.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us (Detailed) -->
<section id="why-us" class="section" style="background: var(--bg-light); padding: 120px 0;">
    <div class="container">
        <div class="split-section">
            <div class="split-content animate-up delay-1">
                <span style="color: var(--secondary-blue); font-weight: 600; text-transform: uppercase; font-size: 14px; margin-bottom: 10px; display: block;">Why Choose Us</span>
                <div style="width: 64px; height: 4px; background: var(--secondary-blue); margin-bottom: 20px; transform: skewX(-12deg);"></div>
                <h2 style="font-size: 36px; margin-bottom: 20px;">Why Choose PrimePath?</h2>
                <p style="color: var(--text-muted); margin-bottom: 30px;">At PrimePath, our operational values dictate how we handle talent and navigate complex corporate client requirements. They serve as our firm commitment to ethical, premium workforce management.</p>
                
                <div style="display: flex; flex-direction: column; gap: 25px; margin-bottom: 30px;">
                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                        <div style="min-width: 48px; height: 48px; background: rgba(0, 180, 216, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="color: var(--secondary-blue); font-size: 18px;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 5px; font-size: 17px;">Comprehensive HR Operations</h4>
                            <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Managing the full talent lifecycle from initial identification to payroll, benefits, and contract lifecycle compliance.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                        <div style="min-width: 48px; height: 48px; background: rgba(0, 180, 216, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-crosshairs" style="color: var(--secondary-blue); font-size: 18px;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 5px; font-size: 17px;">Precision Placement Matrix</h4>
                            <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Rapid turnarounds achieved without sacrificing technical proficiency or structural cultural fit.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                        <div style="min-width: 48px; height: 48px; background: rgba(0, 180, 216, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bullseye" style="color: var(--secondary-blue); font-size: 18px;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 5px; font-size: 17px;">Strategic Executive Advisory</h4>
                            <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Consistent consultative communication at every stage of your enterprise growth journey.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 15px;">
                        <div style="min-width: 48px; height: 48px; background: rgba(0, 180, 216, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-cogs" style="color: var(--secondary-blue); font-size: 18px;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 5px; font-size: 17px;">Unified Technical Frameworks</h4>
                            <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Innovative web integrations like the SmartHR Portal that keep all stakeholders aligned and informed.</p>
                        </div>
                    </div>
                </div>
                
                <a href="index.php#about" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%);">Learn Our Story</a>
            </div>
            <div class="split-image animate-up delay-2" style="position: relative;">
                <div style="position: absolute; inset: 0; background: var(--secondary-blue); opacity: 0.1; transform: translate(16px, 16px); border-radius: 16px;"></div>
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80" alt="Corporate Meeting" style="border-radius: 16px; position: relative; z-index: 2;">
            </div>
        </div>
    </div>
</section>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/971545480972" target="_blank" class="floating-whatsapp" aria-label="Contact us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<?php include 'includes/footer.php'; ?>
