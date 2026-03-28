<?php
require_once 'functions.php';

// Load bio data
$bio = read_json('data/bio.json');

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-user"></i> About <?= h($bio['name']) ?></h1>
    </div>
</section>

<main class="container my-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <h2><?= h($bio['name']) ?></h2>
            <h4 class="text-muted"><?= h($bio['title']) ?></h4>
            <h5 class="text-muted mb-4"><?= h($bio['institution']) ?></h5>

            <div class="bio-section mb-4">
                <h3><i class="fas fa-id-card me-2"></i>Biography</h3>
                <p><?= h($bio['bio']) ?></p>
            </div>

            <?php if (!empty($bio['prior_positions'])): ?>
            <div class="positions-section mb-4">
                <h3><i class="fas fa-briefcase me-2"></i>Prior Positions</h3>
                <ul class="list-unstyled">
                    <?php foreach ($bio['prior_positions'] as $position): ?>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-primary me-1"></i> <?= h($position) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['administrative_roles'])): ?>
            <div class="achievements-section mb-4">
                <h3><i class="fas fa-star me-2"></i>Administrative Roles &amp; Honors</h3>
                <ul class="list-unstyled">
                    <?php foreach ($bio['administrative_roles'] as $role): ?>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-primary me-1"></i> <?= h($role) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['supervision'])): ?>
            <div class="supervision-section mb-4">
                <h3><i class="fas fa-users me-2"></i>Doctoral Supervision</h3>
                <p><?= h($bio['supervision']) ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['education'])): ?>
            <div class="education-section mb-4">
                <h3><i class="fas fa-graduation-cap me-2"></i>Education</h3>
                <ul class="list-unstyled">
                    <?php if (!empty($bio['education']['DPhil'])): ?>
                    <li class="mb-2">
                        <i class="fas fa-graduation-cap text-primary me-1"></i> <strong>DPhil</strong> - <?= h($bio['education']['DPhil']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['education']['MPhil'])): ?>
                    <li class="mb-2">
                        <i class="fas fa-graduation-cap text-primary me-1"></i> <strong>MPhil</strong> - <?= h($bio['education']['MPhil']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['education']['MA_BA'])): ?>
                    <li class="mb-2">
                        <i class="fas fa-graduation-cap text-primary me-1"></i> <strong>MA &amp; BA Hons School in Economics</strong> - <?= h($bio['education']['MA_BA']) ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['research_interests'])): ?>
            <div class="research-section mb-4">
                <h3><i class="fas fa-flask me-2"></i>Research Interests</h3>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($bio['research_interests'] as $interest): ?>
                    <span class="badge bg-primary fs-6"><?= h($interest) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['teaching_interests'])): ?>
            <div class="teaching-section mb-4">
                <h3><i class="fas fa-chalkboard-teacher me-2"></i>Teaching Interests</h3>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($bio['teaching_interests'] as $interest): ?>
                    <span class="badge bg-secondary fs-6"><?= h($interest) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="profiles-section mb-4">
                <h3><i class="fas fa-globe me-2"></i>Academic Profiles</h3>
                <ul class="list-unstyled">
                    <?php if (!empty($bio['institution_profile_url'])): ?>
                    <li class="mb-2">
                        <a href="<?= h($bio['institution_profile_url']) ?>" target="_blank" class="text-decoration-none">
                            <i class="fas fa-link me-1"></i> Oxford Brookes University Profile
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['google_scholar_url'])): ?>
                    <li class="mb-2">
                        <a href="<?= h($bio['google_scholar_url']) ?>" target="_blank" class="text-decoration-none">
                            <i class="fas fa-link me-1"></i> Google Scholar Profile
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['academia_url'])): ?>
                    <li class="mb-2">
                        <a href="<?= h($bio['academia_url']) ?>" target="_blank" class="text-decoration-none">
                            <i class="fas fa-link me-1"></i> Academia.edu Profile
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-external-link-alt me-2"></i>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="books.php" class="text-decoration-none"><i class="fas fa-book me-1"></i> View Books</a></li>
                        <li class="mb-2"><a href="chapters.php" class="text-decoration-none"><i class="fas fa-bookmark me-1"></i> View Book Chapters</a></li>
                        <li class="mb-2"><a href="articles.php" class="text-decoration-none"><i class="fas fa-file-alt me-1"></i> View Articles</a></li>
                        <li class="mb-2"><a href="videos.php" class="text-decoration-none"><i class="fas fa-video me-1"></i> View Videos</a></li>
                        <li class="mb-2"><a href="conferences.php" class="text-decoration-none"><i class="fas fa-microphone me-1"></i> View Conferences</a></li>
                        <li class="mb-2"><a href="blog.php" class="text-decoration-none"><i class="fas fa-pen me-1"></i> View Blog</a></li>
                        <li class="mb-2"><a href="contact.php" class="text-decoration-none"><i class="fas fa-envelope me-1"></i> Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
