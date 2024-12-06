<?php

require_once '../app/config/constants.php';
include '../db_connection/config.php';
$db = new Database();
 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../phpmailer/src/PHPMailer.php';
include '../phpmailer/src/SMTP.php';



// Remove tags and encode special characters
function sanitizeInput($input) {
    
    return htmlspecialchars(strip_tags($input));
}

// Validate CSRF token
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {



    //-----------------------------------------------------------------------------------------------------ADMIN LOGIN
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_login'])) {
    
        $username = sanitizeInput($_POST['username']);
        $password = $_POST['password'];

        $selectAdminLogin = $db->adminLogin($username);

        if ($selectAdminLogin) {

            $hashedPasswordFromDB = $selectAdminLogin['password'];
            $email = $selectAdminLogin['email'];

            if ($selectAdminLogin['verify_status'] == 'Not Verified') {

                $verification_code = rand(10000, 99999);

                $selectAdmin_email = $db->selectAdmin_email($email);

                if ($selectAdmin_email) {

                    $updateAdminOTP_code = $db->updateAdminOTP_code($email, $verification_code);

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
                    $mail->Subject = 'Verify Your ADMIN Account';
                    $mail->Body = 'COPY THIS CODE TO VERIFY YOUR ACCOUNT. <h1> '.$verification_code.' </h1>';
                    // $mail->send();

                    if ($updateAdminOTP_code && $mail->send()) {

                        $_SESSION['status'] = "OTP sent to your email";
                        $_SESSION['status-code'] = "success";

                        $_SESSION['admin_email'] = $email;
                        header("location: index.php?route=verifyotpadmin");
                        exit();
                    
                    } else {
                        $_SESSION['status'] = "Failed to send the OTP code. Try again.";
                        $_SESSION['status-code'] = "error";
                        header("location: index.php?route=home");
                        exit();
                    }


                
                } else {

                    $_SESSION['status'] = "Email is not existing in the database";
                    $_SESSION['status-code'] = "error";
                    header("location: index.php?route=forgotpword");
                    exit();

                }
            
            } else if ($selectAdminLogin['verify_status'] == 'Verified') {

                // Compare the provided password with the hashed password from the database
                if (password_verify($password, $hashedPasswordFromDB)) {

                    $_SESSION['auth'] = true;
                    $_SESSION['auth_user'] = [
                        'admin_id' => $selectAdminLogin['id'],
                        'full_name' => $selectAdminLogin['full_name'],
                        'username' => $selectAdminLogin['username'],
                        'email' => $selectAdminLogin['email'],
                    ];

                    $_SESSION['status'] = "Log In Success";
                    $_SESSION['status-code'] = "success";
                    header("location: route.php?route=dashboard");
                    exit();
                } else {
                    $_SESSION['status'] = "Incorrect Password. Try Again!";
                    $_SESSION['status-code'] = "error";
                    header("location: ./index.php?route=home");
                    exit();
                }

            }

        } else {
            $_SESSION['status'] = "Incorrect Log In Details";
            $_SESSION['status-code'] = "error";
            header("location: ./index.php?route=home");
            exit();
        }

    }




    //-------------------------------------------------------------------------------------------------------REGISTER ADMIN ACCOUNT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_admin'])) {

    $username = sanitizeInput($_POST['username']);
    $full_name = sanitizeInput($_POST['full_name']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $status = 'Not Verified';

    $selectAdmin_email_username = $db->selectAdmin_email_username($username, $email);

    if ($selectAdmin_email_username) {

        $_SESSION['status'] = "Username or Email already exist. Try another input";
        $_SESSION['status-code'] = "error";
        header("location: route.php?route=settings");
        exit();
    
    } else {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $insertAdminAccount = $db->insertAdminAccount($username, $full_name, $email, $hashed_password, $status);
        
        
                if ($insertAdminAccount) {
        
                    $_SESSION['status'] = "Admin Account Registered. Verify account by logging in";
                    $_SESSION['status-code'] = "success";
                    header("location: route.php?route=settings");
                    exit();
                
                } else {
                    $_SESSION['status'] = "Failed to Register Account. Try again.";
                    $_SESSION['status-code'] = "error";
                    header("location: route.php?route=settings");
                    exit();
                }
                
        
        
            } else {
                $_SESSION['status'] = "Email is not Valid. Try another Email.";
                $_SESSION['status-code'] = "error";
                header("location: route.php?route=settings");
                exit();
            }

        }


}



