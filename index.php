<?php 
$page_title = "Global Staffing & Emiratization Solutions | PrimePath HR";
$page_description = "PrimePath HR is a leading human resource consultancy in the UAE. We specialize in executive search, corporate scaling, and MOHRE compliant Emiratization solutions.";
include 'includes/header.php'; 
?>

<!-- Hero Section — Dynamic Image Slider -->
<section class="hero-fortune" style="position: relative; overflow: hidden; background: none;">
    <!-- Background Slider -->
    <div class="hero-slider" role="region" aria-label="Hero Image Slider" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
        <div class="slide active" style="background-image: url('assets/images/slider/slider1.png');"></div>
        <div class="slide" style="background-image: url('assets/images/slider/slider2.png');"></div>
        <div class="slide" style="background-image: url('assets/images/slider/slider3.png');"></div>
        <div class="slide" style="background-image: url('assets/images/slider/slider4.png');"></div>
        <!-- Light overlay to keep it bright -->
        <div class="slider-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.95)); z-index: 2;"></div>
    </div>
    
    <style>
        .hero-slider .slide {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 1.5s ease-in-out, transform 8s linear;
            transform: scale(1.05); z-index: 1;
        }
        .hero-slider .slide.active { opacity: 1; transform: scale(1); }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slides = document.querySelectorAll('.hero-slider .slide');
            let currentSlide = 0;
            setInterval(() => {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }, 6000);
        });
    </script>
    
    <div class="container" style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 40px; position: relative; z-index: 3;">
        
        <!-- Left: Hero Copy -->
        <div class="reveal-left" style="flex: 1; min-width: 320px; max-width: 600px; padding-top: 40px;">
            <div style="display: flex; align-items: center; gap: 12px; font-size: 13px; font-weight: 700; color: var(--secondary-blue); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 24px;">
                <span style="width: 30px; height: 2px; background: var(--secondary-blue);"></span>LEADING UAE HR CONSULTANCY
            </div>
            <h1 class="fluid-h1" style="font-family: var(--font-heading); margin-bottom: 24px; font-weight: 800; color: var(--primary-navy); letter-spacing: -1px; line-height: 1.1;">
                Bridging Organizational Ambition with Extraordinary Human Capital.
            </h1>
            <p style="font-size: 18px; color: var(--text-muted); margin-bottom: 40px; line-height: 1.6; font-weight: 400;">
                Bespoke talent mapping, executive search, and compliant workforce deployment frameworks in Sharjah, Dubai, and the wider GCC region.
            </p>
            <!-- Stats row -->
            <div style="display: flex; gap: 40px; flex-wrap: wrap;">
                <div>
                    <div style="font-family: var(--font-heading); font-size: 36px; font-weight: 800; color: var(--secondary-blue); line-height: 1;">15+</div>
                    <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px;">Years Experience</div>
                </div>
                <div>
                    <div style="font-family: var(--font-heading); font-size: 36px; font-weight: 800; color: var(--secondary-blue); line-height: 1;">100%</div>
                    <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px;">MOHRE Compliant</div>
                </div>
                <div>
                    <div style="font-family: var(--font-heading); font-size: 36px; font-weight: 800; color: var(--secondary-blue); line-height: 1;">SmartHR</div>
                    <div style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px;">Proprietary Platform</div>
                </div>
            </div>
        </div>
        
        <!-- Right: Overlapping Consultation Form -->
        <div class="reveal-right delay-200" style="flex: 0 0 420px; max-width: 100%;">
            <div class="fortune-form">
                <h3 style="font-family: var(--font-heading); font-size: 24px; color: var(--primary-navy); margin-bottom: 10px; font-weight: 700; text-align: center; letter-spacing: -0.5px;">Initiate a Request</h3>
                <p style="color: var(--text-muted); font-size: 14px; text-align: center; margin-bottom: 30px;">Speak with our UAE staffing experts.</p>
                <form action="contact.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    <input type="text" name="name" class="fortune-input" placeholder="Full Name" required>
                    <input type="email" name="email" class="fortune-input" placeholder="Corporate Email" required>
                    <input type="text" name="company" class="fortune-input" placeholder="Enterprise Name">
                    <select name="subject" class="fortune-input" required style="appearance: none; -webkit-appearance: none; background: transparent;">
                        <option value="" disabled selected>Select Engagement Type</option>
                        <option value="Executive Search">Executive Search</option>
                        <option value="HR Outsourcing">HR Outsourcing</option>
                        <option value="Corporate Training">Corporate Training</option>
                        <option value="HR Compliance">HR Compliance</option>
                        <option value="Emiratization">Emiratization</option>
                    </select>
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
                        Request Consultation
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Trust Banner -->
<section style="background: var(--primary-navy); padding: 40px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
    <div class="container reveal">
        <div style="display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap; gap: 30px;">
            <div style="text-align: center;">
                <div style="color: var(--secondary-blue); font-size: 32px; font-weight: 800; font-family: var(--font-heading);">100%</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">MOHRE Compliant</div>
            </div>
            <div style="text-align: center;">
                <div style="color: var(--secondary-blue); font-size: 32px; font-weight: 800; font-family: var(--font-heading);">500+</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">Visas Processed</div>
            </div>
            <div style="text-align: center;">
                <div style="color: var(--secondary-blue); font-size: 32px; font-weight: 800; font-family: var(--font-heading);">15 Yrs</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">GCC Experience</div>
            </div>
            <div style="text-align: center;">
                <div style="color: var(--secondary-blue); font-size: 32px; font-weight: 800; font-family: var(--font-heading);">Trusted</div>
                <div style="color: rgba(255,255,255,0.7); font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">By UAE Enterprises</div>
            </div>
        </div>
    </div>
