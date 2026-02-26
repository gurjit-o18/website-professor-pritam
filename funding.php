<?php
require_once 'functions.php';

$data = read_json('data/funding.json');
$items = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Funding</h1>
    <p class="lead mb-4">Estimated total external funding between 2008 and 2015: £33,000+. Professor Singh has attracted funding from institutions across Europe, Asia, and the Americas.</p>

    <?php if (empty($items)): ?>
        <div class="alert alert-info">No funding data available.</div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                        <p class="text-primary mb-1"><strong><?= h($item['funder']) ?></strong></p>
                        <?php if (!empty($item['notes'])): ?>
                        <p class="text-muted small mb-0"><?= h($item['notes']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="text-end ms-3">
                        <span class="badge bg-success d-block mb-1"><?= h($item['amount']) ?></span>
                        <span class="badge bg-secondary"><?= h($item['year']) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
