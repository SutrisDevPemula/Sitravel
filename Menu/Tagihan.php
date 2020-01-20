<?php
session_start();

require "../config/FunctionTampil.php";
?>

<?php
$id_transaksi = $_GET["id_transaksi"];
$tagihan = query("SELECT * FROM tb_paketwisata 
                                    INNER JOIN tb_pemesanan 
                                    ON tb_paketwisata.Id_paket = tb_pemesanan.Id_paket 
                                    INNER JOIN tb_pembayaran 
				                    ON tb_pemesanan.Id_transaksi = tb_pembayaran.Id_transaksi
                                    WHERE tb_pemesanan.Id_transaksi = '$id_transaksi'");
?>

<?php
require "../config/function_sewa.php";
if (isset($_POST["unggah"])) {
    if (ubah($_POST) != 0) {
        echo "<script>
                Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Bukti pembayaran berhasil diunggah.',
                        showConfirmButton: false,
                        timer: 2100
                    });
                document.location = 'DaftarPesanan.php';
               </script>";
    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Bukti pembayaran gagal diunggah',
                    })
                </script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- css with bootstrap -->
    <link rel="stylesheet" href="../asset/bootsrap/bootstrap.css">
    <!-- last css with bootstrap -->

    <!-- my css -->
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/SwitAlert2/sweetalert2.scss">

    <!-- last my css -->

    <title>SITRAVEL</title>
</head>
<body>

<!-- Navbar -->
<div id="potition" style="position: fixed; z-index: 1000; width: 100%;">
    <nav class="navbar  bg-light" style="background-color: white;">
        <a class="navbar-barnds" href="#"
           style="font-family:'Condiment', 'Marck Script', 'cursive'; font-size: 30px; margin-left: 100px; color: #040505; text-transform: uppercase">
            <!-- SiRent -->
            SITravel
        </a>
        <ul class="nav" style="margin-right: 300px">

            <li class="nav-item" style="margin-left: 15px">
                <div style="background-color: #4e555b; width: 25px;border-radius: 100px; text-align: center; color: white">
                    2
                </div>
            </li>
            <li class="nav-item">
                <a href="../DaftarPesanan.php">
                    <h6 class="font-weight-normal" style="margin-left: 5px;"> Daftar pesanan</h6>
                </a>
            </li>

            <li class="nav-item" style="margin-left: 15px">
                <div style="background-color: #4e555b; width: 30px; height: 3px; margin-top: 10px; border-radius: 100px"></div>
            </li>

            <li class="nav-item" style="margin-left: 15px">
                <div style="background-color:#005cbf; width: 25px;border-radius: 100px; text-align: center; color: white">
                    2
                </div>
            </li>
            <li class="nav-item">
                <h6 class="font-weight-normal" style="margin-left: 5px; color:#005cbf"> Tagihan</h6>
            </li>

        </ul>
    </nav>
</div>
<br>
<!--Last Navbar-->
<?php foreach ($tagihan as $tagihan): ?>
    <div class="container">
        <br>
        <br>
        <br>
        <h3>Informasi Tagihan</h3>
        <br>
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            No Tagihan
                        </div>
                        <div class="col-lg-6" style="text-align: right">
                            <?= $tagihan['Id_tagihan']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Status Bayar <p></p><b><?= $tagihan['Status_bayar']; ?></b></li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-6">
                                Total Tagihan <p></p> <b>Rp. <?= $tagihan['Total_bayar']; ?></b><br><br>
                                Biaya Hotel <p></p> <b>Rp. <?= $tagihan['biaya_hotel']; ?></b><br><br>
                                Biaya Antar Jemput <p></p> <b>Rp. <?= $tagihan['Harga_jemput']; ?></b>

                            </div>
                            <div class="col-lg-6" style="text-align: right">
                                Rincian
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-header"></div>
            <div class="container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Alamat Penjemputan <p></p>
                        <hr>
                        <b><?= $_SESSION["Username"]; ?>.</b>
                        <p>
                            <?php
                            require "../config/koneksi.php";
                            $id = $tagihan['Id_lokasi'];
                            $lokasiJemput = mysqli_query($con, "SELECT * FROM `tb_lokasi` WHERE Id_lokasi = '$id'");

                            $rowLokasi = mysqli_fetch_assoc($lokasiJemput);

                            echo $rowLokasi["Deskripsi"];
                            ?>
                        </p></li>
                </ul>
            </div>
            <div class="card-header"></div>
            <div class="container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nomor Transaksi<p></p>
                        <hr>
                        <b><?= $tagihan['Id_transaksi']; ?></b>
                    </li>
                    <li class="list-group-item">
                        Info Paket<p></p>
                        <hr>
                        <div class="row">
                            <div class="col-lg">
                                <b><?= $tagihan['Nama']; ?></b>
                                <p>
                                    Lama: <?= $tagihan['Durasi']; ?> hari
                                </p>

                            </div>
                            <div class="col-lg" style="text-align: right">
                                <img src="../asset/Upload/Paket/<?= $tagihan['Gambar']; ?>" alt=""
                                     style="width: 70px; height: 70px">
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-6">
                                Bukti Pembayaran<p></p>
                                <?= $tagihan['Status_bayar']; ?>
                            </div>
                            <div class="col-lg-6" style="text-align: right">
                                <b>
                                    <!-- Button trigger modal -->
                                    <?php if ($tagihan['Status_bayar'] === "Unpayred") : ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                            Unggah bukti pembayaran
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal" disabled>
                                            Unggah bukti pembayaran
                                        </button>
                                    <?php endif; ?>
                                    <br>
                                    <br>
                                    <img src="<?= $tagihan['Bukti_pembayaran']; ?>" alt=""
                                         style="width: 70px; height: 70px">
                                </b>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<br><br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah bukti
                    pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="buktiBayar" style="text-align: left">Bukti pembayaran</label>
                            </div>
                            <div class="col">
                                <img src="" alt="">
                            </div>
                        </div>
                        <input type="file" class="form-control" id="buktiBayar" name="foto"
                               placeholder="unggah bukti pembayaran">
                        <input type="text" class="form-control" id="buktiBayar" name="id_tagihan"
                               value="<?= $tagihan['Id_tagihan']; ?>" hidden>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" name="unggah">Unggah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- jquery or js with bootstrap -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../asset/js/jquery-3.3.1.slim.min.js"></script>
<script src="../asset/SwitAlert2/sweetalert2.js"></script>
<script src="../asset/js/popper.min.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/script.js"></script>
<!-- last jquery or js with bootstrap-->
</body>
</html>
