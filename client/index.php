<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RISHATECH CLIENT</title>
    <link rel="stylesheet" href="../admin/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8rsqVujOnsKL8vU9s2ryJC2EPnm7EY2pb3hlh+Z5Q5i6fM41QI94ukzU+Ue++tCSDzhxu0DWFL4xVZLQw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }
        .hero {
            /* background-image: url("https://source.unsplash.com/1600x900/?nature,landscape"); */
            background-image: url("../admin/img/bg.jpg");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            color: #fff;
            background-color: rgba(0,0,0,0.5);
        }
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2rem;
            line-height: 1.5;
        }
        .hero button {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            margin-top: 25px;
        }
        .hero button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <div style="text-align: left;">
                <h1 class="display-1" style="color: #333;">RishaTech Client</h1>
                <p class="lead" style="color: #333;">Track and Manage Your Credits</p>
                <div >
                    <a href="signin.php" class="btn btn-primary">Login</a>
                    <a href="registration.php" class="btn btn-success">Sign Up</a>
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



