<?php
require_once 'functions.php';
require_login();

// Load counts
$books_data = read_json('data/books.json');
$articles_data = read_json('data/articles.json');
$videos_data = read_json('data/videos.json');

$books_count = count($books_data['items']);
$articles_count = count($articles_data['items']);
$videos_count = count($videos_data['items']);

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Admin Dashboard</h1>

    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3">
            <div class="admin-sidebar">
                <h5 class="mb-3">Admin Menu</h5>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="admin.php">Dashboard</a>
                    <a class="nav-link" href="admin_books.php">Manage Books</a>
                    <a class="nav-link" href="admin_articles.php">Manage Articles</a>
                    <a class="nav-link" href="admin_videos.php">Manage Videos</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h2 class="display-4"><?= $books_count ?></h2>
                            <p class="card-text">Books</p>
                            <a href="admin_books.php" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h2 class="display-4"><?= $articles_count ?></h2>
                            <p class="card-text">Articles</p>
                            <a href="admin_articles.php" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h2 class="display-4"><?= $videos_count ?></h2>
                            <p class="card-text">Videos</p>
                            <a href="admin_videos.php" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h4>Welcome, <?= h($_SESSION['admin_user'] ?? 'Admin') ?>!</h4>
                    <p>Use the menu on the left to manage your website content. You can add, edit, or delete books, articles, and videos.</p>
                    
                    <div class="alert alert-info mt-3">
                        <strong>Quick Tips:</strong>
                        <ul class="mb-0">
                            <li>All changes are saved to JSON files in the /data directory</li>
                            <li>Make sure to fill in all required fields when adding content</li>
                            <li>URLs will be validated automatically</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
