<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $post->title ?></title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="icon" href="/images/svg/logo.svg" type="image/x-icon">
</head>
<body>
  <?php require_once 'views/layouts/header.php'; ?>
  <main class="post-main">
    <article class="post">
      <h1 class="post__title"><?= htmlspecialchars($post->title) ?></h1>
      <p class="post__body"><?= nl2br(htmlspecialchars($post->body)) ?></p>
      <p class="post__published"><small>Published on <?= htmlspecialchars($post->created_at) ?></small></p>
    </article>
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="post__actions">
        <a class="post__edit" href="/post/edit/<?= $post->id ?>">Edit</a>
        <form method="POST" action="/post/delete/<?= $post->id ?>" class="post__delete-form">
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="post__delete">Delete</button>
        </form>
      </div>
    <?php endif; ?>
    <section class="post__comments">
      <h2 class="post__comments-title">Comments</h2>
      <?php if (empty($comments)): ?>
        <p class="post__no-comments">No comments yet. Be the first to comment!</p>
      <?php else: ?>
        <ul class="post__comments-list">
          <?php foreach ($comments as $comment): ?>
            <li class="post__comment">
              <p class="post__comment-author"><?= htmlspecialchars($comment->author) ?> says:</p>
              <p class="post__comment-body"><?= nl2br(htmlspecialchars($comment->body)) ?></p>
              <p class="post__comment-date"><small>Posted on <?= htmlspecialchars($comment->created_at) ?></small></p>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST" action="/post/<?= $post->id ?>/comment" class="post__comment-form">
          <h3 class="post__comment-form-title">Leave a Comment</h3>
          <div class="post__comment-form-group">
            <label for="comment-author" class="post__comment-form-label">Your Name:</label>
            <input type="text" id="comment-author" name="author" placeholder="Enter your name"
                   class="post__comment-form-input" required> 
          </div>
          <div class="post__comment-form-group">
            <label for="comment-body" class="post__comment-form-label">Comment:</label>
            <textarea id="comment-body" name="body" placeholder="Write your comment here"
                      class="post__comment-form-textarea" required></textarea>
          </div>
          <div class="post__comment-form-group">
            <input type="submit" value="Post Comment" class="post__comment-form-submit">
          </div>
        </form>
      <?php else: ?>
        <p class="post__comment-login">You must be logged in to leave a comment. <a href="/login" class="post__comment-login-link">Login</a> or <a href="/register" class="post__comment-login-link">Register</a></p>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>
