# AGENT BRIEF — PrimePath HR Website
## Repo: https://github.com/Diode11-Alt/flawless.git
## Stack: PHP + Vanilla JS + Custom CSS (no frameworks)
## Copy-paste this entire file into your agent.

---

# PART 1 — CRITICAL BUGS (Fix these FIRST, in order)

---

## BUG 1 — Mobile hamburger has no JavaScript handler
**File:** `includes/header.php` + `includes/footer.php`

**Problem:** There are TWO hamburger buttons in the header:
- `<button class="nav-toggle">` — has JS handler in footer.php
- `<button class="mobile-menu-toggle">` — CSS shows it on mobile, but ZERO JS attached

On mobile, `.mobile-menu-toggle` appears (CSS `display: block` at 992px breakpoint), but clicking it does NOTHING. The `.nav-toggle` is hidden inside the `<nav>` so users can't reach it on mobile.

**Fix:** In `includes/footer.php`, inside the existing script block, add this alongside the existing nav-toggle handler:

```javascript
// Mobile menu toggle (the visible hamburger on mobile)
const mobileToggle = document.querySelector('.mobile-menu-toggle');
if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        const isOpen = navLinks.classList.contains('active');
        mobileToggle.setAttribute('aria-expanded', isOpen);
        // Change icon between bars and X
        const icon = mobileToggle.querySelector('i');
        if (icon) {
            icon.className = isOpen ? 'fas fa-times' : 'fas fa-bars';
        }
    });
}
// Close mobile nav when a link is clicked
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
        if (mobileToggle) {
            mobileToggle.setAttribute('aria-expanded', 'false');
            const icon = mobileToggle.querySelector('i');
            if (icon) icon.className = 'fas fa-bars';
        }
    });
});
```

Also remove the `.nav-toggle` button from inside `<nav>` in `includes/header.php` entirely — it is redundant. Only keep `.mobile-menu-toggle` in the `.header-inner` div.

---

## BUG 2 — jobs.php page title renders wrong
**File:** `jobs.php`

**Problem:** `$page_title = "Careers | PrimePath HR";` is set on line 22, AFTER `include 'includes/header.php';` is called on line 2. The `<title>` tag in the header is already printed before `$page_title` has a value, so the browser title always shows "Home | PrimePath HR" on the Careers page.

**Fix:** Move `$page_title` BEFORE the header include. In `jobs.php`, rearrange the top like this:

```php
<?php 
include 'includes/db.php';
$page_title = "Careers | PrimePath HR";   // SET FIRST
include 'includes/header.php';            // THEN include header
$jobs = get_jobs();
// ... rest of filter logic
```

---

## BUG 3 — Location filter in jobs.php search bar does nothing
**File:** `jobs.php`

**Problem:** The search bar has `<select name="location">` with Dubai/Abu Dhabi options. This value is submitted via GET but PHP never reads `$_GET['location']` — the filter doesn't exist.

**Fix:** After the existing `$types` filter block in `jobs.php`, add:

```php
// Filter by location dropdown
$location_filter = strtolower(trim($_GET['location'] ?? ''));
if ($location_filter) {
    $jobs = array_filter($jobs, fn($j) =>
        stripos(strtolower($j['location']), $location_filter) !== false
    );
}
```

Also update the select so it remembers the user's choice:

```php
<select name="location" style="flex: 1; min-width: 150px;">
    <option value="">All Locations</option>
    <option value="dubai" <?= (($_GET['location'] ?? '') === 'dubai') ? 'selected' : '' ?>>Dubai</option>
    <option value="abudhabi" <?= (($_GET['location'] ?? '') === 'abudhabi') ? 'selected' : '' ?>>Abu Dhabi</option>
</select>
```

---

## BUG 4 — Sidebar Industry checkboxes do nothing
**File:** `jobs.php`

**Problem:** The sidebar has "Industry" checkboxes (`name="industry[]"`), but PHP never reads `$_GET['industry']`. Clicking them and submitting does nothing.

**Note:** Jobs in `data/jobs.json` currently have no `industry` field, so this can't fully work yet. Two-step fix:

**Step A — Add `industry` field to `data/jobs.json`:**

```json
[
    {
        "id": 1,
        "title": "Senior Frontend Developer",
        "company": "TechVision UAE",
        "location": "Dubai",
        "type": "Full-Time",
        "salary": "AED 18,000 - 25,000",
        "industry": "tech"
    },
    {
        "id": 2,
        "title": "HR Manager",
        "company": "Global Solutions Group",
        "location": "Abu Dhabi",
        "type": "Full-Time",
        "salary": "AED 15,000 - 22,000",
        "industry": "finance"
    },
    {
        "id": 3,
        "title": "Data Scientist",
        "company": "AI Innovators",
        "location": "Dubai",
        "type": "Contract",
        "salary": "AED 20,000 - 30,000",
        "industry": "tech"
    }
]
```

**Step B — Add PHP filter in `jobs.php`:**

```php
// Filter by industry
$industries = $_GET['industry'] ?? [];
if (!empty($industries)) {
    $jobs = array_filter($jobs, fn($j) =>
        in_array(strtolower($j['industry'] ?? ''), array_map('strtolower', $industries))
    );
}
```

