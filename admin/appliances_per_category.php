<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['category_id']) && isset($_GET['cat_name'])) {

    $category_id = sanitizeInput($_GET['category_id']);
    $category_name = sanitizeInput($_GET['cat_name']);

}

?>


<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php
require_once 'templates/admin_header.php';
?>

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        require_once 'templates/admin_sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require_once 'templates/admin_topbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php echo $category_name; ?></h1>


                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All <?php echo $category_name; ?> Appliances</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID No.#</th>
                                            <th><?php echo $category_name; ?> Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Unit/s</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selectAllappliancesWHERECat_ID = $db->selectAllappliancesWHERECat_ID($category_id);

                                        foreach ($selectAllappliancesWHERECat_ID as $result) {
                                        ?>
                                        <tr>
                                            <td><?=$result['AppliancesID']?></td>
                                            <td><?=$result['appliances_name']?></td>
                                            <td><?=$result['cat_name']?></td>
                                            <td>₱ <?=$result['price']?></td>
                                            <td><?=$result['qty']?> pc/s</td>
                                            <td><?=$result['status']?></td>
                                            
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once 'templates/admin_footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="js/sweetalert.js"></script>
    <?php 
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

    ?>
    <script>
        swal({
    title: "<?php echo $_SESSION['status']; ?>",
    icon: "<?php echo $_SESSION['status-code']; ?>",
    button: "DONE",
    });
    </script>
    <?php
    unset($_SESSION['status']);
    }
    ?>

</body>

</html>