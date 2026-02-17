<?php
require_once 'functions.php';

// Load videos data
$data = read_json('data/videos.json');
$videos = $data['items'];

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Videos & Presentations</h1>

    <?php if (empty($videos)): ?>
        <div class="alert alert-info">No videos available at the moment.</div>
    <?php else: ?>
        <?php foreach ($videos as $video): ?>
        <div class="video-item">
            <h3><?= h($video['title']) ?></h3>
            
            <div class="meta-info mb-2">
                <strong>Platform:</strong> <?= h($video['platform']) ?><br>
                <strong>Channel:</strong> <?= h($video['channel']) ?><br>
                <strong>Duration:</strong> <?= h($video['duration']) ?><br>
                <strong>Published:</strong> <?= h($video['published_date']) ?>
            </div>

            <?php if (!empty($video['notes'])): ?>
            <p><?= h($video['notes']) ?></p>
            <?php endif; ?>

            <?php if (!empty($video['url'])): ?>
            <a href="<?= h($video['url']) ?>" class="btn btn-sm btn-primary" target="_blank">Watch Video</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
