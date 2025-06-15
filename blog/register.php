<?php

session_start();
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to the homepage if already logged in
    exit;
}

require_once 'includes/db.php'; // Include database connection

// if GET show the registration form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if there is an error message in the URL
    if (isset($_GET['error'])) {
        $error = htmlspecialchars($_GET['error']);
        echo "<p style='color: red;'>$error</p>";
    }
    // Display the registration form
    echo '<form method="POST" action="register.php">';
    echo '<label for="name">Name:</label>';
    echo '<input type="text" id="name" name="name" required>';
    echo '<br/>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" required>';
    echo '<br/>';
    echo '<label for="password">Password:</label>';
    echo '<input type="password" id="password" name="password" required>';
    echo '<br/>';
    echo '<input type="submit" value="Register">';
    echo '</form>';
    exit;
}

// If POST, process the registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the input
    if (empty($name) || empty($email) || empty($password)) {
        // redirect back to the registration form with an error message
        header('Location: register.php?error=Please fill in all fields');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // redirect back to the registration form with an error message
        header('Location: register.php?error=Invalid email format');
        exit;
    }
    if (strlen($password) < 6) {
        // redirect back to the registration form with an error message
        header('Location: register.php?error=Password must be at least 6 characters long');
        exit;
    }
    // Sanitize the input
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    // Here you would typically hash the password and save the user to a database
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    // Here you would typically save the user to a database
    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        // redirect back to the registration form with an error message
        header('Location: register.php?error=Database error: ' . $mysqli->error);
        exit;
    }
    $stmt->bind_param("sss", $name, $email, $passwordHash);
    if (!$stmt->execute()) {
        // redirect back to the registration form with an error message
        header('Location: register.php?error=Database error: ' . $stmt->error);
        exit;
    }
    $stmt->close();
    // Close the database connection
    $mysqli->close();
    // Redirect to the login page with a success message
    header('Location: login.php?success=Registration successful! Please log in.');
    exit;
}
