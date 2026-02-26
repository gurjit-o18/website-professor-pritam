<?php
require_once 'functions.php';

// Load blog data
$data = read_json('data/blog.json');
$posts = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Blog</h1>

    <?php if (empty($posts)): ?>
        <div class="alert alert-info">No blog posts available at the moment. Check back soon.</div>
    <?php else: ?>
        <?php foreach (array_reverse($posts) as $post): ?>
        <div class="article-item">
            <h3><?= h($post['title']) ?></h3>

            <div class="meta-info mb-2">
                <strong>Date:</strong> <?= h(date('j F Y', strtotime($post['date']))) ?>
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
            <a href="<?= h($post['url']) ?>" class="btn btn-sm btn-primary" target="_blank">Read More</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
