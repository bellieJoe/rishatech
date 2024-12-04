<?php
include('config.php');

$db = new Database();

// Test connection
try {
    $stmt = $db->pdo->query("SELECT 1");
    echo "";
} catch (Exception $e) {
    echo "Failed to connect: " . $e->getMessage();
}
?>
<!-- HEADER -->
<?php
require_once 'templates/admin_header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Financial Reports</title>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        /* CSS for printing only the report content */
        @media print {
            body * {
                visibility: hidden;
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
        <a href="route.php?route=dashboard" class="btn btn-primary">🢀 Back to Merchant</a><br><br>

        <h2>Financial Reports</h2>

        <!-- Filter Form for Customizable Reports -->
        <form method="GET" action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="reportType">Report Type</label>
                    <select id="reportType" name="reportType" class="form-control">
                        <option value="sales" <?php echo isset($_GET['reportType']) && $_GET['reportType'] == 'sales' ? 'selected' : ''; ?>>Sales Report</option>
                        <option value="aging" <?php echo isset($_GET['reportType']) && $_GET['reportType'] == 'aging' ? 'selected' : ''; ?>>Aging Report</option>
                        <option value="creditUsage" <?php echo isset($_GET['reportType']) && $_GET['reportType'] == 'creditUsage' ? 'selected' : ''; ?>>Credit Usage Report</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="startDate">Start Date</label>
                    <input type="date" name="startDate" class="form-control" required value="<?php echo isset($_GET['startDate']) ? $_GET['startDate'] : ''; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="endDate">End Date</label>
                    <input type="date" name="endDate" class="form-control" required value="<?php echo isset($_GET['endDate']) ? $_GET['endDate'] : ''; ?>">
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </div>
        </form>

        <hr>

        <!-- Display Report Data -->
        <div id="printableReport">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['reportType'])) {
                $reportType = $_GET['reportType'];
                $startDate = $_GET['startDate'];
                $endDate = $_GET['endDate'];

                if ($reportType == 'sales') {
                    // Sales Report Query
                    $salesQuery = "SELECT SUM(amount_paid) AS total_sales, DATE_FORMAT(payment_date, '%Y-%m') AS period
                                   FROM customer_credit_payment
                                   WHERE payment_date BETWEEN ? AND ?
                                   GROUP BY period
                                   ORDER BY period";
                    $stmt = $db->pdo->prepare($salesQuery);
                    $stmt->execute([$startDate, $endDate]);
                    $salesData = $stmt->fetchAll();

                    echo "<h4>Sales Report from $startDate to $endDate</h4>";
                    echo "<table class='table table-bordered'><tr><th>Month</th><th>Total Sales</th></tr>";
                    foreach ($salesData as $row) {
                        echo "<tr><td>{$row['period']}</td><td>{$row['total_sales']}</td></tr>";
                    }
                    echo "</table>";
                } elseif ($reportType == 'aging') {
                    // Aging Report Query
                    $agingQuery = "SELECT c.full_name AS customer_name, p.payment_date, p.amount_paid, p.payment_status
                                   FROM customer_credit_payment p
                                   JOIN customers c ON p.customer_id = c.id
                                   WHERE p.payment_date BETWEEN ? AND ? AND p.payment_status != 'PAID'
                                   ORDER BY p.payment_date";
                    $stmt = $db->pdo->prepare($agingQuery);
                    $stmt->execute([$startDate, $endDate]);
                    $agingData = $stmt->fetchAll();

                    echo "<h4>Aging Report (Outstanding Payments) from $startDate to $endDate</h4>";
                    echo "<table class='table table-bordered'><tr><th>Customer Name</th><th>Payment Date</th><th>Amount Due</th><th>Status</th></tr>";
                    foreach ($agingData as $row) {
                        echo "<tr><td>{$row['customer_name']}</td><td>{$row['payment_date']}</td><td>{$row['amount_paid']}</td><td>{$row['payment_status']}</td></tr>";
                    }
                    echo "</table>";
                } elseif ($reportType == 'creditUsage') {
                    // Credit Usage Report Query
                    $creditQuery = "SELECT c.full_name AS customer_name, COUNT(p.id) AS total_credits, SUM(p.amount_paid) AS total_credit_amount
                                    FROM customer_credit_payment p
                                    JOIN customers c ON p.customer_id = c.id
                                    WHERE p.payment_date BETWEEN ? AND ?
                                    GROUP BY p.customer_id";
                    $stmt = $db->pdo->prepare($creditQuery);
                    $stmt->execute([$startDate, $endDate]);
                    $creditData = $stmt->fetchAll();

                    echo "<h4>Credit Usage Report from $startDate to $endDate</h4>";
                    echo "<table class='table table-bordered'><tr><th>Customer Name</th><th>Total Credits</th><th>Total Credit Amount</th></tr>";
                    foreach ($creditData as $row) {
                        echo "<tr><td>{$row['customer_name']}</td><td>{$row['total_credits']}</td><td>{$row['total_credit_amount']}</td></tr>";
                    }
                    echo "</table>";
                }
            }
			
            ?>
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
   
</body>

    <!-- Print and PDF Buttons -->
    <div class="d-flex justify-content-center">
        <button id="printButton" class="btn btn-secondary" onclick="window.print()">Print Report</button>
        
    </div>
<br>

            <div class="d-flex justify-content-center">
        
        <a href="#" id="downloadPdfButton" class="btn btn-success" onclick="downloadPDF()">Download Report</a>
    </div>
   

    <!-- JavaScript -->
    <script>
        function downloadPDF() {
            const reportType = document.getElementById('reportType').value;
            const startDate = document.querySelector('input[name="startDate"]').value;
            const endDate = document.querySelector('input[name="endDate"]').value;

            if (!startDate || !endDate) {
                alert('Please select both start and end dates.');
                return;
            }

            // Redirect to the PHP script with query parameters
            window.location.href = `download_report.php?reportType=${reportType}&startDate=${startDate}&endDate=${endDate}`;
        }
    </script>
</body>

</html>

</script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>
