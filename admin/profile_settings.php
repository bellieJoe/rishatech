<?php
$admin_id = $_SESSION['auth_user']['admin_id'];

$selectAdmin_id = $db->selectAdmin_id($admin_id);

?>


<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php
require_once 'templates/admin_header.php';
?>

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
                    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd_Admin">
                      Add Profile
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modalAdd_Admin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="forms_code.php" method="post" class="user">
                                    <!-- Include CSRF token as a hidden input field -->
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                    <div class="modal-body">

                                        <div class="container-fluid">
<div class="form-group">
    <label for="type">Select Type</label>
    <select class="form-control" name="type" id="type" required>
        <option value="" disabled selected>Select an option</option>
        <option value="admin">Admin</option>
        <option value="branch_manager">Branch Manager</option>
    </select>

                                            </div>
                                            <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required>
                                            </div>
                                            <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter Full Name" required>
                                            </div>
                                            <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                                            </div>
                                            <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button name="register_admin" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <br><br>

                    <div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
    <div class="card-body">
        <div class="account-settings">
            <div class="user-profile">
                <div class="user-avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-circle img-thumbnail isTooltip" alt="ADMIN PROFILE">
                </div>
                <h5 class="user-name"><?=$selectAdmin_id['username']?></h5>
                <h6 class="user-email"><?=$selectAdmin_id['email']?></h6>
            </div>
            <!-- <div class="about">
                <h5>Information</h5>
                <p>Phone Number:</p>
                <p>Address: </p>
            </div> -->
        </div>
    </div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">

    <form action="forms_code.php" method="POST">
        <!-- Include CSRF token as a hidden input field -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

        <div class="card-body">

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Update Information</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" name="username" class="form-control" id="uname" value="<?=$selectAdmin_id['username']?>" placeholder="Enter Username" required>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fname">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="fname" value="<?=$selectAdmin_id['full_name']?>" placeholder="Enter Full Name" required>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <button name="updateAdminInfo" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <hr>

    <form action="./updatepwrd" method="POST">

    <!-- Include CSRF token as a hidden input field -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="card-body">

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mt-3 mb-2 text-primary">Change Password</h6>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="Current_Password">Current Password</label>
                    <input type="password" name="currentPassword" class="form-control" id="Current_Password" placeholder="Enter Current Password" required>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="newPassword" class="form-control" id="new_password" placeholder="Enter New Password" required>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                </div>
            </div>
        </div>
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">
                    <button name="updateAdminPassword" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    
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