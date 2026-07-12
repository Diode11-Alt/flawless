<?php
require_once __DIR__ . '/auth.php';
if (!check_admin_auth()) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../includes/db.php';
init_csrf_token();
$jobs = get_jobs();
$contacts_file = get_data_file_path('contacts.json');
$leads = file_exists($contacts_file) ? json_decode(file_get_contents($contacts_file), true) : [];
$leads = array_reverse($leads); // newest first

$registrations_file = get_data_file_path('registrations.json');
$applications = file_exists($registrations_file) ? json_decode(file_get_contents($registrations_file), true) : [];
$applications = array_reverse($applications); // newest first
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - PrimePath HR</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { padding: 15px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .admin-table th { background: var(--primary-navy); color: white; }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <div class="logo">Prime<span>Path</span> <span style="font-size: 16px; color: var(--text-muted);">Admin</span></div>
            <nav>
                <ul class="nav-links">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2>Manage Jobs</h2>
            <button onclick="document.getElementById('addForm').style.display='block'" class="btn btn-primary">Add New Job</button>
        </div>
        
        <div id="addForm" style="display: none; background: white; padding: 30px; border-radius: var(--border-radius); box-shadow: var(--shadow-card); margin-bottom: 40px; animation: fadeInUp 0.5s ease;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 id="formTitle">Add New Position</h3>
                <button onclick="document.getElementById('addForm').style.display='none'" class="btn btn-outline" style="border: none; font-size: 20px;">&times;</button>
            </div>
            <form action="process.php" method="POST" id="jobForm" style="display: grid; gap: 15px; grid-template-columns: 1fr 1fr;">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="jobId" value="">
                
                <div class="form-group"><input type="text" name="title" id="jobTitle" required placeholder=" "><label>Job Title</label></div>
                <div class="form-group"><input type="text" name="company" id="jobCompany" required placeholder=" "><label>Company</label></div>
                <div class="form-group"><input type="text" name="location" id="jobLocation" required placeholder=" "><label>Location (e.g. Valletta)</label></div>
                <div class="form-group">
                    <select name="type" id="jobType" required style="padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-size: 15px;">
                        <option value="">Select Type</option>
                        <option value="Full-Time">Full-Time</option>
                        <option value="Part-Time">Part-Time</option>
                        <option value="Contract">Contract</option>
                    </select>
                    <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Job Type</label>
                </div>
                <div class="form-group"><input type="text" name="salary" id="jobSalary" required placeholder=" "><label>Salary Range (e.g. AED 15,000 - 22,000)</label></div>
                <div class="form-group">
                    <select name="industry" id="jobIndustry" style="padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-size: 15px;">
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
                    <textarea name="description" id="jobDesc" placeholder=" " rows="3" style="width: 100%; padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-family: var(--font-body); font-size: 15px; resize: vertical;"></textarea>
                    <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Job Description (1–2 paragraphs)</label>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <textarea name="responsibilities" id="jobResp" placeholder=" " rows="5" style="width: 100%; padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-family: var(--font-body); font-size: 15px; resize: vertical;"></textarea>
                    <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Key Responsibilities — one per line</label>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <textarea name="requirements" id="jobReq" placeholder=" " rows="5" style="width: 100%; padding: 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-family: var(--font-body); font-size: 15px; resize: vertical;"></textarea>
                    <label style="position: static; padding: 0; font-size: 12px; color: var(--text-muted);">Requirements — one per line</label>
                </div>
                <button type="submit" class="btn btn-primary" style="grid-column: 1 / -1;" id="submitBtn">Save Job Listing</button>
            </form>
        </div>

        <div style="background: white; border-radius: var(--border-radius); box-shadow: var(--shadow-sm); overflow: hidden;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jobs as $job): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($job['title']) ?></strong></td>
                        <td><?= htmlspecialchars($job['company']) ?></td>
                        <td><?= htmlspecialchars($job['location']) ?></td>
                        <td>
                            <button onclick='editJob(<?= json_encode($job) ?>)' class="btn btn-outline" style="padding: 5px 15px; font-size: 12px; margin-right: 5px;">Edit</button>
                            <form action="process.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $job['id'] ?>">
                                <button type="submit" class="btn btn-outline" style="padding: 5px 15px; font-size: 12px; border-color: red; color: red;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- LEADS SECTION -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 60px; margin-bottom: 30px;">
            <h2>Leads & Inquiries</h2>
        </div>
        
        <div style="background: white; border-radius: var(--border-radius); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 50px; overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Service Required</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($leads)): ?>
                        <tr><td colspan="5" style="text-align: center; color: var(--text-muted);">No leads found.</td></tr>
                    <?php else: ?>
                        <?php foreach($leads as $lead): ?>
                        <tr>
                            <td style="white-space: nowrap;"><?= htmlspecialchars($lead['date'] ?? '') ?></td>
                            <td><strong><?= htmlspecialchars($lead['name'] ?? '') ?></strong></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($lead['email'] ?? '') ?>" style="color: var(--secondary-blue); display: block;"><?= htmlspecialchars($lead['email'] ?? '') ?></a>
                                <span style="font-size: 13px; color: var(--text-muted);"><?= htmlspecialchars($lead['phone'] ?? '') ?></span>
                            </td>
                            <td><span style="background: rgba(0, 180, 216, 0.1); color: var(--secondary-blue); padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;"><?= htmlspecialchars($lead['subject'] ?? 'General') ?></span></td>
                            <td style="max-width: 300px; white-space: pre-wrap; font-size: 14px; color: var(--text-dark);"><?= htmlspecialchars($lead['message'] ?? '') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- CAREER APPLICATIONS SECTION -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 60px; margin-bottom: 30px;">
            <h2>Career Applications</h2>
        </div>
        
        <div style="background: white; border-radius: var(--border-radius); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 80px; overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Job Title Applied For</th>
                        <th>Resume / CV</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($applications)): ?>
                        <tr><td colspan="5" style="text-align: center; color: var(--text-muted);">No applications found.</td></tr>
                    <?php else: ?>
                        <?php foreach($applications as $app): ?>
                        <tr>
                            <td style="white-space: nowrap;"><?= htmlspecialchars($app['date'] ?? '') ?></td>
                            <td><strong><?= htmlspecialchars($app['name'] ?? '') ?></strong></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($app['email'] ?? '') ?>" style="color: var(--secondary-blue); display: block;"><?= htmlspecialchars($app['email'] ?? '') ?></a>
                                <span style="font-size: 13px; color: var(--text-muted);"><?= htmlspecialchars($app['phone'] ?? '') ?></span>
                            </td>
                            <td><span style="background: rgba(46, 204, 113, 0.1); color: #2ecc71; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;"><?= htmlspecialchars($app['job_title'] ?: 'General Application') ?></span></td>
                            <td>
                                <?php if (!empty($app['cv'])): ?>
                                    <a href="download.php?file=<?= urlencode(basename($app['cv'])) ?>" target="_blank" class="btn btn-outline" style="padding: 5px 12px; font-size: 12px;"><i class="fas fa-file-download" style="margin-right: 5px;"></i> Download CV</a>
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-size: 13px;">No file uploaded</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        function editJob(job) {
            document.getElementById('addForm').style.display = 'block';
            document.getElementById('formTitle').innerText = 'Edit Position';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('jobId').value = job.id;
            document.getElementById('submitBtn').innerText = 'Update Job Listing';
            
            document.getElementById('jobTitle').value = job.title || '';
            document.getElementById('jobCompany').value = job.company || '';
            document.getElementById('jobLocation').value = job.location || '';
            document.getElementById('jobType').value = job.type || '';
            document.getElementById('jobSalary').value = job.salary || '';
            document.getElementById('jobIndustry').value = job.industry || '';
            
            document.getElementById('jobDesc').value = Array.isArray(job.description) ? job.description.join('\n') : (job.description || '');
            document.getElementById('jobResp').value = Array.isArray(job.responsibilities) ? job.responsibilities.join('\n') : (job.responsibilities || '');
            document.getElementById('jobReq').value = Array.isArray(job.requirements) ? job.requirements.join('\n') : (job.requirements || '');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>
</html>
