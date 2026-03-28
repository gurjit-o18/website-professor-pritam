<?php
require_once 'functions.php';

$data = read_json('data/education.json');
$items = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-graduation-cap"></i> Education</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($items)): ?>
        <div class="alert alert-info">No education data available.</div>
    <?php else: ?>
    <div class="row g-4">
        <?php foreach ($items as $item): ?>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-graduation-cap me-2"></i><?= h($item['degree']) ?></h3>
                    <h5 class="text-muted"><?= h($item['year']) ?></h5>
                    <p class="mb-1"><strong><?= h($item['institution']) ?></strong></p>
                    <?php if (!empty($item['notes'])): ?>
                    <p class="text-muted mt-2"><?= h($item['notes']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
