<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/Models/User.php';

$session = new Session();
$session->start();
$mysqli = Database::getInstance()->getConnection();
// Check if the user is logged in
if ($session->exists('user_id')) {
    $user_id = $session->get('user_id');
    // Fetch user data from the database
    $user = User::findById($user_id);
    // Display the header with user information
    echo "<header>";
    echo "<h1>Welcome to the Blog, $user->name </h1>";
    echo "<p>Email: $user->email</p>";
    echo "<nav>";
    echo "<ul>";
    echo "<li><a href='index.php'>Home</a></li>";
    echo "<li><a href='logout.php'>Logout</a></li>";
    echo "</ul>";
    echo "</nav>";
} else {
    // Display the header for guests
    echo "<header>";
    echo "<h1>Welcome to the Blog</h1>";
    echo "<nav>";
    echo "<ul>";
    echo "<li><a href='index.php'>Home</a></li>";
    echo "<li><a href='login.php'>Login</a></li>";
    echo "<li><a href='register.php'>Register</a></li>";
    echo "</ul>";
    echo "</nav>";
}
echo "</header>";
