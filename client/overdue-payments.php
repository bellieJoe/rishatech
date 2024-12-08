<?php
   session_start();

   include_once '../app/config/constants.php';
   include_once '../db_connection/config.php';

   $db = new Database();

   if(!isset($_SESSION['user'])) {
       header("Location: ".BASE_URL."/client/index.php");
       exit();
   }

   $overdue = $db->getCustomerPassDuePayments($_SESSION['user']['customer_id']);
   $upcoming = $db->getCustomerUpcomingPayments($_SESSION['user']['customer_id']);


?>

<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php require_once './templates/client_header.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php require_once 'templates/client_sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once 'templates/client_topbar.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Payments</h1>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        <strong>Reminder:</strong> Pending payments should be paid immediately or they will incur a 5% penalty every day.
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Overdue Payments</h6>
                        </div>    
                        <div class="card-body">
                            <?php if (count($overdue) <= 0) { ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Congratulations!</strong> You have no overdue payments.
                                </div>
                            <?php } ?>
                            <?php if (count($overdue) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableActiveCredits" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Amount</th>
                                                <th>Payment Date</th>
                                                <th>Days Overdue</th>
                                                <th>Penalty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($overdue as $payment) { ?>
                                                <tr>
                                                    <td><?php echo $payment['appliances_name'] ?></td>
                                                    <td><?php echo "PHP " . number_format($payment['monthly_payment'], 2); ?></td>
                                                    <td><?php echo date("M d, Y", strtotime($payment['payment_date'])); ?></td>
                                                    <td><?php echo $payment['overdue_days']; ?> days</td>
                                                    <td><?php echo "PHP " . number_format($payment['penalty'], 2); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php }  ?>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Upcoming Payments</h6>
                        </div>    
                        <div class="card-body">
                            <?php if (count($upcoming) <= 0) { ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Congratulations!</strong> You have no upcoming payments.
                                </div>
                            <?php } ?>
                            <?php if (count($upcoming) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableUpcomingPayments" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Amount</th>
                                                <th>Payment Date</th>
                                                <th>Days Left</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($upcoming as $payment) { ?>
                                                <tr>
                                                    <td><?php echo $payment['appliances_name'] ?></td>
                                                    <td><?php echo "PHP " . number_format($payment['monthly_payment'], 2); ?></td>
                                                    <td><?php echo date("M d, Y", strtotime($payment['payment_date'])); ?></td>
                                                    <td><?php echo $payment['days_to_due_date']; ?> days</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
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
        $('#dataTableUpcomingPayments').DataTable({
            language: {
                emptyTable: "No Inactive Credits" // Custom message
            }
        });
    });
</script>

