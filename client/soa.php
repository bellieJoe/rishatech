<?php
   session_start();

   include_once '../app/config/constants.php';
   include_once '../db_connection/config.php';

   $db = new Database();

    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags($input));
    }

    if(!isset($_SESSION['user'])) {
        header("Location: ".BASE_URL."/client/index.php");
        exit();
    }

   
    if(!isset($_GET['sales_id'])) {
        $_SESSION['message']['status'] = "error";
        $_SESSION['message']['message'] = "No selected sales found.";
        header("Location: ".BASE_URL."/client/credits.php");
        exit();
    }

   $sales_id = sanitizeInput($_GET['sales_id']);
   
   $sales = $db->getSalesById($sales_id);

   if (!$sales) {
        $_SESSION['message']['status'] = "error";
        $_SESSION['message']['message'] = "No sales found.";
        header("Location: ".BASE_URL."/client/credits.php");
        exit();
   }

   $appliance = $db->selectAppliances($sales['appliances_id']);

   if (!$appliance) {
        $_SESSION['message']['status'] = "error";
        $_SESSION['message']['message'] = "No appliance found.";
        header("Location: ".BASE_URL."/client/credits.php");
        exit();
   }

   $payments = $db->getCreditPaymnetsBySalesId($sales_id);

   if (!$payments) {
        $_SESSION['message']['status'] = "error";
        $_SESSION['message']['message'] = "No payments found.";
        header("Location: ".BASE_URL."/client/credits.php");
        exit();
   }

   $customer = $db->getCustomerById($sales['customer_id']);

   if (!$customer) {
        $_SESSION['message']['status'] = "error";
        $_SESSION['message']['message'] = "No customer found.";
        header("Location: ".BASE_URL."/client/credits.php");
        exit();
   }

   $paidCredits = $db->countPaidCreditsBySalesId($sales_id);
   $total_balance = $sales['total_sales'] - $sales['downpayment'] - ($sales['monthly_payment'] * $paidCredits);


?>

<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php require_once './templates/client_header.php'; ?>

    <style>
        * {
            font-family: Arial, sans-serif;
            color: #4d4d4d;
        }
    </style>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" >
            <div id="content " class="container-md py-5 px-5 bg-white">
                <div class="header mb-5">
                    <h5 class="text-center font-weight-bold">A-RISHA GENERAL MERCHANDISE</h5>
                    <h5 class="text-center font-weight-bold">STATEMENT OF ACCOUNT</h5>
                </div>

                <hr class="border border-dark mb-5">

                <table class="table mb-5">
                    <tbody>
                        <tr>
                            <td class="border-0"><strong>Customer Name :</strong></td>
                            <td class="border-0"><?= $customer['full_name'] ?></td>
                            <td class="border-0"><strong>Total Item Amount :</strong></td>
                            <td class="border-0"><?= "PHP " . number_format($sales['total_sales'], 2) ?></td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Date Registered :</strong></td>
                            <td class="border-0"><?= date("M d, Y", strtotime($customer['date_registered'])) ?> </td>
                            <td class="border-0"><strong>Interest Rate :</strong></td>
                            <td class="border-0">3%</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Date of Purchase :</strong></td>
                            <td class="border-0"><?= date("M d, Y", strtotime($sales['date_created'])) ?></td>
                            <td class="border-0"><strong>Downpayment :</strong></td>
                            <td class="border-0"><?= "PHP " . number_format($sales['downpayment'], 2) ?></td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Purchase Item :</strong></td>
                            <td class="border-0"><?= $appliance['appliances_name'] ?></td>
                            <td class="border-0"><strong>Total Balance :</strong></td>
                            <td class="border-0"><?= "PHP " . number_format($total_balance, 2) ?></td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Quantity :</strong></td>
                            <td class="border-0"><?= $sales['qty'] ?></td>
                            <td class="border-0"><strong>Term :</strong></td>
                            <td class="border-0"><?= $sales['months_to_pay'] ?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th >No. of Terms</th>
                            <th >Monthly Amortization</th>
                            <th >Due Date</th>
                            <th >Date Paid</th>
                            <th >Amount Paid</th>
                            <th >Penalty</th>
                            <th >Outstanding Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $index = 0;
                            foreach($payments as $payment) {
                                $index++;
                        ?>
                        <tr>
                            <td><?= $index ?></td>
                            <td><?= "PHP " . number_format($sales['monthly_payment'], 2) ?></td>
                            <td><?= date("M d, Y", strtotime($payment['payment_date'])) ?></td>
                            <td><?= $payment['date_paid'] == null ? "-" : date("M d, Y", strtotime($payment['date_paid'])) ?></td>
                            <td><?= "PHP " . number_format($payment['amount_paid'], 2) ?></td>
                            <td><?= $payment['amount_paid'] == 0 ? "-" : "PHP " . number_format(($payment['amount_paid'] - $sales['monthly_payment']), 2) ?></td>
                            <td><?= 
                                   $payment['amount_paid'] > $sales['monthly_payment'] ? "PHP 0.00" : "PHP " . number_format($sales['monthly_payment'] - $payment['amount_paid'], 2) ?>
                            </td>
                        </tr>

                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>

</html>

<!-- scripts -->
<script src="../admin/vendor/jquery/jquery.min.js"></script>
<script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../admin/js/sb-admin-2.min.js"></script>
<script src="../admin/vendor/chart.js/Chart.min.js"></script>
<script src="../admin/js/sweetalert.js"></script>
<!-- Custom styles for this page -->
<link href="../admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<?php 
if (isset($_SESSION['message']) && $_SESSION['message']['message'] != '') {
?>
<script>
    swal({
        title: "<?php echo $_SESSION['message']['message']; ?>",
        icon: "<?php echo $_SESSION['message']['status']; ?>",
        button: "DONE",
    });
</script>
<?php
    unset($_SESSION['message']);
}
?>

<script>
    $(document).ready(function() {
        $('#dataTableActiveCredits').DataTable({
            language: {
                emptyTable: "No Active Credits" // Custom message
            },
            "order": [[ 0, "desc" ]]
        });
        $('#dataTableInactiveCredits').DataTable({
            language: {
                emptyTable: "No Inactive Credits" // Custom message
            },
            "order": [[ 0, "desc" ]]
        });
    });
</script>