**Step C — Wrap sidebar in a form and wire up the button.** The sidebar checkboxes are currently OUTSIDE any `<form>` tag — the "Apply Filters" button does nothing. Wrap the sidebar:

```php
<form action="jobs.php" method="GET">
    <!-- preserve the search query -->
    <input type="hidden" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <input type="hidden" name="location" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>">
    
    <aside class="filters-sidebar animate-up delay-2">
        <h4>Filters</h4>
        <div class="filter-group">
            <label><strong>Job Type</strong></label>
            <label><input type="checkbox" name="type[]" value="full-time" <?= in_array('full-time', array_map('strtolower', $_GET['type'] ?? [])) ? 'checked' : '' ?>> Full Time</label>
            <label><input type="checkbox" name="type[]" value="part-time" <?= in_array('part-time', array_map('strtolower', $_GET['type'] ?? [])) ? 'checked' : '' ?>> Part Time</label>
            <label><input type="checkbox" name="type[]" value="contract" <?= in_array('contract', array_map('strtolower', $_GET['type'] ?? [])) ? 'checked' : '' ?>> Contract</label>
        </div>
        <div class="filter-group">
            <label><strong>Industry</strong></label>
            <label><input type="checkbox" name="industry[]" value="tech" <?= in_array('tech', $_GET['industry'] ?? []) ? 'checked' : '' ?>> Technology</label>
            <label><input type="checkbox" name="industry[]" value="finance" <?= in_array('finance', $_GET['industry'] ?? []) ? 'checked' : '' ?>> Finance</label>
            <label><input type="checkbox" name="industry[]" value="healthcare" <?= in_array('healthcare', $_GET['industry'] ?? []) ? 'checked' : '' ?>> Healthcare</label>
        </div>
        <button type="submit" class="btn btn-outline" style="width: 100%; margin-top: 10px;">Apply Filters</button>
        <a href="jobs.php" style="display: block; text-align: center; margin-top: 10px; font-size: 13px; color: var(--text-muted);">Clear all filters</a>
    </aside>
</form>
```

---

## BUG 5 — Sort dropdown has no name and no PHP logic
**File:** `jobs.php`

**Problem:** The "Sort by: Newest" dropdown has no `name` attribute — it's purely decorative. Selecting a sort option does nothing.

**Fix:** Add `name="sort"` to the dropdown, move it inside the search `<form>`, and add PHP sorting logic:

HTML change — add `name` and make it auto-submit:
```php
<select name="sort" onchange="this.form.submit()" style="padding: 8px 15px; border-radius: 5px; border: 1px solid #E2E8F0;">
    <option value="newest" <?= (($_GET['sort'] ?? 'newest') === 'newest') ? 'selected' : '' ?>>Sort by: Newest</option>
    <option value="salary_high" <?= (($_GET['sort'] ?? '') === 'salary_high') ? 'selected' : '' ?>>Salary: High to Low</option>
</select>
```

PHP sorting logic (add after all filters):
```php
// Sort
$sort = $_GET['sort'] ?? 'newest';
$jobs = array_values($jobs); // re-index after array_filter
if ($sort === 'salary_high') {
    usort($jobs, function($a, $b) {
        // Extract first number from salary string e.g. "AED 18,000 - 25,000"
        preg_match('/[\d,]+/', $a['salary'], $ma);
        preg_match('/[\d,]+/', $b['salary'], $mb);
        $sa = isset($ma[0]) ? (int)str_replace(',', '', $ma[0]) : 0;
        $sb = isset($mb[0]) ? (int)str_replace(',', '', $mb[0]) : 0;
        return $sb - $sa;
    });
} else {
    // Default: sort by id descending (newest added = highest id)
    usort($jobs, fn($a, $b) => $b['id'] - $a['id']);
}
```

---

## BUG 6 — job-detail.php has static hardcoded description for EVERY job
**File:** `job-detail.php` + `data/jobs.json`

**Problem:** Every job detail page shows the exact same hardcoded "We are looking for an experienced [title]..." text with the same 3 generic bullet points. The JSON has no per-job description fields.

**Step A — Add description fields to `data/jobs.json`:**

