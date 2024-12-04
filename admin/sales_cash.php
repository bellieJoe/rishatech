
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
                    <h1 class="h3 mb-2 text-gray-800">Cash</h1>

                    
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCustomer">
                      Add Customer
                    </button>

                    
                    <div class="modal fade" id="AddCustomer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Appliances</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="forms_code.php" method="post">
                                    
                                
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                                    <div class="modal-body">

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
                                            <label for="appliances">Appliances</label>
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
                                          <label for="qty">Quantity</label>
                                          <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter Quantity">
                                        </div>

                                        <div class="form-group">
                                            <label for="discount">Promotion Applied/Discount</label>
                                            <select class="form-control" name="discount" id="discount" required>
                                                <option disabled>----------SELECT DISCOUNT---------</option>
                                                <option value="No Discount">No Discount/Promotion Applied</option>
                                                <option value="No Downpayment">No Downpayment</option>
                                                <option value="No Interest">No Interest</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_type">Payment Type</label>
                                            <select class="form-control" name="payment_type" id="payment_type" required>
                                                <option disabled selected>----------SELECT PAYMENT TYPE---------</option>
                                                <option value="Credit">Credit</option>
                                                <option value="Cash">Cash</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="months_to_pay">Months To Pay</label>
                                            <select class="form-control" name="months_to_pay" id="months_to_pay" required>
                                                <option disabled selected>----------SELECT MONTHS TO PAY---------</option>
                                                <option value="3">3 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="9">9 Months</option>
                                                <option value="12">12 Months</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button name="Add_Sales" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->


                    <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Cash</h6>
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
                                            <th>Promotion/Discount Applied</th>
                                            <th>Payment Type</th>
                                            <th>Payment Method</th>
                                            <th>Transaction/References No.#</th>
                                            <th>Status</th>
                                            <th>Receipts</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $payment_type = 'Cash';
                                        
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
                                            <td><?=$key['sales_status']?></td>
                                            <td>
                                                <?php
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
                                                                    <button name="upload_receipts" class="btn btn-primary">Upload</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }else{
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