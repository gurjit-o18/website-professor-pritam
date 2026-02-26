<?php
require_once 'functions.php';

// Load bio data
$bio = read_json('data/bio.json');

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">About <?= h($bio['name']) ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <h2><?= h($bio['name']) ?></h2>
            <h4 class="text-muted"><?= h($bio['title']) ?></h4>
            <h5 class="text-muted mb-4"><?= h($bio['institution']) ?></h5>

            <div class="bio-section mb-4">
                <h3>Biography</h3>
                <p><?= h($bio['bio']) ?></p>
            </div>

            <?php if (!empty($bio['prior_positions'])): ?>
            <div class="positions-section mb-4">
                <h3>Prior Positions</h3>
                <ul class="list-unstyled">
                    <?php foreach ($bio['prior_positions'] as $position): ?>
                    <li class="mb-2">
                        <i class="text-primary">✓</i> <?= h($position) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['administrative_roles'])): ?>
            <div class="achievements-section mb-4">
                <h3>Administrative Roles & Honors</h3>
                <ul class="list-unstyled">
                    <?php foreach ($bio['administrative_roles'] as $role): ?>
                    <li class="mb-2">
                        <i class="text-primary">✓</i> <?= h($role) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['supervision'])): ?>
            <div class="supervision-section mb-4">
                <h3>Doctoral Supervision</h3>
                <p><?= h($bio['supervision']) ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['education'])): ?>
            <div class="education-section mb-4">
                <h3>Education</h3>
                <ul class="list-unstyled">
                    <?php if (!empty($bio['education']['DPhil'])): ?>
                    <li class="mb-2">
                        <i class="text-primary">🎓</i> <strong>DPhil</strong> - <?= h($bio['education']['DPhil']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['education']['MPhil'])): ?>
                    <li class="mb-2">
                        <i class="text-primary">🎓</i> <strong>MPhil</strong> - <?= h($bio['education']['MPhil']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['education']['MA_BA'])): ?>
                    <li class="mb-2">
                        <i class="text-primary">🎓</i> <strong>MA & BA Hons School in Economics</strong> - <?= h($bio['education']['MA_BA']) ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['research_interests'])): ?>
            <div class="research-section mb-4">
                <h3>Research Interests</h3>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($bio['research_interests'] as $interest): ?>
                    <span class="badge bg-primary fs-6"><?= h($interest) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($bio['teaching_interests'])): ?>
            <div class="teaching-section mb-4">
                <h3>Teaching Interests</h3>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($bio['teaching_interests'] as $interest): ?>
                    <span class="badge bg-secondary fs-6"><?= h($interest) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="profiles-section mb-4">
                <h3>Academic Profiles</h3>
                <ul class="list-unstyled">
                    <?php if (!empty($bio['institution_profile_url'])): ?>
                    <li class="mb-2">
                        <a href="<?= h($bio['institution_profile_url']) ?>" target="_blank" class="text-decoration-none">
                            🔗 Oxford Brookes University Profile
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['google_scholar_url'])): ?>
                    <li class="mb-2">
                        <a href="<?= h($bio['google_scholar_url']) ?>" target="_blank" class="text-decoration-none">
                            🔗 Google Scholar Profile
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($bio['academia_url'])): ?>
                    <li class="mb-2">
                        <a href="<?= h($bio['academia_url']) ?>" target="_blank" class="text-decoration-none">
                            🔗 Academia.edu Profile
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="books.php" class="text-decoration-none">📚 View Books</a></li>
                        <li class="mb-2"><a href="articles.php" class="text-decoration-none">📄 View Articles</a></li>
                        <li class="mb-2"><a href="videos.php" class="text-decoration-none">🎥 View Videos</a></li>
                        <li class="mb-2"><a href="conferences.php" class="text-decoration-none">🎤 View Conferences</a></li>
                        <li class="mb-2"><a href="blog.php" class="text-decoration-none">📝 View Blog</a></li>
                        <li class="mb-2"><a href="contact.php" class="text-decoration-none">✉️ Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
