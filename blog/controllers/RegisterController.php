<?php
require_once __DIR__ . '/../includes/Session.php';
require_once __DIR__ . '/../includes/Models/User.php';

class RegisterController
{
  public static function handle()
  {
    Session::start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      self::register();
    } else {
      self::showForm();
    }
  }
  public static function showForm($error = null)
  {
    include __DIR__ . '/../views/register.php';
  }

  public static function register()
  {
    $session = new Session();
    $session->start();
    if ($session->exists('logged_in')) {
      header('Location: /');
      exit;
    }
    $name = trim($_POST['name']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $password = trim($_POST['password']) ?? '';
    // Validate the input
    if (empty($name) || empty($email) || empty($password)) {
      self::showForm('Please fill in all fields');
      return;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      self::showForm('Invalid email format');
      return;
    }
    if (strlen($password) < 6) {
      self::showForm('Password must be at least 6 characters long');
      return;
    }
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    try {
      $user = new User(null, $name, $email, $passwordHash);
      $user->save();
    } catch (Exception $e) {
      self::showForm('Registration failed: ' . htmlspecialchars($e->getMessage()));
      return;
    }
    header('Location: /login?success=Registration successful! Please log in.');
    exit;
  }
}
