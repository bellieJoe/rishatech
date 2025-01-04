<?php

use PHPMailer\PHPMailer\PHPMailer;

include '../phpmailer/src/PHPMailer.php';
include '../phpmailer/src/SMTP.php';

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
            header("location: ".BASE_URL."/client/signin.php");
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
        header("location: ".BASE_URL."/client/signin.php");  
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ForgotPassword'])) {

    try {
        // Sanitize email input
        $email = sanitizeInput($_POST['email']);

        $customer = $db->getCustomerByEmail($email);
        
        
        if ($customer) {
            // Generate a unique token
            $token = bin2hex(random_bytes(50)); // Generate a secure token

            // Store the token in the password_resets table
            $reset_token = $db->setUserResetToken($customer['user_id'], $token);

            // Send reset password email
            $resetLink = "http://localhost/".BASE_URL . "/client/reset-password.php?user_id=" . $customer['user_id'] . "&token=" . $token;
            $message = "<html>
                        <head>
                            <title>Reset Your Account Password</title>
                        </head>
                        <body>
                            <p>Click the link below to reset your password:</p>
                            <br>
                            <a href='".$resetLink."' style='text-decoration: none; color: #0056b3; font-weight: bold;'>Reset Password</a>
                            <br><br>
                            <p>If you did not request a password reset, please disregard this email.</p>
                        </body>
                        </html>";

            $mail = new PHPMailer(true);
    
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hyperwebit0513@gmail.com'; /*---GMAIL That you made----*/
            $mail->Password = 'caefargpsmbmxbzg'; /*---App Password. Turn On Your 2authentication factor----*/
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
    
            $mail->setFrom('hyperwebit0513@gmail.com'); /*---GMAIL That you made----*/
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Account Password';
            $mail->Body = $message;

            if ($reset_token && $mail->send()) {

                $_SESSION['message'] = [
                    "status" => "success",
                    "message" => "Password Reset link successfully sent to your email. Please check your email for the link and follow the instructions to reset your password."
                ];

                $_SESSION['admin_email'] = $email;
                header("Location: " . BASE_URL . "/client/forgot-password.php");
                exit();
            
            } else {
                $_SESSION['message'] = [
                    "status" => "error",
                    "message" => "An unexpected error occurred while sending the password reset link. Try again."
                ];
                header("Location: " . BASE_URL . "/client/forgot-password.php");
                exit();
            }
        } else {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "No account found with that email address."
            ];
            header("Location: " . BASE_URL . "/client/index.php");
            exit();
        }
    } catch (\Throwable $th) {
        echo $th;
        exit();
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occurred while sending the password reset link. Try again."
        ];
        header("Location: " . BASE_URL . "/client/forgot-password.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resetPassword'])) {

    try {
        // Sanitize email input
        $password = sanitizeInput($_POST['password']);
        $token = sanitizeInput($_POST['token']);
        $user_id = sanitizeInput($_POST['user_id']);

        $user = $db->getUserById($user_id);

        if (!$user) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "No account found with that email address."
            ];
            header("Location: " . BASE_URL . "/client/index.php");
            exit();
        }

        if($user['reset_token'] != $token) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Invalid token. Try again."
            ];
            header("Location: " . BASE_URL . "/client/reset-password.php?user_id=" . $user_id . "&token=" . $token);
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if(!$db->updatePassword($user_id, $hashed_password)) {
            $_SESSION['message'] = [
                "status" => "success",
                "message" => "Password reset failed."
            ];
            header("Location: " . BASE_URL . "/client/reset-password.php?user_id=" . $user_id . "&token=" . $token);
            exit();
        }
        $_SESSION['message'] = [
            "status" => "success",
            "message" => "Password reset successfully. You can now log in with your new password."
        ];
        header("Location: " . BASE_URL . "/client/signin.php");
        exit();

    } catch (\Throwable $th) {
        echo $th;
        exit();
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occurred while sending the password reset link. Try again."
        ];
        header("Location: " . BASE_URL . "/client/reset-password.php?user_id=" . $user_id . "&token=" . $token);
        exit();
    }
}

?>