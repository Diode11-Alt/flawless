<?php 
$page_title = "Jobs Portal | PrimePath HR";
include 'includes/db.php';
$jobs = get_jobs();
include 'includes/header.php'; 
?>

<main class="min-h-screen">
<!-- Hero Section / Title Area -->
<section class="relative bg-deep-navy pt-24 pb-28 overflow-hidden">
<div class="absolute inset-0 opacity-5">
<!-- Subtle background pattern or noise could go here -->
</div>
<div class="container mx-auto px-margin-mobile md:px-margin-desktop relative z-10 text-center md:text-left">
<h1 class="font-display-lg text-display-lg md:text-5xl lg:text-6xl text-white mb-8 tracking-tight">Elite Career Opportunities</h1>
<p class="text-surface-sky/70 font-body-lg text-body-lg max-w-2xl mx-auto md:mx-0 leading-relaxed">
                    Connecting visionary leaders with the UAE’s most prestigious organizations across C-Suite, Finance, and Emerging Tech sectors.
                </p>
</div>
</section>
<!-- Main Content Grid -->
<div class="container mx-auto px-margin-mobile md:px-margin-desktop py-16 flex flex-col md:flex-row gap-12">
<!-- Sidebar Filters (30%) -->
<aside class="w-full md:w-[30%] lg:w-[25%] shrink-0">
<div class="sidebar-sticky md:sticky bg-white p-10 rounded-2xl border border-border-slate card-shadow-light">
<h3 class="font-headline-sm text-xl text-deep-navy mb-8">Filter Positions</h3>
<div class="space-y-10">
<!-- Industry Filter -->
<div>
<span class="font-label-caps text-[11px] text-outline uppercase tracking-[0.1em] block mb-5">Industries</span>
<div class="space-y-4">
<label class="flex items-center group cursor-pointer">
<input checked="" class="rounded border-border-slate text-primary focus:ring-primary/20 h-4 w-4" type="checkbox"/>
<span class="ml-3 text-sm text-on-surface-variant group-hover:text-primary transition-colors">C-Suite &amp; Executive</span>
</label>
<label class="flex items-center group cursor-pointer">
<input class="rounded border-border-slate text-primary focus:ring-primary/20 h-4 w-4" type="checkbox"/>
<span class="ml-3 text-sm text-on-surface-variant group-hover:text-primary transition-colors">Banking &amp; Finance</span>
</label>
<label class="flex items-center group cursor-pointer">
<input class="rounded border-border-slate text-primary focus:ring-primary/20 h-4 w-4" type="checkbox"/>
<span class="ml-3 text-sm text-on-surface-variant group-hover:text-primary transition-colors">Technology &amp; AI</span>
</label>
<label class="flex items-center group cursor-pointer">
<input class="rounded border-border-slate text-primary focus:ring-primary/20 h-4 w-4" type="checkbox"/>
<span class="ml-3 text-sm text-on-surface-variant group-hover:text-primary transition-colors">Real Estate &amp; Dev</span>
</label>
<label class="flex items-center group cursor-pointer">
<input class="rounded border-border-slate text-primary focus:ring-primary/20 h-4 w-4" type="checkbox"/>
<span class="ml-3 text-sm text-on-surface-variant group-hover:text-primary transition-colors">Engineering &amp; Infra</span>
</label>
</div>
</div>
<!-- Location Filter -->
<div>
<span class="font-label-caps text-[11px] text-outline uppercase tracking-[0.1em] block mb-5">Location</span>
<select class="w-full bg-surface-container-lowest border border-border-slate rounded-lg p-3 text-sm font-body-md focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
<option>All UAE Locations</option>
<option>Dubai - DIFC</option>
<option>Abu Dhabi - ADGM</option>
<option>Sharjah</option>
</select>
</div>
<button class="w-full py-3.5 border border-border-slate text-on-surface-variant text-sm font-semibold rounded-lg hover:bg-surface-bright hover:border-outline-variant transition-all">
                            Reset Filters
                        </button>
</div>
<!-- CTA Mini -->
<div class="mt-12 p-6 bg-surface-sky/50 rounded-xl border border-blue-100/50">
<p class="font-headline-sm text-lg text-primary mb-2">Can't find a role?</p>
<p class="text-on-surface-variant text-[13px] mb-4 leading-relaxed">Submit your CV for our confidential talent database.</p>
<a class="text-secondary text-sm font-bold hover:underline flex items-center gap-1 group" href="#">
                            Drop CV <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
</a>
</div>
</div>
</aside>
<!-- Listings Area (70%) -->
<section class="w-full md:w-[70%] lg:w-[75%]">
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
<p class="text-on-surface-variant text-sm">Showing <span class="text-deep-navy font-bold">128</span> open positions in UAE</p>
<div class="flex items-center gap-4">
<span class="text-xs text-outline uppercase tracking-wider">Sort by:</span>
<select class="bg-transparent border-none font-bold text-sm text-deep-navy focus:ring-0 cursor-pointer p-0">
<option>Most Recent</option>
<option>Highest Salary</option>
</select>
</div>
</div>
<!-- Job Cards -->
<div class="grid gap-8">

