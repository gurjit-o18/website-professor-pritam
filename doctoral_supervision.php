<?php
require_once 'functions.php';

$data = read_json('data/doctoral_supervision.json');
$completed = $data['completed'];
$current = $data['current'];
$external = $data['external_examination'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-user-graduate me-3"></i>Doctoral Supervision</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (!empty($completed)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-check-circle me-2 text-success"></i>Successfully Completed Doctoral Students</h2>
    <div class="row g-4">
        <?php foreach ($completed as $item): ?>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-1"><i class="fas fa-user me-1"></i><?= h($item['student']) ?></h5>
                    <p class="card-text text-muted"><em><?= h($item['thesis']) ?></em></p>
                    <div class="mt-2">
                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Completed <?= h($item['year_completed']) ?></span>
                    </div>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-2 mb-0"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($current)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-spinner me-2 text-primary"></i>Current Doctoral Students</h2>
    <div class="row g-4">
        <?php foreach ($current as $item): ?>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-1"><i class="fas fa-user me-1"></i><?= h($item['student']) ?></h5>
                    <p class="card-text text-muted"><em><?= h($item['thesis']) ?></em></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted small mt-2 mb-0"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($external)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-gavel me-2 text-primary"></i>External Examination</h2>
    <div class="card">
        <div class="card-body">
            <p class="mb-0"><?= h($external) ?></p>
        </div>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
