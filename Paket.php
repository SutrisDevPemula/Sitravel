<?php
require "config/koneksi.php";
require "config/functionLogin.php";
session_start();
require "config/FunctionTampil.php";
require "Header/header.php"
?>

<?php
$paket = query("SELECT * FROM `tb_paketwisata`");
?>

<?php
$lokasi = $_GET["lokasiJemput"];
$tanggalSewa = $_GET["tanggalPesan"];
$durasi = $_GET["durasi"];
$tanggalBerakhir = $_GET["tanggalBerakhir"];
$guest = $_GET["guest"];
?>

    <!--SESSION-->
<?php
if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $Username = loginCostumer($email, $password);

    $result = mysqli_query($con, "SELECT * FROM `tb_costumer` WHERE e_mail = '$email'");

    $row = mysqli_fetch_assoc($result);
    $_SESSION['noTelp'] = $row['No_telp'];
    $_SESSION['noKtp'] = $row['Ktp'];

    if ($Username === $row['Nama']) {

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

        $_SESSION['foto'] = $row['Foto'];
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
    <nav class="navbar navbar-expand-lg navbar-light" style=" background-color: rgba(255, 255, 255, 100);
        box-shadow: 2px 0px 8px 0px rgb(145, 145, 145);">
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


                    <!--Dropdown-->
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
                    <!--Dropdown-->
                </div>
            </div>
        </div>
    </nav>
    <!-- last navbar -->


    <!--content-->
    <div class="container-fluid" style="margin-top: 200px">
        <!--    <center style="">-->

        <h3>Agen Travel</h3>
        <!--    </center>-->
        <br>
        <p style="text-align: center">Kami bekerja sama dengan berbagai jaringan Agen Travel terbaik di seluruh
            indonesia
            untuk memastikan kenyamanan dan
            pengalaman yang menarik <br> dalam perjalanan traveling Anda!</p><br>
        <div class="row">
            <?php foreach ($paket as $rows) : ?>
                <div class="col-lg">
                    <a href="Menu/pesan.php?paket_id=<?= $rows['Id_paket'] ?>&gambar=<?= $rows['Gambar']; ?>&nama_paket=<?= $rows['Nama']; ?>&lokasiJemput=<?= $lokasi; ?>&tanggalPesan=<?= $tanggalSewa; ?>&durasi=<?= $durasi; ?>&tanggalBerakhir=<?= $tanggalBerakhir; ?>&guest=<?= $guest; ?>"
                       style="color: black; text-decoration: none">

                        <div class="card mb-3" style="max-width: 100%; max-height: 240px">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="asset/Upload/Paket/<?= $rows["Gambar"]; ?>" class="card-img-top" alt="..."
                                         style="max-height:240px ">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $rows["Nama"]; ?></h5>
                                        <p class="card-text"><?= $rows['Deskripsi']; ?></p>
                                        <p>
                                            <img src="asset/icon/lokasi.png" alt=""
                                                 style="width: 25px; height: 25px; margin-right: 10px">
                                            <?= $rows["Alamat"]; ?>
                                        </p>
                                        <div class="card-footer" style="margin-top: 50px">
                                            <div class="row">
                                                <div class="col-lg" style="text-align: right">
                                                    <h5 style=" color: #424242; margin-right: 10px">
                                                        <?php
                                                        $harga_jemput = mysqli_query($con, "SELECT * FROM tb_lokasi WHERE Id_lokasi = '$lokasi'");
                                                        $row1 = mysqli_fetch_assoc($harga_jemput);
                                                        $Hjemput = $row1["Tarif"];

                                                        $paket_id = $rows['Id_paket'];
                                                        $query = mysqli_query($con, "SELECT * FROM `tb_hotel` INNER JOIN tb_paketwisata 
                                                                                            ON tb_hotel.Id_hotel = tb_paketwisata.Id_hotel 
                                                                                            WHERE Id_paket = '$paket_id'");

                                                        $row = mysqli_fetch_assoc($query);

                                                        $biayaHotel = $row['harga'];

                                                        ?>
                                                        Rp. <?= number_format(($biayaHotel * $durasi) + $Hjemput, 2, ',', '.'); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <br>
                    <br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!--last content-->

<?php
require "Header/footer.php"
?>