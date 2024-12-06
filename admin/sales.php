
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

                    <!-- ADD SALES MODAL -->
                    <div class="modal fade" id="AddCustomer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
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
                                        <div class="row">
                                            <div class="col-sm-5">
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
                                                        <option data-price="<?=$key['price']?>" value="<?=$key['AppliancesID']?>"><?=$key['appliances_name']?> - ₱<?= number_format($key['price'], 2) ?></option>
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
                                            <div class="col-sm-7">
                                                <div id="payment_breakdown">
                                                    <table class="table border">
                                                        <thead class="thead-dark bg-primary text-white">
                                                            <tr>
                                                                <td class="text-center">Payments Breakdown</td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <table class="table table-bordered table-sm" >
                                                        <tbody>
                                                            <tr>
                                                                <td class="w-50"><strong>Total Price</strong></td>
                                                                <td class="w-50" id="total_price">N/A</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50"><strong>Downpayment</strong></td>
                                                                <td class="w-50" id="downpayment">N/A</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table border table-striped" id="monthly_ammortization_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Penalty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
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

</body>



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
        // Cache jQuery selectors
        const $AddCustomer = $('#AddCustomer');
        const $PaymentType = $AddCustomer.find('#payment_type');
        const $Qty = $AddCustomer.find('#qty');
        const $Appliances = $AddCustomer.find('#appliances');
        const $MonthsToPay = $AddCustomer.find('#months_to_pay');
        const $TotalPrice = $AddCustomer.find('#total_price');
        const $DownPayment = $AddCustomer.find('#downpayment');
        const $MonthsToPayContainer = $('#months_to_pay_container');
        const $MonthlyAmmortizationTable = $('#monthly_ammortization_table');
        const $Discount = $('#discount');
        const discounts = <?=json_encode($db->selectAllDiscountsPromotions())?>.filter(discount => new Date(discount.start_date) <= new Date() && new Date(discount.end_date) >= new Date());


        // Event listeners
        $PaymentType.on('change', function() {
            toggleMonthsToPayVisibility();
            renderPaymentBreakdown();
            filterDiscounts();
        });

        $MonthsToPay.on('change', function() {
            renderPaymentBreakdown();
        });

        $Appliances.on('change', function() {
            renderPaymentBreakdown();
        });

        $Qty.on('input', function() {
            renderPaymentBreakdown();
        });

        $Discount.on('change', function() {
            renderPaymentBreakdown();
        })

        function filterDiscounts() {
            // Empty the Discount dropdown
            $Discount.empty();
            
            const paymentType = $PaymentType.val();
            
            // Add a default disabled option
            $Discount.append(`<option disabled>----------SELECT DISCOUNT/PROMOTION----------</option>`);
            
            // Handle Cash Payment type
            if (paymentType === 'Cash') {
                discounts.filter(discount => ['Cash', 'Both'].includes(discount.payment_type)).forEach(discount => {
                    $Discount.append(`<option value="${discount.id}">${discount.name}</option>`);
                });
            } 
            
            // Handle Credit Payment type
            else if (paymentType === 'Credit') {
                // Add hardcoded credit-specific options
                const creditOptions = [
                    { value: "No Downpayment", text: "No Downpayment" },
                    { value: "No Interest", text: "No Interest" },
                    { value: "No Discount", text: "No Promotion or Discount Applied" }
                ];
                
                // Append hardcoded options
                creditOptions.forEach(option => {
                    $Discount.append(`<option value="${option.value}">${option.text}</option>`);
                });
                
                // Append discounts for credit or both payment types
                discounts.filter(discount => ['Credit', 'Both'].includes(discount.payment_type)).forEach(discount => {
                    $Discount.append(`<option value="${discount.id}">${discount.name}</option>`);
                });

                $Discount.val('');
            }
        }


        // Toggle visibility of months_to_pay input
        function toggleMonthsToPayVisibility() {
            if ($PaymentType.val() === 'Credit') {
                $MonthsToPayContainer.show();
                $MonthsToPay.prop('required', true); // Make it required
            } else {
                $MonthsToPayContainer.hide();
                $MonthsToPay.prop('required', false); // Remove required
            }
        }

        // Calculate the total price
        function calculateTotalPrice() {
            const selectedAppliance = $Appliances.find(':selected');
            const price = ($Qty.val() * selectedAppliance.data('price'));
            var cash_discount_percentage = 0;

            if($PaymentType.val() === 'Cash' && $Discount.val() ) {
                cash_discount_percentage = discounts.find(discount => discount.id === $Discount.val()).cash_discount_percentage;
            }

            if($PaymentType.val() === 'Credit' ) {
                var interest = 0.03;

                if($Discount.val() === 'No Discount') {
                    return price + ((price - calculateDownPayment()) * interest);
                }
                if($Discount.val() === 'No Interest') {
                    interest = 0;
                    return price + ((price - calculateDownPayment()) * interest);
                }
                else if(!["No Downpayment", "", null].includes($Discount.val())) {
                    var discount = discounts.find(discount => discount.id === $Discount.val());  
                    interest = discount.interest_percentage;
                    return price + ((price - calculateDownPayment()) * interest);
                }
                return price + ((price - calculateDownPayment()) * interest);
            }

            return price - (price * cash_discount_percentage);
        }

        // Calculate downpayment (25% of total price)
        function calculateDownPayment() {
            const selectedAppliance = $Appliances.find(':selected');
            const price = ($Qty.val() * selectedAppliance.data('price'));
            var downpayment = Math.round(price * 0.25);
            if ($Discount.val() == 'No Downpayment') {
                // No downpayment, apply 3% interest
                return 0;
            } 
            else if(!["No Discount", "No Interest", "", null].includes($Discount.val())) {
              var discount = discounts.find(discount => discount.id === $Discount.val());  
              downpayment = Math.round(price * discount.downpayment_percentage);
            }
            return downpayment;
        }

        // Render the payment breakdown
        function renderPaymentBreakdown() {
            const totalPrice = calculateTotalPrice();
            $TotalPrice.text(`PHP ${totalPrice.toFixed(2)}`);

            if ($PaymentType.val() === 'Credit') {
                renderCreditBreakdown();
            } else {
                renderCashBreakdown();
            }
        }

        // Render breakdown for Credit payment type
        function renderCreditBreakdown() {
            const downPayment = calculateDownPayment();
            $DownPayment.text(`PHP ${downPayment.toFixed(2)}`);
            $MonthlyAmmortizationTable.show();
            renderMonthlyAmmortization();
        }

        // Render breakdown for Cash payment type
        function renderCashBreakdown() {
            $DownPayment.text('N/A');
            $MonthlyAmmortizationTable.hide();
        }

        function renderMonthlyAmmortization() {
            const monthsToPay = parseInt($MonthsToPay.val());
            const totalPrice = calculateTotalPrice();
            const downPayment = calculateDownPayment();
            const monthlyPayment = (totalPrice - downPayment) / monthsToPay;
            let today = new Date();

            // Helper function to get the next month's date
            function getNextMonth(date) {
                const nextMonth = new Date(date);
                nextMonth.setMonth(date.getMonth() + 1);
                return nextMonth;
            }

            // Helper function to format date as "Month Year"
            function formatDate(date) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            }

            // Empty the table body first
            $MonthlyAmmortizationTable.find('tbody').empty();

            // Generate rows for the selected number of months
            for (let i = 0; i < monthsToPay; i++) {
                const dueDate = getNextMonth(today);
                today = new Date(dueDate);  // Update today to the new due date for the next iteration

                // Add a new row for the monthly amortization
                $MonthlyAmmortizationTable.find('tbody').append(`
                    <tr>
                        <td>${formatDate(dueDate)}</td>
                        <td>PHP ${monthlyPayment.toFixed(2)}</td>
                        <td>PHP ${(monthlyPayment * 0.05).toFixed(2)}</td>
                    </tr>
                `);
            }
        }
    });
</script>


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

    $('#payment_method').trigger('change');
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

</html>