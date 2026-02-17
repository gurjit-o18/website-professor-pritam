<?php
require_once 'functions.php';

// Static admin credentials
// NOTE: Change this password before deployment!
// This is a hashed version of "CHANGE_ME_STRONG_PASSWORD"
$ADMIN_USER = "admin";
$ADMIN_PASS_HASH = '$2y$10$YourHashedPasswordHere'; // Replace with password_hash('your_password', PASSWORD_DEFAULT)

// For initial setup, we'll use plain text comparison (MUST be changed in production)
$ADMIN_PASS_PLAIN = "CHANGE_ME_STRONG_PASSWORD"; // TODO: Remove this and use only hashed passwords

$error = '';
$success = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!csrf_check()) {
        $error = 'Invalid request. Please try again.';
    } else {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // In production, use password_verify() with hashed password
        // For now, using plain text for ease of setup
        if ($username === $ADMIN_USER && $password === $ADMIN_PASS_PLAIN) {
            $_SESSION['admin'] = true;
            $_SESSION['admin_user'] = $username;
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            header('Location: admin.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}

// Redirect if already logged in
if (is_logged_in()) {
    header('Location: admin.php');
    exit;
}

include 'header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Admin Login</h2>

                    <?php if ($error): ?>
                    <div class="alert alert-danger"><?= h($error) ?></div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                    <div class="alert alert-success"><?= h($success) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="login.php">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
