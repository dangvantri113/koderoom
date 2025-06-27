<?php

require_once __DIR__ . '/../includes/Session.php';
require_once __DIR__ . '/../includes/Models/User.php';
require_once __DIR__ . '/../includes/Auth.php';

class LoginController
{
  public static function index()
  {
    Session::start();
    if (Session::exists('user_id')) {
      header('Location: /');
      exit;
    }
    $error = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = trim($_POST['email']) ?? '';
      $password = trim($_POST['password']) ?? '';

      if (Auth::login($email, $password)) {
        header('Location: /');
        exit;
      } else {
        $error = 'Invalid email or password';
      }
    }
    include __DIR__ . '/../views/login.php';
  }
}
