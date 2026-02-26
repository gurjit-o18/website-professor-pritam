<?php
require_once 'functions.php';

// Load chapters data
$data = read_json('data/chapters.json');
$chapters = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Book Chapters</h1>

    <?php if (empty($chapters)): ?>
        <div class="alert alert-info">No book chapters available at the moment.</div>
    <?php else: ?>
        <?php foreach ($chapters as $chapter): ?>
        <div class="article-item">
            <h3><?= h($chapter['title']) ?></h3>

            <div class="meta-info mb-2">
                <strong>Book:</strong> <em><?= h($chapter['book']) ?></em><br>
                <?php if (!empty($chapter['editors'])): ?>
                <strong>Edited by:</strong> <?= h($chapter['editors']) ?><br>
                <?php endif; ?>
                <strong>Author(s):</strong> <?= h($chapter['authors']) ?><br>
                <?php if (!empty($chapter['publisher'])): ?>
                <strong>Publisher:</strong> <?= h($chapter['publisher']) ?> (<?= h($chapter['year']) ?>)
                <?php else: ?>
                <strong>Year:</strong> <?= h($chapter['year']) ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($chapter['summary'])): ?>
            <p><?= h($chapter['summary']) ?></p>
            <?php endif; ?>

            <?php if (!empty($chapter['url'])): ?>
            <a href="<?= h($chapter['url']) ?>" class="btn btn-sm btn-primary" target="_blank">View Chapter</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
