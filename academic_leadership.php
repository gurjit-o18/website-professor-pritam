<?php
require_once 'functions.php';

$data = read_json('data/academic_leadership.json');
$items = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-chalkboard-teacher me-3"></i>Academic Leadership</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($items)): ?>
        <div class="alert alert-info">No academic leadership data available.</div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <p class="mb-0"><i class="fas fa-check-circle me-2 text-primary"></i><?= h($item['description']) ?></p>
                    <?php if (!empty($item['period'])): ?>
                    <span class="badge bg-primary ms-3"><?= h($item['period']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
