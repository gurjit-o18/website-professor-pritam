<?php
require_once 'functions.php';

$data = read_json('data/global_impact.json');
$visiting = $data['visiting_positions'];
$conferences = $data['international_conferences_organised'];
$translations = $data['translations'];
$panels = $data['panels_chaired'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Global Impact</h1>

    <?php if (!empty($visiting)): ?>
    <h2 class="mt-4 mb-3">Visiting Positions</h2>
    <?php foreach ($visiting as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                    <p class="text-muted mb-0"><?= h($item['institution']) ?></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-1 mb-0"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
                <span class="badge bg-primary ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($conferences)): ?>
    <h2 class="mt-4 mb-3">International Conferences Organised</h2>
    <?php foreach ($conferences as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                    <p class="text-muted mb-0"><?= h($item['event']) ?> &mdash; <?= h($item['location']) ?></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-1 mb-0"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
                <span class="badge bg-secondary ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($translations)): ?>
    <h2 class="mt-4 mb-3">Translations of Work</h2>
    <ul class="list-group mb-4">
        <?php foreach ($translations as $item): ?>
        <li class="list-group-item">
            <span class="badge bg-info me-2"><?= h($item['year']) ?></span>
            <?= h($item['description']) ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <?php if (!empty($panels)): ?>
    <h2 class="mt-4 mb-3">Panels Chaired</h2>
    <div class="card">
        <div class="card-body">
            <p class="mb-0"><?= h($panels) ?></p>
        </div>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
