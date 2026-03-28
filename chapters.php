<?php
require_once 'functions.php';

// Load chapters data
$data = read_json('data/chapters.json');
$chapters = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-bookmark me-3"></i>Book Chapters</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($chapters)): ?>
        <div class="alert alert-info">No book chapters available at the moment.</div>
    <?php else: ?>
        <?php foreach ($chapters as $chapter): ?>
        <div class="article-item">
            <h3><?= h($chapter['title']) ?></h3>

            <div class="meta-info mb-2">
                <strong><i class="fas fa-book me-1"></i>Book:</strong> <em><?= h($chapter['book']) ?></em><br>
                <?php if (!empty($chapter['editors'])): ?>
                <strong><i class="fas fa-user-edit me-1"></i>Edited by:</strong> <?= h($chapter['editors']) ?><br>
                <?php endif; ?>
                <strong><i class="fas fa-pen me-1"></i>Author(s):</strong> <?= h($chapter['authors']) ?><br>
                <?php if (!empty($chapter['publisher'])): ?>
                <strong><i class="fas fa-building me-1"></i>Publisher:</strong> <?= h($chapter['publisher']) ?> (<?= h($chapter['year']) ?>)
                <?php else: ?>
                <strong><i class="fas fa-calendar me-1"></i>Year:</strong> <?= h($chapter['year']) ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($chapter['summary'])): ?>
            <p><?= h($chapter['summary']) ?></p>
            <?php endif; ?>

            <?php if (!empty($chapter['url'])): ?>
            <a href="<?= h($chapter['url']) ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-external-link-alt me-1"></i>View Chapter</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
