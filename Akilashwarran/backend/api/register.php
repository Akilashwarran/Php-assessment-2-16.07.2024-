<?php
require '../config/Database.php';
require '../models/User.php';

$db = (new Database())->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $avatar = $_FILES['avatar']['name'];

    //form validation
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }
    if (empty($avatar)) {
        $errors[] = "Avatar is required";
    }

    if (empty($errors)) {
       
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], "../uploads/$avatar")) {
            if ($user->register($username, $email, $password, $avatar)) {
                header('Location: ../views/login.php');
            } else {
                echo json_encode(["message" => "User registration failed", "success" => false]);
            }
        } else {
            echo json_encode(["message" => "Failed to upload avatar", "success" => false]);
        }
    } else {
        echo json_encode(["message" => $errors, "success" => false]);
    }
}
?>