//------------------------------------------------------------------------------------------------VERIFY ADMIN OTP CODE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_otpCode_Admin'])) {

    $email = sanitizeInput($_SESSION['admin_email']);
    $otp_code = sanitizeInput($_POST['otp_code']);

    $selectAdminOTP_Code = $db->selectAdminOTP_Code($email, $otp_code);

    if ($selectAdminOTP_Code) {

        $status = 'Verified';

        $updateAdminVerifyStatus = $db->updateAdminVerifyStatus($email, $status);

        if ($updateAdminVerifyStatus) {

            $_SESSION['status'] = "Admin Account Verified.";
            $_SESSION['status-code'] = "success";
            header("location: index.php?route=home");
            exit();
        
        } else {
            $_SESSION['status'] = "ERROR! Failed to verify admin account. Try again.";
            $_SESSION['status-code'] = "error";
            header("location: index.php?route=home");
            exit();
        }
    
    } else {

        $_SESSION['status'] = "Wrong OTP Code";
        $_SESSION['status-code'] = "error";
        $_SESSION['admin_email'] = $email;
        header("location: index.php?route=verifyotpadmin");
        exit();

    }


}





    //------------------------------------------------------------------------------------------SEND OTP CODE TO EMAIL

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])) {

        $email = sanitizeInput($_POST['email']);

        if ($email == 'admin123@gmail.com') {

            $_SESSION['status'] = "You cannot change password default account";
            $_SESSION['status-code'] = "info";
            header("location: index.php?route=forgotpword");
            exit();
        
        } else {

            $verification_code = rand(10000, 99999);

            $selectAdmin_email = $db->selectAdmin_email($email);

            if ($selectAdmin_email) {

                $updateAdminOTP_code = $db->updateAdminOTP_code($email, $verification_code);

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
                $mail->Body = 'COPY THIS CODE TO RESET YOUR PASSWORD. <h1> '.$verification_code.' </h1>';
                // $mail->send();

                if ($updateAdminOTP_code && $mail->send()) {

                    $_SESSION['status'] = "OTP sent to your email";
                    $_SESSION['status-code'] = "success";

                    $_SESSION['admin_email'] = $email;
                    header("location: index.php?route=verifyotpcode");
                    exit();
                
                } else {
                    $_SESSION['status'] = "Failed to send the OTP code. Try again.";
                    $_SESSION['status-code'] = "error";
                    header("location: index.php?route=forgotpword");
                    exit();
                }


            
            } else {

                $_SESSION['status'] = "Email is not existing in the database";
                $_SESSION['status-code'] = "error";
                header("location: index.php?route=forgotpword");
                exit();

            }

            

        }

        
    
    }


//------------------------------------------------------------------------------------------------VERIFY ADMIN OTP CODE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_otpCode'])) {

    $email = sanitizeInput($_SESSION['admin_email']);
    $otp_code = sanitizeInput($_POST['otp_code']);

    $selectAdminOTP_Code = $db->selectAdminOTP_Code($email, $otp_code);

    if ($selectAdminOTP_Code) {

        $_SESSION['status'] = "OTP Verified. You may now change your password.";
        $_SESSION['status-code'] = "success";
        $_SESSION['admin_email'] = $email;
        header("location: index.php?route=enterpword");
        exit();
    
    } else {

        $_SESSION['status'] = "Wrong OTP Code";
        $_SESSION['status-code'] = "error";
        $_SESSION['admin_email'] = $email;
        header("location: index.php?route=verifyotpcode");
        exit();

    }


}

//------------------------------------------------------------------------------------------------UPDATE ADMIN PASSWORD
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {

    $email = sanitizeInput($_SESSION['admin_email']);
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];

    if ($new_password == $repeat_new_password) {

        $selectAdmin_email = $db->selectAdmin_email($email);

        if ($selectAdmin_email) {

            // Hash the password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $updateAdminPassword = $db->updateAdminPassword($hashed_password, $email);

            if ($updateAdminPassword) {

                $_SESSION['status'] = "Password Updated";
                $_SESSION['status-code'] = "success";
                $_SESSION['admin_email'] = $email;
                header("location: index.php?route=home");
                exit();
            
            } else {

                $_SESSION['status'] = "Failed to update password. Try Again!";
                $_SESSION['status-code'] = "error";
                $_SESSION['admin_email'] = $email;
                header("location: index.php?route=home");
                exit();
            }

        } else {

            $_SESSION['status'] = "Email is not existing in the database";
            $_SESSION['status-code'] = "error";
            header("location: index.php?route=forgotpword");
            exit();

        }
    
    } else {

        $_SESSION['status'] = "New Password & Repeat Password not match";
        $_SESSION['status-code'] = "error";
        $_SESSION['admin_email'] = $email;
        header("location: index.php?route=enterpword");
        exit();

    }


}

//------------------------------------------------------------------------------------------------UPDATE ADMIN PASSWORD
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateAdminPassword'])) {
    $email = sanitizeInput($_SESSION['auth_user']['email']);
    $currentPassword = $_POST['currentPassword'];  // Assuming you're capturing the current password
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Fetch the admin's data from the database
    $selectAdmin_email = $db->selectAdmin_email($email);

    if ($selectAdmin_email) {
        // Verify if the current password matches the hashed password in the database
        if (password_verify($currentPassword, $selectAdmin_email['password'])) {

            // Check if the new password matches the confirm password
            if ($newPassword == $confirmPassword) {
                
                // Hash the new password
                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updateAdminPassword = $db->updateAdminPassword($hashed_password, $email);

                if ($updateAdminPassword) {
                    $_SESSION['status'] = "Password Updated";
                    $_SESSION['status-code'] = "success";
                    header("location: route.php?route=settings");
                    exit();
                } else {
                    $_SESSION['status'] = "Failed to update password. Try Again!";
                    $_SESSION['status-code'] = "error";
                    header("location: route.php?route=settings");
                    exit();
                }

            } else {
                // New password and confirm password do not match
                $_SESSION['status'] = "New Password & Repeat Password do not match";
                $_SESSION['status-code'] = "error";
                header("location: route.php?route=settings");
                exit();
            }
        } else {
            // Current password does not match
            $_SESSION['status'] = "Current Password is incorrect";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=settings");
            exit();
        }
    } else {
        // Email not found in the database
        $_SESSION['status'] = "Email does not exist in the database";
        $_SESSION['status-code'] = "error";
        header("location: route.php?route=settings");
        exit();
    }
}






