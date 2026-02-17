<?php
require_once 'functions.php';

// Load bio data
$bio_data = read_json('data/bio.json');

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">About Professor Pritam Singh</h1>

    <div class="row">
        <div class="col-lg-8">
            <h2><?= h($bio_data['name']) ?></h2>
            <h4 class="text-muted"><?= h($bio_data['title']) ?></h4>
            <h5 class="text-muted mb-4"><?= h($bio_data['institution']) ?></h5>

            <div class="bio-section mb-4">
                <h3>Biography</h3>
                <p><?= h($bio_data['bio']) ?></p>
            </div>

            <?php if (!empty($bio_data['education'])): ?>
            <div class="education-section mb-4">
                <h3>Education</h3>
                <ul class="list-unstyled">
                    <?php foreach ($bio_data['education'] as $edu): ?>
                    <li class="mb-2">
                        <i class="text-primary">🎓</i> <?= h($edu) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio_data['research_interests'])): ?>
            <div class="research-section mb-4">
                <h3>Research Interests</h3>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($bio_data['research_interests'] as $interest): ?>
                    <span class="badge bg-primary fs-6"><?= h($interest) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="books.php" class="text-decoration-none">📚 View Books</a></li>
                        <li class="mb-2"><a href="articles.php" class="text-decoration-none">📄 View Articles</a></li>
                        <li class="mb-2"><a href="videos.php" class="text-decoration-none">🎥 View Videos</a></li>
                        <li class="mb-2"><a href="contact.php" class="text-decoration-none">✉️ Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