</section>

<!-- 5 Simple Steps -->
<section class="section" style="padding: 100px 0; background: var(--bg-white);">
    <div class="container">
        <div class="reveal" style="margin-bottom: 80px;">
            <span style="display: inline-block; padding: 4px 12px; border: 1px solid var(--secondary-blue); color: var(--secondary-blue); border-radius: 0px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px;">Execution Architecture</span>
            <h2 style="font-family: var(--font-heading); font-size: 40px; color: var(--primary-navy); margin-bottom: 16px; font-weight: 800; letter-spacing: -1px;">The PrimePath Protocol</h2>
            <p style="color: var(--text-muted); font-size: 18px; max-width: 600px; line-height: 1.6;">Our rigorous five-phase methodology guarantees compliance, speed, and precision.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 40px; position: relative;">
            <!-- Sleek Timeline Line -->
            <div style="position: absolute; top: 12px; left: 10%; right: 10%; height: 1px; background: var(--border-color); z-index: 1;"></div>
            
            <div class="reveal delay-100" style="position: relative; z-index: 2;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary-navy); border: 4px solid var(--bg-white); margin-bottom: 24px; display: inline-block;"></div>
                <h4 style="font-family: var(--font-heading); font-size: 18px; color: var(--primary-navy); font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px;">Requirements</h4>
                <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">Defining exact technical metrics and volume quotas.</p>
            </div>
            <div class="reveal delay-200" style="position: relative; z-index: 2;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary-navy); border: 4px solid var(--bg-white); margin-bottom: 24px; display: inline-block;"></div>
                <h4 style="font-family: var(--font-heading); font-size: 18px; color: var(--primary-navy); font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px;">Global Sourcing</h4>
                <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">Activating elite expatriate networks globally for the UAE.</p>
            </div>
            <div class="reveal delay-300" style="position: relative; z-index: 2;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary-navy); border: 4px solid var(--bg-white); margin-bottom: 24px; display: inline-block;"></div>
                <h4 style="font-family: var(--font-heading); font-size: 18px; color: var(--primary-navy); font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px;">Strict Vetting</h4>
                <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">Executing robust medical, background, and trade tests.</p>
            </div>
            <div class="reveal delay-400" style="position: relative; z-index: 2;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary-navy); border: 4px solid var(--bg-white); margin-bottom: 24px; display: inline-block;"></div>
                <h4 style="font-family: var(--font-heading); font-size: 18px; color: var(--primary-navy); font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px;">MOHRE Processing</h4>
                <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">Managing the entire UAE visa and work permit lifecycle.</p>
            </div>
            <div class="reveal delay-500" style="position: relative; z-index: 2;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary-navy); border: 4px solid var(--bg-white); margin-bottom: 24px; display: inline-block;"></div>
                <h4 style="font-family: var(--font-heading); font-size: 18px; color: var(--primary-navy); font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px;">Deployment</h4>
                <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">Flight logistics and UAE corporate integration.</p>
            </div>
        </div>
    </div>