//-----------------------------------------------------------------------------------UPDATE ADMIN INFORMATION
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateAdminInfo'])) {
    
    $username = sanitizeInput($_POST['username']);
    $full_name = sanitizeInput($_POST['full_name']);
    $admin_id = sanitizeInput($_POST['admin_id']);

    $updateAdmin = $db->updateAdmin($username, $full_name, $admin_id);

    if($updateAdmin){
        $_SESSION['status'] = "Admin Information Updated";
        $_SESSION['status-code'] = "success";
        header("location: route.php?route=settings");
        exit();
    } else {
        $_SESSION['status'] = "Failed to update admin information. Try again";
        $_SESSION['status-code'] = "error";
        header("location: route.php?route=settings");
        exit();
    }


}





//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------




    





//-------------------------------------------------------------------------------------------------------------------------------------------------------------


    //-----------------------------------------------------------------------------------------------------ADD Category
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AddCategory'])) {

        $category_name = sanitizeInput($_POST['category_name']);
        $admin_id = sanitizeInput($_POST['admin_id']);

        $insertCategory = $db->insertCategory($admin_id, $category_name);

        if ($insertCategory) {

            $_SESSION['status'] = "Category Added";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to add subject. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();
        }
    
    }

    //-----------------------------------------------------------------------------------------------------UPDATE CATEGORY
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Update_Category'])) {

        $category_id = sanitizeInput($_POST['category_id']);
        $Category_name = sanitizeInput($_POST['Category_name']);
        $subject_code = sanitizeInput($_POST['subject_code']);

        $updateCategory = $db->updateCategory($Category_name, $category_id);

        if ($updateCategory) {

            $_SESSION['status'] = "Category Updated";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to update Category. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();
        }
    
    }

    //---------------------------------------------------------------------------------------------------------DELETE SUBJECT
    if (isset($_POST['DeleteCategory'])) {

        $category_id = sanitizeInput($_POST['category_id']);

        $deleteCategory = $db->deleteCategory($category_id);

        if ($deleteCategory) {

            $_SESSION['status'] = "Category Deleted";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to delete appliances. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();

        }
    
    }



//-----------------------------------------------------------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------------ADD Appliances
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add_Appliances'])) {

        $admin_id = sanitizeInput($_POST['admin_id']);
        $appliance_name = sanitizeInput($_POST['appliance_name']);
        $category = sanitizeInput($_POST['category']);
        $brand = sanitizeInput($_POST['brand']);
        $price = sanitizeInput($_POST['price']);
        $quantity = sanitizeInput($_POST['quantity']);
        $status = 'Available';
        $unit_measurement = sanitizeInput($_POST['unit_measurement']);
        // echo $brand." ".$category;
        // exit();
        $insertAppliances = $db->insertAppliances($admin_id, $appliance_name, $category, $brand, $price, $quantity, $unit_measurement, $status);

        if ($insertAppliances) {

            $_SESSION['status'] = "Appliances Inserted";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to add room. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();

        }
    
    }

    //--------------------------------------------------------------------------------------------------------------UPDATE APPLIANCES
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Update_Appliances'])) {

        $appliances_id = sanitizeInput($_POST['appliances_id']);
        $appliance_name = sanitizeInput($_POST['appliance_name']);
        $category = sanitizeInput($_POST['category']);
        $brand = sanitizeInput($_POST['brand']);
        $price = sanitizeInput($_POST['price']);
        $quantity = sanitizeInput($_POST['quantity']);
        $status = sanitizeInput($_POST['status']);
        $unit_measurement = sanitizeInput($_POST['unit_measurement']);

        $updateAppliances = $db->updateAppliances($appliances_id, $appliance_name, $category,$brand, $price, $quantity, $unit_measurement, $status);

        if ($updateAppliances) {

            $_SESSION['status'] = "Appliances Updated";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to update appliances. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();

        }
    
    }

    //---------------------------------------------------------------------------------------------------------DELETE APPLIANCES
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DeleteAppliances'])) {

        $appliances_id = sanitizeInput($_POST['appliances_id']);

        $deleteRoom = $db->deleteAppliances($appliances_id);

        if ($deleteRoom) {

            $_SESSION['status'] = "Appliances Deleted";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to delete Appliances. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();

        }
    
    }





    
