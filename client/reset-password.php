<?php
include_once '../app/config/constants.php';
include_once "../db_connection/config.php";

$db = new Database();

session_start();

if (!isset($_GET['token'])) {
    $_SESSION['message'] = [
        "status" => "error",
        "message" => "No token provided."
    ];
    header("Location: " . BASE_URL . "/client/index.php");
    exit();
} 

$user = $db->getUserById($_GET['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'components/head.php'; ?>

<body>
<!-- Navigation -->
<?php require_once 'components/navbar.php'; ?>

    <section class="reset-password-section bg-light vh-100 pt-5">
        <div class="container ">
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body p-4">
                    <h4>Reset Your Password</h4>
                    <form action="../app/formController.php" method="POST">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_GET['user_id']); ?>">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button name="resetPassword" type="submit" class="btn btn-success w-100">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- scripts -->
<script src="../admin/vendor/jquery/jquery.min.js"></script>
<script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../admin/js/sb-admin-2.min.js"></script>
<script src="../admin/vendor/chart.js/Chart.min.js"></script>
<script src="../admin/js/sweetalert.js"></script>


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
</html>
