<?php
require '../config/Database.php';
require '../models/User.php';

session_start();

$db = (new Database())->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameOrEmail = $_POST['usernameOrEmail'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($usernameOrEmail, $password);
    
    if ($loggedInUser) {
        
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['user'] = $loggedInUser; 
        
        header('Location: ../views/users.php');
        exit();
    } else {
        echo "Invalid credentials"; 
    }
} else {
    echo "Invalid request method";
}
?>
