<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="../frontend/js/app.js" defer></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold text-center mb-4">Login</h1>
        <form id="loginForm" action="../api/login.php" method="POST">
            <input type="text" name="usernameOrEmail" placeholder="Username or Email" required class="w-full p-2 border border-gray-300 rounded mb-4" />
            <input type="password" name="password" placeholder="Password" required class="w-full p-2 border border-gray-300 rounded mb-4" />
            <div id="error" class="text-red-500 mb-4"></div> 
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">Login</button>
        </form>
        <a href="register" class="text-green-500 hover:underline text-center block mt-4">Don't have an account? Register</a>
    </div>
</body>
</html>
