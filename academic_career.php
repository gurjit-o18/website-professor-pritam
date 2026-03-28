<?php
require_once 'functions.php';

$data = read_json('data/academic_career.json');
$items = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-briefcase me-3"></i>Academic Career</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($items)): ?>
        <div class="alert alert-info">No career data available.</div>
    <?php else: ?>
    <div class="timeline">
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title mb-1"><?= h($item['title']) ?></h4>
                        <h5 class="text-primary mb-1"><i class="fas fa-university me-1"></i><?= h($item['institution']) ?></h5>
                        <?php if (!empty($item['notes'])): ?>
                        <p class="text-muted mb-0"><?= h($item['notes']) ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="badge bg-secondary fs-6 ms-3"><?= h($item['period']) ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
