<?php
require_once 'functions.php';

// Load data
$books = read_json('data/books.json');
$articles = read_json('data/articles.json');
$videos = read_json('data/videos.json');
$conferences = read_json('data/conferences.json');
$blog = read_json('data/blog.json');

// Get latest items (most recent)
$latest_books = get_latest_items($books['items'], 2);
$latest_articles = get_latest_items($articles['items'], 2);
$latest_videos = get_latest_items($videos['items'], 1);

include 'header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                <img src="assets/img/professor-placeholder.svg" alt="Professor Pritam Singh" class="img-fluid rounded-circle shadow" style="max-width: 250px;">
            </div>
            <div class="col-lg-8">
                <h1>Professor Pritam Singh</h1>
                <p class="lead">Emeritus Professor of Economics</p>
                <p class="lead">Oxford Brookes University, Oxford, UK</p>
                <p class="mb-4" style="opacity:.88">Specializing in Development Economics, Sustainability, and Political Economy with focus on India and Punjab</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="about.php" class="btn btn-light btn-lg"><i class="fas fa-user me-2"></i>Learn More</a>
                    <a href="contact.php" class="btn btn-outline-light btn-lg"><i class="fas fa-envelope me-2"></i>Contact</a>
                </div>
            </div>
        </div>
    </div>
</section>

<main class="container my-5">
    <!-- Feature Cards -->
    <div class="row g-4 mb-5 stagger-children">
        <div class="col-md-4 col-sm-6">
            <div class="card feature-card animate-fade-in-up">
                <div class="card-body">
                    <span class="feature-icon"><i class="fas fa-book"></i></span>
                    <h3 class="card-title">Books</h3>
                    <p class="card-text">Explore published books on federalism, nationalism, governance, and human rights in South Asian contexts.</p>
                    <a href="books.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right me-1"></i>View Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card feature-card animate-fade-in-up">
                <div class="card-body">
                    <span class="feature-icon"><i class="fas fa-bookmark"></i></span>
                    <h3 class="card-title">Book Chapters</h3>
                    <p class="card-text">Read book chapters and contributions to edited volumes on political economy and South Asian studies.</p>
                    <a href="chapters.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right me-1"></i>View Chapters</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card feature-card animate-fade-in-up">
                <div class="card-body">
                    <span class="feature-icon"><i class="fas fa-file-alt"></i></span>
                    <h3 class="card-title">Journal Articles</h3>
                    <p class="card-text">Read scholarly articles on economics, development, political economy, and governance issues.</p>
                    <a href="articles.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right me-1"></i>View Articles</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card feature-card animate-fade-in-up">
                <div class="card-body">
                    <span class="feature-icon"><i class="fas fa-newspaper"></i></span>
                    <h3 class="card-title">Newspaper Articles</h3>
                    <p class="card-text">Over 60 articles and letters published in newspapers and news magazines in the UK and South Asia.</p>
                    <a href="newspaper_articles.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right me-1"></i>View Articles</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card feature-card animate-fade-in-up">
                <div class="card-body">
                    <span class="feature-icon"><i class="fas fa-microphone-alt"></i></span>
                    <h3 class="card-title">Conferences &amp; Talks</h3>
                    <p class="card-text">Browse conference presentations and keynote addresses at international academic events worldwide.</p>
                    <a href="conferences.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right me-1"></i>View Conferences</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card feature-card animate-fade-in-up">
                <div class="card-body">
                    <span class="feature-icon"><i class="fas fa-globe-americas"></i></span>
                    <h3 class="card-title">Global Impact</h3>
                    <p class="card-text">Discover visiting positions, international conferences organised, and translations of work across the globe.</p>
                    <a href="global_impact.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right me-1"></i>View Impact</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Updates Section -->
    <h2 class="section-title">Latest Updates</h2>

    <!-- Latest Books -->
    <?php if (!empty($latest_books)): ?>
    <h3 class="mt-4 mb-3"><i class="fas fa-book me-2 text-primary"></i>Recent Books</h3>
    <div class="row g-4">
        <?php foreach ($latest_books as $book): ?>
        <div class="col-md-6">
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
    <h3 class="mt-4 mb-3"><i class="fas fa-file-alt me-2 text-primary"></i>Recent Articles</h3>
    <div class="row g-4">
        <?php foreach ($latest_articles as $article): ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= h($article['title']) ?></h5>
                    <p class="meta-info"><?= h($article['source']) ?> &mdash; <?= h($article['date']) ?></p>
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
    <h3 class="mt-4 mb-3"><i class="fas fa-video me-2 text-primary"></i>Recent Videos</h3>
    <div class="row g-4">
        <?php foreach ($latest_videos as $video): ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= h($video['title']) ?></h5>
                    <p class="meta-info"><?= h($video['channel']) ?> &mdash; <?= h($video['duration']) ?> &mdash; <?= h($video['published_date']) ?></p>
                    <a href="<?= h($video['url']) ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-play me-1"></i>Watch Video</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
