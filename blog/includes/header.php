<?php
// add header for the blog
session_start();
require_once 'db.php'; // Include database connection
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Fetch user data from the database
    $stmt = $mysqli->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name, $email);
    $stmt->fetch();
    $stmt->close();
    // Display the header with user information
    echo "<header>";
    echo "<h1>Welcome to the Blog, $name</h1>";
    echo "<p>Email: $email</p>";
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
