<!DOCTYPE html>
<html lang="en">

<?php require_once 'components/head.php'; ?>

<body>

    <?php require_once 'components/navbar.php'; ?>
    <br><br>
    <div class="container">
        <h3 class="text-center">Client Registration</h3>
        <div class="card">
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <!-- Include CSRF token as a hidden input field -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

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

                    <button name="AddCustomer" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $query = "INSERT INTO clients (name, email, password, phone, address) VALUES ('$name', '$email', '$password', '$phone', '$address')";

    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
