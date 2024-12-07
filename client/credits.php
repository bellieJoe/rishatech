<?php
   session_start();

   include_once '../app/config/constants.php';
   include_once '../db_connection/config.php';

   $db = new Database();

   if(!isset($_SESSION['user'])) {
       header("Location: ".BASE_URL."/client/index.php");
       exit();
   }

   $activeCredits = $db->getCustomersActiveCredits($_SESSION['user']['customer_id']);
   $inactiveCredits = $db->getCustomersInctiveCredits($_SESSION['user']['customer_id']);
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
                        <h1 class="h3 mb-0 text-gray-800">Credits</h1>
                    </div>

                    <!-- ACTIVE CREDITS -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Active Credits</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableActiveCredits" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            <th>Item Name</th>
                                            <th>Total Sales</th>
                                            <th>Months To Pay</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($activeCredits as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['date_created'];?></td>
                                            <td><?php echo $row['appliances_name'];?></td>
                                            <td>PHP <?php echo number_format($row['total_sales'], 2);?></td>
                                            <td><?php echo $row['months_to_pay'];?></td>
                                            <td><?php echo $row['sales_status'];?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/client/soa.php?sales_id=<?=$row['sales_id']?>" target="_blank"><i class="fa fa-file mr-2"></i>View SOA</a>
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#ViewPayment_<?=$row['sales_id']?>"><i class="fa fa-history mr-2"></i>View Payments</a>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="ViewPayment_<?=$row['sales_id']?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Credit Payments</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered border" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Due Date</th>
                                                                                <th>Amount to Pay</th>
                                                                                <th>Date Paid</th>
                                                                                <th>Amount Paid</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                $sales_id = $row['sales_id'];
                                                                                $payments = $db->getCreditPaymnetsBySalesId($sales_id);
                                                                                foreach($payments as $payment) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo date("M d, Y", strtotime($payment['payment_date']));?></td>
                                                                                <td>PHP <?php echo number_format($row['monthly_payment'], 2);?></td>
                                                                                <td><?php echo $payment['date_paid'] == null ? "-" : date("M d, Y", strtotime($payment['date_paid']));?></td>
                                                                                <td>PHP <?php echo number_format($payment['amount_paid'], 2);?></td>
                                                                                <td><?php echo $payment['payment_status'];?></td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

                    <!-- INACTIVE CREDITS -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Inactive Credits</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableInactiveCredits" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            <th>Item Name</th>
                                            <th>Total Sales</th>
                                            <th>Months To Pay</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($inactiveCredits as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['date_created'];?></td>
                                            <td><?php echo $row['appliances_name'];?></td>
                                            <td>PHP <?php echo number_format($row['total_sales'], 2);?></td>
                                            <td><?php echo $row['months_to_pay'];?></td>
                                            <td><?php echo $row['sales_status'];?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#ViewPayment_<?=$row['sales_id']?>">View Payments</a>
                                                        <a class="dropdown-item" href="<?php echo BASE_URL;?>/client/soa.php?sales_id=<?=$row['sales_id']?>" target="_blank"><i class="fa fa-file mr-2"></i>View SOA</a>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="ViewPayment_<?=$row['sales_id']?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Credit Payments</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered border" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Due Date</th>
                                                                                <th>Amount to Pay</th>
                                                                                <th>Amount Paid</th>
                                                                                <th>Date Paid</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                $sales_id = $row['sales_id'];
                                                                                $payments = $db->getCreditPaymnetsBySalesId($sales_id);
                                                                                foreach($payments as $payment) {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo date("M d, Y", strtotime($payment['payment_date']));?></td>
                                                                                <td>PHP <?php echo number_format($row['monthly_payment'], 2);?></td>
                                                                                <td>PHP <?php echo number_format($payment['amount_paid'], 2);?></td>
                                                                                <td><?php echo date("M d, Y", strtotime($payment['date_paid']));?></td>
                                                                                <td><?php echo $payment['payment_status'];?></td>
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        $('#dataTableInactiveCredits').DataTable({
            language: {
                emptyTable: "No Inactive Credits" // Custom message
            },
            "order": [[ 0, "desc" ]]
        });
    });
</script>

