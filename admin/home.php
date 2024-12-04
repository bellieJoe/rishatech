<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RISHATECH (Admin Login)</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">RISHATECH (Admin Login)</h1>
                                    </div>
                                    <form action="./login" method="POST" class="user">
                                        <!-- Include CSRF token as a hidden input field -->
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                                        </div>

                                        <!-- Checkbox for terms and conditions -->
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="accept_terms" required> I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Data Privacy Notice</a>.
                                            </label>
                                        </div>

                                        <!-- Login Button -->
                                        <button class="btn btn-primary btn-user btn-block" name="admin_login">Login</button>
                                        <hr>
                                    </form>
                                    
                                    <div class="text-center">
                                        <a class="small" href="index.php?route=forgotpword">Forgot Password?</a>
                                    </div>
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    <!-- Modal for Data Privacy Notice -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Data Privacy Notice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Subject: Data Privacy Compliance Update</h5>
                    <p>Date: <?php echo date('M d, Y'); ?></p>
                    <p>Notice: As part of our commitment to safeguarding customer information, this notice serves to remind all staff of our data privacy policies and procedures. Please ensure that all customer data is handled in accordance with applicable laws and regulations, including the Data Protection Act.</p>
                    <ul>
                        <li><strong>Data Collection:</strong> Only collect personal data necessary for business operations and inform customers about how their data will be used.</li>
                        <li><strong>Data Access:</strong> Access to personal data is restricted to authorized personnel only. Ensure that passwords and access controls are updated regularly.</li>
                        <li><strong>Data Storage:</strong> Securely store personal data and regularly review data retention policies to ensure information is not kept longer than necessary.</li>
                        <li><strong>Data Breaches:</strong> Report any suspected data breaches immediately to the data protection officer. Prompt action is crucial to mitigate potential risks.</li>
                        <li><strong>Training:</strong> Attend regular training sessions on data privacy best practices and updates to ensure compliance across all levels of the organization.</li>
                    </ul>
                    <p>Thank you for your attention to this important matter. For questions or further information regarding data privacy policies, please contact the data protection officer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


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
    unset($_SESSION['admin_email']);
    }
    ?>

</body>

</html>