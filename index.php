<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to the User Portal</h1>
    <p>Please choose an option:</p>
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a>
</body>
</html>
