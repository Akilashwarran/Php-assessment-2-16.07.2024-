<?php
require '../config/Database.php';
require '../models/User.php';

session_start();

$db = (new Database())->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $avatar = $_FILES['avatar']['name'] ?? null;

    if ($avatar) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], "../uploads/$avatar");
    }

    $updateResult = $user->updateUser($id, $username, $email, $avatar);

    if ($updateResult['success']) {
        header('Location: ../views/profile.php?id=' . $id);
        exit();
    } else {
        echo json_encode($updateResult);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
