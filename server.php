<?php
// Development server router for proper path handling
$request_uri = $_SERVER['REQUEST_URI'];
$public_path = __DIR__ . '/public';

// Remove query string
$path = parse_url($request_uri, PHP_URL_PATH);

// If requesting root, redirect to public/index.php
if ($path === '/') {
    $path = '/index.php';
}

// Check if file exists in public directory
$file_path = $public_path . $path;

if (file_exists($file_path) && !is_dir($file_path)) {
    // Serve the file
    if (pathinfo($file_path, PATHINFO_EXTENSION) === 'php') {
        // Change working directory to public for proper relative paths
        chdir($public_path);
        require $file_path;
    } else {
        // Serve static files with proper MIME type
        $mime_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml'
        ];
        
        $ext = pathinfo($file_path, PATHINFO_EXTENSION);
        if (isset($mime_types[$ext])) {
            header('Content-Type: ' . $mime_types[$ext]);
        }
        readfile($file_path);
    }
} else {
    // 404 - File not found
    http_response_code(404);
    echo "404 - File not found: " . htmlspecialchars($path);
}
?>