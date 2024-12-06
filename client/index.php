<?php
include_once '../app/config/constants.php';

session_start();
// echo $_SESSION['message'];
if(isset($_SESSION['user'])) {

    header("Location: ".BASE_URL."/client/dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php'; ?>

<body>

<div class="vh-100 d-flex flex-column ">
    <!-- Navigation -->
    <?php require_once 'components/navbar.php';?>

    <!-- Login Section -->
    <section class="login-section bg-light py-5 h-100 ">
        <div class="container ">
            <?php include './components/error-alert.php'; ?>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="text-center">
                        <h3 class="mb-3 font-weight-bold text-primary">Welcome Back Client!</h3>
                        <p class="lead">Access your account to manage your sales and credits.</p>
                        <p class="lead mb-4">Don't have an account? <a href="./registration.php">Register</a></p>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Login</h2>
                            <form action="../app/formController.php" method="POST">
                                
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button name="ClientLogin" type="submit" class="btn btn-primary btn-block">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    
</body>
<!-- scripts -->
<script src="../admin/vendor/jquery/jquery.min.js"></script>
<script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../admin/js/sb-admin-2.min.js"></script>
<script src="../admin/vendor/chart.js/Chart.min.js"></script>
<script src="../admin/js/sweetalert.js"></script>

</html>




