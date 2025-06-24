<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="icon" href="images/svg/logo.svg" type="image/x-icon">
</head>

<body>
  <?php
  require_once 'views/header.php';
  require_once 'includes/Database.php';
  require_once 'includes/Models/Post.php';
  $posts = Post::all();
  ?>

  <main class="blog-main">
    <h2 class="blog-main__title">Welcome to the Blog</h2>
    <p class="blog-main__desc">This is the homepage of the blog. You can read posts, leave comments, and more.</p>
    <?php if (isset($_SESSION['user_id'])): ?>
      <p class="blog-main__status">You are logged in. <a class="blog-main__link" href='logout.php'>Logout</a></p>
    <?php else : ?>
      <p class="blog-main__status">You are not logged in. <a class="blog-main__link" href='login.php'>Login</a> or <a class="blog-main__link" href='register.php'>Register</a></p>
    <?php endif; ?>
    <div class="blog-main__post-list">
      <?php foreach ($posts as $post): ?>
        <article class="blog-post">
          <h3 class="blog-post__title"><?= htmlspecialchars($post->title) ?></h3>
          <p class="blog-post__body"><?= nl2br(htmlspecialchars($post->body)) ?></p>
          <p class="blog-post__published"><small>Published on <?= htmlspecialchars($post->created_at) ?></small></p>
          <a class="blog-post__read-more" href="post.php?id=<?= $post->id ?>">Read more</a>
        </article>
      <?php endforeach; ?>
    </div>
  </main>
</body>
