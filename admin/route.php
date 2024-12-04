<?php
include '../db_connection/config.php';
$db = new Database();
 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'authentications.php';

if (!isset($_SESSION['auth_user']['admin_id'])) {
    header('Location: index.php?route=home');
    exit();
}

if (isset($_GET['route'])) {

    @$route = sanitizeInput($_GET['route']);

    if ($route == 'dashboard') {
        include ("dashboard.php");
        exit();
    } else if ($route == 'view_profile') {
        include ("profile.php");
        exit();
    } else if ($route == 'settings') {
        include ("profile_settings.php");
        exit();
    } else if ($route == 'appliances') {
        include ("appliances.php");
        exit();
    } else if ($route == 'customers') {
        include ("customers.php");
        exit();
    } else if ($route == 'view_req') {
        include ("view_requirements.php");
        exit();
    } else if ($route == 'all_items') {
        include ("appliances_per_category.php");
        exit();
    } else if ($route == 'cash') {
        include ("sales_cash.php");
        exit();
    } else if ($route == 'credit') {
        include ("sales_credit.php");
        exit();
    } else if ($route == 'allsales') {
        include ("sales.php");
        exit();
    } else if ($route == 'discount_promotions') {
        include ("discount_promotions.php");
        exit();
    } else if ($route == 'financial_reports') {
        include ("financial_reports.php");
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