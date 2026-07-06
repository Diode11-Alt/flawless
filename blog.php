<?php
$page_title = "Career Insights & HR News | PrimePath HR";
include 'includes/header.php';
require_once 'includes/markdown.php';

$articles = get_all_articles();
?>

<section class="page-header" style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); padding: 120px 0 80px; text-align: center; color: white;">
    <div class="container">
        <h1 style="font-size: 42px; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">Insights & News</h1>
        <p style="font-size: 18px; opacity: 0.9; max-width: 600px; margin: 0 auto;">Expert advice on career growth, UAE job market trends, and HR best practices.</p>
    </div>
</section>

<section class="section" style="padding: 80px 0; background: var(--bg-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            <?php foreach ($articles as $article): ?>
            <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
                    <span style="color: var(--secondary-blue); font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 10px; display: block;"><?= $article['date'] ?></span>
                    <h3 style="font-size: 20px; margin-bottom: 15px; line-height: 1.4;">
                        <a href="article.php?slug=<?= $article['slug'] ?>" style="color: var(--primary-navy); text-decoration: none;"><?= htmlspecialchars($article['title']) ?></a>
                    </h3>
                    <p style="color: var(--text-muted); font-size: 15px; margin-bottom: 20px; flex-grow: 1;"><?= htmlspecialchars($article['excerpt']) ?></p>
                    <a href="article.php?slug=<?= $article['slug'] ?>" style="color: var(--secondary-blue); font-weight: 600; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">Read Full Article <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if (empty($articles)): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <p>No articles found. Check back later!</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
