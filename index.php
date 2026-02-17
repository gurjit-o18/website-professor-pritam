<?php
require_once 'functions.php';

// Load data
$books = read_json('data/books.json');
$articles = read_json('data/articles.json');
$videos = read_json('data/videos.json');

// Get latest items (5 most recent)
$latest_books = get_latest_items($books['items'], 2);
$latest_articles = get_latest_items($articles['items'], 2);
$latest_videos = get_latest_items($videos['items'], 1);

include 'header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1>Professor Pritam Singh</h1>
                <p class="lead">Professor of International Law at the University of Oxford</p>
                <p class="lead">Specializing in Human Rights, Global Justice, and International Legal Frameworks</p>
                <a href="about.php" class="btn btn-light btn-lg mt-3">Learn More</a>
            </div>
        </div>
    </div>
</section>

<main class="container my-5">
    <!-- Feature Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">📚 Books</h3>
                    <p class="card-text">Explore published books and academic contributions to international law and human rights.</p>
                    <a href="books.php" class="btn btn-primary">View Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">📄 Articles</h3>
                    <p class="card-text">Read scholarly articles published in leading academic journals and publications.</p>
                    <a href="articles.php" class="btn btn-primary">View Articles</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">🎥 Videos</h3>
                    <p class="card-text">Watch lectures, interviews, and presentations on international law topics.</p>
                    <a href="videos.php" class="btn btn-primary">View Videos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Updates Section -->
    <h2 class="section-title">Latest Updates</h2>

    <!-- Latest Books -->
    <?php if (!empty($latest_books)): ?>
    <h3 class="mt-4 mb-3">Recent Books</h3>
    <div class="row">
        <?php foreach ($latest_books as $book): ?>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= h($book['title']) ?></h5>
                    <p class="meta-info"><?= h($book['authors']) ?> (<?= h($book['year']) ?>)</p>
                    <p class="card-text"><?= h($book['publisher']) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Latest Articles -->
    <?php if (!empty($latest_articles)): ?>
    <h3 class="mt-4 mb-3">Recent Articles</h3>
    <div class="row">
        <?php foreach ($latest_articles as $article): ?>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= h($article['title']) ?></h5>
                    <p class="meta-info"><?= h($article['source']) ?> - <?= h($article['date']) ?></p>
                    <?php if (!empty($article['summary'])): ?>
                    <p class="card-text"><?= h($article['summary']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Latest Videos -->
    <?php if (!empty($latest_videos)): ?>
    <h3 class="mt-4 mb-3">Recent Videos</h3>
    <div class="row">
        <?php foreach ($latest_videos as $video): ?>
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= h($video['title']) ?></h5>
                    <p class="meta-info"><?= h($video['channel']) ?> - <?= h($video['duration']) ?> - <?= h($video['published_date']) ?></p>
                    <a href="<?= h($video['url']) ?>" class="btn btn-sm btn-primary" target="_blank">Watch Video</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
