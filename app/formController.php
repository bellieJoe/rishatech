<?php

session_start();

require_once '../app/config/constants.php';
include '../db_connection/config.php';
$db = new Database();


function sanitizeInput($input) {
    
    return htmlspecialchars(strip_tags($input));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ClientLogin'])) {
    try {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        $user = $db->getClientUserByUsername($username);

        if(!$user) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "ERROR! Failed to login. Try again."
            ];
            header("location: ".BASE_URL."/client/index.php");
            exit();
        }

        if(!password_verify($password, $user['password'])) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "ERROR! Failed to login. Try again."
            ];
            header("location: ".BASE_URL."/client/index.php");
            exit();
        }

        $_SESSION['user'] = $user;

        
        $_SESSION['message'] = [
            "status" => "success",
            "message" => "Customer logged in successfully."
        ];
        header("location: ".BASE_URL."/client/dashboard.php");

        exit();

    } catch (\Throwable $th) {
        echo $th;
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occured . Try again."
        ];
        header("location: ".BASE_URL."/client/index.php");  
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ClientLogout'])) {
    try {
        unset($_SESSION['user']);
        
        $_SESSION['message'] = [
            "status" => "success",
            "message" => "Customer logged out successfully."
        ];
        header("location: ".BASE_URL."/client/index.php");

        exit();

    } catch (\Throwable $th) {
        echo $th;
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occured while registering a customer. Try again."
        ];
        header("location: ".BASE_URL."/client/index.php");  
        exit();
    }
}

?>