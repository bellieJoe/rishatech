<?php
include '../db_connection/config.php';
$db = new Database();
 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'authentications.php';

if (isset($_GET['route'])) {

    @$route = sanitizeInput($_GET['route']);

    if ($route == 'home') {
        include ("home.php");
        exit();
    } else if ($route == 'forgotpword') {
        include ("forgot-password.php");
        exit();
    } else if ($route == 'verifyotpadmin') {
        include ("verify_otp_admin_account.php");
        exit();
    } else if ($route == 'verifyotpcode') {
        include ("verify_otp_code.php");
        exit();
    } else if ($route == 'enterpword') {
        include ("enter_password.php");
        exit();
    } else {
        session_unset();
        session_destroy();

        header('Location: ./index.php?route=home');
        exit();
    }

} else {
    session_unset();
    session_destroy();

    header('Location: ./index.php?route=home');
    exit();
}

?>