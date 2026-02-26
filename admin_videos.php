<?php
require_once 'functions.php';
require_login();

$data_file = 'data/videos.json';
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
            $platform = trim($_POST['platform'] ?? '');
            $url = trim($_POST['url'] ?? '');
            $published_date = trim($_POST['published_date'] ?? '');
            $duration = trim($_POST['duration'] ?? '');
            $channel = trim($_POST['channel'] ?? '');
            $notes = trim($_POST['notes'] ?? '');

            if (empty($title)) {
                $message = 'Title is required.';
                $message_type = 'danger';
            } elseif (empty($platform)) {
                $message = 'Platform is required.';
                $message_type = 'danger';
            } elseif (empty($url) || !is_valid_url($url)) {
                $message = 'Valid URL is required.';
                $message_type = 'danger';
            } elseif (!empty($published_date) && !is_valid_date($published_date)) {
                $message = 'Invalid date format (YYYY-MM-DD).';
                $message_type = 'danger';
            } else {
                $video = [
                    'title' => $title,
                    'platform' => $platform,
                    'url' => $url,
                    'published_date' => $published_date,
                    'duration' => $duration,
                    'channel' => $channel,
                    'notes' => $notes
                ];

                if ($action === 'add') {
                    $video['id'] = new_id('v_');
                    $items[] = $video;
                    $message = 'Video added successfully!';
                } else {
                    $edit_id = $_POST['edit_id'] ?? '';
                    $video['id'] = $edit_id;
                    $items = update_item_by_id($items, $edit_id, $video);
                    $message = 'Video updated successfully!';
                }

                $data['items'] = $items;
                write_json($data_file, $data);
            }
        } elseif ($action === 'delete') {
            $delete_id = $_POST['delete_id'] ?? '';
            $items = delete_item_by_id($items, $delete_id);
            $data['items'] = $items;
            write_json($data_file, $data);
            $message = 'Video deleted successfully!';
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
    <h1 class="section-title">Manage Videos</h1>

    <div class="row">
        <!-- Admin Sidebar -->
        <div class="col-md-3">
            <div class="admin-sidebar">
                <h5 class="mb-3">Admin Menu</h5>
                <nav class="nav flex-column">
                    <a class="nav-link" href="admin.php">Dashboard</a>
                    <a class="nav-link" href="admin_books.php">Manage Books</a>
                    <a class="nav-link" href="admin_chapters.php">Manage Chapters</a>
                    <a class="nav-link" href="admin_articles.php">Manage Articles</a>
                    <a class="nav-link active" href="admin_videos.php">Manage Videos</a>
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
                    <h4><?= $edit_item ? 'Edit Video' : 'Add New Video' ?></h4>
                    <form method="POST" action="admin_videos.php">
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
                                <label for="platform" class="form-label">Platform *</label>
                                <input type="text" class="form-control" id="platform" name="platform" 
                                       value="<?= $edit_item ? h($edit_item['platform']) : '' ?>" 
                                       placeholder="YouTube, Vimeo, etc." required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="channel" class="form-label">Channel</label>
                                <input type="text" class="form-control" id="channel" name="channel" 
                                       value="<?= $edit_item ? h($edit_item['channel']) : '' ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL *</label>
                            <input type="url" class="form-control" id="url" name="url" 
                                   value="<?= $edit_item ? h($edit_item['url']) : '' ?>" 
                                   placeholder="https://..." required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="published_date" class="form-label">Published Date (YYYY-MM-DD)</label>
                                <input type="date" class="form-control" id="published_date" name="published_date" 
                                       value="<?= $edit_item ? h($edit_item['published_date']) : '' ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" class="form-control" id="duration" name="duration" 
                                       value="<?= $edit_item ? h($edit_item['duration']) : '' ?>" 
                                       placeholder="e.g., 26:16">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"><?= $edit_item ? h($edit_item['notes']) : '' ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <?= $edit_item ? 'Update Video' : 'Add Video' ?>
                            </button>
                            <?php if ($edit_item): ?>
                            <a href="admin_videos.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Videos List -->
            <div class="card">
                <div class="card-body">
                    <h4>Videos List</h4>
                    <?php if (empty($items)): ?>
                    <p class="text-muted">No videos yet. Add your first video above.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Platform</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= h($item['title']) ?></td>
                                    <td><?= h($item['platform']) ?></td>
                                    <td><?= h($item['duration']) ?></td>
                                    <td>
                                        <a href="admin_videos.php?edit=<?= h($item['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="admin_videos.php" style="display:inline;">
                                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="delete_id" value="<?= h($item['id']) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
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
