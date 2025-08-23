<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];

    // Use password_hash() for secure password hashing
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, mobile, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $mobile, $password);

    if ($stmt->execute()) {
        echo "<div class='flex items-center justify-center min-h-screen bg-gray-100'><div class='bg-white p-6 rounded-lg shadow-lg text-center'><h2 class='text-2xl font-bold text-green-600 mb-2'>Registration Successful!</h2><p class='text-gray-600'>You can now log in to your account.</p><a href='login.php' class='mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors'>Go to Login</a></div></div>";
    } else {
        echo "<div class='flex items-center justify-center min-h-screen bg-gray-100'><div class='bg-white p-6 rounded-lg shadow-lg text-center'><h2 class='text-2xl font-bold text-red-600 mb-2'>Error!</h2><p class='text-gray-600'>Error: " . $stmt->error . "</p><a href='#' onclick='history.back()' class='mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors'>Go Back</a></div></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-sm">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Register</h2>
            <form method="post" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                    <input type="text" id="mobile" name="mobile" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
