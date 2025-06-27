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
}
