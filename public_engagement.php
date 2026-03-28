<?php
require_once 'functions.php';

$data = read_json('data/public_engagement.json');
$media = $data['media_appearances'];
$community = $data['community_activities'];
$lectures = $data['public_lectures'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-bullhorn me-3"></i>Public Engagement</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (!empty($media)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-tv me-2 text-primary"></i>Media Appearances (Selected)</h2>
    <?php foreach ($media as $item): ?>
    <div class="card mb-2">
        <div class="card-body py-2">
            <div class="d-flex justify-content-between align-items-start">
                <p class="mb-0"><i class="fas fa-microphone me-1 text-muted"></i><?= h($item['description']) ?></p>
                <span class="badge bg-secondary ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($lectures)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Public Lectures (Selected)</h2>
    <?php foreach ($lectures as $item): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1"><?= h($item['title']) ?></h5>
                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i><?= h($item['location']) ?></p>
                </div>
                <span class="badge bg-info ms-3"><?= h($item['year']) ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($community)): ?>
    <h2 class="mt-4 mb-3"><i class="fas fa-hands-helping me-2 text-primary"></i>Community Engagement</h2>
    <ul class="list-group">
        <?php foreach ($community as $activity): ?>
        <li class="list-group-item"><i class="fas fa-check me-2 text-success"></i><?= h($activity) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
