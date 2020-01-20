<?php
session_start();
require "config/koneksi.php";
include "config/FunctionRegistrasi.php";
include('Header/header.php');
require "config/FunctionMkTime.php";
require "config/functionLogin.php";

?>

<?php
if (isset($_POST['simpanDaftar'])) {

    $noKtp = $_POST['noktp'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $noTelp = $_POST['notelp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($noKtp && $nama && $alamat && $noTelp && $email && $password)) {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Harap isi data dengan lengkap!',
                        timer: 2500
                    })
                </script>";
    } elseif (Registrasi($_POST) > 0) {
        echo "<script>  
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Selamat, sekarang anda sudah terdaftar',
                        showConfirmButton: false,
                        timer: 2100
                    })
                                
              </script>";

    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Proses daftar gagal!',
                    })
                </script>";
    }
}
?>


    <!--SESSION-->
<?php
if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $Username = loginCostumer($email, $password);

    $result = mysqli_query($con, "SELECT * FROM `tb_costumer` WHERE e_mail = '$email'");

    $rows = mysqli_fetch_assoc($result);

    $_SESSION['noTelp'] = $rows['No_telp'];
    $_SESSION['noKtp'] = $rows['Ktp'];

    if ($Username === $rows['Nama']) {

        $Username = strtoupper($Username);

        echo "<script>  
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Login Sukses '+'$pesan'+' '+'$Username',
                        showConfirmButton: false,
                        timer: 2100
                    })
                                
              </script>";

        function limit_words($string, $word_limit)
        {
            $words = explode(" ", $string);
            return implode(" ", array_splice($words, 0, $word_limit));
        }

        $Username = limit_words($Username, 2);

        $_SESSION['foto'] = $rows['Foto'];
        $_SESSION['Username'] = $Username;

    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Proses login gagal!',
                    })
                </script>";
    }
}
?>

