<?php
require_once 'functions.php';

$data = read_json('data/enterprise_consultancy.json');
$items = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-handshake me-3"></i>Enterprise &amp; Consultancy</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($items)): ?>
        <div class="alert alert-info">No enterprise and consultancy data available.</div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title mb-1"><i class="fas fa-building me-1"></i><?= h($item['client']) ?></h5>
                <p class="card-text text-muted"><?= h($item['description']) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
