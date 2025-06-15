<?php
require_once __DIR__ . '/env.php';
loadEnv(__DIR__ . '/../.env');

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');
$mysqli = new mysqli($host, $user, $pass, $name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
