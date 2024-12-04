<?php
include '../db_connection/config.php';
$db = new Database();

$qty = 3;
$lowStockItems = $db->selectAllItemsQty($qty); // Use the function you've created

header('Content-Type: application/json');
echo json_encode($lowStockItems); // Output the low-stock items as a JSON array
?>
