<?php
require_once 'functions.php';

$data = read_json('data/research_leadership.json');
$editorial = $data['editorial_positions'];
$review = $data['review_activities'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-flask me-3"></i>Research Leadership</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (!empty($editorial)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-edit me-2 text-primary"></i>Editorial Positions</h2>
    <?php foreach ($editorial as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['role']) ?></h5>
                    <p class="text-muted mb-0"><i class="fas fa-building me-1"></i><?= h($item['organization']) ?></p>
                </div>
                <span class="badge bg-primary ms-3"><?= h($item['period']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($review)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-clipboard-check me-2 text-primary"></i>Academic Review &amp; Referee Activities</h2>
    <ul class="list-group">
        <?php foreach ($review as $activity): ?>
        <li class="list-group-item"><i class="fas fa-check me-2 text-success"></i><?= h($activity) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
