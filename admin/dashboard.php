<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php require_once 'templates/admin_header.php'; ?>

<style>
    /* Center cards and rows */
    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap; /* Allow wrapping if cards overflow */
        gap: 20px; /* Add consistent spacing between cards */
    }

    /* Card styling */
    .card {
        margin: 10px; /* Ensure spacing for smaller screens */
    }

    /* Floating button for larger screens */
    .floating-container {
        position: fixed;
        top: 20%;
        right: 20px;
        width: 300px;
        z-index: 100;
    }

    /* Adjust floating button for smaller screens */
    @media (max-width: 767.98px) {
        .floating-container {
            position: static;
            width: 100%;
            margin-top: 20px;
        }
    }
</style>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Cards Section -->
                    <div class="row center-content">

                        <!-- Appliances Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Items</div>
                                            <?php
                                            $status = 'Available';
                                            $countAllAppliances = $db->countAllAppliances($status);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $countAllAppliances; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customers Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customers</div>
                                            <?php
                                            $countAllCustomers = $db->countAllCustomers();
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $countAllCustomers; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reports Card -->
                        <div class="col-xl-3 col-md-6">
                            <a href="financial_reports.php" style="text-decoration: none;">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Reports</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $countAllAppliances; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                    <!-- Chart Section -->
                    <div class="row center-content">
                        <!-- Area Chart -->
                        <div class="col-xl-5 col-lg-7">
                            <div class="card shadow mb-4 border-0 rounded-lg">
                                <div class="card-header py-3 bg-gradient-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Total Sales Per Month</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr class="my-4">
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-5 col-lg-7">
                            <div class="card shadow mb-4 border-0 rounded-lg">
                                <div class="card-header py-3 bg-gradient-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Cash & Credit</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <hr class="my-4">
                                    <p class="text-muted">Total of how many paid in Cash and in Credit</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-xl-10 col-lg-12">
                            <div class="card shadow mb-4 border-0 rounded-lg">
                                <div class="card-header py-3 bg-gradient-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Total Sales by Item</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                

</body>

</html>

<!-- /.container-fluid -->


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
    <script src="vendor/chart.js/Chart.min.js"></script>


    <?php
   
    $status = 'FULLY PAID';

    $salesByMonthYear = $db->selectAllSales_FULLYPaid_AreaChart($status);
    

    // Prepare sales data and labels for the chart
    $salesData = [];
    $labels = [];
    foreach ($salesByMonthYear as $row) {
        $salesData[] = $row['total_sales']; // Total sales
        $labels[] = $row['month_year']; // Month and Year (e.g., "Jan 2024")
    }

    // Convert PHP arrays to JSON format for JavaScript
    $salesDataJson = json_encode($salesData);
    $labelsJson = json_encode($labels);
        ?>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    
    // Use the labels and sales data from PHP
    var labels = <?php echo $labelsJson; ?>;
    var salesData = <?php echo $salesDataJson; ?>;

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels, // Use dynamically generated month-year labels
            datasets: [{
                label: "Total Sales",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: salesData, // Use the sales data from PHP
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12 // Display a maximum of 12 months on the x-axis
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value, index, values) {
                            return '₱' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ₱' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<?php
$status = 'FULLY PAID';

// Fetch data from the database
$salesByMonthYear = $db->selectAllSales_FULLYPaid_AreaChart($status);

// Initialize arrays for labels and data
$labels = [];
$salesData = [];

// Validate and populate arrays
if (!empty($salesByMonthYear)) {
    foreach ($salesByMonthYear as $row) {
        // Handle null or empty values by providing defaults
        $monthYear = !empty($row['month_year']) ? $row['month_year'] : 'Unknown';
        $totalSales = !empty($row['total_sales']) ? $row['total_sales'] : 0;

        $labels[] = $monthYear;
        $salesData[] = $totalSales;
    }
}

// Fallback for empty data
if (empty($labels)) {
    $labels[] = 'No Data';
    $salesData[] = 0;
}

// Convert PHP arrays to JSON format for JavaScript
$labelsJson = json_encode($labels);
$salesDataJson = json_encode($salesData);
?>

<script>
    // Chart.js global default settings
    Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Parse PHP data into JavaScript
    var labels = <?php echo $labelsJson; ?>;
    var salesData = <?php echo $salesDataJson; ?>;

    // Filter out any null or undefined values
    labels = labels.filter(label => label !== null && label !== undefined);
    salesData = salesData.filter(data => data !== null && data !== undefined);

    // Ensure fallback values for empty arrays
    if (labels.length === 0) {
        labels = ['No Data'];
    }
    if (salesData.length === 0) {
        salesData = [0];
    }

    // Prepend descriptive text to labels
    var updatedLabels = labels.map(function(label) {
        return 'Total Paid of ' + label;
    });

    // Create the doughnut chart
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: updatedLabels, // Updated labels
            datasets: [{
                data: salesData, // Dynamic data
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'], // Colors for slices
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'], // Hover colors
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var datasetLabel = data.labels[tooltipItem.index] || '';
                        var value = data.datasets[0].data[tooltipItem.index] || 0;
                        return datasetLabel + ': ₱' + value.toLocaleString(); // Format as currency
                    }
                }
            },
            legend: {
                display: false // Set to true if legend display is needed
            },
            cutoutPercentage: 80, // Doughnut size
        },
    });
