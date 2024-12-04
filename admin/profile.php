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

                    <div class="container bootstrap snippets bootdey">
<div class="panel-body inf-content">
    <div class="row">
        <div class="col-md-4">
            <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip" src="https://bootdey.com/img/Content/avatar/avatar7.png" data-original-title="Usuario">
        </div>
        <div class="col-md-6">
            <strong>Information</strong><br>
            <div class="table-responsive">
            <table class="table table-user-information">
                <tbody>

                    <tr>    
                        <td>
                            <strong>
                                <span class="fas fa-user"></span>    
                                Full Name                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo $_SESSION['auth_user']['full_name']; ?>     
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="fas fa-user"></span>    
                                Username                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            <?php echo $_SESSION['auth_user']['username']; ?>     
                        </td>
                    </tr>

                    <!-- <tr>        
                        <td>
                            <strong>
                                <span class="fas fa-home"></span> 
                                Complete Address                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            asdsa
                        </td>
                    </tr> -->

                    <!-- <tr>        
                        <td>
                            <strong>
                                <span class="fas fa-phone"></span> 
                                Phone Number                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                             
                        </td>
                    </tr> -->


                    <tr>        
                        <td>
                            <strong>
                                <span class="fas fa-eye"></span> 
                                Role                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            Admin
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="fas fa-envelope"></span> 
                                Email                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                        <?php echo $_SESSION['auth_user']['email']; ?>   
                        </td>
                    </tr>
                                                        
                </tbody>
            </table>
            </div>
        </div>
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

</body>

</html>