<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
require_once '../includes/db.php';
$jobs = get_jobs();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - PrimePath UAE</title>
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
                <div class="form-group"><input type="text" name="location" id="jobLocation" required placeholder=" "><label>Location (e.g. Dubai)</label></div>
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
