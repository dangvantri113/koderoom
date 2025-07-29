<?php
require_once __DIR__ . '/../includes/Models/Post.php';
require_once __DIR__ . '/../includes/Session.php';

class PostController {
    public static function show($id) {
        Session::start();
        $post = Post::findById($id);
        if (!$post) {
            header('Location: /index.php');
            exit;
        }
        require_once __DIR__ . '/../views/post/detail.php';
    }

    public static function create() {
        // Middleware to check if user is logged in
        Session::start();
        if (!Session::exists('user_id')) {
            header('Location: /login?error=You must be logged in to create a post');
            exit;
        }
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $title = $_POST['title'];
        //     $body = $_POST['body'];
        //     Post::create($title, $body);
        //     header('Location: /index.php');
        //     exit;
        // }
        require_once __DIR__ . '/../views/post/create.php';
    
    }
}
