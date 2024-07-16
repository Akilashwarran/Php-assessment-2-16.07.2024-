<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="container bg-white p-6 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold text-center mb-4">Register</h1>
        <form action="../api/register.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="username" class="block">Username:</label>
                <input type="text" id="username" name="username" required class="w-full p-2 border border-gray-300 rounded">
                <div id="usernameError" class="error text-red-500"></div>
            </div>
            <div class="mb-4">
                <label for="email" class="block">Email:</label>
                <input type="email" id="email" name="email" required class="w-full p-2 border border-gray-300 rounded">
                <div id="emailError" class="error text-red-500"></div>
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password:</label>
                <input type="password" id="password" name="password" required class="w-full p-2 border border-gray-300 rounded">
                <div id="passwordError" class="error text-red-500"></div>
            </div>
            <div class="mb-4">
                <label for="avatar" class="block">Avatar:</label>
                <input type="file" id="avatar" name="avatar" required class="w-full p-2 border border-gray-300 rounded">
                <div id="avatarError" class="error text-red-500"></div>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">Register</button>
            <a href="login" class="text-green-500 hover:underline text-center block mt-4">Already have an account? Login</a>
        </form>
        <div id="message" class="error text-red-500 mt-4 text-center">
            <?php
            if (isset($_GET['error'])) {
                echo htmlspecialchars($_GET['error']);
            }
            ?>
        </div>
    </div>
</body>
</html>
