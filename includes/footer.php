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
    <!-- Scroll animations -->
    <script>
        // Intersection Observer for scroll animations
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        document.querySelectorAll('.animate-up').forEach(el => observer.observe(el));

        // CTA tracking
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function() {
                console.log('Primary CTA clicked: ', this.innerText);
            });
        });

        // Mobile Menu Toggle
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const navLinks = document.querySelector('.nav-links');
        if (mobileToggle && navLinks) {
            mobileToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
