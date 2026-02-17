<?php
/**
 * Helper Functions for Professor Pritam Singh Website
 * Contains utility functions for JSON handling, security, and validation
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Read JSON file and return decoded data
 * @param string $path Path to JSON file
 * @return array Decoded JSON data
 */
function read_json($path) {
    if (!file_exists($path)) {
        return ['items' => []];
    }
    $content = file_get_contents($path);
    $data = json_decode($content, true);
    return $data ? $data : ['items' => []];
}

/**
 * Write data to JSON file with file locking
 * @param string $path Path to JSON file
 * @param array $data Data to write
 * @return bool Success status
 */
function write_json($path, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    return file_put_contents($path, $json, LOCK_EX) !== false;
}

/**
 * HTML escape for XSS prevention
 * @param string $string String to escape
 * @return string Escaped string
 */
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in as admin
 * @return bool Login status
 */
function is_logged_in() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

/**
 * Require admin login, redirect to login page if not logged in
 */
function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Generate CSRF token
 * @return string CSRF token
 */
function csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 * @return bool Valid status
 */
function csrf_check() {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}

/**
 * Generate new unique ID with prefix
 * @param string $prefix ID prefix (e.g., 'b_', 'a_', 'v_')
 * @return string New unique ID
 */
function new_id($prefix) {
    $timestamp = time();
    $random = mt_rand(100, 999);
    return $prefix . $timestamp . '_' . $random;
}

/**
 * Validate URL
 * @param string $url URL to validate
 * @return bool Valid status
 */
function is_valid_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Validate date format (YYYY-MM-DD)
 * @param string $date Date to validate
 * @return bool Valid status
 */
function is_valid_date($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

/**
 * Get item by ID from array of items
 * @param array $items Array of items
 * @param string $id ID to find
 * @return array|null Found item or null
 */
function get_item_by_id($items, $id) {
    foreach ($items as $item) {
        if ($item['id'] === $id) {
            return $item;
        }
    }
    return null;
}

/**
 * Delete item by ID from array of items
 * @param array $items Array of items
 * @param string $id ID to delete
 * @return array Updated array
 */
function delete_item_by_id($items, $id) {
    return array_values(array_filter($items, function($item) use ($id) {
        return $item['id'] !== $id;
    }));
}

/**
 * Update item by ID in array of items
 * @param array $items Array of items
 * @param string $id ID to update
 * @param array $new_data New data for item
 * @return array Updated array
 */
function update_item_by_id($items, $id, $new_data) {
    foreach ($items as $key => $item) {
        if ($item['id'] === $id) {
            $items[$key] = $new_data;
            break;
        }
    }
    return $items;
}

/**
 * Get latest items from array
 * @param array $items Array of items
 * @param int $limit Number of items to return
 * @return array Latest items
 */
function get_latest_items($items, $limit = 5) {
    return array_slice(array_reverse($items), 0, $limit);
}
