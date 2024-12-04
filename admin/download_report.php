<?php
include('config.php');

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['reportType'])) {
    $reportType = $_GET['reportType'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="report_' . $reportType . '_' . $startDate . '_to_' . $endDate . '.csv"');

    $output = fopen('php://output', 'w');

    // Add headers based on report type
    if ($reportType == 'sales') {
        fputcsv($output, ['Month', 'Total Sales']);

        $query = "SELECT SUM(amount_paid) AS total_sales, DATE_FORMAT(payment_date, '%Y-%m') AS period
                  FROM customer_credit_payment
                  WHERE payment_date BETWEEN ? AND ?
                  GROUP BY period
                  ORDER BY period";
        $stmt = $db->pdo->prepare($query);
        $stmt->execute([$startDate, $endDate]);
        $data = $stmt->fetchAll();

        foreach ($data as $row) {
            fputcsv($output, [$row['period'], $row['total_sales']]);
        }
    } elseif ($reportType == 'aging') {
        fputcsv($output, ['Customer Name', 'Payment Date', 'Amount Due', 'Status']);

        $query = "SELECT c.full_name AS customer_name, p.payment_date, p.amount_paid, p.payment_status
                  FROM customer_credit_payment p
                  JOIN customers c ON p.customer_id = c.id
                  WHERE p.payment_date BETWEEN ? AND ? AND p.payment_status != 'PAID'
                  ORDER BY p.payment_date";
        $stmt = $db->pdo->prepare($query);
        $stmt->execute([$startDate, $endDate]);
        $data = $stmt->fetchAll();

        foreach ($data as $row) {
            fputcsv($output, [$row['customer_name'], $row['payment_date'], $row['amount_paid'], $row['payment_status']]);
        }
    } elseif ($reportType == 'creditUsage') {
        fputcsv($output, ['Customer Name', 'Total Credits', 'Total Credit Amount']);

        $query = "SELECT c.full_name AS customer_name, COUNT(p.id) AS total_credits, SUM(p.amount_paid) AS total_credit_amount
                  FROM customer_credit_payment p
                  JOIN customers c ON p.customer_id = c.id
                  WHERE p.payment_date BETWEEN ? AND ?
                  GROUP BY p.customer_id";
        $stmt = $db->pdo->prepare($query);
        $stmt->execute([$startDate, $endDate]);
        $data = $stmt->fetchAll();

        foreach ($data as $row) {
            fputcsv($output, [$row['customer_name'], $row['total_credits'], $row['total_credit_amount']]);
        }
    }

    fclose($output);
    exit;
}
?>
