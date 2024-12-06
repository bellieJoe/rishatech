<?php
   session_start();

   include_once '../app/config/constants.php';
   include_once '../db_connection/config.php';

   $db = new Database();

   if(!isset($_SESSION['user'])) {
       header("Location: ".BASE_URL."/client/index.php");
       exit();
   }

   $purchaseHistory = $db->getCustomerPurchaseHistory($_SESSION['user']['customer_id']);
//    echo json_encode($purchaseHistory);
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
                        <h1 class="h3 mb-0 text-gray-800">Purchase History</h1>
                    </div>

                    <!-- ACTIVE CREDITS -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Purchase History</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered " id="dataTablePurchaseHistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            <th>Item Name</th>
                                            <th>Total Sales</th>
                                            <th>Payment Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($purchaseHistory as $row) {
                                                
                                        ?>
                                        <tr>
                                            <td><?=$row['date_created']?></td>
                                            <td><?php echo $row['appliances_name'];?></td>
                                            <td><?=$row['total_sales']?></td>
                                            <td><?php echo $row['payment_type'];?></td>
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
        $('#dataTablePurchaseHistory').DataTable({
            language: {
                emptyTable: "No Purchase made" // Custom message
            },
            "order": [[ 0, "desc" ]],
            columnDefs : [
                {
                    targets : 0,
                    render : function(data, type, row, meta) {
                        return type === 'display' ? 
                            new Intl.DateTimeFormat('en-US', { year: 'numeric', month: 'short', day: '2-digit' }).format(new Date(data)) : data;
                    }
                },
                {
                    targets : 2,
                    render : function(data, type, row) {
                        return type === 'display' || type === 'filter' 
                            ? '₱ ' + parseFloat(data).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                            : parseFloat(data); // Use numeric value for sorting
                    }
                }
            ]
        });
    });
</script>

