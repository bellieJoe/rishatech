<?php
   session_start();

   include_once '../app/config/constants.php';
   include_once '../db_connection/config.php';
   include_once '../paymongo.php';

   $db = new Database();

   if(!isset($_SESSION['user'])) {
       header("Location: ".BASE_URL."/client/index.php");
       exit();
   }

?>

<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php require_once './templates/client_header.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php require_once 'templates/client_sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once 'templates/client_topbar.php'; ?>
                <div class="container-fluid">
                    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                    </div> -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-4">
                                    <img src="<?= $_SESSION['user']['image'] ? '../app/'.$_SESSION['user']['image'] : 'https://api.dicebear.com/9.x/bottts/svg?seed='.$_SESSION['user']['full_name'] ?>" class="img-thumbnail rounded-circle d-block mx-auto mb-2" width="150" alt="Profile Picture">
                                    <button class="btn btn-primary btn-sm mx-auto d-block" data-toggle="modal" data-target="#changeImageModal">Change</button>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-selected="false">Edit Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-selected="false">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content" >
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                                    <dl class="p-3 row">
                                        <dt class="col-sm-3">Username :</dt>
                                        <dd class="col-sm-9"><?= $_SESSION['user']['username'] ?></dd>
                                        <dt class="col-sm-3">Full Name :</dt>
                                        <dd class="col-sm-9"><?= $_SESSION['user']['full_name'] ?></dd>
                                        <dt class="col-sm-3">Email :</dt>
                                        <dd class="col-sm-9"><?= $_SESSION['user']['email'] ?></dd>
                                        <dt class="col-sm-3">Citizenship :</dt>
                                        <dd class="col-sm-9"><?= $_SESSION['user']['citizenship'] ?></dd>
                                        <dt class="col-sm-3">Phone Number :</dt>
                                        <dd class="col-sm-9"><?= $_SESSION['user']['phone_number'] ?></dd>
                                        <dt class="col-sm-3">Address :</dt>
                                        <dd class="col-sm-9"><?= $_SESSION['user']['street_name'].', '.$_SESSION['user']['barangay'].', '.$_SESSION['user']['municipality'].', Marinduque' ?></dd>
                                    </dl>
                                </div>
                                <div class="tab-pane fade" id="edit-profile" role="tabpanel">
                                    <div class=" p-3">
                                        <form action="../app/formController.php" method="POST">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" value="<?= $_SESSION['user']['username'] ?>" />
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $_SESSION['user']['email'] ?>" />
                                            </div>
                                            <div class="mb-2">
                                                <button type="submit" class="btn btn-primary" name="edit_profile">Save</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="change-password" role="tabpanel">
                                    <div class="p-3">
                                    <form action="../app/formController.php" method="POST">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Old Password</label>
                                                <input type="password" class="form-control" name="old_password"  />
                                            </div>
                                            <hr>
                                            <div class="mb-2">
                                                <label for="" class="form-label">New Password</label>
                                                <input type="password" class="form-control" name="new_password"  />
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" name="confirm_new_password"  />
                                            </div>
                                            <div class="mb-2">
                                                <button type="submit" class="btn btn-primary" name="change_password">Save</button>
                                            </div> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Change Image Modal -->
    <div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-labelledby="changeImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeImageModalLabel">Change Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../app/formController.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="profileImage">Upload New Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept=".png, .jpeg, .jpg" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="uploadImage">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<!-- scripts -->
<script src="../admin/vendor/jquery/jquery.min.js"></script>
<script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../admin/js/sb-admin-2.min.js"></script>
<script src="../admin/vendor/chart.js/Chart.min.js"></script>
<script src="../admin/js/sweetalert.js"></script>
<!-- Custom styles for this page -->
<link href="../admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<?php 
if (isset($_SESSION['message']) && $_SESSION['message']['message'] != '') {
?>
<script>
    swal({
        title: "<?php echo $_SESSION['message']['message']; ?>",
        icon: "<?php echo $_SESSION['message']['status']; ?>",
        button: "DONE",
    });
</script>
<?php
    unset($_SESSION['message']);
}
?>


