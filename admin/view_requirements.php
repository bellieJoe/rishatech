<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['viewkey']) && isset($_GET['fname'])) {
    $customer_id = sanitizeInput($_GET['viewkey']);
    $fname = sanitizeInput($_GET['fname']);
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php require_once 'templates/admin_header.php'; ?>

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once 'templates/admin_sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once 'templates/admin_topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Requirements of <?php echo $fname; ?></h1>
                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Requirements</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID No.#</th>
                                            <th>Valid ID</th>
                                            <th>2 by 2 Picture</th>
                                            <th>Brgy Clearance</th>
                                            <th>Cedula</th>
                                            <th>Proof Of Billing</th>
                                            <th>Application For Credit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $result = $db->selectRequirements($customer_id);

                                        if ($result !== false) {
                                    ?>
                                            <tr>
                                                <td><?= $result['id'] ?></td>
                                                <td><img src="<?= $result['valid_id'] ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="Valid ID"></td>
                                                <td><img src="<?= $result['twoBytwo_pic'] ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="2 By 2 ID Picture"></td>
                                                <td><a href="<?= $result['brgy_clearance'] ?>" target="_blank" class="btn btn-link">Brgy Clearance.pdf</a></td>
                                                <td><a href="<?= $result['cedula'] ?>" target="_blank" class="btn btn-link">Cedula.pdf</a></td>
                                                <td><a href="<?= $result['proof_of_billing'] ?>" target="_blank" class="btn btn-link">Proof of Billing.pdf</a></td>
                                                <td><a href="<?= $result['application_form_credit'] ?>" target="_blank" class="btn btn-link">Application for Credit.pdf</a></td>
                                                <td>
                                                    <!-- Edit Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit_<?= $result['id'] ?>">Edit</button>

                                                    <!-- Delete Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete_<?= $result['id'] ?>">Delete</button>
                                                    
                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="modalEdit_<?= $result['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Requirements</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="forms_code.php" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                                    <input type="hidden" name="req_id" value="<?= $result['id'] ?>">
                                                                    <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
                                                                    <input type="hidden" name="full_name" value="<?= $fname ?>">
                                                                    <div class="modal-body">
                                                                        <!-- Form fields for editing files -->
                                                                        <div class="form-group">
                                                                            <label for="valid_id">Valid ID</label>
                                                                            <input type="file" name="valid_id" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="twoBytwo_pic">2 by 2 Picture</label>
                                                                            <input type="file" name="twoBytwo_pic" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="brgy_clearance">Brgy Clearance</label>
                                                                            <input type="file" name="brgy_clearance" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="cedula">Cedula</label>
                                                                            <input type="file" name="cedula" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="proof_of_billing">Proof Of Billing</label>
                                                                            <input type="file" name="proof_of_billing" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="application_form_credit">Application For Credit</label>
                                                                            <input type="file" name="application_form_credit" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit_requirements" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="modalDelete_<?= $result['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Requirements</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="forms_code.php" method="post">
                                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                                    <input type="hidden" name="req_id" value="<?= $result['id']; ?>">
                                                                    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                                                                    <input type="hidden" name="full_name" value="<?php echo $fname; ?>">
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this requirement?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button name="delete_requirements" class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        } else {
                                            echo "<tr><td colspan='8'>No requirements found for this customer.</td></tr>";
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
            <?php require_once 'templates/admin_footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JavaScript and Plugins -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/sweetalert.js"></script>

    <!-- SweetAlert Notification -->
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
