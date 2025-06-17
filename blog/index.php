<?php
require_once 'includes/header.php';
require_once 'includes/db.php';

$stmt = $mysqli->prepare("SELECT id, title, body, created_at FROM posts ORDER BY created_at DESC LIMIT 5");
$stmt->execute();
$stmt->bind_result($id, $title, $content, $created_at);
$posts = [];
while ($stmt->fetch()) {
  $posts[] = [
    'id' => $id,
    'title' => $title,
    'content' => $content,
    'created_at' => $created_at
  ];
}
$stmt->close();
$mysqli->close();
?>

<main>
<h2>Welcome to the Blog</h2>
<p>This is the homepage of the blog. You can read posts, leave comments, and more.</p>
<?php if (isset($_SESSION['user_id'])): ?>
    <p>You are logged in. <a href='logout.php'>Logout</a></p>
<?php else : ?>
    <p>You are not logged in. <a href='login.php'>Login</a> or <a href='register.php'>Register</a></p>
<?php endif; ?>
<?php foreach ($posts as $post): ?>
        <article>
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            <p><small>Published on <?= htmlspecialchars($post['created_at']) ?></small></p>
            <a href="post.php?id=<?= $post['id'] ?>">Read more</a>
        </article>
    <?php endforeach; ?>
</main>
