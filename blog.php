<?php
require_once 'functions.php';

// Load blog data
$data = read_json('data/blog.json');
$posts = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-blog me-3"></i>Blog</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($posts)): ?>
        <div class="alert alert-info">No blog posts available at the moment. Check back soon.</div>
    <?php else: ?>
        <?php foreach (array_reverse($posts) as $post): ?>
        <div class="article-item">
            <h3><?= h($post['title']) ?></h3>

            <div class="meta-info mb-2">
                <strong><i class="fas fa-calendar me-1"></i>Date:</strong> <?= h(date('j F Y', strtotime($post['date']))) ?>
                <?php if (!empty($post['tags'])): ?>
                &nbsp;|&nbsp;
                <?php foreach ($post['tags'] as $tag): ?>
                <span class="badge bg-secondary"><?= h($tag) ?></span>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($post['content'])): ?>
            <p><?= h($post['content']) ?></p>
            <?php endif; ?>

            <?php if (!empty($post['url'])): ?>
            <a href="<?= h($post['url']) ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-external-link-alt me-1"></i>Read More</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
