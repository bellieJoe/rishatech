<?php
include_once '../db_connection/config.php';

$db = new Database();

// Test connection


$customers = $db->getCustomersWithOverduePayments();

?>
<!-- HEADER -->
<?php
require_once 'templates/admin_header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customers with overdue payments</title>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        /* CSS for printing only the report content */
        * {
            font-family: Arial, sans-serif !important;
        }
        @media print {
            body * {
                visibility: hidden;
                font-family: Arial, sans-serif !important;
            }

            #printableReport,
            #printableReport * {
                visibility: visible;
            }

            #printableReport {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            #printButton {
                display: none; /* Hide the print button when printing */
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="route.php?route=dashboard" class="btn btn-primary">🢀 Back to Merchant</a>
            <!-- Print and PDF Buttons -->
            <div class="d-flex">
                <button id="printButton" class="btn btn-secondary mr-2" onclick="window.print()">Print Report</button>
            </div>
        </div>
        <h2>Customers w/ Overdue Payments</h2>
        

        <hr>

        <!-- Display Report Data -->
        <div id="printableReport">
            <div class="mb-3">
                <h4 class="text-center font-weight-bold">A-RISHA GENERAL MERCHANDISE</h4>
                <h4 class="text-center font-weight-bold">LIST OF CUSTOMERS W/ OVERDUE PAYMENTS</h4>
            </div>
            <table class="table table-bordered border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Complete Address</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">No. of Overdue Payments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $index = 1;
                        foreach ($customers as $customer) {
                    ?>
                        <tr>
                            <th scope="row"><?=$index?></th>
                            <td><?=$customer['full_name']?></td>
                            <td><?=$customer['complete_address']?></td>
                            <td><?=$customer['email']?></td>
                            <td><?=$customer['phone_number']?></td>
                            <td><?=$customer['overdue_count']?></td>
                        </tr>
                    <?php
                            $index++;
                        }
                    ?>
                </tbody>
            </table>

            <!-- Signature Section -->
            <div style="
                position: fixed;
                bottom: 20px;
                right: 20px;
                text-align: right;
                font-size: 14px;
                width: 200px; /* Ensure consistent width */
            ">
                <p>Prepared by:</p>
                <p>______________________</p>
                <p><i>(Signature over printed name)</i></p>
            </div>
        </div>
    </div>
</body>

</html>

</script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>