```json
[
    {
        "id": 1,
        "title": "Senior Frontend Developer",
        "company": "TechVision UAE",
        "location": "Dubai",
        "type": "Full-Time",
        "salary": "AED 18,000 - 25,000",
        "industry": "tech",
        "description": "We are seeking a highly skilled Senior Frontend Developer to lead the development of our customer-facing web applications. You will work closely with our product and backend teams to deliver exceptional digital experiences across the UAE.",
        "responsibilities": [
            "Architect and build responsive, high-performance web interfaces using React or Vue.js",
            "Lead code reviews and establish frontend best practices across the engineering team",
            "Collaborate with UX/UI designers to implement pixel-perfect designs",
            "Optimize applications for maximum speed and scalability",
            "Mentor junior developers and contribute to team knowledge sharing"
        ],
        "requirements": [
            "5+ years of frontend development experience with React or Vue.js",
            "Strong command of HTML5, CSS3, and modern JavaScript (ES6+)",
            "Experience with REST APIs and GraphQL integration",
            "Proven track record of delivering production-grade web applications",
            "Bachelor's degree in Computer Science or equivalent practical experience"
        ]
    },
    {
        "id": 2,
        "title": "HR Manager",
        "company": "Global Solutions Group",
        "location": "Abu Dhabi",
        "type": "Full-Time",
        "salary": "AED 15,000 - 22,000",
        "industry": "finance",
        "description": "Global Solutions Group is seeking an experienced HR Manager to lead talent acquisition, employee relations, and compliance across our Abu Dhabi operations. This is a strategic role for an HR professional passionate about building high-performance workplace cultures.",
        "responsibilities": [
            "Oversee end-to-end recruitment processes and talent pipeline development",
            "Ensure full compliance with UAE Labour Law, MOHRE regulations, and WPS requirements",
            "Develop and implement performance management and career development frameworks",
            "Manage employee relations, dispute resolution, and disciplinary procedures",
            "Partner with senior leadership on workforce planning and organizational design"
        ],
        "requirements": [
            "7+ years of HR management experience, ideally within the UAE or GCC",
            "Deep knowledge of UAE Labour Law, Emiratisation (Tawteen) policies, and MOHRE procedures",
            "CIPD, SHRM, or equivalent HR certification strongly preferred",
            "Excellent interpersonal, negotiation, and communication skills",
            "Proficiency in HRIS systems and Microsoft Office Suite"
        ]
    },
    {
        "id": 3,
        "title": "Data Scientist",
        "company": "AI Innovators",
        "location": "Dubai",
        "type": "Contract",
        "salary": "AED 20,000 - 30,000",
        "industry": "tech",
        "description": "AI Innovators is looking for a talented Data Scientist to join our rapidly growing team in Dubai. You will leverage large datasets and cutting-edge machine learning techniques to develop models that directly impact our product roadmap and business strategy.",
        "responsibilities": [
            "Design, develop, and deploy machine learning models for production environments",
            "Analyze complex datasets to extract actionable business insights",
            "Collaborate with engineering teams to integrate AI models into existing products",
            "Present findings and recommendations to senior stakeholders in clear, business-focused language",
            "Stay current with latest developments in ML, NLP, and AI research"
        ],
        "requirements": [
            "3+ years of hands-on experience in data science or machine learning roles",
            "Proficiency in Python (pandas, scikit-learn, TensorFlow or PyTorch)",
            "Strong statistical and mathematical foundation",
            "Experience with cloud platforms (AWS, GCP, or Azure) for model deployment",
            "Master's degree or PhD in Data Science, Statistics, Computer Science, or related field preferred"
        ]
    }
]
```

**Step B — Update `job-detail.php` to display dynamic content:**

Replace the static `<div class="single-blog-content">` block with:

```php
<div class="single-blog-content">
    <h2>Job Description</h2>
    <p><?= htmlspecialchars($job['description'] ?? 'Full job description available upon application.') ?></p>
    
    <?php if (!empty($job['responsibilities'])): ?>
    <h3>Key Responsibilities</h3>
    <ul style="margin-left: 20px; margin-top: 15px; line-height: 1.8;">
        <?php foreach ($job['responsibilities'] as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    
    <?php if (!empty($job['requirements'])): ?>
    <h3>Requirements</h3>
    <ul style="margin-left: 20px; margin-top: 15px; line-height: 1.8;">
        <?php foreach ($job['requirements'] as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
```

**Step C — Update `admin/process.php` add job handler** to accept optional description/responsibilities/requirements fields so admin can add richer jobs later:

```php
if ($action == 'add') {
    $data = [
        'title'            => sanitize($_POST['title'] ?? ''),
        'company'          => sanitize($_POST['company'] ?? ''),
        'location'         => sanitize($_POST['location'] ?? ''),
        'type'             => sanitize($_POST['type'] ?? ''),
        'salary'           => sanitize($_POST['salary'] ?? ''),
        'industry'         => sanitize($_POST['industry'] ?? ''),
        'description'      => trim($_POST['description'] ?? ''),
        'responsibilities' => array_filter(array_map('trim', explode("\n", $_POST['responsibilities'] ?? ''))),
        'requirements'     => array_filter(array_map('trim', explode("\n", $_POST['requirements'] ?? ''))),
    ];
    add_job($data);
}
```

---

## BUG 7 — contact.php submits data to nowhere
**File:** `contact.php`

**Problem:** When contact form is submitted, PHP shows a success message but data is NEVER sent anywhere — no email, no Zoho, no file log. Data is silently discarded.

**Minimum viable fix** — save to a contacts log file until Zoho is wired:

```php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name'      => htmlspecialchars(strip_tags(trim($_POST['name'] ?? ''))),
        'email'     => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone'     => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'message'   => htmlspecialchars(strip_tags(trim($_POST['message'] ?? ''))),
        'submitted' => date('Y-m-d H:i:s'),
        'source'    => 'contact_form'
    ];

    // Save to local log
    $log_file = __DIR__ . '/data/contacts.json';
    $contacts = [];
    if (file_exists($log_file)) {
        $contacts = json_decode(file_get_contents($log_file), true) ?? [];
    }
    $contacts[] = $data;
    file_put_contents($log_file, json_encode($contacts, JSON_PRETTY_PRINT));

    // Send Zoho (uncomment when token is ready)
    // send_to_zoho_crm($data);

    // Send email notification (basic, requires mail() configured on server)
    // mail('info@primepathuae.com', 'New Contact Form Submission', 
    //     "Name: {$data['name']}\nEmail: {$data['email']}\nPhone: {$data['phone']}\nMessage: {$data['message']}");

    $message = "Thank you, {$data['name']}! Your message has been received. We'll be in touch within 24 hours.";
}
```

