<?php
session_start();


require_once '../db_connection/config.php';
require_once "../paymongo.php";

$db = new Database();
$paymongo = new PayMongo();

$amount = $_GET['amount'];
$payment_id = $paymongo->decryptData($_GET['payment_id']);

// Update the payment status in the database

if(!$db->updatePayment($amount, 'Paid', $payment_id)) {
    $_SESSION['status'] = "ERROR! Failed to add payment. Try again";
    $_SESSION['status-code'] = "error";
    header("Location: ../client/credits.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="../admin/css/sb-admin-2.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Lato', sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 80px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }


 
    </style>
</head>
<body>
    <div class="container">
        <div class="" role="alert">
            <h3 class="text-success text-center">Payment Successful</h3>
            <p class="lead text-center">Your payment of PHP <?php echo $_GET['amount']; ?> has been successfully processed. We appreciate your business and hope to see you again soon!</p>
            <a href="../client/credits.php" class="btn btn-success d-block mx-auto">Return to Home</a>
        </div>
    </div>
</body>
</html>