<?php foreach ($jobs as $job): ?>
<!-- Job Card 1 -->
<div class="bg-white p-10 md:p-12 rounded-2xl border border-border-slate card-shadow-light transition-all hover:shadow-md hover:border-primary/20 group">
<div class="flex flex-col lg:flex-row justify-between items-start gap-8">
<div class="flex-1">
<div class="flex items-center gap-4 mb-5">
<span class="px-3 py-1 bg-sky-50 text-primary font-stats-number text-[11px] rounded-full uppercase tracking-widest font-bold"><?= htmlspecialchars($job['department'] ?? $job['industry'] ?? 'Corporate') ?></span>
<span class="text-outline text-xs flex items-center gap-1.5 font-medium">
<span class="material-symbols-outlined text-[16px]">schedule</span> 2 days ago
                                    </span>
</div>
<h2 class="font-headline-md text-2xl lg:text-3xl text-deep-navy mb-4 group-hover:text-primary transition-colors"><?= htmlspecialchars($job['title']) ?></h2>
<p class="text-on-surface-variant font-body-md text-base mb-8 leading-relaxed max-w-3xl">
                                    <?= htmlspecialchars(is_array($job['description']) ? implode(' ', $job['description']) : $job['description']) ?>
                                </p>
<div class="flex flex-wrap gap-y-4 gap-x-12">
<div class="flex items-center gap-2.5 text-on-surface-variant">
<span class="material-symbols-outlined text-primary/70">location_on</span>
<span class="text-sm font-medium"><?= htmlspecialchars($job['location']) ?></span>
</div>
<div class="flex items-center gap-2.5 text-on-surface-variant">
<span class="material-symbols-outlined text-primary/70">work_history</span>
<span class="text-sm font-medium"><?= htmlspecialchars($job['experience'] ?? 'Experienced') ?></span>
</div>
<div class="flex items-center gap-2.5 text-on-surface-variant">
<span class="material-symbols-outlined text-primary/70">payments</span>
<span class="text-sm font-stats-number font-medium"><?= htmlspecialchars($job['salary_range'] ?? $job['salary'] ?? 'Competitive') ?></span>
</div>
</div>
</div>
<div class="w-full lg:w-auto shrink-0 flex flex-row lg:flex-col gap-4">
<a href="job-detail.php?id=<?= $job[\'id\'] ?>" class="btn-gradient text-white px-10 py-3.5 rounded-xl font-bold flex-1 lg:flex-none text-sm tracking-wide shadow-sm hover:brightness-110 transition-all">Apply Now</a>
<button class="p-3.5 border border-border-slate rounded-xl text-outline hover:text-primary hover:border-primary/40 transition-all">
<span class="material-symbols-outlined">bookmark</span>
</button>
</div>
</div>
</div>

<?php endforeach; ?>

</div>
<!-- Pagination -->
<div class="mt-16 flex justify-center items-center gap-3">
<button class="w-11 h-11 flex items-center justify-center rounded-lg border border-border-slate text-outline hover:bg-white hover:border-primary/40 transition-all">
<span class="material-symbols-outlined text-[20px]">chevron_left</span>
</button>
<button class="w-11 h-11 flex items-center justify-center rounded-lg bg-primary text-white font-bold text-sm shadow-sm">1</button>
<button class="w-11 h-11 flex items-center justify-center rounded-lg border border-border-slate text-on-surface-variant text-sm font-medium hover:bg-white transition-colors">2</button>
<button class="w-11 h-11 flex items-center justify-center rounded-lg border border-border-slate text-on-surface-variant text-sm font-medium hover:bg-white transition-colors">3</button>
<span class="px-2 text-outline">...</span>
<button class="w-11 h-11 flex items-center justify-center rounded-lg border border-border-slate text-on-surface-variant text-sm font-medium hover:bg-white transition-colors">12</button>
<button class="w-11 h-11 flex items-center justify-center rounded-lg border border-border-slate text-outline hover:bg-white hover:border-primary/40 transition-all">
<span class="material-symbols-outlined text-[20px]">chevron_right</span>
</button>
</div>
</section>
</div>
<!-- Call to Action Banner -->
<section class="container mx-auto px-margin-mobile md:px-margin-desktop py-20">
<div class="relative bg-deep-navy rounded-3xl p-12 md:p-20 overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-12 border border-white/5">
<div class="absolute inset-0 z-0">
<div class="bg-primary/10 w-full h-full transform -skew-x-12 translate-x-1/3"></div>
</div>
<div class="relative z-10 max-w-2xl text-center lg:text-left">
<h2 class="font-headline-md text-3xl md:text-4xl text-white mb-6">Partnering for Executive Talent</h2>
<p class="text-surface-sky/60 font-body-md text-lg leading-relaxed">Hiring for your organization? Let PrimePath handle the precision search for your next strategic leader with our bespoke methodology.</p>
</div>
<div class="relative z-10">
<button class="px-12 py-5 bg-white text-deep-navy font-bold rounded-xl hover:bg-surface-sky transition-all transform hover:scale-[1.02] shadow-xl">
                        Client Inquiries
                    </button>
</div>
</div>
</section>
</main>

<?php include 'includes/footer.php'; ?>