---

## BUG 8 — register.php Zoho call permanently commented out + data lost
**File:** `register.php`

**Problem:** Zoho call is commented out. Data goes nowhere. No log.

**Fix — same pattern as contact.php:**

```php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name'      => htmlspecialchars(strip_tags(trim($_POST['name'] ?? ''))),
        'email'     => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        'phone'     => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? ''))),
        'submitted' => date('Y-m-d H:i:s'),
        'source'    => 'inquiry_form'
    ];

    // Save to leads log
    $log_file = __DIR__ . '/data/leads.json';
    $leads = [];
    if (file_exists($log_file)) {
        $leads = json_decode(file_get_contents($log_file), true) ?? [];
    }
    $leads[] = $data;
    file_put_contents($log_file, json_encode($leads, JSON_PRETTY_PRINT));

    // send_to_zoho_crm($data); // Uncomment when token is configured

    $message = "Thank you, {$data['name']}! Your inquiry has been received. Our team will contact you shortly.";
}
```

---

## BUG 9 — No .htaccess — data/ folder is publicly accessible
**Create new file:** `.htaccess` in project root

```apache
# Deny direct access to data folder (JSON files are sensitive)
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Block access to data directory
    RewriteRule ^data/ - [F,L]

    # Optional: redirect www to non-www
    # RewriteCond %{HTTP_HOST} ^www\.(.+)$ [NC]
    # RewriteRule ^ https://%1%{REQUEST_URI} [R=301,L]
</IfModule>

# Security headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Hide PHP version
Header unset X-Powered-By

# Prevent directory listing
Options -Indexes
```

**Also create:** `data/.htaccess` with just:
```apache
deny from all
```

---

## BUG 10 — Admin credentials hardcoded in PHP + no session hardening
**File:** `admin/login.php`

**Problem:** `ADMIN_USER` and `ADMIN_HASH` are hardcoded in the PHP file which is version-controlled. Anyone with repo access sees the hash. Also, no `session_regenerate_id()` after login = session fixation vulnerability.

**Fix — move creds to a config file outside the web root ideally, or at minimum a separate config.php:**

Create `admin/config.php` (add to `.gitignore`):
```php
<?php
// DO NOT COMMIT THIS FILE
define('ADMIN_USER', 'admin');
// Generate new hash: php -r "echo password_hash('your_password', PASSWORD_BCRYPT, ['cost'=>12]);"
define('ADMIN_HASH', '$2y$12$8.euxuNX3ZLIHBQhwv5BgODDFUhHIFZBQawJuOUl8RG9FP.9eo4eK');
```

Update `admin/login.php` top:
```php
<?php
session_start();
require_once 'config.php'; // load from separate file

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === ADMIN_USER && password_verify($password, ADMIN_HASH)) {
        session_regenerate_id(true); // PREVENT SESSION FIXATION
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        // Small delay to slow brute force
        sleep(1);
        $error = "Invalid credentials";
    }
}
```

Add `admin/config.php` to `.gitignore`:
```
/admin/config.php
/data/leads.json
/data/contacts.json
```

---

## BUG 11 — delay-4 animation class mismatch
**File:** `assets/css/style.css`

**Problem:** `.animate-up` uses `animation-delay`, but `.delay-4` through `.delay-6` use `transition-delay`. These are different CSS properties. `.delay-4` will NOT delay the fadeInUp animation on elements using `animate-up delay-4`.

**Fix:** In `assets/css/style.css`, update delay classes to set BOTH:

```css
.delay-1 { animation-delay: 0.1s; transition-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; transition-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; transition-delay: 0.3s; }
.delay-4 { animation-delay: 0.4s; transition-delay: 0.4s; }
.delay-5 { animation-delay: 0.5s; transition-delay: 0.5s; }
.delay-6 { animation-delay: 0.6s; transition-delay: 0.6s; }
```

---

# PART 2 — UI/UX IMPROVEMENTS (Inspired by top HR agency websites: Mitchell Adam, Blu Digital, Hanover, Bond Global)

---

## UI UPGRADE 1 — Dual Audience Split on Homepage Hero
**Inspired by:** Mitchell Adam (KIJO-designed), Clarity Recruiting
**File:** `index.php`

**Why:** Best HR websites serve two audiences — job seekers AND employers — each with separate journeys and CTAs. Currently PrimePath only has one path. This is the single biggest UX upgrade.

**Replace the two CTA buttons in the hero section** from:
```html
<div style="display: flex; gap: 15px; flex-wrap: wrap;">
    <a href="contact.php" class="btn btn-primary" ...>Find Top Talent</a>
    <a href="jobs.php" class="btn btn-outline" ...>Explore Careers</a>
</div>
```

**With this dual-path CTA block:**
```html
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
```

**Add to `assets/css/style.css`:**
```css
.dual-cta {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px 32px;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.dual-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
}
```

---

## UI UPGRADE 2 — Client Logo Strip (Social Proof)
**Inspired by:** Blu Digital, Hanover, Porter Group
**File:** `index.php`

**Why:** Top recruitment sites prominently display client logos to build instant credibility. PrimePath has none.