</section>

<!-- Core Services - Stitch UI -->
<section class="section stitch-services-section">
    <div class="container relative">
        <div class="blur-blob-1"></div>
        <div class="blur-blob-2"></div>
        
        <div class="reveal" style="margin-bottom: 60px; position: relative; z-index: 10;">
            <span style="display: inline-block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px; color: #00B4D8;">Expert Solutions</span>
            <h2 style="font-family: var(--font-heading); font-size: 40px; margin-bottom: 16px; font-weight: 800; letter-spacing: -1px;">Elevating Human Potential Across the GCC</h2>
            <p class="text-muted" style="font-size: 18px; max-width: 550px; line-height: 1.6;">Bespoke consultancy services designed for market leaders in Dubai and beyond. We bridge the gap between talent and organizational excellence.</p>
        </div>
        
        <div class="stitch-services-grid" style="position: relative; z-index: 10;">
            <!-- Service 1: Executive Search -->
            <div class="glass-card reveal delay-100" onclick="window.location='solutions.php'">
                <div class="stitch-icon-box bg-medium-blue">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Executive Search</h3>
                <p>Securing visionary leadership through rigorous headhunting and cultural alignment for C-suite excellence.</p>
                <div class="glass-card-footer">
                    <span>Learn More</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
            
            <!-- Service 2: Emiratization -->
            <div class="glass-card border-accent reveal delay-200" onclick="window.location='solutions.php'">
                <div class="stitch-icon-box bg-light-blue">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Emiratization</h3>
                <p>Strategic talent solutions dedicated to empowering UAE nationals within the private sector ecosystem.</p>
                <div class="glass-card-footer">
                    <span>View Strategy</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
            
            <!-- Service 3: HR Compliance -->
            <div class="glass-card reveal delay-300" onclick="window.location='solutions.php'">
                <div class="stitch-icon-box bg-medium-blue">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h3>HR Compliance</h3>
                <p>Mitigating risk with comprehensive regulatory audits and adherence to evolving GCC labor laws.</p>
                <div class="glass-card-footer">
                    <span>Explore Compliance</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- Service 4: Corporate Training -->
            <div class="glass-card reveal delay-400" onclick="window.location='solutions.php'">
                <div class="stitch-icon-box bg-light-blue">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3>Corporate Training</h3>
                <p>Future-proofing your workforce through high-impact leadership development and technical upskilling.</p>
                <div class="glass-card-footer">
                    <span>Discover Programs</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- CEO Quote Band -->
<section class="reveal bg-cinematic-1" style="padding: 120px 0;">
    <div class="container" style="display: flex; align-items: center; gap: 60px; flex-wrap: wrap; justify-content: center;">
        <img src="assets/images/ceo.jpg" alt="Shishir Yogi, CEO" loading="lazy" style="width: 120px; height: 120px; border-radius: 0%; object-fit: cover; filter: grayscale(100%); border: 1px solid rgba(255,255,255,0.2);" onerror="this.src='https://via.placeholder.com/120?text=CEO'">
        <div style="max-width: 700px;">
            <p style="font-size: 26px; color: #ffffff; line-height: 1.4; font-weight: 300; margin-bottom: 24px; letter-spacing: -0.5px;">
                "Building a team should be a milestone to celebrate, not an operational complication. Whether you are seeking specialized executive leaders, implementing nationalization programs, or managing large-scale staff outsourcing, our expert team is here to support you."
            </p>
            <div style="display: flex; align-items: center; gap: 8px; text-transform: uppercase; letter-spacing: 1px; font-size: 12px;">
                <strong style="color: var(--secondary-blue);">Shishir Yogi</strong>
                <span style="color: rgba(255,255,255,0.5);">| Chief Executive Officer</span>
            </div>
        </div>
    </div>
</section>

