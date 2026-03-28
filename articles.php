<?php
require_once 'functions.php';

// Load articles data
$data = read_json('data/articles.json');
$articles = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-file-alt"></i> Academic Articles</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($articles)): ?>
        <div class="alert alert-info">No articles available at the moment.</div>
    <?php else: ?>
        <?php foreach ($articles as $article): ?>
        <div class="article-item">
            <h3><i class="fas fa-file-alt me-2"></i><?= h($article['title']) ?></h3>
            
            <div class="meta-info mb-2">
                <strong>Source:</strong> <?= h($article['source']) ?><br>
                <strong>Date:</strong> <?= h($article['date']) ?>
            </div>

            <?php if (!empty($article['summary'])): ?>
            <p><?= h($article['summary']) ?></p>
            <?php endif; ?>

            <?php if (!empty($article['url'])): ?>
            <a href="<?= h($article['url']) ?>" class="btn btn-sm btn-primary" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>Read Article
            </a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