//-----------------------------------------------------------------------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------------------------ADD CUSTOMERS
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AddCustomer'])) {
        
        $admin_id = sanitizeInput($_POST['admin_id']);
        $full_name = sanitizeInput($_POST['full_name']);
        $complete_address = sanitizeInput($_POST['complete_address']);
        $municipality = sanitizeInput($_POST['municipality']);
        $barangay = sanitizeInput($_POST['barangay']);
        $street_name = sanitizeInput($_POST['street_name']);
        $email_address = sanitizeInput($_POST['email_address']);
        $phoneNumber = sanitizeInput($_POST['phoneNumber']);
        $age = sanitizeInput($_POST['age']);
        $civil_status = sanitizeInput($_POST['civil_status']);
        $Citizenship = sanitizeInput($_POST['Citizenship']);
        

        $insertCustomer = $db->insertCustomer($admin_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship);

        if ($insertCustomer) {

            $_SESSION['status'] = "Customer Inserted";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=customers");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to add customer. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=customers");
            exit();

        }
    
    }


    //--------------------------------------------------------------------------------------------------------------UPDATE CUSTOMERS

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UpdateCustomer'])) {

        $customer_id = sanitizeInput($_POST['customer_id']);
        $full_name = sanitizeInput($_POST['full_name']);
        $complete_address = sanitizeInput($_POST['complete_address']);
        $municipality = sanitizeInput($_POST['municipality']);
        $barangay = sanitizeInput($_POST['barangay']);
        $street_name = sanitizeInput($_POST['street_name']);
        $email_address = sanitizeInput($_POST['email_address']);
        $phoneNumber = sanitizeInput($_POST['phoneNumber']);
        $age = sanitizeInput($_POST['age']);
        $civil_status = sanitizeInput($_POST['civil_status']);
        $Citizenship = sanitizeInput($_POST['Citizenship']);

        $updateCustomer = $db->updateCustomer($customer_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship);

        if ($updateCustomer) {

            $_SESSION['status'] = "Customer Updated";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=customers");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to update customer. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=customers");
            exit();

        }
    
    }

    //---------------------------------------------------------------------------------------------------------DELETE CUSTOMERS
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DeleteCustomer'])) {

        $customer_id = sanitizeInput($_POST['customer_id']);

        $deleteCustomer = $db->deleteCustomer($customer_id);

        $deleteRequirements = $db->deleteRequirements($customer_id);

        $deleteSales = $db->deleteSales($customer_id);

        $deletecUSTOMERcREDITpayment = $db->deletecUSTOMERcREDITpayment($customer_id);

        if ($deleteCustomer && $deleteRequirements && $deleteSales && $deletecUSTOMERcREDITpayment) {

            $_SESSION['status'] = "Customer Deleted";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=customers");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to delete Customer. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=customers");
            exit();

        }
    
    }

    //-------------------------------------------------------------------------------------------------------UPLOAD FILES
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Upload_Files'])) {

        $customer_id = sanitizeInput($_POST['customer_id']);

        $admin_id = sanitizeInput($_POST['admin_id']);


        $selectRequirements = $db->selectRequirements($customer_id);

        if ($selectAllRequirements) {

            $_SESSION['status'] = "Requirements ALready Uploaded";
            $_SESSION['status-code'] = "info";
            header("location: route.php?route=customers");
            exit();
        
        } else {
    
                // Check if a file is uploaded for form_137
                if (isset($_FILES['valid_id']) && $_FILES['valid_id']['error'] === UPLOAD_ERR_OK) {
                    $valid_id_file_name = uniqid() . '-' . $_FILES['valid_id']['name'];
                    $valid_id_file_tmp = $_FILES['valid_id']['tmp_name'];
                    $valid_id_upload_dir = "uploads/";
                    $valid_id_upload_path = $valid_id_upload_dir . $valid_id_file_name;
            
                    move_uploaded_file($valid_id_file_tmp, $valid_id_upload_path);
                } else {
                    $valid_id_upload_path = ''; // Save empty if no file is uploaded
                }
            
                
                if (isset($_FILES['twoby2_pic']) && $_FILES['twoby2_pic']['error'] === UPLOAD_ERR_OK) {
                    $twoby2_pic_file_name = uniqid() . '-' . $_FILES['twoby2_pic']['name'];
                    $twoby2_pic_file_tmp = $_FILES['twoby2_pic']['tmp_name'];
                    $twoby2_pic_upload_dir = "uploads/";
                    $twoby2_pic_upload_path = $twoby2_pic_upload_dir . $twoby2_pic_file_name;
            
                    move_uploaded_file($twoby2_pic_file_tmp, $twoby2_pic_upload_path);
                } else {
                    $twoby2_pic_upload_path = ''; // Save empty if no file is uploaded
                }
            
            
                if (isset($_FILES['brgy_clearance']) && $_FILES['brgy_clearance']['error'] === UPLOAD_ERR_OK) {
                    $brgy_clearance_file_name = uniqid() . '-' . $_FILES['brgy_clearance']['name'];
                    $brgy_clearance_file_tmp = $_FILES['brgy_clearance']['tmp_name'];
                    $brgy_clearance_upload_dir = "uploads/";
                    $brgy_clearance_upload_path = $brgy_clearance_upload_dir . $brgy_clearance_file_name;
            
                    move_uploaded_file($brgy_clearance_file_tmp, $brgy_clearance_upload_path);
                } else {
                    $brgy_clearance_upload_path = ''; // Save empty if no file is uploaded
                }

                if (isset($_FILES['cedula']) && $_FILES['cedula']['error'] === UPLOAD_ERR_OK) {
                    $cedula_file_name = uniqid() . '-' . $_FILES['cedula']['name'];
                    $cedula_file_tmp = $_FILES['cedula']['tmp_name'];
                    $cedula_upload_dir = "uploads/";
                    $cedula_upload_path = $cedula_upload_dir . $cedula_file_name;
            
                    move_uploaded_file($cedula_file_tmp, $cedula_upload_path);
                } else {
                    $cedula_upload_path = ''; // Save empty if no file is uploaded
                }

                if (isset($_FILES['proof_of_billing']) && $_FILES['proof_of_billing']['error'] === UPLOAD_ERR_OK) {
                    $proof_of_billing_file_name = uniqid() . '-' . $_FILES['proof_of_billing']['name'];
                    $proof_of_billing_file_tmp = $_FILES['proof_of_billing']['tmp_name'];
                    $proof_of_billing_upload_dir = "uploads/";
                    $proof_of_billing_upload_path = $proof_of_billing_upload_dir . $proof_of_billing_file_name;
            
                    move_uploaded_file($proof_of_billing_file_tmp, $proof_of_billing_upload_path);
                } else {
                    $proof_of_billing_upload_path = ''; // Save empty if no file is uploaded
                }

                if (isset($_FILES['application_for_credit']) && $_FILES['application_for_credit']['error'] === UPLOAD_ERR_OK) {
                    $application_for_credit_file_name = uniqid() . '-' . $_FILES['application_for_credit']['name'];
                    $application_for_credit_file_tmp = $_FILES['application_for_credit']['tmp_name'];
                    $application_for_credit_upload_dir = "uploads/";
                    $application_for_credit_upload_path = $application_for_credit_upload_dir . $application_for_credit_file_name;
            
                    move_uploaded_file($application_for_credit_file_tmp, $application_for_credit_upload_path);
                } else {
                    $application_for_credit_upload_path = ''; // Save empty if no file is uploaded
                }
            
                // Save file paths to database
                $uploadFiles = $db->uploadFiles($customer_id, $admin_id, $valid_id_upload_path, $twoby2_pic_upload_path, $brgy_clearance_upload_path, $cedula_upload_path, $proof_of_billing_upload_path, $application_for_credit_upload_path);
            
                if ($uploadFiles) {

                    $_SESSION['status'] = "Requirements Uploaded Successfully";
                    $_SESSION['status-code'] = "success";
                    header("location: route.php?route=customers");
                    exit();
                }


        }
    
    }

