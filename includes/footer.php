    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-widget">
                    <h4>PrimePath HR</h4>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.7;">Strategic Progression for forward-thinking enterprises.</p>
                </div>
                <div class="footer-widget">
                    <h4>Services</h4>
                    <ul class="footer-links">
                        <li><a href="index.php#solutions">Executive Search</a></li>
                        <li><a href="index.php#solutions">Strategic HR</a></li>
                        <li><a href="index.php#solutions">Payroll Outsourcing</a></li>
                        <li><a href="jobs.php">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="index.php#about">About Us</a></li>
                        <li><a href="index.php#why-us">Why Choose Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h4>Contact</h4>
                    <ul class="footer-links" style="color: rgba(255,255,255,0.7);">
                        <li style="display: flex; align-items: flex-start; gap: 8px;">
                            <i class="fas fa-map-marker-alt" style="margin-top: 4px; color: var(--secondary-blue);"></i>
                            <a href="https://www.google.com/maps/search/Business+Village+Block+B+Office+923+Deira+Dubai" target="_blank" rel="noopener noreferrer">Business Village, Block B - Office 923<br>Deira, Dubai - UAE</a>
                        </li>
                        <li style="display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-phone-alt" style="color: var(--secondary-blue);"></i>
                            <a href="tel:+971545480972">+971 54 548 0972</a>
                        </li>
                        <li style="display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-envelope" style="color: var(--secondary-blue);"></i>
                            <a href="mailto:info@primepathuae.com">info@primepathuae.com</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <p>&copy; <?php echo date('Y'); ?> PrimePath HR Services. All Rights Reserved. Licensed by MOHRE UAE.</p>
                <div style="display: flex; gap: 15px;">
                    <a href="https://www.facebook.com/PrimePathHR" target="_blank" rel="noopener noreferrer" aria-label="PrimePath HR on Facebook" style="color: rgba(255,255,255,0.7); transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/primepathhr/" target="_blank" rel="noopener noreferrer" aria-label="PrimePath HR on LinkedIn" style="color: rgba(255,255,255,0.7); transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Back to Top Button -->
    <button id="back-to-top" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Scripts -->
    <script>
        // Preloader
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.classList.add('done');
                setTimeout(() => { preloader.style.display = 'none'; }, 600);
            }
        });

        // Header Shrink & Back to Top
        const header = document.querySelector('.site-header');
        const backToTop = document.getElementById('back-to-top');
        if (header && backToTop) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                    backToTop.classList.add('visible');
                } else {
                    header.classList.remove('scrolled');
                    backToTop.classList.remove('visible');
                }
            });
        }

        if (backToTop) {
            backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Intersection Observer for scroll animations
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    
                    // Number Counter Trigger
                    const countTarget = entry.target.querySelector('.stat-number');
                    if (countTarget && !countTarget.classList.contains('counted')) {
                        countTarget.classList.add('counted');
                        const target = +countTarget.getAttribute('data-target');
                        const suffix = countTarget.getAttribute('data-suffix') || '';
                        let count = 0;
                        const duration = 2000; // 2s duration
                        const increment = target / (duration / 16); // 60fps
                        
                        const updateCount = () => {
                            count += increment;
                            if (count < target) {
                                countTarget.innerText = Math.ceil(count) + suffix;
                                requestAnimationFrame(updateCount);
                            } else {
                                countTarget.innerText = target + suffix;
                            }
                        };
                        updateCount();
                    }

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        document.querySelectorAll('.animate-up, .animate-left, .animate-right, .animate-fade, .animate-scale').forEach(el => observer.observe(el));

        // CTA tracking
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function() {
                console.log('Primary CTA clicked: ', this.innerText);
            });
        });

        // Mobile Menu Toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navLinks = document.querySelector('.nav-links');
        if (navToggle && navLinks) {
            navToggle.addEventListener('click', () => {
                const expanded = navToggle.getAttribute('aria-expanded') === 'true' || false;
                navToggle.setAttribute('aria-expanded', !expanded);
                navLinks.classList.toggle('active');
            });
        }
        
        // Active Nav State based on URL
        const currentLocation = location.pathname;
        const navItems = document.querySelectorAll('.nav-links a');
        navItems.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            if (linkPath === currentLocation && linkPath !== '/') {
                link.classList.add('active');
            } else if (currentLocation === '/' && linkPath === '/index.php') {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>
