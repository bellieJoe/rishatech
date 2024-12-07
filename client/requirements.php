<?php
   session_start();

   include_once '../app/config/constants.php';
   include_once '../db_connection/config.php';

   $db = new Database();

   if(!isset($_SESSION['user'])) {
       header("Location: ".BASE_URL."/client/index.php");
       exit();
   }

   $requirement = $db->getRequirementByCustomerId($_SESSION['user']['customer_id']);

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
                        <h1 class="h3 mb-0 text-gray-800">Requirements</h1>
                    </div>

                    

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Valid ID</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($requirement && $requirement['valid_id'] != null) {
                                                        echo "Uploaded";
                                                        ?>
                                                        <a class="small mt-2 d-block" target="_blank" href="<?php echo BASE_URL.'/admin/'.$requirement['valid_id']; ?>">View</a>
                                                        <?php
                                                    } else {
                                                        echo "Not Uploaded";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">2x2 Picture</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($requirement && $requirement['twoBytwo_pic'] != null) {
                                                        echo "Uploaded";
                                                        ?>
                                                        <a class="small mt-2 d-block" target="_blank" href="<?php echo BASE_URL.'/admin/'.$requirement['twoBytwo_pic']; ?>">View</a>
                                                        <?php
                                                    } else {
                                                        echo "Not Uploaded";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-image fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Brgy Clearance</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($requirement && $requirement['brgy_clearance'] != null) {
                                                        echo "Uploaded";
                                                        ?>
                                                        <a class="small mt-2 d-block" target="_blank" href="<?php echo BASE_URL.'/admin/'.$requirement['brgy_clearance']; ?>">View</a>
                                                        <?php
                                                    } else {
                                                        echo "Not Uploaded";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cedula</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($requirement && $requirement['cedula'] != null) {
                                                        echo "Uploaded";
                                                        ?>
                                                        <a class="small mt-2 d-block" target="_blank" href="<?php echo BASE_URL.'/admin/'.$requirement['cedula']; ?>">View</a>
                                                        <?php
                                                    } else {
                                                        echo "Not Uploaded";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proof Of Billing</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($requirement && $requirement['proof_of_billing'] != null) {
                                                        echo "Uploaded";
                                                        ?>
                                                        <a class="small mt-2 d-block" target="_blank" href="<?php echo BASE_URL.'/admin/'.$requirement['proof_of_billing']; ?>">View</a>
                                                        <?php
                                                    } else {
                                                        echo "Not Uploaded";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Application Form Credit</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if ($requirement && $requirement['application_form_credit'] != null) {
                                                        echo "Uploaded";
                                                        ?>
                                                        <a class="small mt-2 d-block" target="_blank" href="<?php echo BASE_URL.'/admin/'.$requirement['application_form_credit']; ?>">View</a>
                                                        <?php
                                                    } else {
                                                        echo "Not Uploaded";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-signature fa-2x text-gray-300"></i>
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