//--------------------------------------------------------------------------------------------------------------UPLOAD RECEIPTS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_receipts'])) {   

    $sales_id = sanitizeInput($_POST['sales_id']);

    $receipts_file_name = rand(100,999) . '-' . $_FILES['receipts']['name'];
    $receipts_file_tmp = $_FILES['receipts']['tmp_name'];
    $receipts_upload_dir = "uploads/";
    $receipts_upload_path = $receipts_upload_dir . $receipts_file_name;

    $uploadmove_file = move_uploaded_file($receipts_file_tmp, $receipts_upload_path);

    if ($uploadmove_file) {
        $uploadReceipt = $db->uploadReceipt($sales_id, $receipts_upload_path);

        if($uploadReceipt){

            $_SESSION['status'] = "Cash Receipt Uploaded";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=cash");
            exit();
        } else {
            $_SESSION['status'] = "ERROR! Failed to upload cash receipt. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=cash");
            exit();
        }

    }  
}


//--------------------------------------------------------------------------------------------------------------UPLOAD RECEIPTS CREDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_receipts_credit'])) {   

    $sales_id = sanitizeInput($_POST['sales_id']);

    $receipts_file_name = rand(100,999) . '-' . $_FILES['receipts']['name'];
    $receipts_file_tmp = $_FILES['receipts']['tmp_name'];
    $receipts_upload_dir = "uploads/";
    $receipts_upload_path = $receipts_upload_dir . $receipts_file_name;

    $uploadmove_file = move_uploaded_file($receipts_file_tmp, $receipts_upload_path);

    if ($uploadmove_file) {
        $uploadReceipt = $db->uploadReceipt($sales_id, $receipts_upload_path);

        if($uploadReceipt){

            $_SESSION['status'] = "Cash Receipt Uploaded";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=credit");
            exit();
        } else {
            $_SESSION['status'] = "ERROR! Failed to upload cash receipt. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=credit");
            exit();
        }

    }  
}




//--------------------------------------------------------------------------------------------------------------DELETE REQUIREMENTS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_requirements'])) {
    
    $req_id = sanitizeInput($_POST['req_id']);

    $full_name = sanitizeInput($_POST['full_name']);
    $customer_id = sanitizeInput($_POST['customer_id']);

    $deleteRequirements_id = $db->deleteRequirements_id($req_id);

    if ($deleteRequirements_id) {
        $_SESSION['status'] = "Requirements Deleted";
        $_SESSION['status-code'] = "success";
        header("location: route.php?route=customers");
        exit();
    } else{
        $_SESSION['status'] = "ERROR! Failed to delete customer requirements. Try again.";
        $_SESSION['status-code'] = "error";
        header("location: route.php?route=view_req&viewkey=$customer_id&fname=$full_name");
        exit();

    }



}