<!-- Client Success Profiles (Case Studies) -->
<section class="reveal bg-cinematic-2" style="padding: 120px 0;">
    <div class="container">
        <div style="max-width: 1000px;">
            <span style="display: inline-block; padding: 4px 12px; border: 1px solid var(--secondary-blue); color: var(--secondary-blue); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px;">Track Record</span>
            <h2 style="font-family: var(--font-heading); font-size: 40px; color: #ffffff; margin-bottom: 48px; font-weight: 800; letter-spacing: -1px;">Client Success Profiles</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 60px;">
                <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 24px;">
                    <span style="color: var(--secondary-blue); font-family: var(--font-heading); font-size: 12px; font-weight: 700; letter-spacing: 1px; display: block; margin-bottom: 12px;">TECH SCALE-UP • DUBAI INTERNET CITY</span>
                    <h3 style="font-size: 20px; color: #ffffff; margin-bottom: 16px; font-weight: 700; letter-spacing: -0.5px;">Emiratization Compliance & Tech Hiring</h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 15px; line-height: 1.6;">
                        <strong>Challenge:</strong> A fast-growing tech firm required high-level software engineers while simultaneously needing to meet strict MOHRE Emiratization quotas within a 3-month window.<br><br>
                        <strong>Execution:</strong> PrimePath deployed our dual-track sourcing system, placing international C-suite executives while concurrently running a targeted Nationalization program for specialized local talent.<br><br>
                        <strong>Result:</strong> 100% quota compliance achieved ahead of the MOHRE deadline, alongside a fully integrated tech team.
                    </p>
                </div>
                <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 24px;">
                    <span style="color: var(--secondary-blue); font-family: var(--font-heading); font-size: 12px; font-weight: 700; letter-spacing: 1px; display: block; margin-bottom: 12px;">INFRASTRUCTURE • SHARJAH, UAE</span>
                    <h3 style="font-size: 20px; color: #ffffff; margin-bottom: 16px; font-weight: 700; letter-spacing: -0.5px;">WPS Payroll & Volume Outsourcing</h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 15px; line-height: 1.6;">
                        <strong>Challenge:</strong> A Tier-1 construction firm required 250+ specialized laborers and engineers managed entirely off their core HR books, with 100% Wage Protection System (WPS) compliance.<br><br>
                        <strong>Execution:</strong> We managed the complete end-to-end outsourcing, from visa processing to deployment, backed by our SmartHR Platform for transparent WPS payroll administration.<br><br>
                        <strong>Result:</strong> Zero payroll delays. The project timeline was secured, and the client retained PrimePath for their ongoing PEO operations.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industries We Serve -->
