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
            header("location: ".BASE_URL."/client/signin.php");
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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uploadImage'])) {

    try {

        $customer_id = $_SESSION['user']['customer_id'];

        if (isset($_FILES['image'])) {
            $image_file_name = uniqid() . '-' . $_FILES['image']['name'];
            $image_file_tmp = $_FILES['image']['tmp_name'];
            $image_upload_dir = "uploads/c_image/";
            $image_upload_path = $image_upload_dir . $image_file_name;
    
            move_uploaded_file($image_file_tmp, $image_upload_path);
            $image = $db->updateImage($customer_id, $image_upload_path);
            if (!$image) {
                $_SESSION['message'] = [
                    "status" => "error",
                    "message" => "No account found with that email address."
                ];
                header("Location: " . BASE_URL . "/client/profile.php");
                exit();
            }
        } else {
            $image_upload_path = ''; // Save empty if no file is uploaded
        }

        $_SESSION["user"]["image"] = $image_upload_path;

        $_SESSION['message'] = [
            "status" => "success",
            "message" => "Image uploaded successfully."
        ];
        header("Location: " . BASE_URL . "/client/profile.php");
        exit();

    } catch (\Throwable $th) {
        echo $th;
        exit();
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occurred while sending the password reset link. Try again."
        ];
        header("Location: " . BASE_URL . "/client/profile.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_profile'])) {

    try {

        $customer_id = $_SESSION['user']['customer_id'];

        $user_id = $_SESSION['user']['user_id'];

        $userWithSameEmail = $db->findUserByEmail(sanitizeInput($_POST['email']), $user_id);

        if ($userWithSameEmail) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Email already exists."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        $userWithSameUsername = $db->findUserByUsername(sanitizeInput($_POST['username']), $user_id);

        if ($userWithSameUsername) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Username already exists."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        if(!$db->updateUsername($user_id, sanitizeInput($_POST['username']))) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Unable to update Username."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        if(!$db->updateEmail($user_id, sanitizeInput($_POST['email']))) {

            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Unable to update Email."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        $_SESSION["user"]["username"] = sanitizeInput($_POST['username']);
        $_SESSION["user"]["email"] = sanitizeInput($_POST['email']);


        $_SESSION['message'] = [
            "status" => "success",
            "message" => "Profile updated successfully."
        ];
        header("Location: " . BASE_URL . "/client/profile.php");
        exit();

    } catch (\Throwable $th) {
        echo $th;
        exit();
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occurred while sending the password reset link. Try again."
        ];
        header("Location: " . BASE_URL . "/client/profile.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {

    try {

        $old_password = sanitizeInput($_POST['old_password']);
        $new_password = sanitizeInput($_POST['new_password']);
        $confirm_new_password = sanitizeInput($_POST['confirm_new_password']);

        if ($new_password !== $confirm_new_password) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Passwords do not match."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        $user = $db->getUserById($_SESSION['user']['user_id']);

        if(!$user){
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "No account found."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        if(!password_verify($old_password, $user['password'])) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Old password is incorrect."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }

        if(!$db->updatePassword(password_hash($new_password, PASSWORD_DEFAULT), $user['user_id'])) {
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "Unable to update Password."
            ];
            header("Location: " . BASE_URL . "/client/profile.php");
            exit();
        }


        $_SESSION['message'] = [
            "status" => "success",
            "message" => "Password updated successfully."
        ];
        header("Location: " . BASE_URL . "/client/profile.php");
        exit();

    } catch (\Throwable $th) {
        echo $th;
        exit();
        $_SESSION['message'] = [
            "status" => "error",
            "message" => "An unexpected error occurred while sending the password reset link. Try again."
        ];
        header("Location: " . BASE_URL . "/client/profile.php");
        exit();
    }
}

?>