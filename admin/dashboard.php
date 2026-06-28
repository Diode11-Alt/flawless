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
                <div class="form-group"><input type="text" name="location" required placeholder=" "><label>Location</label></div>
                <div class="form-group"><input type="text" name="type" required placeholder=" "><label>Type (e.g., Full-Time)</label></div>
                <div class="form-group" style="grid-column: 1 / -1;"><input type="text" name="salary" required placeholder=" "><label>Salary Range</label></div>
                <button type="submit" class="btn btn-primary" style="grid-column: 1 / -1;">Save Job</button>
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