<section class="section" style="padding: 100px 0; background: var(--bg-light);">
    <div class="container">
        <div class="reveal" style="text-align: center; margin-bottom: 60px;">
            <span style="display: inline-block; padding: 4px 12px; border: 1px solid var(--secondary-blue); color: var(--secondary-blue); border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 16px;">Sector Expertise</span>
            <h2 style="font-family: var(--font-heading); font-size: 40px; color: var(--primary-navy); margin-bottom: 16px; font-weight: 800; letter-spacing: -1px;">Industries We Serve</h2>
            <p style="color: var(--text-muted); font-size: 18px; max-width: 550px; margin: 0 auto; line-height: 1.6;">Specialized recruitment verticals for UAE's fastest-growing sectors.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 24px;">
            <div class="reveal delay-100" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; padding: 32px 20px; text-align: center; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 32px rgba(14,165,233,0.12)';this.style.borderColor='var(--secondary-blue)'" onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='var(--border-color)'">
                <div style="width: 56px; height: 56px; background: rgba(14,165,233,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: var(--secondary-blue);"><i class="fas fa-building"></i></div>
                <h4 style="font-size: 15px; color: var(--primary-navy); font-weight: 700; margin-bottom: 6px;">Corporate Governance</h4>
                <p style="color: var(--text-muted); font-size: 13px; margin: 0; line-height: 1.4;">Legal Risk & Banking Ops</p>
            </div>
            <div class="reveal delay-200" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; padding: 32px 20px; text-align: center; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 32px rgba(14,165,233,0.12)';this.style.borderColor='var(--secondary-blue)'" onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='var(--border-color)'">
                <div style="width: 56px; height: 56px; background: rgba(14,165,233,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: var(--secondary-blue);"><i class="fas fa-hard-hat"></i></div>
                <h4 style="font-size: 15px; color: var(--primary-navy); font-weight: 700; margin-bottom: 6px;">Engineering & EPC</h4>
                <p style="color: var(--text-muted); font-size: 13px; margin: 0; line-height: 1.4;">Procurement & Infrastructure</p>
            </div>
            <div class="reveal delay-300" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; padding: 32px 20px; text-align: center; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 32px rgba(14,165,233,0.12)';this.style.borderColor='var(--secondary-blue)'" onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='var(--border-color)'">
                <div style="width: 56px; height: 56px; background: rgba(14,165,233,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: var(--secondary-blue);"><i class="fas fa-laptop-code"></i></div>
                <h4 style="font-size: 15px; color: var(--primary-navy); font-weight: 700; margin-bottom: 6px;">Advanced Tech</h4>
                <p style="color: var(--text-muted); font-size: 13px; margin: 0; line-height: 1.4;">Cloud Infrastructure & SaaS</p>
            </div>
            <div class="reveal delay-400" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; padding: 32px 20px; text-align: center; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 32px rgba(14,165,233,0.12)';this.style.borderColor='var(--secondary-blue)'" onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='var(--border-color)'">
                <div style="width: 56px; height: 56px; background: rgba(14,165,233,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: var(--secondary-blue);"><i class="fas fa-briefcase"></i></div>
                <h4 style="font-size: 15px; color: var(--primary-navy); font-weight: 700; margin-bottom: 6px;">C-Suite Execs</h4>
                <p style="color: var(--text-muted); font-size: 13px; margin: 0; line-height: 1.4;">Leadership & Change Mgmt</p>
            </div>
            <div class="reveal delay-100" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; padding: 32px 20px; text-align: center; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 32px rgba(14,165,233,0.12)';this.style.borderColor='var(--secondary-blue)'" onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='var(--border-color)'">
                <div style="width: 56px; height: 56px; background: rgba(14,165,233,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: var(--secondary-blue);"><i class="fas fa-home"></i></div>
                <h4 style="font-size: 15px; color: var(--primary-navy); font-weight: 700; margin-bottom: 6px;">Real Estate</h4>
                <p style="color: var(--text-muted); font-size: 13px; margin: 0; line-height: 1.4;">Asset Management & Dev</p>
            </div>
            <div class="reveal delay-200" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; padding: 32px 20px; text-align: center; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 32px rgba(14,165,233,0.12)';this.style.borderColor='var(--secondary-blue)'" onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='var(--border-color)'">
                <div style="width: 56px; height: 56px; background: rgba(14,165,233,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px; color: var(--secondary-blue);"><i class="fas fa-heartbeat"></i></div>
                <h4 style="font-size: 15px; color: var(--primary-navy); font-weight: 700; margin-bottom: 6px;">Healthcare</h4>
                <p style="color: var(--text-muted); font-size: 13px; margin: 0; line-height: 1.4;">Admin, Ops & Compliance</p>
            </div>
        </div>
    </div>
</section>

