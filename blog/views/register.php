<?php
$error = $error ?? null;
?>
<form method="POST" action="/register">
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br/>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br/>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br/>
    <input type="submit" value="Register">
</form>
