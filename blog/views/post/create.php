<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Create Post</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/post.css">
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.2.1/ckeditor5.css" crossorigin>
  <link rel="icon" href="/images/svg/logo.svg" type="image/x-icon">
</head>

<body>
  <?php require_once 'views/layouts/header.php'; ?>
  <main class="post-create-main">
    <form method="POST" action="/post/create" class="form form--create-post">
      <h2 class="form__title">Create New Post</h2>
      <?php if (!empty($error_message)): ?>
        <p class="form__error" style="color: red;"><?= htmlspecialchars($error_message) ?></p>
      <?php endif; ?>
      <div class="form__group">
        <label for="post-title" class="form__label">Title:</label>
        <input type="text" id="post-title" name="title" placeholder="Enter post title"
          class="form__input form__input--title" required>
      </div>
      <div class="form__group">
        <label for="post-description" class="form__label">Description:</label>
        <textarea id="post-description" name="description" placeholder="Enter post description"
          class="form__input form__input--description" required></textarea>
      </div>
      <div class="form_group">
        <label for="post-image" class="form__label">Attach Feature Image:</label>
        <input type="file" id="post-image" name="image" class="form__input form__input--image">
      </div>
      <div class="form__group">
        <label for="post-body" class="form__label">Body:</label>
        <div class="main-container">
          <div class="editor-container editor-container_classic-editor" id="editor-container">
            <div class="editor-container__editor">
              <div id="editor"></div>
            </div>
          </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/45.2.1/ckeditor5.umd.js" crossorigin></script>
        <script src="/js/main.js"></script>
      </div>
      <div class="form__group">
        <input type="submit" value="Create Post" class="form__submit form__submit--create">
      </div>
    </form>
  </main>
</body>
</html>
