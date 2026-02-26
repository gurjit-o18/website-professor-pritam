<?php
require_once 'functions.php';

$data = read_json('data/reviews.json');
$items = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Reviews</h1>

    <?php if (empty($items)): ?>
        <div class="alert alert-info">No reviews available at the moment.</div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                        <p class="text-muted mb-1"><em><?= h($item['source']) ?></em></p>
                        <?php if (!empty($item['notes'])): ?>
                        <p class="text-muted small mb-0"><?= h($item['notes']) ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="badge bg-secondary ms-3"><?= h($item['year']) ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