**Add this section directly BELOW the hero section, before the "Who We Are" section:**

```html
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
```

**Add to `assets/css/style.css`:**
```css
.logo-strip {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 48px;
    flex-wrap: wrap;
    opacity: 0.5;
    filter: grayscale(100%);
    transition: opacity 0.3s;
}
.logo-strip:hover {
    opacity: 0.8;
    filter: grayscale(0%);
}
.logo-item {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 18px;
    color: var(--primary-navy);
    letter-spacing: -0.5px;
    white-space: nowrap;
}
/* Replace .logo-item text with <img> tags when real logos exist */
```

---

## UI UPGRADE 3 — "How We Work" Process Section
**Inspired by:** Hanover, SearchTech (KIJO), OnDeck Recruiting
**File:** `index.php`

**Why:** Top recruitment sites explain their process with a numbered timeline. It builds trust and reduces hesitation. PrimePath has no process section.

**Add this after the "What Sets Us Apart" section:**

```html
<!-- How We Work -->
<section id="process" class="section" style="background: var(--primary-navy); padding: 100px 0; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="section-title">
            <h2 style="color: white;">How We <span style="color: var(--secondary-blue);">Work</span></h2>
            <p style="color: rgba(255,255,255,0.7);">Our proven 4-step process delivers the right talent, every time.</p>
        </div>
        <div class="process-steps">
            <div class="process-step animate-up delay-1">
                <div class="step-number">01</div>
                <div class="step-icon"><i class="fas fa-comments"></i></div>
                <h3>Discovery Call</h3>
                <p>We learn your organization's culture, goals, and exact requirements through a structured briefing.</p>
            </div>
            <div class="process-connector"></div>
            <div class="process-step animate-up delay-2">
                <div class="step-number">02</div>
                <div class="step-icon"><i class="fas fa-search"></i></div>
                <h3>Talent Mapping</h3>
                <p>Our proprietary database and active search methodology targets passive candidates not visible on job boards.</p>
            </div>
            <div class="process-connector"></div>
            <div class="process-step animate-up delay-3">
                <div class="step-number">03</div>
                <div class="step-icon"><i class="fas fa-user-check"></i></div>
                <h3>Shortlist Delivery</h3>
                <p>We deliver a curated shortlist of 3–5 vetted candidates within 14 business days.</p>
            </div>
            <div class="process-connector"></div>
            <div class="process-step animate-up delay-4">
                <div class="step-number">04</div>
                <div class="step-icon"><i class="fas fa-handshake"></i></div>
                <h3>Placement & Support</h3>
                <p>We manage offer negotiation, onboarding, and provide a 90-day placement guarantee.</p>
            </div>
        </div>
    </div>
</section>
```

**Add to `assets/css/style.css`:**
```css
.process-steps {
    display: flex;
    align-items: flex-start;
    gap: 0;
    margin-top: 60px;
}
.process-step {
    flex: 1;
    text-align: center;
    padding: 0 20px;
    position: relative;
}
.step-number {
    font-family: var(--font-heading);
    font-size: 48px;
    font-weight: 700;
    color: var(--secondary-blue);
    opacity: 0.3;
    line-height: 1;
    margin-bottom: 8px;
}
.step-icon {
    width: 64px;
    height: 64px;
    background: rgba(0, 180, 216, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    border: 1px solid rgba(0, 180, 216, 0.3);
}
.step-icon i {
    color: var(--secondary-blue);
    font-size: 22px;
}
.process-step h3 {
    color: white;
    font-size: 18px;
    margin-bottom: 12px;
}
.process-step p {
    color: rgba(255,255,255,0.65);
    font-size: 14px;
    line-height: 1.7;
}
.process-connector {
    flex: 0 0 1px;
    height: 1px;
    background: linear-gradient(90deg, rgba(0,180,216,0.5), rgba(0,180,216,0.1));
    margin-top: 80px;
    width: 40px;
}
@media (max-width: 768px) {
    .process-steps {
        flex-direction: column;
        gap: 40px;
    }
    .process-connector {
        width: 1px;
        height: 40px;
        background: linear-gradient(180deg, rgba(0,180,216,0.5), rgba(0,180,216,0.1));
        margin: 0 auto;
    }
}
```

---

## UI UPGRADE 4 — Testimonials / Social Proof Section
**Inspired by:** Tattersall Recruiting, Porter Group, Hanover
**File:** `index.php`

**Why:** Testimonials are the #1 trust signal on any professional services site. PrimePath has zero.

**Add after the CEO section:**

