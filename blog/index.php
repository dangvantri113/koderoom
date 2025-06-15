<?php
require_once 'includes/header.php'; // Include the header
require_once 'includes/db.php'; // Include database connection

// show the homepage content
echo "<main>";
echo "<h2>Welcome to the Blog</h2>";
echo "<p>This is the homepage of the blog. You can read posts, leave comments, and more.</p>";
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo "<p>You are logged in. <a href='logout.php'>Logout</a></p>";
} else {
    echo "<p>You are not logged in. <a href='login.php'>Login</a> or <a href='register.php'>Register</a></p>";
}
// Fetch and display recent posts from the database
$stmt = $mysqli->prepare("SELECT id, title, body, created_at FROM posts ORDER BY created_at DESC LIMIT 5");
$stmt->execute();
$stmt->bind_result($id, $title, $content, $created_at);
while ($stmt->fetch()) {
    echo "<article>";
    echo "<h3>" . htmlspecialchars($title) . "</h3>";
    echo "<p>" . htmlspecialchars($content) . "</p>";
    echo "<p><small>Published on " . htmlspecialchars($created_at) . "</small></p>";
    echo "<a href='post.php?id=" . $id . "'>Read more</a>";
    echo "</article>";
}
$stmt->close();
echo "</main>";
// Close the database connection
$mysqli->close();
// End the session
