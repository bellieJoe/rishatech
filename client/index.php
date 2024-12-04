<!DOCTYPE html>
<html lang="en">
<?php
require_once 'components/head.php';
?>

<body>

    <!-- Navigation -->
    <?php
    require_once 'components/navbar.php';

    ?>
    
    <!-- Login Section -->
    <section class="login-section bg-light py-5">
        <div class="container">
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
                            <form action="../client/login.php" method="post">
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="../admin/js/sb-admin-2.min.js"></script>
</body>
</html>
