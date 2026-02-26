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

<main class="container my-5">
    <h1 class="section-title">Conference Presentations</h1>

    <?php if (empty($conferences)): ?>
        <div class="alert alert-info">No conference presentations available at the moment.</div>
    <?php else: ?>
        <?php foreach ($by_year as $year => $items): ?>
        <h3 class="mt-4 mb-3"><?= h($year) ?></h3>
        <?php foreach ($items as $conf): ?>
        <div class="article-item">
            <h5><?= h($conf['title']) ?></h5>

            <div class="meta-info mb-2">
                <strong>Event:</strong> <?= h($conf['event']) ?><br>
                <strong>Location:</strong> <?= h($conf['location']) ?><br>
                <strong>Date:</strong> <?= h(date('F Y', strtotime($conf['date']))) ?>
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
