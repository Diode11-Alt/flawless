<footer class="bg-deep-navy text-surface-sky px-margin-mobile md:px-margin-desktop py-24 w-full border-t border-white/5">
<div class="grid grid-cols-1 md:grid-cols-4 gap-16">
<div class="md:col-span-1">
<div class="font-headline-md text-headline-md font-bold text-white mb-8 tracking-tight">PrimePath HR</div>
<p class="text-surface-variant/50 text-sm leading-relaxed mb-8">
                Redefining recruitment across the GCC through precision, authority, and deep market expertise.
            </p>
</div>
<div>
<h5 class="text-white font-bold mb-8 uppercase text-[10px] tracking-[0.2em] opacity-60">Services</h5>
<ul class="space-y-5">
<li><a class="text-surface-variant/70 hover:text-primary-fixed transition-colors font-body-md text-sm" href="javascript:void(0)">Executive Search</a></li>
<li><a class="text-surface-variant/70 hover:text-primary-fixed transition-colors font-body-md text-sm" href="javascript:void(0)">HR Outsourcing</a></li>
<li><a class="text-surface-variant/70 hover:text-primary-fixed transition-colors font-body-md text-sm" href="javascript:void(0)">Talent Management</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-8 uppercase text-[10px] tracking-[0.2em] opacity-60">Insights</h5>
<ul class="space-y-5">
<li><a class="text-surface-variant/70 hover:text-primary-fixed transition-colors font-body-md text-sm" href="javascript:void(0)">Labor Law Updates</a></li>
<li><a class="text-surface-variant/70 hover:text-primary-fixed transition-colors font-body-md text-sm" href="javascript:void(0)">Market Trends</a></li>
<li><a class="text-surface-variant/70 hover:text-primary-fixed transition-colors font-body-md text-sm" href="javascript:void(0)">Careers</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-8 uppercase text-[10px] tracking-[0.2em] opacity-60">Connect</h5>
<p class="text-surface-variant/50 text-sm mb-8 leading-relaxed">
                Sheikh Zayed Road, Level 24,<br/>
                Dubai, United Arab Emirates
            </p>
<div class="flex gap-4">
<a class="w-11 h-11 rounded-full border border-white/10 flex items-center justify-center hover:bg-primary transition-all group" href="javascript:void(0)">
<span class="material-symbols-outlined text-sm group-hover:scale-110 transition-transform">alternate_email</span>
</a>
<a class="w-11 h-11 rounded-full border border-white/10 flex items-center justify-center hover:bg-primary transition-all group" href="javascript:void(0)">
<span class="material-symbols-outlined text-sm group-hover:scale-110 transition-transform">share</span>
</a>
</div>
</div>
</div>
<div class="pt-16 mt-16 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
<p class="text-surface-variant/30 text-[10px] uppercase tracking-widest">© 2024 PrimePath HR Services. All rights reserved.</p>
<div class="flex gap-10 text-[10px] uppercase tracking-widest text-surface-variant/30">
<a class="hover:text-white transition-colors" href="javascript:void(0)">Privacy Policy</a>
<a class="hover:text-white transition-colors" href="javascript:void(0)">Terms of Service</a>
</div>
</div>
</footer>
<script>
    // Mobile Menu Toggle (Tailwind version)
    document.querySelector('.md\\:hidden')?.addEventListener('click', function() {
        const nav = document.querySelector('nav');
        if (nav) {
            nav.classList.toggle('hidden');
            nav.classList.toggle('flex');
            nav.classList.toggle('flex-col');
            nav.classList.toggle('absolute');
            nav.classList.toggle('top-full');
            nav.classList.toggle('left-0');
            nav.classList.toggle('w-full');
            nav.classList.toggle('bg-white');
            nav.classList.toggle('p-6');
            nav.classList.toggle('shadow-lg');
            nav.classList.toggle('border-t');
            nav.classList.toggle('z-50');
        }
    });

    // Intersection Observer for Smooth Reveal Animations
    document.addEventListener("DOMContentLoaded", function() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
            observer.observe(el);
        });
    });
</script>
</body>
</html>
