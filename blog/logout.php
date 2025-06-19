<?php
require_once __DIR__ . '/includes/Auth.php';

Auth::logout();
header('Location: login.php?success=You have been logged out successfully');
