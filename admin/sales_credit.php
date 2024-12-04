
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
                    <h1 class="h3 mb-2 text-gray-800">Credit</h1>


                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Credits</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Date of Avail</th>
                                            <th>Customer Name</th>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Unit</th>
                                            <th>Total Sales</th>
                                            <th>Promotion Applied/Discount</th>
                                            <th>Payment Type</th>
                                            <th>Payment Method</th>
                                            <th>Transaction/References No.#</th>
                                            <th>Receipt</th>
                                            <th>Months To Pay</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $payment_type = 'Credit';
                                        
                                        $selectAllSales_PaymentType = $db->selectAllSales_PaymentType($payment_type);

                                        foreach($selectAllSales_PaymentType AS $key){
                                        ?>
                                        <tr>
                                          
                                            <td><?= date("M d, Y", strtotime($key['date_created'])) ?></td>
                                            <td><?=$key['full_name']?></td>
                                            <td><?=$key['appliances_name']?></td>
                                            <td><?=$key['cat_name']?></td>
                                            <td><?=$key['sales_qty']?> <?=$key['unit_measurement']?></td>
                                            <td>₱ <?= number_format($key['total_sales'], 2) ?></td>
                                            <td><?=$key['discount_promotion']?></td>
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
                                            <td><?=$key['months_to_pay']?></td>
                                            <td><?=$key['sales_status']?></td>
                                            <td>
                                                <?php
                                                $sales_id = $key['Sales_Id'];
                                                $count_total_credit_payments = $db->count_total_credit_payments($sales_id);

                                                // Check if the number of payments made is less than months_to_pay
                                                if ($count_total_credit_payments > 0) {
                                                    // Display the Payment button if payments made are less than months_to_pay
                                                    ?>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InsertPayment_<?=$key['Sales_Id']?>">
                                                        Payment
                                                    </button>
                                                    <?php
                                                } else {
                                                    $sales_id = $key['Sales_Id'];
                                                    $status1 = 'FULLY PAID';

                                                    $updateSales_fully_paid = $db->updateSales_fully_paid1($status1, $sales_id);

                                                    if ($updateSales_fully_paid) {
                                                        // Optionally, display a message or do nothing if the payment button is hidden
                                                        echo '<span class="badge badge-success">Fully Paid</span>';
                                                    
                                                    }
                                                }
                                                ?>

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ViewPayment_<?=$key['Sales_Id']?>">
                                                  View Payment
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="InsertPayment_<?=$key['Sales_Id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="paymentModalLabel">Record Monthly Payment</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="forms_code.php" method="POST">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                <input type="hidden" name="sales_id" value="<?=$key['Sales_Id']?>">
                                                                <!-- <input type="hidden" name="customer_id" value="<?=$key['customer_id']?>">

                                                                <input type="hidden" name="date_of_avail" value="<?=$key['date_created']?>">

                                                                <input type="hidden" name="months_to_pay" value="<?=$key['months_to_pay']?>"> -->
                                                                
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="payment_date">Payment Date</label>
                                                                        <input type="date" class="form-control" name="payment_date" min="<?= date('Y-m-d'); ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="amount_paid">Amount Paid</label>
                                                                        <input type="number" class="form-control" name="amount_paid" value="<?=$key['monthly_payment']?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="save_payment" class="btn btn-primary">Save Payment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Payment History Modal -->
                                                <div class="modal fade" id="ViewPayment_<?=$key['Sales_Id']?>" tabindex="-1" aria-labelledby="paymentHistoryModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="paymentHistoryModalLabel">Payment History</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                        <thead>
                                                            <tr>
                                                            <th>Payment Date</th>
                                                            <th>Amount Paid</th>
                                                            <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sales_id = $key['Sales_Id'];
                                                            $selectCreditPayment_WHERE_salesID = $db->selectCreditPayment_WHERE_salesID($sales_id);

                                                            foreach($selectCreditPayment_WHERE_salesID as $payment){
                                                            ?>
                                                            <tr>
                                                                <td><?= date("M d, Y", strtotime($payment['payment_date'])) ?></td>
                                                                <td>₱ <?= number_format($payment['amount_paid'], 2) ?></td>
                                                                <td><?=$payment['payment_status']?></td>
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
                                                <?php
                                                if ($key['payment_method'] != 'CASH') {
                                                if (empty($key['cash_receipt'])) {
                                                ?>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UploadReceipts_<?=$key['Sales_Id']?>">
                                                  Upload Receipt <i class="fa fa-upload"></i>
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="UploadReceipts_<?=$key['Sales_Id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Upload Receipt</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="POST" enctype="multipart/form-data">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                
                                                                <input type="hidden" name="sales_id" value="<?=$key['Sales_Id'];?>">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                      <label for="receipts">Upload Receipt (Image Only)</label>
                                                                      <input type="file" accept="image/*" class="form-control-file" name="receipts" id="receipts" placeholder="Upload Receipts">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="upload_receipts_credit" class="btn btn-primary">Upload</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>

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