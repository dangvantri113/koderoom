<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Include the database connection
require_once 'includes/db.php';
// if check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to the homepage if already logged in
    exit;
}
// if GET show the login form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check to show message from registration
    if (isset($_GET['success'])) {
        $success_message = htmlspecialchars($_GET['success']);
        echo "<p style='color: green;'>$success_message</p>";
    }

    // Check if there is an error message in the URL
    if (isset($_GET['error'])) {
        $error = htmlspecialchars($_GET['error']);
        echo "<p style='color: red;'>$error</p>";
    }
    // Display the login form
    echo '<form method="POST" action="login.php">';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" required>';
    echo '<br/>';
    echo '<label for="password">Password:</label>';
    echo '<input type="password" id="password" name="password" required>';
    echo '<br/>';
    echo '<input type="submit" value="Login">';
    echo '</form>';
    exit;
}
// If POST, process the login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the input
    if (empty($email) || empty($password)) {
        // redirect back to the login form with an error message
        header('Location: login.php?error=Please fill in all fields');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // redirect back to the login form with an error message
        header('Location: login.php?error=Invalid email format');
        exit;
    }

    // Sanitize the input
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    // Check if the user exists in the database
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
    if (!$user) {
        // redirect back to the login form with an error message
        header('Location: login.php?error=Invalid email or password');
        exit;
    }
    // Check if the password is correct
    if (!password_verify($password, $user['password'])) {
        // redirect back to the login form with an error message
        header('Location: login.php?error=Invalid email or password');
        exit;
    }
    // Set the session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $email;
    // Redirect to the homepage
    header('Location: index.php');
    exit;
}
