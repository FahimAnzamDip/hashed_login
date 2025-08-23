<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-bg {
            background-image: radial-gradient(at 100% 0, #d1d5db, #ffffff);
        }
    </style>
</head>
<body class="bg-gray-900 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-2xl maxspace-y-8 p-10 rounded-xl shadow-2xl card-bg transform transition duration-500 hover:scale-105">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Welcome back, <?php echo htmlspecialchars($user['username']); ?>!
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 mb-4">
                    Your information
                </p>
            </div>

            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Username</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($user['username']); ?></p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Email Address</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Mobile Number</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($user['mobile']); ?></p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Your Hashed Password</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900 "><?php echo $user['password']; ?></p>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="logout.php" class="group relative w-full flex justify-center py-3 px-6 border border-transparent text-lg font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 ease-in-out shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Logout
                </a>
            </div>
        </div>
    </div>
</body>
</html>
