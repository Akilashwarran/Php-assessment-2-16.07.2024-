<?php
require '../config/Database.php';
require '../models/User.php';

session_start();
$db = (new Database())->getConnection();
$user = new User($db);

$userId = $_GET['id'] ?? null;
$currentUserId = $_SESSION['user_id'];

$userData = $user->getUserById($userId);

if (!$userData) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="container bg-white p-6 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold text-center mb-4">User Profile</h1>
        
        <div id="profileDetails" class="mb-4">
            <img src="../uploads/<?php echo $userData['avatar']; ?>" alt="Avatar" class="w-36 h-36 rounded-full mx-auto mb-4">
            <div class="mb-4">
                <strong>Username:</strong> <?php echo $userData['username']; ?><br>
                <strong>Email:</strong> <?php echo $userData['email']; ?><br>
            </div>
            <button id="updateButton" <?php echo $userData['id'] == $currentUserId ? '' : 'disabled'; ?> class="w-full bg-red-500 text-white p-2 rounded hover:bg-red-600" onclick="showUpdateForm()">
                Update
            </button>
        </div>

        <div id="updateForm" class="hidden mt-4">
            <form method="POST" action="../api/updateUser.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                <div class="mb-4">
                    <label for="username" class="block">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="email" class="block">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="avatar" class="block">Avatar:</label>
                    <input type="file" id="avatar" name="avatar" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <button type="submit" class="w-full bg-red-500 text-white p-2 rounded hover:bg-red-600">Update</button>
            </form>
        </div>

        <div id="message" class="error text-red-500 mt-4"></div>
    </div>

    <script>
        function showUpdateForm() {
            document.getElementById('profileDetails').classList.add('hidden');
            document.getElementById('updateForm').classList.remove('hidden');
        }
    </script>
</body>
</html>