//-----------------------------------------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------ADD SALES
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add_Sales'])) {

        $admin_id = sanitizeInput($_POST['admin_id']);
        $customer_id = sanitizeInput($_POST['customer']);
        $appliances_id = sanitizeInput($_POST['appliances']);
        $qty = sanitizeInput($_POST['qty']);
        $discount = sanitizeInput($_POST['discount']);
        $payment_type = sanitizeInput($_POST['payment_type']);
        $payment_method = sanitizeInput($_POST['payment_method']);
        $transaction_number = isset($_POST['transaction_number']) && !empty($_POST['transaction_number']) ? sanitizeInput($_POST['transaction_number']) : '';
        $months_to_pay = sanitizeInput($_POST['months_to_pay']);
                

        // Set the default timezone to Asia/Manila
        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d');

        $downpayment = 0;
        $interest = 0;
        $monthly_payment = 0;
        $total_sales = 0;

        // Get the price of the appliances
        $selectAppliances = $db->selectAppliances($appliances_id);

        if ($selectAppliances) {
            $price = $selectAppliances['price'];
            $total_price = $price * $qty; // Calculate the total price for the quantity

            $appliances_quantity = $selectAppliances['qty'];

            if ($appliances_quantity < $qty) {

                $_SESSION['status'] = "Your Quantity exceeds in the items quantity";
                $_SESSION['status-code'] = "error";
                header("location: route.php?route=allsales");
                exit();
            
            }

            if ($payment_type == 'Cash') {
                $status = 'FULLY PAID';
                // No interest for cash payments
                $price_plus_interest = $total_price;
                $total_sales = $price_plus_interest; // Total sales without interest
                $monthly_payment = $price_plus_interest; // Single payment for cash
            } else if ($payment_type == 'Credit') {
                $status = 'Active';

                // Credit Payment logic

                if ($discount == 'No Downpayment') {
                    // No downpayment, apply 3% interest
                    $downpayment = 0;
                    $interest = 0.03 * $total_price; // 3% interest
                    $price_plus_interest = $total_price + $interest;
                    $total_sales = $price_plus_interest; // Total sales with interest
                    $monthly_payment = $total_sales / $months_to_pay; // Spread payment over months
                } else if($discount == 'No Interest') {
                    // No interest, downpayment is required
                    $price_plus_interest = $total_price - $downpayment;
                    $total_sales = $total_price; // Total sales without interest
                    $monthly_payment = $price_plus_interest / $months_to_pay; // Spread payment over months
                } else if($discount == 'No Discount') {

                    $downpayment = 0.25 * $total_price; // 25% downpayment
                    $interest = 0.03 * ($total_price - $downpayment); // 3% interest on remaining amount
                    $price_plus_interest = $total_price + $interest;
                    $total_sales = $price_plus_interest; // Total sales with interest
                    $monthly_payment = ($price_plus_interest - $downpayment) / $months_to_pay; // Spread payment over months

                } else {

                    $selectDiscount_WHEREid = $db->selectDiscount_WHEREid($discount);


                    $downpayment = $selectDiscount_WHEREid['downpayment_percentage'] * $total_price; // 25% downpayment
                    $interest = $selectDiscount_WHEREid['interest_percentage'] * ($total_price - $downpayment); // 3% interest on remaining amount
                    $price_plus_interest = $total_price + $interest;
                    $total_sales = $price_plus_interest; // Total sales with interest
                    $monthly_payment = ($price_plus_interest - $downpayment) / $months_to_pay; // Spread payment over months
                }
            }
        } else {
            $_SESSION['status'] = "Appliances Not Existing";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=allsales");
            exit();
        }

        $customer = $db->getCustomerByID($customer_id);

        if(!$customer) {
            $_SESSION['status'] = "Customer Not Existing";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=allsales");
            exit();
        }

        if($payment_type == 'Credit' && $customer['credit_limit'] < $total_sales) {
            $_SESSION['status'] = "Customer Credit Limit is not enough";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=allsales");
            exit();
        }

        // update customers credit limit here


        // Insert Customer Sales with the updated total_sales
        $insertCustomerSales = $db->insertCustomerSales($admin_id, $customer_id, $appliances_id, $qty, $total_sales, $discount, $payment_type, $payment_method, $transaction_number, $months_to_pay, $monthly_payment, $downpayment, $interest, $status, $currentDate);

        if ($insertCustomerSales) {
            $connection = $db->getConnection(); // Get the PDO connection instance
            $lastInserted_ID = $connection->lastInsertId(); // Get the last inserted ID

            $dates_to_save = [];
            if (is_numeric($months_to_pay) && $months_to_pay > 0) {
                // Calculate the due dates based on the specified months_to_pay
                for ($i = 1; $i <= $months_to_pay; $i++) {
                    $nextDate = date('Y-m-d', strtotime("+$i month", strtotime($currentDate)));
                    $dates_to_save[] = $nextDate;
                }

                // Insert each calculated due date into the customer_credit_payment table
                foreach ($dates_to_save as $due_date) {
                    $amount = sanitizeInput($_POST['amount']); // Assuming amount input from user

                    // Use the new public method to insert each payment record
                    $db->insertCustomerCreditPayment($lastInserted_ID, $customer_id, $due_date);
                }

                echo "Payment schedule created for $months_to_pay months.";
            } else {
                echo "Invalid number of months to pay. Please enter a valid number.";
            }

            // Update appliance quantity
            $updateAppliances_qty = $db->updateAppliances_qty($qty, $appliances_id);

            if ($updateAppliances_qty) {
                $_SESSION['status'] = "Customer Sales Inserted";
                $_SESSION['status-code'] = "success";
                header("location: route.php?route=allsales");
                exit();
            }
        } else {
            $_SESSION['status'] = "ERROR! Failed to add customer Sales. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=allsales");
            exit();
        }


    
    }





