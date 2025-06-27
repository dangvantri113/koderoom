<?php
require_once __DIR__ . '/../includes/Models/User.php';
require_once __DIR__ . '/../includes/Models/Post.php';
require_once __DIR__ . '/../includes/Session.php';
class HomeController {
    public static function index() {
        Session::start();
        if (!Session::exists('user_id')) {
            header('Location: /login');
            exit;
        }

        $user_id = Session::get('user_id');
        $user = User::findById($user_id);
        if (!$user) {
            Session::destroy();
            header('Location: /login');
            exit;    
        }

        $posts = Post::all();
        require_once __DIR__ . '/../views/home.php';
    }
}
