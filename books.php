<?php
require_once 'functions.php';

// Load books data
$data = read_json('data/books.json');
$books = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Books</h1>

    <?php if (empty($books)): ?>
        <div class="alert alert-info">No books available at the moment.</div>
    <?php else: ?>
        <?php foreach ($books as $book): ?>
        <div class="book-item">
            <h3><?= h($book['title']) ?></h3>
            
            <div class="meta-info mb-2">
                <strong>Author(s):</strong> <?= h($book['authors']) ?><br>
                <strong>Year:</strong> <?= h($book['year']) ?><br>
                <strong>Publisher:</strong> <?= h($book['publisher']) ?><br>
                <strong>ISBN:</strong> <?= h($book['isbn']) ?>
            </div>

            <?php if (!empty($book['notes'])): ?>
            <p><?= h($book['notes']) ?></p>
            <?php endif; ?>

            <?php if (!empty($book['links'])): ?>
            <div class="mt-3">
                <strong>Links:</strong><br>
                <?php foreach ($book['links'] as $link): ?>
                <a href="<?= h($link['url']) ?>" class="btn btn-sm btn-primary me-2 mt-2" target="_blank">
                    <?= h($link['label']) ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
