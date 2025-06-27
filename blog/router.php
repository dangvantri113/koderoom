<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$path = __DIR__ . $uri;

// If the requested file exists (e.g., css, js, images), serve it
if ($uri !== '/' && file_exists($path) && !is_dir($path)) {
    return false;
}

// Otherwise, fallback to app logic
require_once __DIR__ . '/index.php';
