<?php
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../includes/Session.php';
require_once __DIR__ . '/../includes/Models/User.php';

$session = new Session();
$session->start();
$mysqli = Database::getInstance()->getConnection();
$user = null;
if ($session->exists('user_id')) {
    $user_id = $session->get('user_id');
    $user = User::findById($user_id);
}
?>
<header class="main-header">
    <?php if ($user): ?>
        <h1 class="main-header__title">Koderoom - Space for coders</h1>
        <nav class="main-header__nav">
            <ul class="main-header__nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    <?php else: ?>
        <h1 class="main-header__title">Koderoom - Space for coders</h1>
        <nav class="main-header__nav">
            <ul class="main-header__nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</header>