//-------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------CREDIT PAYMENT (CUSTOMER PAYING CREDIT)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_payment'])) {
    $sales_id = sanitizeInput($_POST['sales_id']);
    $payment_date = sanitizeInput($_POST['payment_date']);
    $amount_paid = sanitizeInput($_POST['amount_paid']);

    // Retrieve all credit payment dates for the given sales_id
    $selectAllCreditPaymentDate = $db->selectAllCreditPaymentDate($sales_id);

    // Default payment status is 'PAID'
    $status = 'PAID';

    // Flag to track the first record
    $firstRecord = true; 
    $id = null; // Initialize the $id variable

    // Get the current date
    $currentDate = date('Y-m-d'); // or use $payment_date if you are using a custom payment date

    foreach ($selectAllCreditPaymentDate as $paymentRecord) {
        if ($firstRecord) {
            // Extract the 'id' from the first record
            $id = $paymentRecord['id'];

            // If needed, you can display the extracted ID
            echo 'First Payment ID: ' . $id . '<br>';

            // Check if the payment is late
            $storedPaymentDate = $paymentRecord['payment_date']; // Extract the stored payment date
            $storedDate = strtotime($storedPaymentDate); // Convert stored date to timestamp
            $submittedDate = strtotime($payment_date); // Convert submitted payment date to timestamp

            // If the submitted payment date is after the stored payment date, mark it as 'Late'
            if ($submittedDate > $storedDate) {
                $status = 'LATE PAID'; // Mark as late if the payment is after the due date
                $amount_paid = sanitizeInput($_POST['amount_paid']) * 1.05;
            }

            // Set the flag to false to stop after the first iteration
            $firstRecord = false;

            // Break the loop after extracting the first record
            break;
        }
    }

    //FOR DEBUGGING PURPOSES

    // Optionally, you can check if $id is set or use it further
    // if ($id !== null) {
    //     echo 'The extracted first payment ID is: ' . $id;
    // } else {
    //     echo 'No records found.';
    // }

    // // Debug the final payment status
    // echo '<pre>';
    // var_dump($status);
    // echo '</pre>';

    // // Now update the payment record in the database, including the status
    // // Debug before update
    // echo '<pre>';
    // var_dump($sales_id, $payment_date, $amount_paid, $status, $id);
    // echo '</pre>';
    
    $count_total_credit_payments = $db->count_total_credit_payments($sales_id);

    // Check if the number of payments made is less than months_to_pay
    if ($count_total_credit_payments > 0) {

        // Update the payment data in the database
        $UPDATE_PAYMENT = $db->updatePayment($amount_paid, $status, $id);

        if ($UPDATE_PAYMENT) {
            $_SESSION['status'] = "Payment added";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=credit");
            exit();
        } else {
            $_SESSION['status'] = "ERROR! Failed to add payment. Try again";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=credit");
            exit();
        }
        
    } else {

       
        $status1 = 'FULLY PAID';

        $updateSales_fully_paid = $db->updateSales_fully_paid1($status1, $sales_id);

        // Update the payment data in the database
        $UPDATE_PAYMENT = $db->updatePayment($amount_paid, $status, $id);

        if ($UPDATE_PAYMENT && $updateSales_fully_paid) {
            $_SESSION['status'] = "Payment added";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=credit");
            exit();
        } else {
            $_SESSION['status'] = "ERROR! Failed to add payment. Try again";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=credit");
            exit();
        }
    }


    
}











//-----------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------ADD DISCOUNTS & PROMOTIONS

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add_Discounts'])) {

    $admin_id = sanitizeInput($_POST['admin_id']);
    $name = sanitizeInput($_POST['name']);
    $type_of_discount = sanitizeInput($_POST['type_of_discount']);
    $payment_type = sanitizeInput($_POST['payment_type']);

    // Sanitize and convert to decimal percentages
    $downpayment_percentage = in_array($payment_type, ["Both", "Credit"]) ? sanitizeInput($_POST['downpayment_percentage']) / 100 : null;
    $interest_percentage = in_array($payment_type, ["Both", "Credit"]) ? sanitizeInput($_POST['interest_percentage']) / 100 : null;
    $cash_discount_percentage = in_array($payment_type, ["Both", "Cash"]) ? sanitizeInput($_POST['cash_discount_percentage']) / 100 : null;

    $eligible = sanitizeInput($_POST['eligible']);
    $start_date = sanitizeInput($_POST['start_date']);
    $end_date = sanitizeInput($_POST['end_date']);
    $terms = sanitizeInput($_POST['terms']);

    $insertDiscount_Promotions = $db->insertDiscount_Promotions($admin_id, $name, $type_of_discount, $payment_type, $cash_discount_percentage, $downpayment_percentage, $interest_percentage, $eligible, $start_date, $end_date, $terms);

    if ($insertDiscount_Promotions) {
        $_SESSION['status'] = "Discount/Promotion Added";
        $_SESSION['status-code'] = "success";
        header("location: route.php?route=discount_promotions");
        exit();
    } else {
        $_SESSION['status'] = "ERROR! Failed to add a discount/promotion. Try again";
        $_SESSION['status-code'] = "error";
        header("location: route.php?route=discount_promotions");
        exit();
    }

}


