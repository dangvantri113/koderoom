<body>
    <h2>Login</h2>

    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?= $success_message ?></p>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br/>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br/>

        <input type="submit" value="Login">
    </form>
</body>
</html>
