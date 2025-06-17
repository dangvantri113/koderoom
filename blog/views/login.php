<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php if (!empty($success_message)): ?>
    <p style="color: green;"><?= $success_message ?></p>
  <?php endif; ?>

  <?php if (!empty($error_message)): ?>
    <p style="color: red;"><?= $error_message ?></p>
  <?php endif; ?>
  <form method="POST" action="login.php" class="form form--login">
    <h2 class="form__title">Login</h2>
    <div class="form__group">
      <label for="email" class="form__label">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email"
        class="form__input form__input--email">
    </div>

    <div class="form__group">
      <label for="password" class="form__label">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password"
        class="form__input form__input--password">
    </div>
    <div class="form__group">
      <input type="submit" value="Login" class="form__submit">
    </div>
  </form>
</body>
</html>
