<?php
require_once 'functions.php';

$data = read_json('data/enterprise_consultancy.json');
$items = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Enterprise &amp; Consultancy</h1>

    <?php if (empty($items)): ?>
        <div class="alert alert-info">No enterprise and consultancy data available.</div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title mb-1"><?= h($item['client']) ?></h5>
                <p class="card-text text-muted"><?= h($item['description']) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
