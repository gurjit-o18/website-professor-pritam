<?php
/**
 * Static Website Generator
 * 
 * This script generates a static HTML version of the PHP website.
 * It starts a temporary PHP server, fetches each page, converts links,
 * and saves the static HTML files.
 */

// Configuration
define('OUTPUT_DIR', __DIR__ . '/static-website');
define('SERVER_HOST', '127.0.0.1');
define('SERVER_PORT', 8080);
define('BASE_URL', 'http://' . SERVER_HOST . ':' . SERVER_PORT);

// Public pages to convert (excluding admin, login, logout)
$pages = [
    'index.php',
    'about.php',
    'books.php',
    'articles.php',
    'videos.php',
    'contact.php'
];

// Ensure output directory exists
if (!file_exists(OUTPUT_DIR)) {
    mkdir(OUTPUT_DIR, 0755, true);
}

echo "Starting static website generation...\n";

// Start PHP built-in server in background
$serverPid = null;
$descriptorspec = [
    0 => ['pipe', 'r'],  // stdin
    1 => ['pipe', 'w'],  // stdout
    2 => ['pipe', 'w']   // stderr
];

echo "Starting PHP server on " . BASE_URL . "...\n";
$process = proc_open(
    'php -S ' . SERVER_HOST . ':' . SERVER_PORT,
    $descriptorspec,
    $pipes,
    __DIR__
);

if (!is_resource($process)) {
    die("Failed to start PHP server\n");
}

// Wait for server to start
echo "Waiting for server to be ready...\n";
sleep(2);

// Check if server is running
$context = stream_context_create([
    'http' => [
        'timeout' => 5,
        'ignore_errors' => true
    ]
]);

$serverReady = false;
for ($i = 0; $i < 10; $i++) {
    $result = @file_get_contents(BASE_URL . '/index.php', false, $context);
    if ($result !== false) {
        $serverReady = true;
        echo "Server is ready!\n";
        break;
    }
    echo "Waiting for server... (attempt " . ($i + 1) . "/10)\n";
    sleep(1);
}

if (!$serverReady) {
    proc_terminate($process);
    die("Server failed to start\n");
}

// Function to convert PHP links to HTML links
function convertLinks($html, $currentPage) {
    // Convert .php to .html in href attributes
    $html = preg_replace('/href="([^"]*?)\.php([^"]*?)"/i', 'href="$1.html$2"', $html);
    
    // Handle special case for index.php (convert to index.html)
    $html = preg_replace('/href="index\.html"/i', 'href="index.html"', $html);
    
    return $html;
}

// Generate static HTML for each page
foreach ($pages as $page) {
    echo "Generating $page...\n";
    
    $url = BASE_URL . '/' . $page;
    $html = @file_get_contents($url, false, $context);
    
    if ($html === false) {
        echo "  WARNING: Failed to fetch $page\n";
        continue;
    }
    
    // Convert links
    $html = convertLinks($html, $page);
    
    // Generate output filename
    $outputFile = OUTPUT_DIR . '/' . str_replace('.php', '.html', $page);
    
    // Save the HTML file
    if (file_put_contents($outputFile, $html) !== false) {
        echo "  ✓ Generated $outputFile\n";
    } else {
        echo "  ✗ Failed to write $outputFile\n";
    }
}

// Copy assets directory
echo "Copying assets directory...\n";
$assetsSource = __DIR__ . '/assets';
$assetsDest = OUTPUT_DIR . '/assets';

if (file_exists($assetsSource)) {
    // Create assets directory if it doesn't exist
    if (!file_exists($assetsDest)) {
        mkdir($assetsDest, 0755, true);
    }
    
    // Copy recursively
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($assetsSource, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $destPath = $assetsDest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        if ($item->isDir()) {
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            copy($item, $destPath);
        }
    }
    echo "  ✓ Assets copied\n";
}

// Copy data directory (needed for JSON data if accessed client-side)
echo "Copying data directory...\n";
$dataSource = __DIR__ . '/data';
$dataDest = OUTPUT_DIR . '/data';

if (file_exists($dataSource)) {
    // Create data directory if it doesn't exist
    if (!file_exists($dataDest)) {
        mkdir($dataDest, 0755, true);
    }
    
    // Copy only JSON files (not .htaccess)
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dataSource, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $destPath = $dataDest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        if ($item->isDir()) {
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            // Only copy JSON files
            if (pathinfo($item, PATHINFO_EXTENSION) === 'json') {
                copy($item, $destPath);
            }
        }
    }
    echo "  ✓ Data files copied\n";
}

// Create a .nojekyll file to prevent GitHub Pages from ignoring files starting with _
file_put_contents(OUTPUT_DIR . '/.nojekyll', '');
echo "  ✓ Created .nojekyll file\n";

// Create a README in the static-website directory
$readmeContent = <<<'README'
# Static Website

This directory contains the static HTML version of the PHP website.
It is automatically generated by the GitHub Actions workflow.

## Files

- `*.html` - Static HTML pages
- `assets/` - CSS, images, and other assets
- `data/` - JSON data files

## Usage

You can serve these files with any static web server, such as:
- GitHub Pages
- Netlify
- Vercel
- Apache/Nginx
- Python's SimpleHTTPServer

## Regeneration

The static files are automatically regenerated on every push and pull request.
To regenerate manually, run:

```bash
php generate-static.php
```
README;

file_put_contents(OUTPUT_DIR . '/README.md', $readmeContent);
echo "  ✓ Created README.md\n";

// Stop the PHP server
echo "Stopping PHP server...\n";
proc_terminate($process);
proc_close($process);

echo "\n✓ Static website generation complete!\n";
echo "Output directory: " . OUTPUT_DIR . "\n";