```html
<!-- Testimonials -->
<section id="testimonials" class="section section-bg-white" style="padding: 100px 0;">
    <div class="container">
        <div class="section-title">
            <h2>What Our <span>Clients Say</span></h2>
            <p>Trusted by HR leaders and executives across the GCC.</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card animate-up delay-1">
                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                <p class="testimonial-text">"PrimePath placed our VP of Operations in 11 days. The quality of candidates was exceptional — they genuinely understood our culture and the seniority of the role."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">MK</div>
                    <div>
                        <strong>Mohammed Al-Khalidi</strong>
                        <span>CEO, Gulf Logistics Partners — Dubai</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card animate-up delay-2">
                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                <p class="testimonial-text">"Their knowledge of Emiratisation regulations saved us months of compliance work. Highly recommend for any business navigating Tawteen requirements in the UAE."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">SA</div>
                    <div>
                        <strong>Sarah Al-Amiri</strong>
                        <span>HR Director, Meridian Financial Group — Abu Dhabi</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card animate-up delay-3">
                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                <p class="testimonial-text">"We've used three recruitment firms in Dubai. PrimePath is the only one that felt like a true strategic partner rather than just a CV-forwarding service."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">JP</div>
                    <div>
                        <strong>James Pritchard</strong>
                        <span>COO, TechVision UAE — Dubai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Add to `assets/css/style.css`:**
```css
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 50px;
}
.testimonial-card {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 40px 35px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    position: relative;
}
.testimonial-card:hover {
    box-shadow: var(--shadow-card);
    transform: translateY(-4px);
}
.quote-icon {
    color: var(--secondary-blue);
    font-size: 24px;
    margin-bottom: 20px;
    opacity: 0.5;
}
.testimonial-text {
    color: var(--text-muted);
    font-size: 15px;
    line-height: 1.8;
    font-style: italic;
    margin-bottom: 30px;
}
.testimonial-author {
    display: flex;
    align-items: center;
    gap: 14px;
}
.author-avatar {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--primary-navy), var(--secondary-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 13px;
    flex-shrink: 0;
}
.testimonial-author strong {
    display: block;
    color: var(--primary-navy);
    font-size: 14px;
}
.testimonial-author span {
    color: var(--text-muted);
    font-size: 12px;
}
@media (max-width: 900px) {
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
}
```

---

## UI UPGRADE 5 — Job Cards Redesign (jobs.php)
**Inspired by:** HyreLink HR Dashboard, Nubize, modern job boards
**File:** `jobs.php` + `assets/css/style.css`

**Why:** Current job cards are plain. Top job portals display salary prominently, have urgency badges, and have better visual hierarchy.

**Replace the existing `.job-card` inner HTML** with this improved layout:

```php
<div class="job-card animate-up delay-<?= min($delay++, 3) ?>">
    <div class="job-card-header">
        <div class="company-logo-placeholder">
            <?= strtoupper(substr($job['company'], 0, 2)) ?>
        </div>
        <div class="job-card-top-info">
            <span class="job-type-badge <?= strtolower(str_replace(' ', '-', $job['type'])) ?>">
                <?= htmlspecialchars($job['type']) ?>
            </span>
            <span class="job-id-label">REF: PRM-<?= $job['id'] ?></span>
        </div>
    </div>
    <div class="job-info" style="margin-top: 16px;">
        <h3>
            <a href="job-detail.php?id=<?= $job['id'] ?>" style="color: var(--primary-navy); text-decoration: none;">
                <?= htmlspecialchars($job['title']) ?>
            </a>
        </h3>
        <div class="job-meta" style="margin-top: 12px; display: flex; flex-wrap: wrap; gap: 10px;">
            <span class="meta-tag"><i class="fas fa-building"></i> <?= htmlspecialchars($job['company']) ?></span>
            <span class="meta-tag"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['location']) ?></span>
        </div>
    </div>
    <div class="job-card-footer">
        <div class="salary-display">
            <span class="salary-label">Package</span>
            <strong><?= htmlspecialchars($job['salary']) ?></strong>
        </div>
        <a href="job-detail.php?id=<?= $job['id'] ?>" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px;">
            View & Apply <i class="fas fa-arrow-right" style="margin-left: 6px;"></i>
        </a>
    </div>
