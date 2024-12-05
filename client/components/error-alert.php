
<?php if (isset($_SESSION['message']['status']) && $_SESSION['message']['status'] == "success") { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?php echo $_SESSION['message']['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } elseif (isset($_SESSION['message']['status']) && $_SESSION['message']['status'] == "error") { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?php echo $_SESSION['message']['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php unset($_SESSION['message']); ?>




<script src="../../admin/vendor/jquery/jquery.min.js"></script>
<script src="../../admin/vendor/bootstrap/js/bootstrap.min.js"></script>
