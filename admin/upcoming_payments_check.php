<?php
include '../db_connection/config.php';
$db = new Database();

// Define the number of days before the due date for the notification to trigger
$daysBeforeDue = 3; // for example, notify 3 days before the due date

// Prepare the SQL query to select upcoming payments
$upcomingPayments = $db->selectCreditPayment_DueDate($daysBeforeDue);


header('Content-Type: application/json');
echo json_encode($upcomingPayments);
?>
