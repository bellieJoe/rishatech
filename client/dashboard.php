<?php
   session_start();

    include_once '../app/config/constants.php';
    include_once '../db_connection/config.php';

    if(!isset($_SESSION['user'])) {
        header("Location: ".BASE_URL."/client/index.php");
        exit();
    }

    $db = new Database();

    $totalCreditPayments = $db->getTotalCreditPayments($_SESSION['user']['customer_id']);
    $totalCashPayments = $db->getTotalCashPayments($_SESSION['user']['customer_id']);
    $totalSpent = $totalCreditPayments + $totalCashPayments;
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Welcome, <?php echo $_SESSION['user']['full_name']; ?>!</h5>
                                    <p>We are glad to have you back. Here's a quick overview of your account.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Credit Limit</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PHP <?php echo number_format($_SESSION['user']['credit_limit'], 2); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Spent
                                            </div>
                                            <?php
                                                
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PHP <?php echo number_format($totalSpent, 2); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Spent on Credit Purchases
                                            </div>
                                            <?php
                                                
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PHP <?php echo number_format($totalCreditPayments, 2); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Spent on Cash Purchases
                                            </div>
                                            <?php
                                                
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">PHP <?php echo number_format($totalCashPayments, 2); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Recent Purchases</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Payment Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $recentPurchases = $db->recentPurchases($_SESSION['user']['customer_id']);
                                                    foreach ($recentPurchases as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo date('M d, Y', strtotime($row['date_created'])); ?></td>
                                                    <td>PHP <?=$row['appliances_name']?></td>
                                                    <td>PHP <?php echo number_format($row['total_sales'], 2); ?></td>
                                                    <td><?php echo $row['payment_type']; ?></td>
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

