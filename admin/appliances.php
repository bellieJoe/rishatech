<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php
require_once 'templates/admin_header.php';
?>

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <?php
                require_once 'templates/admin_topbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">ITEMS</h1>
                    
                    <!-- ITEM CATEGORY TABLE -->
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#AddCategory">Add Category</button>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Item Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables_Category" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID No.#</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $category_no = 1;
                                        $selectAllCategory = $db->selectAllCategory();

                                        foreach ($selectAllCategory as $result) {
                                        ?>
                                        <tr>
                                            <td><?=$category_no?></td>
                                            <td><?=$result['cat_name']?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEditCategory_<?=$result['id']?>">
                                                  Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDeleteCategory_<?=$result['id']?>">
                                                  Delete
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalEditCategory_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Instructors</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                            <!-- Include CSRF token as a hidden input field -->
                                                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                            <input type="hidden" name="category_id" value="<?=$result['id']?>">

                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                <label for="Category_Name">Category Name</label>
                                                                <input type="text" name="Category_name" id="Category_Name" value="<?=$result['cat_name']?>" class="form-control" placeholder="Enter Appliances Name">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button name="Update_Category" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal fade" id="ModalDeleteCategory_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete <?=$result['cat_name']?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                
                                                                <input type="hidden" name="category_id" value="<?=$result['id']?>">

                                                                <div class="modal-body">

                                                                    Are you sure you want to delete this Category?

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="DeleteCategory" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                        <?php
                                        $category_no++;
                                        }
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- BRANDS TABLE -->
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#AddBrand">Add Brand</button>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Brands</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables_Brand" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.#</th>
                                            <th>Brand Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $brand_no = 1;
                                        $selectAllBrands = $db->selectAllBrands();

                                        foreach ($selectAllBrands as $result) {
                                        ?>
                                        <tr>
                                            <td><?=$brand_no?></td>
                                            <td><?=$result['brand_name']?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEditBrand_<?=$result['id']?>">
                                                  Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDeleteBrand_<?=$result['id']?>">
                                                  Delete
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalEditBrand_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Brand</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                            <!-- Include CSRF token as a hidden input field -->
                                                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                            <input type="hidden" name="brand_id" value="<?=$result['id']?>">

                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                <label for="brand_name">Brand Name</label>
                                                                <input type="text" name="brand_name" id="brand_name" value="<?=$result['brand_name']?>" class="form-control" placeholder="Enter brand name">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button name="UpdateBrand" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal fade" id="ModalDeleteBrand_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete <?=$result['brand_name']?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                
                                                                <input type="hidden" name="brand_id" value="<?=$result['id']?>">

                                                                <div class="modal-body">

                                                                    Are you sure you want to delete this Brand?

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="DeleteBrand" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                        <?php
                                        $brand_no++;
                                        }
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- APPLIANCES TABLE -->
					<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#AddAppliances">Add Item</button>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Items</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No. of Items</th>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                            <th>Units</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $appliance_no = 1;
                                        $selectAllappliances = $db->selectAllappliances();

                                        foreach ($selectAllappliances as $result) {
                                        ?>
                                        <tr>
                                            <td><?=$appliance_no?></td>
                                            <td><?=$result['appliances_name']?></td>
                                            <td><?=$result['cat_name']?></td>
                                            <td><?=$result['brand_name']?></td>
                                            <td>₱ <?=$result['price']?></td>
                                            <td><?=$result['qty']?> <?=$result['unit_measurement']?></td>
                                            <td><?=$result['status']?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit_<?=$result['AppliancesID']?>">
                                                  Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete_<?=$result['AppliancesID']?>">
                                                  Delete
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalEdit_<?=$result['AppliancesID']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Items</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                            <!-- Include CSRF token as a hidden input field -->
                                                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                            <input type="hidden" name="appliances_id" value="<?=$result['AppliancesID']?>">

                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                <label for="appliance_Name">Appliance Name</label>
                                                                <input type="text" name="appliance_name" id="appliance_Name" value="<?=$result['appliances_name']?>" class="form-control" placeholder="Enter Appliances Name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="category">Category</label>
                                                                    <select class="form-control" name="category" id="category" required>
                                                                        <option value="<?=$result['cat_id']?>" selected><?=$result['cat_name']?></option>
                                                                        <option disabled>----------SELECT CATEGORY---------</option>
                                                                        <?php
                                                                        $selectAllCategory = $db->selectAllCategory();

                                                                        foreach ($selectAllCategory as $key) {
                                                                        ?>
                                                                        <option value="<?=$key['id']?>"><?=$key['cat_name']?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="brand">Brand</label>
                                                                    <select class="form-control" name="brand" id="brand" required>
                                                                        <!-- <option value="<?=$result['brand_id']?>" selected><?=$result['brand_name']?></option> -->
                                                                        <option disabled>----------SELECT BRAND---------</option>
                                                                        <?php
                                                                        // $selectAllCategory = $db->selectAllCategory();

                                                                        foreach ($selectAllBrands as $key) {
                                                                        ?>
                                                                        <option <?=($result['brand_id'] == $key['id']) ? "selected" : "" ?> value="<?=$key['id']?>"><?=$key['brand_name']?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="price">Price</label>
                                                                <input type="number" name="price" id="price" value="<?=$result['price']?>" class="form-control" placeholder="Enter Price">
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="quantity">Unit</label>
                                                                <input type="number" name="quantity" id="quantity" value="<?=$result['qty']?>" class="form-control" placeholder="Enter Quantity">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="unit_measurement">Unit Measurement</label>
                                                                    <select class="form-control" name="unit_measurement" id="unit_measurement" required>
                                                                        <option value="<?=$result['unit_measurement']?>" selected><?=$result['unit_measurement']?></option>
                                                                        <option disabled>----------Select Measurement---------</option>
                                                                        <option value="Bundle">Bundle</option>
                                                                        <option value="pc/s">pc/s</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select class="form-control" name="status" id="status" required>
                                                                        <option value="<?=$result['status']?>" selected><?=$result['status']?></option>
                                                                        <option disabled>----------SELECT STATUS---------</option>
                                                                        <option value="Available">Available</option>
                                                                        <option value="Not Available">Not Available</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button name="Update_Appliances" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal fade" id="ModalDelete_<?=$result['AppliancesID']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete <?=$result['appliances_name']?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                
                                                                <input type="hidden" name="appliances_id" value="<?=$result['AppliancesID']?>">

                                                                <div class="modal-body">

                                                                    Are you sure you want to delete this appliances?

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="DeleteAppliances" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php
                                        $appliance_no++;
                                        }
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <?php require_once 'templates/admin_footer.php'; ?>
                    <!-- End of Footer -->
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- MODALS -->
    <div class="modal fade" id="AddAppliances" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="forms_code.php" method="post">
                    <!-- Include CSRF token as a hidden input field -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="appliance_Name">Item Name</label>
                            <input type="text" name="appliance_name" id="appliance_Name" class="form-control" placeholder="Enter Category Name">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category" required>
                                <option disabled selected>----------SELECT CATEGORY---------</option>
                                <?php
                                $selectAllCategory = $db->selectAllCategory();

                                foreach ($selectAllCategory as $key) {
                                ?>
                                <option value="<?=$key['id']?>"><?=$key['cat_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select class="form-control" name="brand" id="brand" required>
                                <option disabled selected>----------SELECT BRAND---------</option>
                                <?php
                                // $selectAllCategory = $db->selectAllCategory();

                                foreach ($selectAllBrands as $key) {
                                ?>
                                <option value="<?=$key['id']?>"><?=$key['brand_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label for="unit_measurement">Unit Measurement</label>
                            <select class="form-control" name="unit_measurement" id="unit_measurement" required>
                                <option disabled selected>----------Select Measurement---------</option>
                                <option value="Bundle">Bundle</option>
                                <option value="pc/s">Set</option>
                                <option value="pc/s">pc/s</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Units</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter Units">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="Add_Appliances" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="forms_code.php" method="post">
                    <!-- Include CSRF token as a hidden input field -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="category_Name">Category Name</label>
                            <input type="text" name="category_name" id="category_Name" class="form-control" placeholder="Enter Category Name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="AddCategory" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddBrand" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form action="forms_code.php" method="post">
                    <!-- Include CSRF token as a hidden input field -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Enter Brand Name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="AddBrand" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<!-- SCRIPTS -->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

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

<script>
    $(document).ready(function() {
        $('#dataTables_Brand').DataTable({
            "order": [[0, "desc"]]
        });
    })
</script>

</html>
