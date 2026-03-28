<?php
require_once 'functions.php';

// Load videos data
$data = read_json('data/videos.json');
$videos = $data['items'];

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-video me-3"></i>Videos &amp; Presentations</h1>
    </div>
</section>

<main class="container my-5">
    <?php if (empty($videos)): ?>
        <div class="alert alert-info">No videos available at the moment.</div>
    <?php else: ?>
        <?php foreach ($videos as $video): ?>
        <div class="video-item">
            <h3><?= h($video['title']) ?></h3>
            
            <div class="meta-info mb-2">
                <strong><i class="fas fa-play-circle me-1"></i>Platform:</strong> <?= h($video['platform']) ?><br>
                <strong><i class="fas fa-tv me-1"></i>Channel:</strong> <?= h($video['channel']) ?><br>
                <strong><i class="fas fa-clock me-1"></i>Duration:</strong> <?= h($video['duration']) ?><br>
                <strong><i class="fas fa-calendar me-1"></i>Published:</strong> <?= h($video['published_date']) ?>
            </div>

            <?php if (!empty($video['notes'])): ?>
            <p><?= h($video['notes']) ?></p>
            <?php endif; ?>

            <?php if (!empty($video['url'])): ?>
            <a href="<?= h($video['url']) ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-play me-1"></i>Watch Video</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