//--------------------------------------------------------------------EDIT DISCOUNTS & PROMOTIONS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Edit_Discounts'])) {
    $discount_id = sanitizeInput($_POST['discount_id']);
    $name = sanitizeInput($_POST['name']);
    $type_of_discount = sanitizeInput($_POST['type_of_discount']);
    $payment_type = sanitizeInput($_POST['payment_type']);
    $cash_discount_percentage =  in_array($payment_type, ["Both", "Cash"]) ? sanitizeInput($_POST['cash_discount_percentage']) / 100 : null;
    $downpayment_percentage = in_array($payment_type, ["Both", "Credit"]) ? sanitizeInput($_POST['downpayment_percentage']) / 100 : null;
    $interest_percentage = in_array($payment_type, ["Both", "Credit"]) ? sanitizeInput($_POST['interest_percentage']) / 100 : null;
    $eligible = sanitizeInput($_POST['eligible']);
    $start_date = sanitizeInput($_POST['start_date']);
    $end_date = sanitizeInput($_POST['end_date']);
    $terms = sanitizeInput($_POST['terms']);

    // Call your update function
    $updateDiscountPromotion = $db->updateDiscountPromotion($discount_id, $name, $type_of_discount, $payment_type, $cash_discount_percentage, $downpayment_percentage, $interest_percentage, $eligible, $start_date, $end_date, $terms);

    if ($updateDiscountPromotion) {
        $_SESSION['status'] = "Discount/Promotion Updated";
        $_SESSION['status-code'] = "success";
    } else {
        $_SESSION['status'] = "ERROR! Failed to update the discount/promotion. Try again.";
        $_SESSION['status-code'] = "error";
    }

    header("location: route.php?route=discount_promotions");
    exit();
}



//--------------------------------------------------------------------DELETE DISCOUNTS & PROMOTIONS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Delete_Discount'])) {
    $discount_id = sanitizeInput($_POST['discount_id']);

    // Call your update function
    $deleteDiscountPromotion = $db->deleteDiscountPromotion($discount_id);

    if ($deleteDiscountPromotion) {
        $_SESSION['status'] = "Discount/Promotion DELETED";
        $_SESSION['status-code'] = "success";
    } else {
        $_SESSION['status'] = "ERROR! Failed to delete the discount/promotion. Try again.";
        $_SESSION['status-code'] = "error";
    }

    header("location: route.php?route=discount_promotions");
    exit();
}  
// } else {
//     echo "<script>alert('Invalid CSRF Token test!'); window.location.href = 'index.php?route=home';</script>";
// }


/*
 * START OF REVISIONS
 * @credits ICTSC.DEVS
*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['RegisterCustomer'])) {

        try {
            // $admin_id = sanitizeInput($_POST['admin_id']);
            $full_name = sanitizeInput($_POST['full_name']);
            $complete_address = sanitizeInput($_POST['complete_address']);
            $municipality = sanitizeInput($_POST['municipality']);
            $barangay = sanitizeInput($_POST['barangay']);
            $street_name = sanitizeInput($_POST['street_name']);
            $email_address = sanitizeInput($_POST['email_address']);
            $phoneNumber = sanitizeInput($_POST['phoneNumber']);
            $age = sanitizeInput($_POST['age']);
            $civil_status = sanitizeInput($_POST['civil_status']);
            $Citizenship = sanitizeInput($_POST['Citizenship']);

            $username = sanitizeInput($_POST['username']);
            $password = sanitizeInput($_POST['password']);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);




            $registerCustomer = $db->registerCustomer(1, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship, $username, $hash_password);

            if(!$registerCustomer) {
                header("location: ".BASE_URL."/client/registration.php");
                $_SESSION['message'] = [
                    "status" => "error",
                    "message" => "ERROR! Failed to register a customer. Try again."
                ];
                exit();
            }

            
            $_SESSION['message'] = [
                "status" => "success",
                "message" => "Customer registered successfully."
            ];
            header("location: ".BASE_URL."/client/index.php");
            exit();

        } catch (\Throwable $th) {
            echo $th;
            $_SESSION['message'] = [
                "status" => "error",
                "message" => "An unexpected error occured while registering a customer. Try again."
            ];
            header("location: ".BASE_URL."/client/registration.php");
            exit();
        }
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AddBrand'])) {

        $brand_name = sanitizeInput($_POST['brand_name']);
        $admin_id = sanitizeInput($_POST['admin_id']);

        $insertBrand = $db->insertBrand($admin_id, $brand_name);

        if ($insertBrand) {

            $_SESSION['status'] = "Brand Added";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to add brand. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();
        }

    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UpdateBrand'])) {

        $brand_id = sanitizeInput($_POST['brand_id']);
        $brand_name = sanitizeInput($_POST['brand_name']);

        $updateBrand = $db->updateBrand($brand_name, $brand_id);

        if ($updateBrand) {

            $_SESSION['status'] = "Brand Updated";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to update Brand. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();
        }

    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DeleteBrand'])) {

        $brand_id = sanitizeInput($_POST['brand_id']);

        $countBrandAppliances = $db->countBrandAppliances($brand_id);

        if ($countBrandAppliances > 0) {
            $_SESSION['status'] = "Brand has appliances. Cannot delete.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();
        }

        $deleteBrand= $db->deleteBrand($brand_id);

        if ($deleteBrand) {

            $_SESSION['status'] = "Brand Deleted";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=appliances");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to delete Brand. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=appliances");
            exit();

        }

    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UpdateCreditLimit'])) {

        $customer_id = sanitizeInput($_POST['customer_id']);
        $credit_limit = sanitizeInput($_POST['credit_limit']);

        $updateCreditLimit = $db->updateCreditLimit($customer_id, $credit_limit);

        if ($updateCreditLimit) {

            $_SESSION['status'] = "Credit Limit Updated";
            $_SESSION['status-code'] = "success";
            header("location: route.php?route=customers");
            exit();
        
        } else {

            $_SESSION['status'] = "ERROR! Failed to update Credit Limit. Try Again.";
            $_SESSION['status-code'] = "error";
            header("location: route.php?route=customers");
            exit();
        }

    }


/*
 * END OF REVISIONS
 * @credits ICTSC.DEVS
*/



}

?>