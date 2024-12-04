
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
                    <h1 class="h3 mb-2 text-gray-800">Discounts & Promotions</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddDiscountPromotion">
                      Add Discount/Promotions
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="AddDiscountPromotion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Discounts & Promotions</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="forms_code.php" method="post">
                                    <!-- Include CSRF token as a hidden input field -->
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                                    <div class="modal-body">

                                        <div class="form-group">
                                          <label for="name">Discounts & Promotions Name</label>
                                          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="Type">Type</label>
                                            <select class="form-control" name="type_of_discount" id="Type" required>
                                                <option disabled>----------SELECT TYPE---------</option>
                                                <option value="Promotion">Promotion</option>
                                                <option value="Discount">Discount</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                          <label for="downpayment_percentage">Downpayment Percentage</label>
                                          <input type="number" name="downpayment_percentage" id="downpayment_percentage" class="form-control" placeholder="Enter Downpayment Percentage">
                                        </div>

                                        <div class="form-group">
                                          <label for="interest_percentage">Interest Percentage</label>
                                          <input type="number" name="interest_percentage" id="interest_percentage" class="form-control" placeholder="Enter Interest Percentage">
                                        </div>

                                        <div class="form-group">
                                          <label for="eligible">Eligible For</label>
                                          <input type="text" name="eligible" id="eligible" class="form-control" placeholder="e.g: All Customers">
                                        </div>

                                        <div class="form-group">
                                          <label for="start_date">Start Date</label>
                                          <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Enter Start Date">
                                        </div>

                                        <div class="form-group">
                                          <label for="end_date">End Date</label>
                                          <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Enter End Date">
                                        </div>

                                        <div class="form-group">
                                          <label for="terms">Terms</label>
                                          <input type="text" name="terms" id="terms" class="form-control" placeholder="Enter Terms">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button name="Add_Discounts" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Discounts & Promotions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Discount/Promotion Name</th>
                                            <th>Type</th>
                                            <th>Downpayment Discount Percentage</th>
                                            <th>Interest Discount Percentage</th>
                                            <th>Eligible For</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Terms</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selectAllDiscountsPromotions = $db->selectAllDiscountsPromotions();
                                        $currentDate = date('Y-m-d'); // Get today's date in Asia/Manila timezone

                                        foreach ($selectAllDiscountsPromotions as $key) {
                                            // Determine the status based on start and end dates
                                            if ($currentDate < $key['start_date']) {
                                                $status = 'Upcoming';
                                            } elseif ($currentDate > $key['end_date']) {
                                                $status = 'Expired';
                                            } else {
                                                $status = 'Active'; // If the current date is between start and end dates
                                            }
                                        ?>
                                            <tr>
                                                <td><?=$key['name']?></td>
                                                <td><?=$key['type_of_discount']?></td>
                                                <td><?php echo htmlspecialchars($key['downpayment_percentage'] * 100) . '%'; ?></td>
                                                <td><?php echo htmlspecialchars($key['interest_percentage'] * 100) . '%'; ?></td>
                                                <td><?=$key['eligible']?></td>
                                                <td><?php echo (new DateTime($key['start_date']))->format('M d, Y'); ?></td>
                                                <td><?php echo (new DateTime($key['end_date']))->format('M d, Y'); ?></td>
                                                <td><?=$key['terms']?></td>
                                                <td><?=$status?></td> <!-- Display the determined status -->
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#EditDiscount_<?=$key['id']?>">Edit</button>

                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteDiscount_<?=$key['id']?>">Delete</button>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="EditDiscount_<?=$key['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Discounts & Promotions</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="forms_code.php" method="post">
                                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                                    <input type="hidden" name="discount_id" value="<?=$key['id']?>">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="name">Discounts & Promotions Name</label>
                                                                            <input type="text" name="name" id="name" class="form-control" value="<?=$key['name']?>" placeholder="Enter Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="Type">Type</label>
                                                                            <select class="form-control" name="type_of_discount" id="Type" required>
                                                                                <option disabled>----------SELECT TYPE---------</option>
                                                                                <option value="Promotion" <?= $key['type_of_discount'] === 'Promotion' ? 'selected' : '' ?>>Promotion</option>
                                                                                <option value="Discount" <?= $key['type_of_discount'] === 'Discount' ? 'selected' : '' ?>>Discount</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="downpayment_percentage">Downpayment Percentage</label>
                                                                            <input type="number" name="downpayment_percentage" id="downpayment_percentage" class="form-control" value="<?=$key['downpayment_percentage'] * 100?>" placeholder="Enter Downpayment Percentage">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="interest_percentage">Interest Percentage</label>
                                                                            <input type="number" name="interest_percentage" id="interest_percentage" class="form-control" value="<?=$key['interest_percentage'] * 100?>" placeholder="Enter Interest Percentage">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="eligible">Eligible For</label>
                                                                            <input type="text" name="eligible" id="eligible" class="form-control" value="<?=$key['eligible']?>" placeholder="e.g: All Customers">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="start_date">Start Date</label>
                                                                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?=$key['start_date']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="end_date">End Date</label>
                                                                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?=$key['end_date']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="terms">Terms</label>
                                                                            <input type="text" name="terms" id="terms" class="form-control" value="<?=$key['terms']?>" placeholder="Enter Terms">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button name="Edit_Discounts" class="btn btn-primary">Save Changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="DeleteDiscount_<?=$key['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Discount/Promotion</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this discount/promotion?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="forms_code.php" method="post">
                                                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                                        <input type="hidden" name="discount_id" value="<?=$key['id']?>">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button name="Delete_Discount" class="btn btn-danger">Delete</button>
                                                                    </form>
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


    <script>
        // Get references to the payment type select element and the months to pay container
        var paymentTypeSelect = document.getElementById('payment_type');
        var monthsToPayContainer = document.getElementById('months_to_pay_container');
        var monthsToPaySelect = document.getElementById('months_to_pay');

        // Add event listener to the payment type select
        paymentTypeSelect.addEventListener('change', function() {
            if (this.value === 'Credit') {
                // Show the Months To Pay dropdown if Credit is selected
                monthsToPayContainer.style.display = 'block';
                monthsToPaySelect.setAttribute('required', 'required'); // Make it required
            } else {
                // Hide the Months To Pay dropdown if Cash is selected
                monthsToPayContainer.style.display = 'none';
                monthsToPaySelect.removeAttribute('required'); // Remove the required attribute
            }
        });
    </script>


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