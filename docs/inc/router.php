<?php

// router.php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Security: Prevent directory traversal
if (str_contains($path, '..')) {
    header("HTTP/1.0 403 Forbidden");
    exit('Directory traversal not allowed');
}

// List ekstensi file yang boleh diakses langsung
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'css', 'js', 'ico', 'webp', 'svg', 'txt', 'pdf'];

// MIME types mapping
$mime_types = [
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'css'  => 'text/css',
    'js'   => 'application/javascript',
    'ico'  => 'image/x-icon',
    'webp' => 'image/webp',
    'svg'  => 'image/svg+xml',
    'txt'  => 'text/plain',
    'pdf'  => 'application/pdf'
];

$path = ltrim($path, '/');
// File path yang aman
$file_path = is_file(ABSPATH . DIRECTORY_SEPARATOR . $path) ?
    ABSPATH . DIRECTORY_SEPARATOR . $path : __DIR__ . DIRECTORY_SEPARATOR . $path;

// Cek jika file exists dan ekstensi diperbolehkan
if (file_exists($file_path) && is_file($file_path)) {
    $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    if (in_array($extension, $allowed_extensions)) {
        // Set MIME type yang tepat
        if (isset($mime_types[$extension])) {
            header('Content-Type: ' . $mime_types[$extension]);
        }

        // Cache control untuk static assets
        if (in_array($extension, ['css', 'js', 'jpg', 'png', 'gif'])) {
            // header('Cache-Control: max-age=3600'); // 1 hour cache
        }

        readfile($file_path);
        exit;
    }
}

// Handle PHP files specifically
if (file_exists($file_path) && preg_match('/\.php$/', $file_path)) {
    require $file_path;
    exit;
}