<?php
if (isset($_POST['logout'])) {
    session_destroy();
    session_unset();
    $_SESSION = [];
}
?>


    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SITravel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"
                    style="background-color: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="Agen.php">Agen Travel</a>
                    <a class="nav-item nav-link" href="hotel.php">Partner Hotel</a>
                    <a class="nav-item nav-link" href="faq.php">FAQ</a>


                    <?php if (isset($_SESSION["Username"])) : ?>
                        <div class="dropdown">
                            <a class="nav-item btn btn-dark btn-tombol" href="#" style="border-radius: 50px"
                               type="button"
                               id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"><?= $_SESSION["Username"]; ?></a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 200px">
                                <form action="" method="post" style="text-align: center">
                                    <img src="<?= $_SESSION['foto']; ?>" alt="NO FOTO"
                                         class="rounded-circle border border-info"
                                         style="height: 75px; width: 75px; margin-bottom: 20px; margin-top: 10px">
                                    <a class="dropdown-item" href="DaftarPesanan.php" style="text-align: left">Pesanan
                                        Saya</a>
                                    <button type="submit" name="logout" class="dropdown-item" style="text-align: left">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>

                    <?php else : ?>

                        <!--Dropdown-->
                        <div class="dropdown">
                            <a class="nav-item btn btn-dark btn-tombol" href="#" style="border-radius: 50px"
                               type="button"
                               id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Login</a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                 style="width: 310px; margin-left: -50px; padding: 20px">
                                <form class="" action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleDropdownFormEmail2">Email address</label>
                                        <input type="text" class="form-control" id="exampleDropdownFormEmail2"
                                               placeholder="email@example.com" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleDropdownFormPassword2">Password</label>
                                        <input type="password" class="form-control" id="exampleDropdownFormPassword2"
                                               placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                                            <label class="form-check-label" for="dropdownCheck2">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="login">Sign in</button>
                                </form>
                            </div>
                        </div>
                        <!--Dropdown-->

                    <?php endif; ?>


                </div>
            </div>
        </div>
    </nav>
    <!-- last navbar -->


    <!-- jumbotron -->

    <div class="jumbotron jumbotron-fluid" style="height: 800px">
        <div class="container">
            <h1 style="text-align: center; margin-top: 200px; color: #000000;"><b><?= $pesan ?></b>
                <h3 style="text-align: center">Nikmati kenyamanan dan kemudahan dalam traveling anda</h3>
            </h1>
            <br>
        </div>
        <div class="container form-call" style="margin-top: 315px">
            <!--        <form action="" method="post">-->
            <div class="row justify-content-md-center" style="width: 100%; padding-left: 30px">
                <div class="col-lg">
                    <button id="btn1" type="submit" name="login" class="btn btn-dark btn-lg btn-block active"
                            style="height: 60px">Tentang Kami
                    </button>
                </div>
                <div class="col-lg" style="margin-right: -27px; margin-left: -27px">
                    <button id="btn2" type="submit" name="pesan" class="btn btn-dark btn-lg btn-block active"
                            style="height: 60px">Form Penyewan
                    </button>
                </div>
                <div class="col-lg">
                    <button id="btn3" type="submit" name="daftar" class="btn btn-dark btn-lg btn-block active"
                            style="height: 60px">Form Daftar
                    </button>
                </div>
            </div>
            <!--        </form>-->
        </div>
    </div>
    <!-- last jumbotron -->


    <!--About me-->
    <div id="Div1" class="jumbotron-fluid paralax" style="width: 100%; padding-top: 170px">
        <h3 style="color: white; text-align: center;">Tentang Sitravel</h3><br>
        <h4 class="font-italic" style="color: white; text-align: center;">"SITRAVEL adalah website yang menyediakan
            berbagai macam layanan paket wisata dengan
            layanan <br> akomodasi yang lengkap dan memuaskan, memungkinkan Anda untuk menciptakan momen
            bersama orang-orang terkasih."</h4>
    </div>
    <!--Last About me-->

    <!-- form Pemesanan -->

    <div id="Div2" class="container-fluid" style="margin-top: 100px; width: 100%">
        <div class="row">
            <div class="col-lg-12 form-panel">
                <form action="Paket.php" method="get">
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="exampleInputEmail1">lokasi jemputan:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <img src="asset/icon/location.png" alt="" class="icon">
                                        </div>
                                    </div>
                                    <select class="form-control" name="lokasiJemput">
                                        <option>lokasi anda</option>
                                        <?php require "config/FunctionTampil.php";

                                        $lokasi = query("SELECT * FROM `tb_lokasi` ");

                                        foreach ($lokasi as $rows) :
                                            ?>
                                            <option value="<?= $rows['Id_lokasi'] ?>"><?= $rows['Deskripsi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Check-in:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <img src="asset/icon/ico-calender.png" alt="" class="icon">
                                        </div>
                                    </div>
                                    <input type="date" class="form-control" id="inlineFormInputGroupUsername"
                                           placeholder="Check-in" name="tanggalPesan">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group" id="only-number">
                                <label for="number">Durasi:</label>
                                <input type="text" class="form-control" id="number" aria-describedby="emailHelp"
                                       placeholder="Durasi" name="durasi">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Check-out:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <img src="asset/icon/ico-calender.png" alt="" class="icon">
                                        </div>
                                    </div>
                                    <input type="date" class="form-control" id="inlineFormInputGroupUsername"
                                           placeholder="Check-out" name="tanggalBerakhir">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group" id="only-number">
                                <label for="number">Guest:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <img src="asset/icon/guest.png" alt="" class="icon">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="number" aria-describedby="emailHelp"
                                           placeholder="Guest" name="guest">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <button type="submit" name="cari" class="btn btn-dark"
                                    style="margin-top: 30px; width: 100%; color: white; font-weight: bold; height: 42.5px; border-radius: 5px">
                                Cari
                            </button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- last form info panel -->

    <!-- form Daftar -->
    <div id="Div3" class="container-fluid" style="margin-top: 100px; width: 100%">
        <div class="row">
            <div class="col-lg-12 form-panel">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="ktp">No Ktp:</label>
                                <input type="text" class="form-control" id="ktp" name="noktp"
                                       placeholder="No Ktp">
                            </div>
                            <div class="form-group">
                                <label for="ktp">Nama:</label>
                                <input type="text" class="form-control" id="ktp" name="nama"
                                       placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <textarea class="form-control" id="alamat" rows="5" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="notelp">No Telp:</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><img src="asset/icon/indonesia.png" alt=""
                                                                                   style="width: 25px; height: 25px">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup"
                                                   value="+62" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg" style="padding-top: 13.6px; margin-left: -20px">
                                        <small for="notelp">Data anda akan dilindungi dan tidak disebarluaskan</small>
                                        <input type="text" class="form-control" id="notelp" name="notelp"
                                               placeholder="Contoh:  85338994876">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <small id="emailHelp" class="form-text text-muted">Data Anda dilindungi dan tidak akan
                                    disebarluaskan.</small>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                       placeholder="Contoh : email@example.com" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto:</label>
                                <input type="file" id="foto" name="foto"
                                       placeholder="Unggah foto" class="form-control-file">
                                <small class="form-text text-muted">Pastikan ukuran gambar tidak lebih dari 2MB</small>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <button id="btnDaftar" type="submit" name="simpanDaftar" class="btn btn-dark"
                                style="width: 100%; height: 65px; font-size: large">
                            <h4 style="text-transform: uppercase">Daftar</h4>
                        </button>
                        <small class="form-text text-muted" style="text-align: center">
                            Dengan melakukan pendaftaran, saya setuju dengan Kebijakan Privasi dan Syarat & Ketentuan
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- last form info panel -->


    <!--content-->
    <div class="container-fluid">
        <!--    <center style="">-->

        <h3 style="font-family: 'Arial Black'; text-transform: capitalize; margin-top: 100px; text-align: center; margin-bottom: 46px">
            Tempat Wisata Pilihan</h3>
        <!--    </center>-->
        <div class="row">
            <div class="col-lg">
                <div class="card" style="width: 25rem;">
                    <img src="asset/img/img-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                    </div>
                    <div class="card-body">

                        <img src="asset/img/IMG_0291.JPG" alt="" class="rounded-circle"
                             style="width: 50px; height: 50px; border: 1px">
                        <small style="font-family: 'Viga'; color: #424242; font-size: large; margin-left: 10px">Sutrisno</small>

                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card" style="width: 25rem;">
                    <img src="asset/img/img-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                    </div>
                    <div class="card-body">

                        <img src="asset/img/IMG_0291.JPG" alt="" class="rounded-circle"
                             style="width: 50px; height: 50px; border: 1px">
                        <small style="font-family: 'Viga'; color: #424242; font-size: large; margin-left: 10px">Sutrisno</small>

                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card" style="width: 25rem;">
                    <img src="asset/img/img-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                    </div>
                    <div class="card-body">

                        <img src="asset/img/IMG_0291.JPG" alt="" class="rounded-circle"
                             style="width: 50px; height: 50px; border: 1px">
                        <small style="font-family: 'Viga'; color: #424242; font-size: large; margin-left: 10px">Sutrisno</small>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg">
                <div class="card" style="width: 25rem;">
                    <img src="asset/img/img-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                    </div>
                    <div class="card-body">

                        <img src="asset/img/IMG_0291.JPG" alt="" class="rounded-circle"
                             style="width: 50px; height: 50px; border: 1px">
                        <small style="font-family: 'Viga'; color: #424242; font-size: large; margin-left: 10px">Sutrisno</small>

                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card" style="width: 25rem;">
                    <img src="asset/img/img-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                    </div>
                    <div class="card-body">

                        <img src="asset/img/IMG_0291.JPG" alt="" class="rounded-circle"
                             style="width: 50px; height: 50px; border: 1px">
                        <small style="font-family: 'Viga'; color: #424242; font-size: large; margin-left: 10px">Sutrisno</small>

                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card" style="width: 25rem;">
                    <img src="asset/img/img-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                    </div>
                    <div class="card-body">

                        <img src="asset/img/IMG_0291.JPG" alt="" class="rounded-circle"
                             style="width: 50px; height: 50px; border: 1px">
                        <small style="font-family: 'Viga'; color: #424242; font-size: large; margin-left: 10px">Sutrisno</small>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--last content-->

<?php
require "Header/footer.php"
?>