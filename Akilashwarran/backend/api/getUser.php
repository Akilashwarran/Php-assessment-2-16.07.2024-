<?php
require '../config/Database.php';
require '../models/User.php';

$db = (new Database())->getConnection();
$user = new User($db);

session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["message" => "Not authenticated", "success" => false]);
    exit();
}

$userId = $_SESSION['user_id'];
$userData = $user->getUserById($userId);

if ($userData) {
    echo json_encode(["data" => $userData, "success" => true]);
} else {
    echo json_encode(["message" => "User not found", "success" => false]);
}
?>
