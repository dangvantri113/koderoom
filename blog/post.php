<?php 
require_once 'includes/header.php';
require_once 'includes/Models/Post.php';
// Check if the post ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$post_id = intval($_GET['id']);
$post = Post::findById($post_id);

echo "<h2>" . htmlspecialchars($post->title) . "</h2>";
echo "<p>" . htmlspecialchars($post->body) . "</p>";
echo "<p><small>Published on " . htmlspecialchars($post->created_at) . "</small></p>";
?>
