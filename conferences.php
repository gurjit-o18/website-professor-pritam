<?php
require_once 'functions.php';

// Load conferences data
$data = read_json('data/conferences.json');
$conferences = $data['items'];

// Group conferences by year
$by_year = [];
foreach ($conferences as $conf) {
    $year = substr($conf['date'], 0, 4);
    $by_year[$year][] = $conf;
}
krsort($by_year);

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-microphone-alt me-3"></i>Conference Presentations</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($conferences)): ?>
        <div class="alert alert-info">No conference presentations available at the moment.</div>
    <?php else: ?>
        <?php foreach ($by_year as $year => $items): ?>
        <h3 class="mt-4 mb-3"><i class="fas fa-calendar-alt me-2 text-primary"></i><?= h($year) ?></h3>
        <?php foreach ($items as $conf): ?>
        <div class="article-item">
            <h5><?= h($conf['title']) ?></h5>

            <div class="meta-info mb-2">
                <strong><i class="fas fa-calendar-check me-1"></i>Event:</strong> <?= h($conf['event']) ?><br>
                <strong><i class="fas fa-map-marker-alt me-1"></i>Location:</strong> <?= h($conf['location']) ?><br>
                <strong><i class="fas fa-clock me-1"></i>Date:</strong> <?= h(date('F Y', strtotime($conf['date']))) ?>
            </div>

            <?php if (!empty($conf['notes'])): ?>
            <p><?= h($conf['notes']) ?></p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
