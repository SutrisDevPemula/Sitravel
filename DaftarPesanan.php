<?php
session_start();
require "config/FunctionTampil.php";
require "Header/header.php"
?>

    <!--SESSION-->
<?php
if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $Username = loginCostumer($email, $password);

    $result = mysqli_query($con, "SELECT * FROM `tb_costumer` WHERE e_mail = '$email'");

    $rows = mysqli_fetch_assoc($result);

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

    <!--penghancuran session-->
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    session_unset();
    $_SESSION = [];

    header("Location:index.php");
    exit();
}
?>

    <!--sql query-->
<?php
$nama = $_SESSION['Username'];

$result = mysqli_query($con, "SELECT * FROM `tb_costumer` WHERE Nama LIKE '%$nama%'");

$rows = mysqli_fetch_assoc($result);

$ktp = $rows['Ktp'];
echo $ktp;

$pesanan = query("SELECT * FROM tb_paketwisata 
                                    INNER JOIN tb_pemesanan 
                                    ON tb_paketwisata.Id_paket = tb_pemesanan.Id_paket 
                                    INNER JOIN tb_pembayaran 
				                    ON tb_pemesanan.Id_transaksi = tb_pembayaran.Id_transaksi
                                    WHERE tb_pemesanan.Ktp = '$ktp' ORDER BY tb_pemesanan.Id_transaksi DESC");

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

    <div class="container" style="margin-top: 200px; font-size: large">
        <!--    <center style="">-->
        <?php foreach ($pesanan as $rowsPesanan) : ?>
            <div class="card mb-3">


                <div class="card-header" style="text-align: right">
                    <!-- Default dropright button -->
                    <div class="btn-group dropright">
                        <button type="button" class="btn btn-link " data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <img src="asset/icon/menu.png" alt="" style="height: 25px">
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                               href="Menu/Tagihan.php?id_transaksi=<?= $rowsPesanan['Id_transaksi']; ?>">Lihat
                                Detail</a>
                            <?php if ($rowsPesanan['Status_bayar'] === "Unpayred") : ?>
                                <a class="dropdown-item"
                                   href="config/hapussewa.php?id_transaksii=<?= $rowsPesanan['Id_transaksi']; ?>">Hapus
                                    dan Batalkan</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <img src="asset/Upload/Paket/<?= $rowsPesanan["Gambar"]; ?>" class="card-img-top" alt="..."
                     style="height: 350px; max-height:350px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <h5 class="card-title"><?= $rowsPesanan['Nama']; ?></h5>
                            <p class="card-text"><?= $rowsPesanan['Alamat']; ?></p>
                        </div>
                        <div class="col-lg" style="text-align: right">
                            <b>Rp. <?= $rowsPesanan['Total_bayar']; ?></b>
                            <p class="card-text"><small
                                        class="text-muted"><?= $rowsPesanan['status_Pemesanan']; ?></small></p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="card-footer" style="text-align: right">
                        <div class="row">
                            <div class="col-lg" style="text-align: left">
                                <p class="card-text"><small class="text-muted">Status
                                        bayar: <?= $rowsPesanan['Status_bayar']; ?></small></p>
                            </div>
                            <div class="col-lg" style="text-align: right">
                                <p class="card-text"><small
                                            class="text-muted"><?= $rowsPesanan['Tgl_pesan']; ?></small>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
require "Header/footer.php"
?>