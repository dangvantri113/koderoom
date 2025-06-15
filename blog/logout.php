<?php

session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit;
}
// Unset all of the session variables
$_SESSION = array();
// Destroy the session
session_destroy();
// Redirect to the homepage with a success message
header('Location: index.php?success=You have been logged out successfully.');
exit;
