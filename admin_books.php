<?php
require_once 'functions.php';
require_login();

$data_file = 'data/books.json';
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
            $authors = trim($_POST['authors'] ?? '');
            $year = trim($_POST['year'] ?? '');
            $publisher = trim($_POST['publisher'] ?? '');
            $isbn = trim($_POST['isbn'] ?? '');
            $notes = trim($_POST['notes'] ?? '');
            
            // Parse links
            $links = [];
            if (!empty($_POST['link_labels']) && !empty($_POST['link_urls'])) {
                for ($i = 0; $i < count($_POST['link_labels']); $i++) {
                    $label = trim($_POST['link_labels'][$i]);
                    $url = trim($_POST['link_urls'][$i]);
                    if (!empty($label) && !empty($url)) {
                        if (!is_valid_url($url)) {
                            $message = 'Invalid URL: ' . h($url);
                            $message_type = 'danger';
                            break;
                        }
                        $links[] = ['label' => $label, 'url' => $url];
                    }
                }
            }

            if (empty($title)) {
                $message = 'Title is required.';
                $message_type = 'danger';
            } elseif (empty($authors)) {
                $message = 'Author(s) is required.';
                $message_type = 'danger';
            } elseif (empty($year) || !is_numeric($year)) {
                $message = 'Valid year is required.';
                $message_type = 'danger';
            } elseif (empty($message)) {
                $book = [
                    'title' => $title,
                    'authors' => $authors,
                    'year' => (int)$year,
                    'publisher' => $publisher,
                    'isbn' => $isbn,
                    'links' => $links,
                    'notes' => $notes
                ];

                if ($action === 'add') {
                    $book['id'] = new_id('b_');
                    $items[] = $book;
                    $message = 'Book added successfully!';
                } else {
                    $edit_id = $_POST['edit_id'] ?? '';
                    $book['id'] = $edit_id;
                    $items = update_item_by_id($items, $edit_id, $book);
                    $message = 'Book updated successfully!';
                }

                $data['items'] = $items;
                write_json($data_file, $data);
            }
        } elseif ($action === 'delete') {
            $delete_id = $_POST['delete_id'] ?? '';
            $items = delete_item_by_id($items, $delete_id);
            $data['items'] = $items;
            write_json($data_file, $data);
            $message = 'Book deleted successfully!';
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
    <h1 class="section-title">Manage Books</h1>

    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3">
            <div class="admin-sidebar">
                <h5 class="mb-3">Admin Menu</h5>
                <nav class="nav flex-column">
                    <a class="nav-link" href="admin.php">Dashboard</a>
                    <a class="nav-link active" href="admin_books.php">Manage Books</a>
                    <a class="nav-link" href="admin_chapters.php">Manage Chapters</a>
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
                    <h4><?= $edit_item ? 'Edit Book' : 'Add New Book' ?></h4>
                    <form method="POST" action="admin_books.php">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="action" value="<?= $edit_item ? 'edit' : 'add' ?>">
                        <?php if ($edit_item): ?>
                        <input type="hidden" name="edit_id" value="<?= h($edit_item['id']) ?>">
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?= $edit_item ? h($edit_item['title']) : '' ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="year" class="form-label">Year *</label>
                                <input type="number" class="form-control" id="year" name="year" 
                                       value="<?= $edit_item ? h($edit_item['year']) : '' ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="authors" class="form-label">Author(s) *</label>
                            <input type="text" class="form-control" id="authors" name="authors" 
                                   value="<?= $edit_item ? h($edit_item['authors']) : '' ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" 
                                       value="<?= $edit_item ? h($edit_item['publisher']) : '' ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       value="<?= $edit_item ? h($edit_item['isbn']) : '' ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"><?= $edit_item ? h($edit_item['notes']) : '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Links</label>
                            <div id="links-container">
                                <?php if ($edit_item && !empty($edit_item['links'])): ?>
                                    <?php foreach ($edit_item['links'] as $link): ?>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="link_labels[]" 
                                                   placeholder="Label" value="<?= h($link['label']) ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="url" class="form-control" name="link_urls[]" 
                                                   placeholder="URL" value="<?= h($link['url']) ?>">
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="link_labels[]" placeholder="Label">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="url" class="form-control" name="link_urls[]" placeholder="URL">
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="addLink()">Add Another Link</button>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <?= $edit_item ? 'Update Book' : 'Add Book' ?>
                            </button>
                            <?php if ($edit_item): ?>
                            <a href="admin_books.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Books List -->
            <div class="card">
                <div class="card-body">
                    <h4>Books List</h4>
                    <?php if (empty($items)): ?>
                    <p class="text-muted">No books yet. Add your first book above.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author(s)</th>
                                    <th>Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= h($item['title']) ?></td>
                                    <td><?= h($item['authors']) ?></td>
                                    <td><?= h($item['year']) ?></td>
                                    <td>
                                        <a href="admin_books.php?edit=<?= h($item['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="admin_books.php" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="delete_id" value="<?= h($item['id']) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
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

<script>
function addLink() {
    const container = document.getElementById('links-container');
    const newLink = document.createElement('div');
    newLink.className = 'row mb-2';
    newLink.innerHTML = `
        <div class="col-md-4">
            <input type="text" class="form-control" name="link_labels[]" placeholder="Label">
        </div>
        <div class="col-md-8">
            <input type="url" class="form-control" name="link_urls[]" placeholder="URL">
        </div>
    `;
    container.appendChild(newLink);
}
</script>

<?php include 'footer.php'; ?>