</script>



<?php
$status = 'FULLY PAID';

// Fetch data from the database
$paymentCounts = $db->selectAllSales_WHERE_APPLIANCES($status);

// Initialize arrays for appliances and prices
$applianceNames = [];
$totalPrices = [];

// Validate and populate arrays
if (!empty($paymentCounts)) {
    foreach ($paymentCounts as $row) {
        $applianceName = !empty($row['appliances_name']) ? $row['appliances_name'] : 'Appliances';
        $totalPrice = !empty($row['total_price']) ? $row['total_price'] : 0;

        $applianceNames[] = $applianceName;
        $totalPrices[] = $totalPrice;
    }
}

// Fallback for empty data
if (empty($applianceNames)) {
    $applianceNames[] = 'No Data';
    $totalPrices[] = 0;
}

// Convert PHP arrays to JSON format for JavaScript
$applianceNamesJson = json_encode($applianceNames);
$totalPricesJson = json_encode($totalPrices);
?>

<script>
    // Get the canvas element
    var ctx = document.getElementById("myBarChart").getContext('2d');

    // Parse PHP data into JavaScript
    var applianceNames = <?php echo $applianceNamesJson; ?>;
    var totalPrices = <?php echo $totalPricesJson; ?>;

    // Filter out any null or undefined values (just in case)
    applianceNames = applianceNames.filter(name => name !== null && name !== undefined);
    totalPrices = totalPrices.filter(price => price !== null && price !== undefined);

    // Handle fallback for empty arrays
    if (applianceNames.length === 0) {
        applianceNames = ['No Data'];
        totalPrices = [0];
    }

    // Create the horizontal bar chart
    var myBarChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: applianceNames,
            datasets: [{
                label: 'Total Price',
                data: totalPrices,
                backgroundColor: 'rgba(78, 115, 223, 0.6)', // Bar color
                borderColor: 'rgba(78, 115, 223, 1)', // Border color
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y', // Horizontal bar chart
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) { 
                            // Format as currency with "K" for thousands
                            if (value >= 1000) {
                                return '₱' + (value / 1000).toFixed(1) + 'K';
                            } else {
                                return '₱' + value;
                            }
                        }
                    }
                }],
                yAxes: [{
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                }]
            },
            legend: { display: false }, // Hide legend if unnecessary
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var value = tooltipItem.xLabel;
                        // Format tooltip as currency with "K" for thousands
                        if (value >= 1000) {
                            return 'Total: ₱' + (value / 1000).toFixed(1) + 'K';
                        } else {
                            return 'Total: ₱' + value;
                        }
                    }
                }
            }
        }
    });
</script>

<!-- SweetAlert for Notifications -->
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

