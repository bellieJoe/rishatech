<?php 

include '../db_connection/config.php';
$db = new Database();

session_start();

$towns = $db->getTowns();
$barangays = $db->getBarangays();

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php'; ?>

<body>

    <?php require_once 'components/navbar.php'; ?>
    <br><br>
    <div class="container">
        <h3 class="text-center">Client Registration</h3>

        <?php include 'components/error-alert.php'; ?>
        

        <div class="card mb-3">
            <div class="card-body">
                <form action="../admin/forms_code.php" method="post">
                    <!-- Include CSRF token as a hidden input field -->
                    <!-- <input type="hidden" name="is_client" value="true"> -->

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required />
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" name="full_name" id="fullName" class="form-control" placeholder="Enter Customer Full Name" required>
                    </div>

                    <div class="form-group">
                        <label for="addrss">Complete Address</label>
                        <input type="text" name="complete_address" id="addrss" class="form-control" placeholder="Enter Complete Address" required>
                    </div>

                    <div class="form-group">
                        <label for="addrss">Municipality</label>
                        <input type="hidden" name="municipality" id="municipality" value="">
                        <select class="form-control" name="municipality_id" id="municipality_id" required>
                            <option disabled selected>Select Municipality</option>
                            <?php
                                foreach ($towns as $town) {
                                    echo '<option value="' . $town['id'] . '">' . $town['town_name'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="addrss">Barangay</label>
                        <select class="form-control" name="barangay" id="barangay" required>
                            <option disabled selected>Select Barangay</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="addrss">Street Name</label>
                        <input type="text" name="street_name" id="addrss" class="form-control" placeholder="Enter Street Name" required>
                    </div>

                    <div class="form-group">
                        <label for="eml_addrss">Email Address</label>
                        <input type="email" name="email_address" id="eml_addrss" class="form-control" placeholder="Enter Email Address"required>
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="09---------" pattern="^09[0-9]{9}$" maxlength="11" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <small id="phoneNumberError" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" class="form-control" placeholder="Enter Age" required>
                    </div>

                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" name="civil_status" id="civil_status" required>
                            <option disabled selected>----------SELECT CIVIL STATUS---------</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Citizenship">Citizenship</label>
                        <input type="text" name="Citizenship" id="Citizenship" class="form-control" placeholder="Enter Citizenship" required>
                    </div>

                    <button name="RegisterCustomer" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>



<script src="../admin/vendor/jquery/jquery.min.js"></script>

<script>
    const towns = <?php echo json_encode($towns); ?>;
    const barangays = <?php echo json_encode($barangays); ?>;
    console.log(barangays)
    $(document).ready(function() {
        $barangay = $('#barangay');
        $municipality_id = $('#municipality_id');
        $municipality = $('#municipality');

        $municipality_id.change(function() {
            $municipality.val(towns.filter(town => town.id == $municipality_id.val())[0].town_name);
            $barangay.html('<option disabled selected>Select Barangay</option>');
            barangays.filter(brgy => brgy.town_id == $municipality_id.val()).forEach(brgy => {
                $barangay.append('<option value="' + brgy.barangay_name + '">' + brgy.barangay_name + '</option>');
            })
        });


        console.log("Jquert installed")
    })
</script>

</html>

<?php
    unset($_SESSION['message']["status"]);
?>

