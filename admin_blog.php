<?php
require_once 'functions.php';
require_login();

$data_file = 'data/blog.json';
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
            $title   = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $date    = trim($_POST['date'] ?? '');
            $url     = trim($_POST['url'] ?? '');
            $tags    = array_values(array_filter(array_map('trim', explode(',', $_POST['tags'] ?? ''))));

            if (empty($title)) {
                $message = 'Title is required.';
                $message_type = 'danger';
            } elseif (empty($date) || !is_valid_date($date)) {
                $message = 'Valid date (YYYY-MM-DD) is required.';
                $message_type = 'danger';
            } elseif (!empty($url) && !is_valid_url($url)) {
                $message = 'Invalid URL.';
                $message_type = 'danger';
            } else {
                $post = [
                    'title'   => $title,
                    'content' => $content,
                    'date'    => $date,
                    'url'     => $url,
                    'tags'    => $tags
                ];

                if ($action === 'add') {
                    $post['id'] = new_id('bl_');
                    $items[] = $post;
                    $message = 'Blog post added successfully!';
                } else {
                    $edit_id = $_POST['edit_id'] ?? '';
                    $post['id'] = $edit_id;
                    $items = update_item_by_id($items, $edit_id, $post);
                    $message = 'Blog post updated successfully!';
                }

                $data['items'] = $items;
                write_json($data_file, $data);
            }
        } elseif ($action === 'delete') {
            $delete_id = $_POST['delete_id'] ?? '';
            $items = delete_item_by_id($items, $delete_id);
            $data['items'] = $items;
            write_json($data_file, $data);
            $message = 'Blog post deleted successfully!';
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
    <h1 class="section-title">Manage Blog</h1>

    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3">
            <div class="admin-sidebar">
                <h5 class="mb-3">Admin Menu</h5>
                <nav class="nav flex-column">
                    <a class="nav-link" href="admin.php">Dashboard</a>
                    <a class="nav-link" href="admin_books.php">Manage Books</a>
                    <a class="nav-link" href="admin_articles.php">Manage Articles</a>
                    <a class="nav-link" href="admin_videos.php">Manage Videos</a>
                    <a class="nav-link" href="admin_conferences.php">Manage Conferences</a>
                    <a class="nav-link active" href="admin_blog.php">Manage Blog</a>
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
                    <h4><?= $edit_item ? 'Edit Blog Post' : 'Add New Blog Post' ?></h4>
                    <form method="POST" action="admin_blog.php">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="action" value="<?= $edit_item ? 'edit' : 'add' ?>">
                        <?php if ($edit_item): ?>
                        <input type="hidden" name="edit_id" value="<?= h($edit_item['id']) ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="<?= $edit_item ? h($edit_item['title']) : '' ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Date (YYYY-MM-DD) *</label>
                                <input type="date" class="form-control" id="date" name="date"
                                       value="<?= $edit_item ? h($edit_item['date']) : '' ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label">Tags (comma-separated)</label>
                                <input type="text" class="form-control" id="tags" name="tags"
                                       value="<?= $edit_item ? h(implode(', ', $edit_item['tags'] ?? [])) : '' ?>"
                                       placeholder="economics, punjab, development">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">External URL (optional)</label>
                            <input type="url" class="form-control" id="url" name="url"
                                   value="<?= $edit_item ? h($edit_item['url']) : '' ?>" placeholder="https://...">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content / Summary</label>
                            <textarea class="form-control" id="content" name="content" rows="6"><?= $edit_item ? h($edit_item['content']) : '' ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <?= $edit_item ? 'Update Post' : 'Add Post' ?>
                            </button>
                            <?php if ($edit_item): ?>
                            <a href="admin_blog.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Blog Posts List -->
            <div class="card">
                <div class="card-body">
                    <h4>Blog Posts List</h4>
                    <?php if (empty($items)): ?>
                    <p class="text-muted">No blog posts yet. Add your first post above.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Tags</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= h($item['title']) ?></td>
                                    <td><?= h($item['date']) ?></td>
                                    <td><?= h(implode(', ', $item['tags'] ?? [])) ?></td>
                                    <td>
                                        <a href="admin_blog.php?edit=<?= h($item['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="admin_blog.php" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="delete_id" value="<?= h($item['id']) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
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
