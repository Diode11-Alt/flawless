<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
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
            <h3>Add New Position</h3>
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
                            <form action="process.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
</body>
</html>
