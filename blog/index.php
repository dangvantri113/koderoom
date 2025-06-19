<?php
require_once 'includes/header.php';
require_once 'includes/Database.php';
require_once 'includes/Models/Post.php';
$posts = Post::all();
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
            <h3><?= htmlspecialchars($post->title) ?></h3>
            <p><?= nl2br(htmlspecialchars($post->body)) ?></p>
            <p><small>Published on <?= htmlspecialchars($post->created_at) ?></small></p>
            <a href="post.php?id=<?= $post->id ?>">Read more</a>
        </article>
    <?php endforeach; ?>
</main>
