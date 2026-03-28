<?php
require_once 'functions.php';

$data = read_json('data/professional_associations.json');
$items = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-users me-3"></i>Professional Associations</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($items)): ?>
        <div class="alert alert-info">No professional association data available.</div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-1"><i class="fas fa-id-badge me-1"></i><?= h($item['role']) ?></h5>
                        <p class="text-muted mb-0"><i class="fas fa-building me-1"></i><?= h($item['organization']) ?></p>
                        <?php if (!empty($item['notes'])): ?>
                        <p class="text-muted small mt-1 mb-0"><?= h($item['notes']) ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="badge bg-primary ms-3"><?= h($item['period']) ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
