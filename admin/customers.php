<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<?php
require_once 'templates/admin_header.php';
?>

<!-- Optional Custom CSS -->
<style>
    /* Additional custom styling to make the modal wider if needed */
    .modal-xl {
        max-width: 90%; /* Adjust this percentage as needed */
    }
</style>
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Customers</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCustomers">
                      Add Customer
                    </button>

                    <a href="route.php?route=allsales" class="btn btn-primary">
                        Customer Sales
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="AddCustomers" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Customer</h5>
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
                                          <label for="fullName">Full Name</label>
                                          <input type="text" name="full_name" id="fullName" class="form-control" placeholder="Enter Customer Full Name" required>
                                        </div>

                                        <div class="form-group">
                                          <label for="addrss">Complete Address</label>
                                          <input type="text" name="complete_address" id="addrss" class="form-control" placeholder="Enter Complete Address" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="addrss">Municipality</label>
                                            <select class="form-control" name="municipality" id="municipality" required>
                                                <option disabled selected>Select Municipality</option>
                                                <option value="Mogpog">Mogpog</option>
                                                <option value="Boac">Boac</option>
                                                <option value="Gasan">Gasan</option>
                                                <option value="Buenavista">Buenavista</option>
                                                <option value="Santa Cruz">Santa Cruz</option>
                                                <option value="Torrijos">Torrijos</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                          <label for="addrss">Barangay</label>
                                            <select class="form-control" name="barangay" id="barangay" required>
                                                <option disabled selected>Select Barangay</option>
                                                <option value="Anapog-Sibucao">Anapog-Sibucao</option>
                                                <option value="Argao">Argao</option>
                                                <option value="Balanacan">Balanacan</option>
                                                <option value="Banto">Banto</option>
                                                <option value="Bintakay">Bintakay</option>
                                                <option value="Bocboc">Bocboc</option>
                                                <option value="Butansapa">Butansapa</option>
                                                <option value="Caganhaw">Caganhaw</option>
                                                <option value="Capayang">Capayang</option>
                                                <option value="Danao">Danao</option>
                                                <option value="Dulong Bayan">	Dulong Bayan</option>
                                                <option value="Gitnang Bayan">Gitnang Bayan</option>
                                                <option value="Guisian	">Guisian</option>
                                                <option value="Hinadharan">Hinadharan</option>
                                                <option value="Hinanggayon">Hinanggayon</option>
                                                <option value="Ino">Ino</option>
                                                <option value="Janagdong">Janagdong</option>
                                                <option value="Lamesa">Lamesa</option>
                                                <option value="Laon">Laon</option>
                                                <option value="Magapua">Magapua</option>
                                                <option value="Malayak">Malayak</option>
                                                <option value="Malusak">Malusak</option>
                                                <option value="Mangpaitan">Mangpaitan</option>
                                                <option value="Manyan-Mababad">Manyan-Mababad</option>
                                                <option value="Market Site">Market Site</option>
                                                <option value="Mataas na Bayan">Mataas na Bayan</option>
                                                <option value="Mendez">Mendez</option>
                                                <option value="Nangka I">Nangka I</option>
                                                <option value="Nangka II">Nangka II</option>
                                                <option value="Paye">Paye</option>
                                                <option value="Pili">Pili</option>
                                                <option value="Puting Buhangin">Puting Buhangin</option>
                                                <option value="Sayao">Sayao</option>
                                                <option value="Silangan">Silangan</option>
                                                <option value="Sumangga">Sumangga</option>
                                                <option value="Tarug">	Tarug</option>
                                                <option value="Villa Mendez">Villa Mendez</option>
                                                <option value="Agot">Agot</option>
                                                <option value="Agumaymayan">Agumaymayan</option>
                                                <option value="Amoingon">Amoingon</option>
                                                <option value="Apitong	">Apitong</option>
                                                <option value="Balagtasan">Balagtasan</option>
                                                <option value="Balaring">Balaring</option>
                                                <option value="Balimbing">Balimbing</option>
                                                <option value="Balogo">Balogo</option>
                                                <option value="Bamban">Bamban</option>
                                                <option value="Bangbangalon">Bangbangalon</option>
                                                <option value="Bantad">Bantad</option>
                                                <option value="Bantay">Bantay	</option>
                                                <option value="Bayuti">Bayuti</option>
                                                <option value="Binunga">Binunga</option>
                                                <option value="Boi">Boi</option>
                                                <option value="Boton">Boton</option>
                                                <option value="Buliasnin">Buliasnin</option>
                                                <option value="Bunganay">Bunganay</option>
                                                <option value="Caganhao">Caganhao</option>
                                                <option value="Canat">	Canat</option>
                                                <option value="Catubugan">Catubugan</option>
                                                <option value="Cawit">	Cawit</option>
                                                <option value="Daig">Daig</option>
                                                <option value="Daypay">Daypay</option>
                                                <option value="Duyay">Duyay</option>
                                                <option value="Hinapulan">Hinapulan</option>
                                                <option value="Ihatub">Ihatub</option>
                                                <option value="Isok I">Isok I</option>
                                                <option value="Isok II Poblacion">Isok II Poblacion</option>
                                                <option value="Laylay">Laylay</option>
                                                <option value="Lupac">	Lupac</option>
                                                <option value="Mahinhin">Mahinhin</option>
                                                <option value="Mainit">Mainit</option>
                                                <option value="Malbog">Malbog</option>
                                                <option value="Maligaya">Maligaya</option>
                                                <option value="	Malusak">Malusak</option>
                                                <option value="Mansiwat">Mansiwat</option>
                                                <option value="Mataas na Bayan">Mataas na Bayan</option>
                                                <option value="Maybo">Maybo</option>
                                                <option value="Mercado">Mercado</option>
                                                <option value="Murallon">Murallon</option>
                                                <option value="Ogbac">Ogbac</option>
                                                <option value="Pawa">Pawa</option>
                                                <option value="Pili">Pili</option>
                                                <option value="Poctoy">Poctoy	</option>
                                                <option value="Poras">Poras</option>
                                                <option value="Puting Buhangin">Puting Buhangin</option>
                                                <option value="Puyog">Puyog</option>
                                                <option value="Sabong">Sabong</option>
                                                <option value="San Miguel">San Miguel</option>
                                                <option value="Santol">Santol</option>
                                                <option value="Sawi">Sawi</option>
                                                <option value="Tabi">Tabi</option>
                                                <option value="Tabigue	">Tabigue</option>
                                                <option value="Tagwak	">Tagwak</option>
                                                <option value="Tambunan">Tambunan</option>
                                                <option value="Tampus	">Tampus</option>
                                                <option value="Tanza">	Tanza</option>
                                                <option value="Tugos">Tugos</option>
                                                <option value="Tumagabok">Tumagabok</option>
                                                <option value="Tumapon">Tumapon</option>
                                                <option value="Balagasan">Balagasan</option>
                                                <option value="Antipolo">Antipolo</option>
                                                <option value="Bachao Ibaba">Bachao Ibaba</option>
                                                <option value="Bachao Ilaya">Bachao Ilaya</option>
                                                <option value="Bacongbacong">Bacongbacong</option>
                                                <option value="Bahi">Bahi</option>
                                                <option value="Bangbang">Bangbang</option>
                                                <option value="Banot">Banot</option>
                                                <option value="Banuyo">Banuyo</option>
                                                <option value="Barangay I">Barangay I</option>
                                                <option value="Barangay II">Barangay II</option>
                                                <option value="Barangay III">Barangay III</option>
                                                <option value="Bognuyan">Bognuyan</option>
                                                <option value="Cabugao">Cabugao</option>
                                                <option value="Dawis">Dawis</option>
                                                <option value="Dili">Dili</option>
                                                <option value="Libtangin">Libtangin</option>
                                                <option value="Mahunig">Mahunig</option>
                                                <option value="Mangiliol">Mangiliol</option>
                                                <option value="Masiga">Masiga</option>
                                                <option value="Matandang Gasan">Matandang Gasan</option>
                                                <option value="Pangi">Pangi</option>
                                                <option value="Pingan">Pingan</option>
                                                <option value="Tabionan">Tabionan</option>
                                                <option value="Tapuyan">Tapuyan</option>
                                                <option value="Tiguion">Tiguion</option>
                                                <option value="Bagacay">Bagacay</option>
                                                <option value="Bagtingon">Bagtingon</option>
                                                <option value="Barangay I">Barangay I</option>
                                                <option value="Barangay II">Barangay II</option>
                                                <option value="Barangay III">Barangay III</option>
                                                <option value="Barangay IV">Barangay IV</option>
                                                <option value="Bicas-bicas">Bicas-bicas</option>
                                                <option value="Caigangan">Caigangan</option>
                                                <option value="Daykitin">Daykitin</option>
                                                <option value="Libas">Libas</option>
                                                <option value="Malbog">Malbog</option>
                                                <option value="Sihi">Sihi</option>
                                                <option value="Timbo">Timbo</option>
                                                <option value="Tungib-Lipata">Tungib-Lipata</option>
                                                <option value="Yook">Yook</option>
                                                <option value="Alobo">Alobo</option>
                                                <option value="Angas">Angas</option>
                                                <option value="Aturan">Aturan</option>
                                                <option value="Bagong Silang Poblacion">Bagong Silang Poblacion</option>
                                                <option value="Baguidbirin">Baguidbirin</option>
                                                <option value="Baliis">Baliis</option>
                                                <option value="Balogo">Balogo</option>
                                                <option value="Banahaw Poblacion">Banahaw Poblacion</option>
                                                <option value="Bangcuangan">Bangcuangan</option>
                                                <option value="Banogbog">Banogbog</option>
                                                <option value="Biga">Biga</option>
                                                <option value="Botilao">Botilao</option>
                                                <option value="Buyabod">Buyabod</option>
                                                <option value="Dating Bayan">Dating Bayan</option>
                                                <option value="Devilla">Devilla</option>
                                                <option value="Dolores">Dolores</option>
                                                <option value="Haguimit">Haguimit</option>
                                                <option value="Hupi">Hupi</option>
                                                <option value="Ipil">Ipil</option>
                                                <option value="Jolo">Jolo</option>
                                                <option value="Kaganhao">Kaganhao</option>
                                                <option value="Kalangkang">Kalangkang</option>
                                                <option value="Kamandugan">Kamandugan</option>
                                                <option value="Kasily">Kasily</option>
                                                <option value="Kilo-kilo">Kilo-kilo</option>
                                                <option value="Kiñaman">Kiñaman</option>
                                                <option value="Labo">Labo</option>
                                                <option value="Lamesa">Lamesa</option>
                                                <option value="Landy">Landy</option>
                                                <option value="Lapu-lapu Poblacion">Lapu-lapu Poblacion</option>
                                                <option value="Libjo">Libjo</option>
                                                <option value="Lipa">Lipa</option>
                                                <option value="Lusok">Lusok</option>
                                                <option value="Maharlika Poblacion">Maharlika Poblacion</option>
                                                <option value="Makulapnit">Makulapnit</option>
                                                <option value="Maniwaya">Maniwaya</option>
                                                <option value="Manlibunan">Manlibunan</option>
                                                <option value="Masaguisi">Masaguisi</option>
                                                <option value="Masalukot">Masalukot</option>
                                                <option value="Matalaba">Matalaba</option>
                                                <option value="Mongpong">Mongpong</option>
                                                <option value="Morales">Morales</option>
                                                <option value="Napo">Napo</option>
                                                <option value="Pag-asa Poblacion">Pag-asa Poblacion</option>
                                                <option value="Pantayin">Pantayin</option>
                                                <option value="Polo">Polo</option>
                                                <option value="Pulong-Parang">Pulong-Parang</option>
                                                <option value="Punong">Punong</option>
                                                <option value="San Antonio">San Antonio</option>
                                                <option value="San Isidro">San Isidro</option>
                                                <option value="Tagum">Tagum</option>
                                                <option value="Tamayo">Tamayo</option>
                                                <option value="Tambangan">Tambangan</option>
                                                <option value="Tawiran">Tawiran</option>
                                                <option value="Taytay">Taytay</option>
                                                <option value="Bangwayin">Bangwayin</option>
                                                <option value="Bayakbakin">Bayakbakin</option>
                                                <option value="Bolo">Bolo</option>
                                                <option value="Bonliw">Bonliw</option>
                                                <option value="Buangan">Buangan</option>
                                                <option value="Cabuyo">Cabuyo</option>
                                                <option value="Cagpo">Cagpo</option>
                                                <option value="Dampulan">Dampulan</option>
                                                <option value="Kay Duke">Kay Duke</option>
                                                <option value="Mabuhay">Mabuhay</option>
                                                <option value="Makawayan">Makawayan</option>
                                                <option value="Malibago">Malibago</option>
                                                <option value="Malinao">Malinao</option>
                                                <option value="Maranlig">Maranlig</option>
                                                <option value="Marlangga">Marlangga</option>
                                                <option value="Matuyatuya">Matuyatuya</option>
                                                <option value="Nangka">Nangka</option>
                                                <option value="Pakaskasan">Pakaskasan</option>
                                                <option value="Payana">Payana</option>
                                                <option value="Poblacion">Poblacion</option>
                                                <option value="Poctoy">Poctoy</option>
                                                <option value="Sibuyao">Sibuyao</option>
                                                <option value="Suha">Suha</option>
                                                <option value="Talawan">Talawan</option>
                                                <option value="Tigwi">Tigwi</option>
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

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button name="AddCustomer" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
 <br><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Customers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No. of Ongoing Credit Customer</th>
                                            <th>Full Name</th>
                                            <th>Credit Limit</th>
                                            <th>Complete Address</th>
                                            <th>Municipality</th>
                                            <th>Barangay</th>
                                            <th>Street Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Age</th>
                                            <th>Civil Status</th>
                                            <th>Citizenship</th>
                                            <th>Payment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selectAllCustomers = $db->selectAllCustomers();

                                        foreach ($selectAllCustomers as $result) {
                                        ?>
                                        <tr>
                                            <td><?=$result['id']?></td>
                                            <td><?=$result['full_name']?></td>
                                            <td class="<?= $result['credit_limit'] <= 0 ? 'text-danger' : '' ?>" >PHP <?= number_format($result['credit_limit'], 2) ?></td>
                                            <td><?=$result['complete_address']?></td>
                                            <td><?=$result['municipality']?></td>
                                            <td><?=$result['barangay']?></td>
                                            <td><?=$result['street_name']?></td>
                                            <td><?=$result['email']?></td>
                                            <td><?=$result['phone_number']?></td>
                                            <td><?=$result['age']?></td>
                                            <td><?=$result['civil_status']?></td>
                                            <td><?=$result['citizenship']?></td>
                                            <td>
                                                <?php
                                                    $customer_id = $result['id'];

                                                    // Fetch payment status counts for the customer
                                                    $selectPaymentStatus = $db->selectCOUNT_PaymentStatus($customer_id);

                                                    // Initialize counters
                                                    $latePaidCount = 0;
                                                    $paidCount = 0;

                                                    // Loop through results to count "LATE PAID" and "PAID" statuses
                                                    foreach ($selectPaymentStatus as $row) {
                                                        if ($row['payment_status'] === 'LATE PAID') {
                                                            $latePaidCount = $row['count'];
                                                        } elseif ($row['payment_status'] === 'PAID') {
                                                            $paidCount = $row['count'];
                                                        }
                                                    }

                                                    // Display badge based on counts if there's any payment
                                                    if ($latePaidCount > 0 || $paidCount > 0) {
                                                        if ($latePaidCount > $paidCount) {
                                                            echo '<span class="badge badge-danger">Bad Payer</span>';
                                                        } else {
                                                            echo '<span class="badge badge-success">Good Payer</span>';
                                                        }
                                                    } else {
                                                        // No badge will be displayed if there's no payment
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#ModalEdit_<?=$result['id']?>"><i class="fa fa-pen mr-2"></i>Edit</a>
                                                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#ModalDelete_<?=$result['id']?>"><i class="fa fa-trash mr-2"></i>Delete</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item " data-toggle="modal" data-target="#ModalUpdateLimit_<?=$result['id']?>"><i class="fa fa-credit-card mr-2"></i>Update Credit Limit</a>
                                                        <?php
                                                            $customer_id = sanitizeInput($result['id']);
                                                            if ($db->selectSales($customer_id)) {
                                                        ?>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#ModalHistory_<?=$result['id']?>"><i class="fa fa-history mr-2"></i>History</a>
                                                  
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php
                                                            $customer_id = sanitizeInput($result['id']);

                                                            if ($db->selectRequirements($customer_id)) {

                                                            ?>
                                                            <a class="dropdown-item" href="route.php?route=view_req&viewkey=<?=$result['id']?>&fname=<?=$result['full_name']?>" target="_blank" >
                                                                <i class="fa fa-folder mr-2"></i> View Requirements
                                                            </a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#ModalUploadReq_<?=$result['id']?>">
                                                                <i class="fa fa-upload mr-2"></i> Upload Requirements
                                                            </button>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>

                                                <?php
                                                    $customer_id = sanitizeInput($result['id']);

                                                    if ($db->selectSales($customer_id)) {
                                                ?>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="ModalHistory_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document"> <!-- Use modal-xl for extra-large modal -->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Sales History</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Table container with horizontal scroll if needed -->
                                                                    <div style="overflow-x: auto;">
                                                                        <table class="table table-striped" id="dataTables_salesHistory">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID No.#</th>
                                                                                    <th>Date Of Avail</th>
                                                                                    <th>Item Name</th>
                                                                                    <th>Category</th>
                                                                                    <th>Unit</th>
                                                                                    <th>Total Sales</th>
                                                                                    <th>Promotion Applied</th>
                                                                                    <th>Payment Type</th>
                                                                                    <th>Payment Method</th>
                                                                                    <th>Transaction/References No.#</th>
                                                                                    <th>Receipt</th>
                                                                                    <th>Downpayment</th>
                                                                                    <th>Monthly Payment</th>
                                                                                    <th>Interest Rate</th>
                                                                                    <th>Status</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $customer_id = sanitizeInput($result['id']);

                                                                                $selectAllSalesselectAllSales_WHEREcustomerid = $db->selectAllSales_WHEREcustomerid($customer_id);

                                                                                foreach($selectAllSalesselectAllSales_WHEREcustomerid as $key){
                                                                                ?>
                                                                                <tr>
                                                                                    <td><?=$key['Sales_Id']?></td>
                                                                                    <td><?= date("M d, Y", strtotime($key['date_created'])) ?></td>
                                                                                    <td><?=$key['appliances_name']?></td>
                                                                                    <td><?=$key['cat_name']?></td>
                                                                                    <td><?=$key['sales_qty']?> pc/s</td>
                                                                                    <td>₱ <?= number_format($key['total_sales'], 2) ?></td>
                                                                                    <td>
                                                                                        <?php
                                                                                        $discountPromotion = $key['discount_promotion'];

                                                                                        // Check if the discount promotion is numeric
                                                                                        if (is_numeric($discountPromotion)) {
                                                                                            // Fetch the discount promotion details based on the ID
                                                                                            $selectDiscount_WHEREid = $db->selectDiscount_WHEREid($discountPromotion);
                                                                                            
                                                                                            // Echo the name of the discount promotion
                                                                                            echo htmlspecialchars($selectDiscount_WHEREid['name']);
                                                                                        } else {
                                                                                            // If not numeric, echo the value directly
                                                                                            echo htmlspecialchars($discountPromotion);
                                                                                        }
                                                                                        ?>
                                                                                    </td>
                                                                                    <td><?=$key['payment_type']?></td>
                                                                                    <td><?=$key['payment_method']?></td>
                                                                                    <td><?=$key['transaction_number']?></td>
                                                                                    <td>
                                                                                        <?php
                                                                                            if (!empty($key['cash_receipt'])) {
                                                                                                // Show the image in a modal if payment type is Cash and cash receipt exists
                                                                                                ?>
                                                                                                <img class="img-thumbnail" src="<?=$key['cash_receipt']?>" alt="Receipt Img" data-toggle="modal" data-target="#ModalReceipt_view<?=$key['Sales_Id']?>">

                                                                                                <!-- Modal -->
                                                                                                <div class="modal fade" id="ModalReceipt_view<?=$key['Sales_Id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                                                    <div class="modal-dialog" role="document">
                                                                                                        <div class="modal-content">
                                                                                                            <div class="modal-header">
                                                                                                                <h5 class="modal-title">Receipt Image</h5>
                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                            <div class="modal-body text-center">
                                                                                                                <!-- Displaying the image with fixed size -->
                                                                                                                <img src="<?=$key['cash_receipt']?>" alt="Receipt Image" style="width: 100%; max-width: 500px; height: auto;" class="img-fluid">
                                                                                                            </div>
                                                                                                            <div class="modal-footer">
                                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php
                                                                                            } else {
                                                                                                // Show badge if payment type is Cash but no receipt is uploaded
                                                                                                echo '<span class="badge badge-danger">No Cash Receipt Uploaded</span>';
                                                                                            }
                                                                                        
                                                                                        ?>
                                                                                    </td>
                                                                                    <td>₱ <?= number_format($key['downpayment'], 2) ?></td>
                                                                                    <td>₱ <?= number_format($key['monthly_payment'], 2) ?></td>
                                                                                    <td>₱ <?= number_format($key['interest_rate'], 2) ?></td>
                                                                                    <td>
                                                                                        <?=$key['sales_status']?>

                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalEdit_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Customer</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                            <!-- Include CSRF token as a hidden input field -->
                                                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                            <input type="hidden" name="customer_id" value="<?=$result['id']?>">

                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                <label for="fullName">Full Name</label>
                                                                <input type="text" name="full_name" id="fullName" class="form-control" value="<?=$result['full_name']?>" placeholder="Enter Customer Full Name" required>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="addrss">Complete Address</label>
                                                                <input type="text" name="complete_address" id="addrss" class="form-control" value="<?=$result['complete_address']?>" placeholder="Enter Complete Address" required>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="addrss">Municipality</label>
																<select class="form-control" name="municipality" id="municipality" required>
                                                                <option value="<?=$result['municipality']?>" selected><?=$result['municipality']?></option>
																  <option disabled>Select Municipality</option>
                                                                        <option value="Mogpog">Mogpog</option>
                                                                        <option value="Boac">Boac</option>
                                                                        <option value="Gasan">Gasan</option>
																		<option value="Buenavista">Buenavista</option>
																		<option value="Santa Cruz">Santa Cruz</option>
																		<option value="Torrijos">Torrijos</option>
																		 </select>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="addrss">Barangay</label>
                                                                <input type="text" name="barangay" id="addrss" class="form-control" value="<?=$result['barangay']?>" placeholder="Enter barangay" required>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="addrss">Street Name</label>
                                                                <input type="text" name="street_name" id="addrss" class="form-control" value="<?=$result['street_name']?>" placeholder="Enter Street Name" required>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="eml_addrss">Email Address</label>
                                                                <input type="email" name="email_address" id="eml_addrss" class="form-control" value="<?=$result['email']?>" placeholder="Enter Email Address"required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="phoneNumber">Phone Number</label>
                                                                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" value="<?=$result['phone_number']?>" placeholder="Enter Phone Number" pattern="^09[0-9]{9}$" required>
                                                                    <small id="phoneNumberError" class="text-danger"></small>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="age">Age</label>
                                                                <input type="number" name="age" id="age" class="form-control" value="<?=$result['age']?>" placeholder="Enter Age" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="civil_status">Civil Status</label>
                                                                    <select class="form-control" name="civil_status" id="civil_status" required>
                                                                        <option value="<?=$result['civil_status']?>" selected><?=$result['civil_status']?></option>
                                                                        <option disabled>----------SELECT CIVIL STATUS---------</option>
                                                                        <option value="Single">Single</option>
                                                                        <option value="Married">Married</option>
                                                                        <option value="Widowed">Widowed</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                <label for="Citizenship">Citizenship</label>
                                                                <input type="text" name="Citizenship" id="Citizenship" value="<?=$result['citizenship']?>" class="form-control" placeholder="Enter Citizenship" required>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button name="UpdateCustomer" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="ModalUploadReq_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Upload Requirements</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post" enctype="multipart/form-data" onsubmit="return checkFilesSelected()">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                                <input type="hidden" name="customer_id" value="<?=$result['id']?>">
                                                                <input type="hidden" name="admin_id" value="<?php echo $_SESSION['auth_user']['admin_id']; ?>">

                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="validID">Valid IDs</label>
                                                                        <input type="file" accept="image/*" name="valid_id" id="validID" class="form-control">
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="2by2">2 by 2 Picture</label>
                                                                        <input type="file" accept="image/*" name="twoby2_pic" id="2by2" class="form-control">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="brgy_clearance">Barangay Clearance</label>
                                                                        <input type="file" accept=".pdf" name="brgy_clearance" id="brgy_clearance" class="form-control">
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="cedula">Cedula</label>
                                                                        <input type="file" accept=".pdf" name="cedula" id="cedula" class="form-control">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="proof_of_billing">Proof Of Billing</label>
                                                                        <input type="file" accept=".pdf" name="proof_of_billing" id="proof_of_billing" class="form-control">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="application_for_credit">Application For Credit</label>
                                                                        <input type="file" accept=".pdf" name="application_for_credit" id="application_for_credit" class="form-control">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="Upload_Files" class="btn btn-success">Upload</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- JavaScript to check if at least one file is selected -->
                                                <script>
                                                    function checkFilesSelected() {
                                                        const fileInputs = document.querySelectorAll('#ModalUploadReq_<?=$result['id']?> input[type="file"]');
                                                        let fileSelected = false;

                                                        fileInputs.forEach(input => {
                                                            if (input.files.length > 0) {
                                                                fileSelected = true;
                                                            }
                                                        });

                                                        if (!fileSelected) {
                                                            alert("Please select at least one file to upload.");
                                                            return false;
                                                        }
                                                        
                                                        return true;
                                                    }
                                                </script>



                                                <div class="modal fade" id="ModalDelete_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete <?=$result['full_name']?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                
                                                                <input type="hidden" name="customer_id" value="<?=$result['id']?>">

                                                                <div class="modal-body">

                                                                    Are you sure you want to delete this Customer?

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="DeleteCustomer" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="ModalUpdateLimit_<?=$result['id']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update Credit Limit</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="forms_code.php" method="post">
                                                                <!-- Include CSRF token as a hidden input field -->
                                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                                                
                                                                <input type="hidden" name="customer_id" value="<?=$result['id']?>">

                                                                <div class="modal-body">
                                                                    <table class="table border">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">Customer</th>
                                                                                <td><?=$result['full_name']?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Current Credit Limit</th>
                                                                                <td>PHP <?=number_format($result['credit_limit'], 2)?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="form-group">
                                                                        <label for="CreditLimit">Credit Limit</label>
                                                                        <input type="number" value="<?=$result['credit_limit']?>" name="credit_limit" id="CreditLimit" class="form-control" placeholder="Enter Credit Limit" required>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button name="UpdateCreditLimit" class="btn btn-danger">Save</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
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

</body>

</html>