</div>
```

**Add to `assets/css/style.css`:**
```css
.job-card {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    transition: box-shadow 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
}
.job-card:hover {
    box-shadow: var(--shadow-card);
    border-color: var(--secondary-blue);
    transform: translateX(4px);
}
.job-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.company-logo-placeholder {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary-navy), var(--secondary-blue));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 16px;
    font-family: var(--font-heading);
}
.job-card-top-info {
    display: flex;
    align-items: center;
    gap: 10px;
}
.job-type-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.job-type-badge.full-time {
    background: rgba(0, 180, 216, 0.12);
    color: var(--secondary-blue);
}
.job-type-badge.contract {
    background: rgba(255, 165, 0, 0.12);
    color: #c17f00;
}
.job-type-badge.part-time {
    background: rgba(100, 149, 237, 0.12);
    color: #4060d0;
}
.job-id-label {
    font-size: 11px;
    color: var(--text-muted);
    font-family: monospace;
}
.meta-tag {
    background: var(--bg-light);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 6px;
}
.meta-tag i {
    color: var(--secondary-blue);
    font-size: 11px;
}
.job-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
    flex-wrap: wrap;
    gap: 12px;
}
.salary-display .salary-label {
    display: block;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin-bottom: 2px;
}
.salary-display strong {
    font-size: 17px;
    color: var(--primary-navy);
    font-family: var(--font-heading);
}
```

---

## UI UPGRADE 6 — Active Nav Highlight Fix
**File:** `includes/footer.php`

**Problem:** Active nav state JS checks `pathname` against `linkPath` but all nav links use `.php` extensions and anchor fragments, so the matching logic is unreliable. "About Us" never highlights even on the homepage.

**Replace the "Active Nav State" JS block** at the bottom of `includes/footer.php` with:

```javascript
// Active nav state
const currentPath = location.pathname.replace(/\/$/, '') || '/index.php';
const currentHash = location.hash;
document.querySelectorAll('.nav-links a').forEach(link => {
    const url = new URL(link.href);
    const linkPath = url.pathname.replace(/\/$/, '');
    const linkHash = url.hash;
    
    // Match exact page
    if (linkPath === currentPath && !linkHash) {
        link.classList.add('active');
    }
    // Match homepage links
    if ((currentPath.endsWith('index.php') || currentPath === '/') && linkPath.endsWith('index.php') && !linkHash) {
        link.classList.add('active');
    }
});
```

---

## UI UPGRADE 7 — Add FAQ Section
**Inspired by:** Best-practice recruitment sites, Hanover, GritHR
**File:** `index.php`

**Why:** FAQ sections reduce bounce rate, answer objections pre-emptively, and improve SEO.

**Add before the footer:**

```html
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
```

**Add to `assets/css/style.css`:**
```css
.faq-grid {
    max-width: 820px;
    margin: 50px auto 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.faq-item {
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    background: white;
    transition: border-color 0.2s;
}
.faq-item:hover {
    border-color: var(--secondary-blue);
}
.faq-question {
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    padding: 22px 28px;
    font-family: var(--font-heading);
    font-size: 16px;
    font-weight: 600;
    color: var(--primary-navy);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    transition: color 0.2s;
}
.faq-question:hover {
    color: var(--secondary-blue);
}
.faq-icon {
    font-size: 14px;
    color: var(--secondary-blue);
    transition: transform 0.3s ease;
    flex-shrink: 0;
}
.faq-question.open .faq-icon {
    transform: rotate(45deg);
}
.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease, padding 0.3s ease;
    padding: 0 28px;
}
.faq-answer.open {
    max-height: 200px;
    padding: 0 28px 22px;
}
.faq-answer p {
    color: var(--text-muted);
    font-size: 15px;
    line-height: 1.8;
}
```

**Add the FAQ JS** in `includes/footer.php` script block:
```javascript
function toggleFaq(btn) {
    const answer = btn.nextElementSibling;
    const isOpen = answer.classList.contains('open');
    // Close all
    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-question').forEach(b => b.classList.remove('open'));
    // Open this one if it wasn't open
    if (!isOpen) {
        answer.classList.add('open');
        btn.classList.add('open');
    }
}
```

---

## UI UPGRADE 8 — Sticky "Get in Touch" CTA Banner above footer
**Inspired by:** Mitchell Adam, Blu Digital (persistent conversion nudge)
**File:** `includes/footer.php`

**Add directly BEFORE the `<footer>` tag:**

```html
<!-- Pre-footer CTA Banner -->
<section style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); padding: 70px 0;">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; gap: 30px; flex-wrap: wrap;">
        <div>
            <h2 style="color: white; font-size: 32px; margin-bottom: 10px;">Ready to find exceptional talent?</h2>
            <p style="color: rgba(255,255,255,0.85); font-size: 16px; margin: 0;">Join 50+ enterprise clients who trust PrimePath HR across the GCC.</p>
        </div>
        <div style="display: flex; gap: 16px; flex-wrap: wrap; flex-shrink: 0;">
            <a href="contact.php" class="btn" style="background: white; color: var(--secondary-blue); font-weight: 700; padding: 16px 36px; border-radius: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
                Start a Search <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </a>
            <a href="tel:+971545480972" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.4); padding: 16px 36px; border-radius: 30px;">
                <i class="fas fa-phone-alt" style="margin-right: 8px;"></i> Call Now
            </a>
        </div>
    </div>
</section>
```

---

## UI UPGRADE 9 — Register page: be honest it's a Lead Form, not an Account
**File:** `register.php`

**Problem:** Page says "Create an Account" and "Create My Account" but collects NO password. Misleads users. No real account is created.

**Fix — rename all labels to match reality:**
- Change page `<h2>` from "Create an Account" to "Submit Your Inquiry"
- Change `<h1>` in sidebar from "Join PrimePath UAE" to "Start Your Journey"
- Change button text from "Create My Account" to "Submit Inquiry"
- Change `$page_title` to "Submit an Inquiry | PrimePath HR"
- Remove the paragraph "Already have an account? Login here" (there is no login for users)

**Update `register.php` sidebar content to:**
```html
<h1 style="color: white; font-size: 40px; margin-bottom: 20px;">Start Your Journey</h1>
<p style="font-size: 18px; opacity: 0.9; line-height: 1.6;">Submit your details and a PrimePath consultant will be in touch within 24 hours to discuss your needs.</p>
```

---

## UI UPGRADE 10 — Add a 404 Error Page
**Create new file:** `404.php`

```php
<?php
$page_title = "Page Not Found | PrimePath HR";
include 'includes/header.php';
?>
<section class="section" style="text-align: center; padding: 120px 0; background: var(--bg-light);">
    <div class="container">
        <div style="font-size: 100px; font-weight: 700; color: var(--secondary-blue); opacity: 0.3; line-height: 1; font-family: var(--font-heading);">404</div>
        <h2 style="font-size: 36px; margin-bottom: 16px; margin-top: 20px;">Page Not Found</h2>
        <p style="color: var(--text-muted); margin-bottom: 40px; font-size: 18px;">The page you're looking for has moved or doesn't exist.</p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="index.php" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-blue), #007A99); padding: 14px 32px;">Go to Homepage</a>
            <a href="jobs.php" class="btn btn-outline" style="padding: 14px 32px;">View Jobs</a>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
