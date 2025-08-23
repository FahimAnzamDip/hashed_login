<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl p-10 text-center w-96">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9 text-orange-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            Welcome to the Hashed Login System
        </h1>
        <p class="text-gray-600 mb-6">Please choose an option:</p>

        <div class="flex justify-center space-x-6">
            <a href="register.php"
               class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">
                Register
            </a>
            <a href="login.php"
               class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow hover:bg-green-600 transition">
                Login
            </a>
        </div>
    </div>
</body>
</html>
