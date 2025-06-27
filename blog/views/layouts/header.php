<header class="main-header">
    <?php if (Session::exists('user_id')): ?>
        <h1 class="main-header__title">Koderoom - Space for coders</h1>
        <nav class="main-header__nav">
            <ul class="main-header__nav-list">
                <li><a href="/">Home</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    <?php else: ?>
        <h1 class="main-header__title">Koderoom - Space for coders</h1>
        <nav class="main-header__nav">
            <ul class="main-header__nav-list">
                <li><a href="/">Home</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</header>