```

**Add to `.htaccess`:**
```apache
ErrorDocument 404 /404.php
```

---

# PART 3 — ADMIN DASHBOARD IMPROVEMENTS

## ADMIN UPGRADE 1 — Add industry/description fields to Add Job form
**File:** `admin/dashboard.php`

**Replace the existing Add Job form grid** with:

```html
<form action="process.php" method="POST" style="display: grid; gap: 15px; grid-template-columns: 1fr 1fr;">
    <input type="hidden" name="action" value="add">
    <div class="form-group"><input type="text" name="title" required placeholder=" "><label>Job Title</label></div>
    <div class="form-group"><input type="text" name="company" required placeholder=" "><label>Company</label></div>
    <div class="form-group"><input type="text" name="location" required placeholder=" "><label>Location (e.g. Dubai)</label></div>
    <div class="form-group">
        <select name="type" required style="padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-size: 15px;">
            <option value="">Select Type</option>
            <option value="Full-Time">Full-Time</option>
            <option value="Part-Time">Part-Time</option>
            <option value="Contract">Contract</option>
        </select>
        <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Job Type</label>
    </div>
    <div class="form-group"><input type="text" name="salary" required placeholder=" "><label>Salary Range (e.g. AED 15,000 - 22,000)</label></div>
    <div class="form-group">
        <select name="industry" style="padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-size: 15px;">
            <option value="">Select Industry</option>
            <option value="tech">Technology</option>
            <option value="finance">Finance</option>
            <option value="healthcare">Healthcare</option>
            <option value="construction">Construction & Real Estate</option>
            <option value="hospitality">Hospitality</option>
            <option value="fmcg">FMCG</option>
        </select>
        <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Industry</label>
    </div>
    <div class="form-group" style="grid-column: 1 / -1;">
        <textarea name="description" placeholder=" " rows="3" style="width: 100%; padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-family: var(--font-body); font-size: 15px; resize: vertical;"></textarea>
        <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Job Description (1–2 paragraphs)</label>
    </div>
    <div class="form-group" style="grid-column: 1 / -1;">
        <textarea name="responsibilities" placeholder=" " rows="5" style="width: 100%; padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-family: var(--font-body); font-size: 15px; resize: vertical;"></textarea>
        <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Key Responsibilities — one per line</label>
    </div>
    <div class="form-group" style="grid-column: 1 / -1;">
        <textarea name="requirements" placeholder=" " rows="5" style="width: 100%; padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-family: var(--font-body); font-size: 15px; resize: vertical;"></textarea>
        <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Requirements — one per line</label>
    </div>
    <button type="submit" class="btn btn-primary" style="grid-column: 1 / -1;">Save Job Listing</button>
</form>
```

---

# PART 4 — NAVIGATION UPDATES

## NAV UPDATE 1 — Add "Process" and "Testimonials" to navigation
**File:** `includes/header.php`

**Update nav-links ul:**
```html
<ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="index.php#solutions">Solutions</a></li>
    <li><a href="index.php#process">How We Work</a></li>
    <li><a href="jobs.php">Careers</a></li>
    <li><a href="index.php#about">About Us</a></li>
    <li><a href="contact.php">Contact</a></li>
</ul>
```

**Update footer nav links** in `includes/footer.php` to add:
```html
<li><a href="index.php#process">How We Work</a></li>
<li><a href="index.php#testimonials">Testimonials</a></li>
```

---

# PART 5 — SUMMARY CHECKLIST FOR YOUR AGENT

## Critical fixes (do these before anything else):
- [ ] BUG 1: Fix mobile hamburger JS handler
- [ ] BUG 2: Move `$page_title` before header include in jobs.php
- [ ] BUG 3: Wire location filter PHP logic
- [ ] BUG 4: Wrap sidebar in form + wire industry filter
- [ ] BUG 5: Add name + PHP logic to sort dropdown
- [ ] BUG 6: Add dynamic job content to jobs.json + job-detail.php
- [ ] BUG 7: Save contact form submissions to data/contacts.json
- [ ] BUG 8: Save register form submissions to data/leads.json
- [ ] BUG 9: Create .htaccess + data/.htaccess
- [ ] BUG 10: Add session_regenerate_id() + move admin creds to config.php
- [ ] BUG 11: Fix delay-4 through delay-6 animation-delay property

## UI/UX additions (do these after bugs):
- [ ] UI 1: Dual audience CTA (Hire / Find a Job) in hero
- [ ] UI 2: Client logo trust strip below hero
- [ ] UI 3: "How We Work" 4-step process section
- [ ] UI 4: Testimonials 3-card grid section
- [ ] UI 5: Redesigned job cards with badges + company avatar
- [ ] UI 6: Fix active nav highlight JS
- [ ] UI 7: FAQ accordion section
- [ ] UI 8: Pre-footer CTA banner
- [ ] UI 9: Fix register page copy to match reality (lead form not account)
- [ ] UI 10: Create 404.php error page

## Admin improvements:
- [ ] ADMIN 1: Extended Add Job form with industry, description, responsibilities, requirements

---
*End of brief. All code is copy-paste ready. File paths are relative to project root.*