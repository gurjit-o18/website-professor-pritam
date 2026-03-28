<?php
require_once 'functions.php';

// Get current page for active menu highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Pritam Singh - Oxford Brookes University</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="assets/css/site.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-graduation-cap me-2"></i>Prof. Pritam Singh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'about.php' ? 'active' : '' ?>" href="about.php">About</a>
                    </li>
                    <!-- Profile dropdown -->
                    <?php $profile_pages = ['education.php','academic_career.php','awards.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $profile_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Profile</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'education.php' ? 'active' : '' ?>" href="education.php"><i class="fas fa-graduation-cap me-2 text-muted"></i>Education</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'academic_career.php' ? 'active' : '' ?>" href="academic_career.php"><i class="fas fa-briefcase me-2 text-muted"></i>Academic Career</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'awards.php' ? 'active' : '' ?>" href="awards.php"><i class="fas fa-award me-2 text-muted"></i>Awards &amp; Honors</a></li>
                        </ul>
                    </li>
                    <!-- Publications dropdown -->
                    <?php $pub_pages = ['books.php','articles.php','chapters.php','reviews.php','newspaper_articles.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $pub_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Publications</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'books.php' ? 'active' : '' ?>" href="books.php"><i class="fas fa-book me-2 text-muted"></i>Books</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'articles.php' ? 'active' : '' ?>" href="articles.php"><i class="fas fa-file-alt me-2 text-muted"></i>Journal Articles</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'chapters.php' ? 'active' : '' ?>" href="chapters.php"><i class="fas fa-bookmark me-2 text-muted"></i>Book Chapters</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'reviews.php' ? 'active' : '' ?>" href="reviews.php"><i class="fas fa-star me-2 text-muted"></i>Reviews</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'newspaper_articles.php' ? 'active' : '' ?>" href="newspaper_articles.php"><i class="fas fa-newspaper me-2 text-muted"></i>Newspaper Articles</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'conferences.php' ? 'active' : '' ?>" href="conferences.php">Conferences</a>
                    </li>
                    <!-- Research dropdown -->
                    <?php $research_pages = ['research_leadership.php','funding.php','doctoral_supervision.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $research_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Research</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'research_leadership.php' ? 'active' : '' ?>" href="research_leadership.php"><i class="fas fa-flask me-2 text-muted"></i>Research Leadership</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'funding.php' ? 'active' : '' ?>" href="funding.php"><i class="fas fa-hand-holding-usd me-2 text-muted"></i>Funding</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'doctoral_supervision.php' ? 'active' : '' ?>" href="doctoral_supervision.php"><i class="fas fa-user-graduate me-2 text-muted"></i>Doctoral Supervision</a></li>
                        </ul>
                    </li>
                    <!-- Engagement dropdown -->
                    <?php $engage_pages = ['professional_associations.php','public_engagement.php','academic_leadership.php','enterprise_consultancy.php','global_impact.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $engage_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Engagement</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'professional_associations.php' ? 'active' : '' ?>" href="professional_associations.php"><i class="fas fa-users me-2 text-muted"></i>Professional Associations</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'public_engagement.php' ? 'active' : '' ?>" href="public_engagement.php"><i class="fas fa-bullhorn me-2 text-muted"></i>Public Engagement</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'academic_leadership.php' ? 'active' : '' ?>" href="academic_leadership.php"><i class="fas fa-chalkboard-teacher me-2 text-muted"></i>Academic Leadership</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'enterprise_consultancy.php' ? 'active' : '' ?>" href="enterprise_consultancy.php"><i class="fas fa-handshake me-2 text-muted"></i>Enterprise &amp; Consultancy</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'global_impact.php' ? 'active' : '' ?>" href="global_impact.php"><i class="fas fa-globe me-2 text-muted"></i>Global Impact</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'search.php' ? 'active' : '' ?>" href="search.php"><i class="fas fa-search me-1"></i>Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'contact.php' ? 'active' : '' ?>" href="contact.php">Contact</a>
                    </li>
                    <?php if (is_logged_in()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($current_page, 'admin') !== false ? 'active' : '' ?>" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'login.php' ? 'active' : '' ?>" href="login.php">Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
