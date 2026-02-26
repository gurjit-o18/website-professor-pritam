<?php
require_once 'functions.php';

$data = read_json('data/awards.json');
$items = $data['items'];

// Group by category
$honorary = array_filter($items, fn($i) => $i['category'] === 'honorary');
$scholarships = array_filter($items, fn($i) => $i['category'] === 'scholarship');
$recognition = array_filter($items, fn($i) => $i['category'] === 'recognition');

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Awards &amp; Honors</h1>

    <?php if (!empty($honorary)): ?>
    <h2 class="mt-4 mb-3">Honorary Awards</h2>
    <?php foreach ($honorary as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                    <p class="text-muted mb-0"><?= h($item['body']) ?></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-1"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
                <span class="badge bg-warning text-dark ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($scholarships)): ?>
    <h2 class="mt-4 mb-3">Scholarships &amp; Fellowships</h2>
    <?php foreach ($scholarships as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                    <p class="text-muted mb-0"><?= h($item['body']) ?></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-1"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
                <span class="badge bg-primary ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($recognition)): ?>
    <h2 class="mt-4 mb-3">External Recognition as Expert</h2>
    <?php foreach ($recognition as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                    <p class="text-muted mb-0"><?= h($item['body']) ?></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-1"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
                <span class="badge bg-success ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
