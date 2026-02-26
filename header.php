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
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="assets/css/site.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Prof. Pritam Singh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'about.php' ? 'active' : '' ?>" href="about.php">About</a>
                    </li>
                    <!-- Profile dropdown -->
                    <?php $profile_pages = ['education.php','academic_career.php','awards.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $profile_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Profile</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'education.php' ? 'active' : '' ?>" href="education.php">Education</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'academic_career.php' ? 'active' : '' ?>" href="academic_career.php">Academic Career</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'awards.php' ? 'active' : '' ?>" href="awards.php">Awards &amp; Honors</a></li>
                        </ul>
                    </li>
                    <!-- Publications dropdown -->
                    <?php $pub_pages = ['books.php','articles.php','chapters.php','reviews.php','newspaper_articles.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $pub_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Publications</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'books.php' ? 'active' : '' ?>" href="books.php">Books</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'articles.php' ? 'active' : '' ?>" href="articles.php">Journal Articles</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'chapters.php' ? 'active' : '' ?>" href="chapters.php">Book Chapters</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'reviews.php' ? 'active' : '' ?>" href="reviews.php">Reviews</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'newspaper_articles.php' ? 'active' : '' ?>" href="newspaper_articles.php">Newspaper Articles</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'conferences.php' ? 'active' : '' ?>" href="conferences.php">Conferences &amp; Talks</a>
                    </li>
                    <!-- Research dropdown -->
                    <?php $research_pages = ['research_leadership.php','funding.php','doctoral_supervision.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $research_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Research</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'research_leadership.php' ? 'active' : '' ?>" href="research_leadership.php">Research Leadership</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'funding.php' ? 'active' : '' ?>" href="funding.php">Funding</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'doctoral_supervision.php' ? 'active' : '' ?>" href="doctoral_supervision.php">Doctoral Supervision</a></li>
                        </ul>
                    </li>
                    <!-- Engagement dropdown -->
                    <?php $engage_pages = ['professional_associations.php','public_engagement.php','academic_leadership.php','enterprise_consultancy.php','global_impact.php']; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($current_page, $engage_pages) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Engagement</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?= $current_page === 'professional_associations.php' ? 'active' : '' ?>" href="professional_associations.php">Professional Associations</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'public_engagement.php' ? 'active' : '' ?>" href="public_engagement.php">Public Engagement</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'academic_leadership.php' ? 'active' : '' ?>" href="academic_leadership.php">Academic Leadership</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'enterprise_consultancy.php' ? 'active' : '' ?>" href="enterprise_consultancy.php">Enterprise &amp; Consultancy</a></li>
                            <li><a class="dropdown-item <?= $current_page === 'global_impact.php' ? 'active' : '' ?>" href="global_impact.php">Global Impact</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'search.php' ? 'active' : '' ?>" href="search.php">Search</a>
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
