<?php
session_start();
require_once 'includes/db.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Handle GET: Show login form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $success_message = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
    $error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
    include 'views/login.php';
    exit;
}

// Handle POST: Process login
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Basic validation
if (empty($email) || empty($password)) {
    header('Location: login.php?error=Please fill in all fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: login.php?error=Invalid email format');
    exit;
}

// Sanitize
$email = htmlspecialchars($email);

// Query user
$stmt = $mysqli->prepare("SELECT id, password FROM users WHERE email = ?");
if (!$stmt) {
    header('Location: login.php?error=Database error');
    exit;
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user || !password_verify($password, $user['password'])) {
    header('Location: login.php?error=Invalid email or password');
    exit;
}

// Success
$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $email;
header('Location: index.php');
exit;
