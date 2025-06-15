<?php 
require_once 'includes/header.php'; // Include the header
require_once 'includes/db.php'; // Include database connection
// Check if the post ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php'); // Redirect to the homepage if no valid post ID
    exit;
}
$post_id = intval($_GET['id']);
// Fetch the post from the database
$stmt = $mysqli->prepare("SELECT title, body, created_at FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($title, $content, $created_at);  
$stmt->fetch();
$stmt->close();
// Display the post details
echo "<h2>" . htmlspecialchars($title) . "</h2>";
echo "<p>" . htmlspecialchars($content) . "</p>";
echo "<p><small>Published on " . htmlspecialchars($created_at) . "</small></p>";
// Close the database connection
$mysqli->close();
?>