<!-- Social Proof Strip -->
<section style="padding: 40px 0; background: var(--bg-white); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
    <div class="container" style="display: flex; justify-content: center; align-items: center; gap: 48px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 48px; height: 48px; background: rgba(14,165,233,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 20px;"><i class="fas fa-building"></i></div>
            <div>
                <div style="font-family: var(--font-heading); font-size: 24px; font-weight: 800; color: var(--primary-navy); line-height: 1;">50+</div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">UAE Employers</div>
            </div>
        </div>
        <div style="width: 1px; height: 40px; background: var(--border-color);"></div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 48px; height: 48px; background: rgba(14,165,233,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 20px;"><i class="fas fa-globe-the GCC"></i></div>
            <div>
                <div style="font-family: var(--font-heading); font-size: 24px; font-weight: 800; color: var(--primary-navy); line-height: 1;">12+</div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">Source Countries</div>
            </div>
        </div>
        <div style="width: 1px; height: 40px; background: var(--border-color);"></div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 48px; height: 48px; background: rgba(14,165,233,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary-blue); font-size: 20px;"><i class="fas fa-award"></i></div>
            <div>
                <div style="font-family: var(--font-heading); font-size: 24px; font-weight: 800; color: var(--primary-navy); line-height: 1;">0%</div>
                <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">12-Month Attrition</div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Blog Articles (Dynamic) -->
<section class="section" style="padding: 100px 0; background: var(--bg-white);">
    <div class="container">
        <div class="reveal" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 48px; flex-wrap: wrap; gap: 20px;">
            <div>
                <span style="display: inline-block; padding: 4px 12px; border: 1px solid var(--secondary-blue); color: var(--secondary-blue); border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 16px;">Latest Insights</span>
                <h2 style="font-family: var(--font-heading); font-size: 40px; color: var(--primary-navy); margin-bottom: 0; font-weight: 800; letter-spacing: -1px;">From the Blog</h2>
            </div>
            <a href="blog.php" style="display: inline-flex; align-items: center; gap: 8px; color: var(--secondary-blue); font-weight: 700; font-size: 14px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;">View All <i class="fas fa-arrow-right" style="font-size: 12px;"></i></a>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
            <?php
            $articles_dir = __DIR__ . '/content';
            $articles = [];
            if (is_dir($articles_dir)) {
                foreach (glob($articles_dir . '/*.md') as $file) {
                    $content = file_get_contents($file);
                    $title = '';
                    if (preg_match('/^#\s+(.+)$/m', $content, $matches)) {
                        $title = trim($matches[1]);
                    }
                    if ($title) {
                        $slug = basename($file, '.md');
                        $mtime = filemtime($file);
                        $articles[] = ['title' => $title, 'slug' => $slug, 'mtime' => $mtime, 'content' => $content];
                    }
                }
                usort($articles, function($a, $b) { return $b['mtime'] - $a['mtime']; });
                $articles = array_slice($articles, 0, 3);
            }
            
            foreach ($articles as $i => $article):
                $excerpt = '';
                $lines = explode("\n", $article['content']);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line && !str_starts_with($line, '#') && !str_starts_with($line, '-') && strlen($line) > 40) {
                        $excerpt = substr(strip_tags($line), 0, 140) . '...';
                        break;
                    }
                }
                $delay = ($i + 1) * 100;
            ?>
            <div class="reveal delay-<?= $delay ?>" style="background: var(--bg-white); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; transition: all 0.4s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='var(--shadow-hover)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="height: 8px; background: linear-gradient(90deg, var(--primary-navy), var(--secondary-blue));"></div>
                <div style="padding: 28px;">
                    <span style="display: inline-block; padding: 3px 10px; background: rgba(14,165,233,0.08); color: var(--secondary-blue); border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 14px;">the UAE Insights</span>
                    <h3 style="font-family: var(--font-heading); font-size: 18px; color: var(--primary-navy); margin-bottom: 12px; font-weight: 700; line-height: 1.3;">
                        <a href="article.php?slug=<?= htmlspecialchars($article['slug']) ?>" style="color: var(--primary-navy); text-decoration: none;"><?= htmlspecialchars($article['title']) ?></a>
                    </h3>
                    <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 16px;"><?= htmlspecialchars($excerpt) ?></p>
                    <a href="article.php?slug=<?= htmlspecialchars($article['slug']) ?>" style="display: inline-flex; align-items: center; gap: 6px; color: var(--secondary-blue); font-weight: 600; font-size: 13px; text-decoration: none;">Read More <i class="fas fa-arrow-right" style="font-size: 11px;"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="reveal" style="padding: 120px 0; background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-navy-dark) 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: -30%; right: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(14,165,233,0.15) 0%, transparent 70%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 40px;">
        <div style="max-width: 600px;">
            <h2 style="font-family: var(--font-heading); font-size: 40px; color: #ffffff; margin-bottom: 16px; font-weight: 800; letter-spacing: -1px;">Scale Your UAE Operations.</h2>
            <p style="color: rgba(255,255,255,0.7); font-size: 16px; line-height: 1.6;">Engage PrimePath to secure, vet, and deploy top-tier international talent to the UAE.</p>
        </div>
        <div style="display: flex; gap: 16px; flex-wrap: wrap;">
            <a href="requirement.php" class="btn btn-secondary">
                Request Talent
            </a>
            <a href="contact.php" class="btn" style="background: transparent; border: 1px solid rgba(255,255,255,0.3); color: #fff; border-radius: 6px;">
                Contact Us
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
