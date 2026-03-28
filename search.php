<?php
require_once 'functions.php';

// Search across all content
$query = trim($_GET['q'] ?? '');
$results = [];

if ($query !== '') {
    $search = strtolower($query);
    
    // Search books
    $books = read_json('data/books.json')['items'] ?? [];
    foreach ($books as $item) {
        if (str_contains(strtolower($item['title'] . ' ' . $item['authors'] . ' ' . ($item['notes'] ?? '')), $search)) {
            $results[] = [
                'type' => 'Book',
                'title' => $item['title'],
                'meta' => $item['authors'] . ' (' . $item['year'] . ')',
                'url' => 'books.php'
            ];
        }
    }
    
    // Search articles
    $articles = read_json('data/articles.json')['items'] ?? [];
    foreach ($articles as $item) {
        if (str_contains(strtolower($item['title'] . ' ' . $item['source'] . ' ' . ($item['summary'] ?? '')), $search)) {
            $results[] = [
                'type' => 'Journal Article',
                'title' => $item['title'],
                'meta' => $item['source'] . ' (' . $item['date'] . ')',
                'url' => 'articles.php'
            ];
        }
    }
    
    // Search chapters
    $chapters = read_json('data/chapters.json')['items'] ?? [];
    foreach ($chapters as $item) {
        if (str_contains(strtolower($item['title'] . ' ' . ($item['book'] ?? '') . ' ' . ($item['editors'] ?? '')), $search)) {
            $results[] = [
                'type' => 'Book Chapter',
                'title' => $item['title'],
                'meta' => ($item['book'] ?? '') . ' (' . $item['year'] . ')',
                'url' => 'chapters.php'
            ];
        }
    }
    
    // Search conferences
    $conferences = read_json('data/conferences.json')['items'] ?? [];
    foreach ($conferences as $item) {
        if (str_contains(strtolower($item['title'] . ' ' . $item['event'] . ' ' . $item['location']), $search)) {
            $results[] = [
                'type' => 'Conference',
                'title' => $item['title'],
                'meta' => $item['event'] . ', ' . $item['location'],
                'url' => 'conferences.php'
            ];
        }
    }

    // Search newspaper articles
    $np_data = read_json('data/newspaper_articles.json');
    $np_articles = $np_data['items'] ?? [];
    foreach ($np_articles as $item) {
        if (str_contains(strtolower($item['title'] . ' ' . $item['publication']), $search)) {
            $results[] = [
                'type' => 'Newspaper Article',
                'title' => $item['title'],
                'meta' => $item['publication'] . ' (' . $item['year'] . ')',
                'url' => 'newspaper_articles.php'
            ];
        }
    }
}

include 'header.php';
?>

<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-search me-3"></i>Search</h1>
    </div>
</section>

<main class="container my-5">
    <form method="get" action="search.php" class="mb-4">
        <div class="input-group">
            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
            <input type="text" name="q" class="form-control form-control-lg"
                   placeholder="Search publications, conferences, articles..."
                   value="<?= h($query) ?>">
            <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-search me-1"></i>Search</button>
        </div>
    </form>

    <?php if ($query !== ''): ?>
        <p class="text-muted mb-3">
            <?= count($results) ?> result<?= count($results) !== 1 ? 's' : '' ?> for &ldquo;<?= h($query) ?>&rdquo;
        </p>

        <?php if (empty($results)): ?>
            <div class="alert alert-info">No results found. Try different keywords.</div>
        <?php else: ?>
            <?php foreach ($results as $result): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <span class="badge bg-primary mb-1"><?= h($result['type']) ?></span>
                    <h5 class="card-title mb-1">
                        <a href="<?= h($result['url']) ?>" class="text-decoration-none"><?= h($result['title']) ?></a>
                    </h5>
                    <p class="text-muted small mb-0"><?= h($result['meta']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
