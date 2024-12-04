<?php
include '../db_connection/config.php';
$db = new Database();

// Define the number of days after the due date for the notification to trigger
$daysafterDue = 1; // Notify 1 day after the due date

// Prepare the SQL query to select past due payments
$pastDuePayments = $db->selectCreditPayment_DueDate($daysafterDue);

header('Content-Type: application/json');
echo json_encode($pastDuePayments);
?>
