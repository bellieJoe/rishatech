
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
                    <h1 class="h3 mb-2 text-gray-800">Sales</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCustomer">
                      New Customer Sales
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="AddCustomer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Items New Customer Sales</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="forms_code.php" method="post">
                                    <!-- Include CSRF token as a hidden input field -->
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                                    <div class="modal-body" style="overflow-y: auto; height: 400px;">

                                        <div class="form-group">
                                            <label for="customer">Customer</label>
                                            <select class="form-control" name="customer" id="customer" required>
                                                <option disabled selected>----------SELECT CUSTOMER---------</option>
                                                <?php
                                                $selectAllCustomers = $db->selectAllCustomers();

                                                foreach ($selectAllCustomers as $key) {
                                                ?>
                                                <option value="<?=$key['id']?>"><?=$key['full_name']?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="appliances">Appliances And Amount</label>
                                            <select class="form-control" name="appliances" id="appliances" required>
                                                <option disabled selected>----------SELECT APPLIANCES---------</option>
                                                <?php
                                                $selectAllappliances = $db->selectAllappliances();

                                                foreach ($selectAllappliances as $key) {
                                                ?>
                                                <option value="<?=$key['AppliancesID']?>"><?=$key['appliances_name']?> - ₱<?= number_format($key['price'], 2) ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                          <label for="qty">Units</label>
                                          <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter Units">
                                        </div>
<div class="form-group">
                                            <label for="payment_type">Payment Type</label>
                                            <select class="form-control" name="payment_type" id="payment_type" required>
                                                <option disabled selected>----------SELECT PAYMENT TYPE---------</option>
                                               <option value="Cash">CASH</option>
											   <option value="Credit">CREDIT</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount">Promotion or Discount Applied</label>
                                            <select class="form-control" name="discount" id="discount" required>
                                                <option disabled>----------SELECT DISCOUNT---------</option>
                                                <option value="No Discount" selected>No Promotion or Discount Applied</option>
                                                <option value="No Downpayment">No Downpayment</option>
                                                <option value="No Interest">No Interest</option>
                                                <?php
                                                // Fetch all discounts and promotions
                                                $selectAllDiscountsPromotions = $db->selectAllDiscountsPromotions();
                                                $currentDate = date('Y-m-d'); // Get today's date

                                                foreach ($selectAllDiscountsPromotions as $discount) {
                                                    // Check if the discount is active based on the current date
                                                    if ($currentDate >= $discount['start_date'] && $currentDate <= $discount['end_date']) {
                                                        // Only show the discount if it is active
                                                        echo '<option value="' . $discount['id'] . '">' . $discount['name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

  <div class="form-group" id="months_to_pay_container" style="display: none;">
                                            <label for="months_to_pay">Installment Plan</label>
                                            <select class="form-control" name="months_to_pay" id="months_to_pay">
                                                <option disabled selected>----------SELECT MONTHS TO PAY---------</option>
                                                <option value="3">3 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="9">9 Months</option>
                                                <option value="12">12 Months</option>
												<option value="18">18 Months</option>
												<option value="24">24 Months</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_method">Payment Method</label>
                                            <select class="form-control" name="payment_method" id="payment_method" required>
                                                <option disabled selected>----------SELECT PAYMENT METHOD---------</option>
                                                <option value="CASH">CASH</option>
                                                <option value="GCASH">GCASH</option>
                                               
                                            </select>
                                        </div>

                                        <!-- Transaction Number Field (Initially Hidden) -->
                                        <div class="form-group" id="transaction_number_group" style="display: none;">
                                            <label for="transaction_number">Transaction Number</label>
                                            <input type="number" name="transaction_number" id="transaction_number" class="form-control" placeholder="Enter Transaction Number">
                                        </div>

                                        

                                      

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button name="Add_Sales" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Sales</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            
                                            <th>Date of Avail</th>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Unit</th>
                                            <th>Total Sales</th>
                                            <th>Promotion or Discount Applied</th>
                                            <th>Payment Type</th>
                                            <th>Payment Method</th>
                                            <th>Transaction/References No.#</th>
                                            <th>Receipt</th>
                                            <th>Customer Name</th>
                                            <th>Downpayment</th>
                                            <th>Monthly Payment</th>
                                            <th>Interest Rate</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $selectAllSales = $db->selectAllSales();

                                        foreach($selectAllSales AS $key){
                                        ?>
                                        <tr>
                                        
                                            <td><?= date("M d, Y", strtotime($key['date_created'])) ?></td>
                                            <td><?=$key['appliances_name']?></td>
                                            <td><?=$key['cat_name']?></td>
                                            <td><?=$key['sales_qty']?> <?=$key['unit_measurement']?></td>
                                            <td>₱ <?= number_format($key['total_sales'], 2) ?></td>
                                            <td>
                                                <?php
                                                $discountPromotion = $key['discount_promotion'];

                                                // Check if the discount promotion is numeric
                                                if (is_numeric($discountPromotion)) {
                                                    // Fetch the discount promotion details based on the ID
                                                    $selectDiscount_WHEREid = $db->selectDiscount_WHEREid($discountPromotion);
                                                    
                                                    // Echo the name of the discount promotion
                                                    echo htmlspecialchars($selectDiscount_WHEREid['name']);
                                                } else {
                                                    // If not numeric, echo the value directly
                                                    echo htmlspecialchars($discountPromotion);
                                                }
                                                ?>
                                            </td>
                                            <td><?=$key['payment_type']?></td>
                                            <td><?=$key['payment_method']?></td>
                                            <td><?=$key['transaction_number']?></td>
                                            <td>
                                                <?php
                                                if ($key['payment_method'] != 'CASH') {
                                                    if (!empty($key['cash_receipt'])) {
                                                        // Show the image in a modal if payment type is Cash and cash receipt exists
                                                        ?>
                                                        <img class="img-thumbnail" src="<?=$key['cash_receipt']?>" alt="Receipt Img" data-toggle="modal" data-target="#ModalReceipt_view<?=$key['Sales_Id']?>">

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="ModalReceipt_view<?=$key['Sales_Id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Receipt Image</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <!-- Displaying the image with fixed size -->
                                                                        <img src="<?=$key['cash_receipt']?>" alt="Receipt Image" style="width: 100%; max-width: 500px; height: auto;" class="img-fluid">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        // Show badge if payment type is Cash but no receipt is uploaded
                                                        echo '<span class="badge badge-danger">No Cash Receipt Uploaded</span>';
                                                    }
                                                } else {
                                                    echo '<span class="badge badge-success">No Receipt For CASH payment method</span>';
                                                }
                                                
                                                ?>
                                            </td>
                                            <td><?=$key['full_name']?></td>
                                            <td>₱ <?= number_format($key['downpayment'], 2) ?></td>
                                            <td>₱ <?= number_format($key['monthly_payment'], 2) ?></td>
                                            <td>₱ <?= number_format($key['interest_rate'], 2) ?></td>
                                            <td><?=$key['sales_status']?></td>
                                            
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

    <script>
    $(document).ready(function() {
        // Show or hide the transaction number field based on payment method selection
        $('#payment_method').change(function() {
            var paymentMethod = $(this).val();
            if (paymentMethod !== 'CASH') {
                $('#transaction_number_group').show();  // Show if payment method is not 'CASH'
            } else {
                $('#transaction_number_group').hide();  // Hide if payment method is 'CASH'
            }
        });
    });
</script>


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