<?php
// Simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/' || $uri === '/index') {
    require_once 'controllers/HomeController.php';
    HomeController::index();
    exit;
}

if ($uri === '/register') {
    require_once 'controllers/RegisterController.php';
    RegisterController::handle();
    exit;
}

if ($uri === '/login') {
    require_once 'controllers/LoginController.php';
    LoginController::index();
    exit;
}

if ($uri === '/logout') {
    require_once 'includes/Auth.php';
    Auth::logout();
    header('Location: /login?success=You have been logged out successfully');
    exit;
}

if (preg_match('#^/post/(\d+)$#', $uri, $matches)) {
    require_once 'controllers/PostController.php';
    PostController::show($matches[1]);
    exit;
}

http_response_code(404);
require 'views/404.php';
exit;
?>
