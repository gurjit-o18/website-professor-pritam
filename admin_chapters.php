<?php
require_once 'functions.php';
require_login();

$data_file = 'data/chapters.json';
$data = read_json($data_file);
$items = $data['items'];

$message = '';
$message_type = 'success';
$edit_item = null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $message = 'Invalid CSRF token.';
        $message_type = 'danger';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'add' || $action === 'edit') {
            // Validate and sanitize input
            $title = trim($_POST['title'] ?? '');
            $book = trim($_POST['book'] ?? '');
            $editors = trim($_POST['editors'] ?? '');
            $publisher = trim($_POST['publisher'] ?? '');
            $year = trim($_POST['year'] ?? '');
            $authors = trim($_POST['authors'] ?? '');
            $url = trim($_POST['url'] ?? '');
            $summary = trim($_POST['summary'] ?? '');

            if (empty($title)) {
                $message = 'Title is required.';
                $message_type = 'danger';
            } elseif (empty($book)) {
                $message = 'Book title is required.';
                $message_type = 'danger';
            } elseif (empty($year) || !ctype_digit($year) || $year < 1900 || $year > (date('Y') + 5)) {
                $message = 'Valid year is required.';
                $message_type = 'danger';
            } elseif (!empty($url) && !is_valid_url($url)) {
                $message = 'Invalid URL.';
                $message_type = 'danger';
            } else {
                $chapter = [
                    'title' => $title,
                    'book' => $book,
                    'editors' => $editors,
                    'publisher' => $publisher,
                    'year' => (int)$year,
                    'authors' => $authors,
                    'url' => $url,
                    'summary' => $summary
                ];

                if ($action === 'add') {
                    $chapter['id'] = new_id('ch_');
                    $items[] = $chapter;
                    $message = 'Chapter added successfully!';
                } else {
                    $edit_id = $_POST['edit_id'] ?? '';
                    $chapter['id'] = $edit_id;
                    $items = update_item_by_id($items, $edit_id, $chapter);
                    $message = 'Chapter updated successfully!';
                }

                $data['items'] = $items;
                write_json($data_file, $data);
            }
        } elseif ($action === 'delete') {
            $delete_id = $_POST['delete_id'] ?? '';
            $items = delete_item_by_id($items, $delete_id);
            $data['items'] = $items;
            write_json($data_file, $data);
            $message = 'Chapter deleted successfully!';
        }
    }

    // Reload data
    $data = read_json($data_file);
    $items = $data['items'];
}

// Handle edit request
if (isset($_GET['edit'])) {
    $edit_item = get_item_by_id($items, $_GET['edit']);
}

include 'header.php';
?>

<main class="container my-5">
    <h1 class="section-title">Manage Book Chapters</h1>

    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3">
            <div class="admin-sidebar">
                <h5 class="mb-3">Admin Menu</h5>
                <nav class="nav flex-column">
                    <a class="nav-link" href="admin.php">Dashboard</a>
                    <a class="nav-link" href="admin_books.php">Manage Books</a>
                    <a class="nav-link active" href="admin_chapters.php">Manage Chapters</a>
                    <a class="nav-link" href="admin_articles.php">Manage Articles</a>
                    <a class="nav-link" href="admin_videos.php">Manage Videos</a>
                    <a class="nav-link" href="admin_conferences.php">Manage Conferences</a>
                    <a class="nav-link" href="admin_blog.php">Manage Blog</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <?php if ($message): ?>
            <div class="alert alert-<?= $message_type ?>"><?= h($message) ?></div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4><?= $edit_item ? 'Edit Chapter' : 'Add New Chapter' ?></h4>
                    <form method="POST" action="admin_chapters.php">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="action" value="<?= $edit_item ? 'edit' : 'add' ?>">
                        <?php if ($edit_item): ?>
                        <input type="hidden" name="edit_id" value="<?= h($edit_item['id']) ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="title" class="form-label">Chapter Title *</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="<?= $edit_item ? h($edit_item['title']) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="book" class="form-label">Book Title *</label>
                            <input type="text" class="form-control" id="book" name="book"
                                   value="<?= $edit_item ? h($edit_item['book']) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="editors" class="form-label">Editors</label>
                            <input type="text" class="form-control" id="editors" name="editors"
                                   value="<?= $edit_item ? h($edit_item['editors']) : '' ?>" placeholder="e.g. Smith J, Jones A (eds)">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher"
                                       value="<?= $edit_item ? h($edit_item['publisher']) : '' ?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="year" class="form-label">Year *</label>
                                <input type="number" class="form-control" id="year" name="year" min="1900" max="<?= date('Y') + 5 ?>"
                                       value="<?= $edit_item ? h($edit_item['year']) : '' ?>" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="authors" class="form-label">Author(s)</label>
                                <input type="text" class="form-control" id="authors" name="authors"
                                       value="<?= $edit_item ? h($edit_item['authors']) : '' ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control" id="url" name="url"
                                   value="<?= $edit_item ? h($edit_item['url']) : '' ?>" placeholder="https://...">
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea class="form-control" id="summary" name="summary" rows="4"><?= $edit_item ? h($edit_item['summary']) : '' ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <?= $edit_item ? 'Update Chapter' : 'Add Chapter' ?>
                            </button>
                            <?php if ($edit_item): ?>
                            <a href="admin_chapters.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Chapters List -->
            <div class="card">
                <div class="card-body">
                    <h4>Chapters List</h4>
                    <?php if (empty($items)): ?>
                    <p class="text-muted">No chapters yet. Add your first chapter above.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Chapter Title</th>
                                    <th>Book</th>
                                    <th>Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= h($item['title']) ?></td>
                                    <td><?= h($item['book']) ?></td>
                                    <td><?= h($item['year']) ?></td>
                                    <td>
                                        <a href="admin_chapters.php?edit=<?= h($item['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="admin_chapters.php" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="delete_id" value="<?= h($item['id']) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this chapter?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
