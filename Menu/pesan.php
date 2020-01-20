<?php
session_start();
require "../config/koneksi.php";
require "../config/function_sewa.php";
require "../config/FunctionTampil.php";
?>

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

$lokasi = $_GET["lokasiJemput"];

//$lokasi = query("SELECT * FROM `tb_lokasi` WHERE Id_lokasi = '$lokasi'");

$lokasiJemput = mysqli_query($con, "SELECT * FROM `tb_lokasi` WHERE Id_lokasi = '$lokasi'");

$rowLokasi = mysqli_fetch_assoc($lokasiJemput);

$lokasiAnda = $rowLokasi["Deskripsi"];

$tanggalSewa = $_GET["tanggalPesan"];
$durasi = $_GET["durasi"];
$tanggalBerakhir = $_GET["tanggalBerakhir"];
$guest = $_GET["guest"];
$paket_id = $_GET["paket_id"];
$gambar = $_GET["gambar"];
$nama_paket = $_GET["nama_paket"];


$query = mysqli_query($con, "SELECT * FROM `tb_hotel` INNER JOIN tb_paketwisata 
                                            ON tb_hotel.Id_hotel = tb_paketwisata.Id_hotel 
                                            WHERE Id_paket = '$paket_id'");

$row = mysqli_fetch_assoc($query);

$biayaHotel = $row['harga'];

//membuat id otomatis
$id_transaksi = uniqid();
$id_transaksi = strtoupper($id_transaksi);


?>

<?php
if (isset($_POST['lanjut'])) {
    if (sewa($_POST) > 0) {
        echo "<script>
                Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Pesanan anda berhasil, mohon menunggu informasi selanjutnya',
                        showConfirmButton: false,
                        timer: 2100
                    })
               </script>";
        header("Location:../DaftarPesanan.php");

    } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Proses gagal!',
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
                <h6 class="font-weight-normal" style="margin-left: 5px;"> Rincian data</h6>
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

<div class="container ShadowBox" style="margin-top: 50px; margin-bottom: 30px; padding: 40px">
    <form method="post">
        <div class="row">
            <div class="col-lg-5">
                <div class="card" style="height: 350px; width: 100%">
                    <!--                    <div class="card-body" style="height: 350px; width: 100%">-->
                    <img src="../asset/Upload/Paket/<?= $gambar; ?>" class="rounded" alt="...">
                    <!--                    </div>-->
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Agen travel</label>
                            <small id="emailHelp" class="form-text text-muted">Anda dapat memilih agen travel yang akan
                                menemani perjalanan anda menuju tujuan wisata yang anda pilih. <p></p></small>
                            <select class="form-control" id="exampleFormControlSelect1" name="agen">
                                <?php $agen = mysqli_query($con, "SELECT * FROM `tb_agentravel`");
                                $row1 = mysqli_fetch_assoc($agen);
                                foreach ($agen as $agen) :
                                    ?>
                                    <option value="<?= $agen["Id_agen"]; ?>"><?= $agen["Nama_prusahaan"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="../index.php">
                                    <button type="button" class="btn btn-danger">Batalkan</button>
                                </a>
                            </div>
                            <div class="col">
                                <a href="../Paket.php?lokasiJemput=<?= $lokasi; ?>&tanggalPesan=<?= $tanggalSewa; ?>&durasi=<?= $durasi; ?>&tanggalBerakhir=<?= $tanggalBerakhir; ?>&guest=<?= $guest; ?>">
                                    <button type="button" class="btn btn-info">Pilih paket</button>
                                </a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success" name="lanjut">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">

                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Id Transaksi</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="12"
                                       value="<?= $id_tr = $id_transaksi; ?>" name="id_transaksi"
                                       style="text-align: right">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="12"
                                       value="<?= $paket_id; ?>" name="id_paket" style="text-align: right" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nm_paket" class="col-sm-3 col-form-label">Nama paket</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="nm_paket" placeholder="" name="nama_paket"
                                       value="<?= $nama_paket; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tglPesan" class="col-sm-3 col-form-label">Tanggal pesan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="tglPesan" placeholder=""
                                       value="<?= $tanggalSewa; ?>" name="tanggal_sewa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="durasi" class="col-sm-3 col-form-label">Durasi</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="durasi" placeholder=""
                                       value="<?= $durasi; ?>" name="durasi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_berakhir" class="col-sm-3 col-form-label">Tanggal berakhir</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="tanggal_berakhir" placeholder=""
                                       value="<?= $tanggalBerakhir; ?>" name="tanggal_berakhir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="guest" class="col-sm-3 col-form-label">Guest</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="guest" placeholder=""
                                       value="<?= $guest; ?>" name="guest">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lokasi_jemput" class="col-sm-3 col-form-label">Lokasi jemput</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="lokasi_jemput" placeholder=""
                                       value="<?= $lokasiAnda; ?>">
                            </div>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="lokasi_jemput" placeholder=""
                                       value="<?= $lokasi; ?>" name="lokasi_jemput" hidden>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="noktp" class="col-sm-3 col-form-label">No ktp</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="noktp" placeholder=""
                                       value="<?= $_SESSION['noKtp']; ?>" name="noktp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lokasi_jemput" placeholder=""
                                       value="<?= $_SESSION['Username']; ?>" name="nama" style="text-align: right">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notelp" class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="notelp" placeholder=""
                                       value="<?= $_SESSION['noTelp']; ?>" name="notelp" style="text-align: right">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6 style="text-transform: capitalize; font-weight: bold">Rincian biaya :</h6>
                        <br>
                        <div class="form-group row">
                            <label for="harga_hotel" class="col-sm-8 col-form-label">Harga hotel (<?= $durasi; ?>
                                Hari)</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="harga_hotel"
                                       value="<?= number_format($biayaHotel * $durasi, 2, ',', '.'); ?>"
                                       name="harga_hotel1">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="harga_hotel"
                                       value="<?= $biayaHotel * $durasi; ?>"
                                       name="harga_hotel" hidden>
                            </div>
                        </div>
                        <?php
                        $harga_jemput = mysqli_query($con, "SELECT * FROM tb_lokasi WHERE Id_lokasi = '$lokasi'");
                        $row1 = mysqli_fetch_assoc($harga_jemput);
                        $Hjemput = $row1["Tarif"];
                        ?>
                        <div class="form-group row">
                            <label for="harga_pj" class="col-sm-8 col-form-label">Harga jemput & antar</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="harga_pj"
                                       value="<?= number_format($Hjemput * 2, 2, ',', '.'); ?>" name="harga_pj1">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" style="text-align: right"
                                       id="harga_pj"
                                       value="<?= $Hjemput * 2 ?>" name="biaya_pp" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga_pj" class="col-sm-8 col-form-label">Harga cemilan</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext"
                                       style="text-align: right; color: blue"
                                       id="harga_pj"
                                       value="GRATIS" name="harga_pj">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row">
                                <label for="harga_pj" class="col-sm-8 col-form-label">Anda bayar</label>
                                <div class="col-sm-4">
                                    <input type="text" readonly class="form-control-plaintext"
                                           style="text-align: right; color: #070707; font-weight: bold"
                                           id="harga_pj"
                                           value="<?= number_format(($biayaHotel * $durasi) + ($Hjemput * 2), 2, ',', '.'); ?>"
                                           name="total1">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" readonly class="form-control-plaintext"
                                           style="text-align: right; color: #070707; font-weight: bold"
                                           id="harga_pj"
                                           value="<?= ($biayaHotel * $durasi) + ($Hjemput * 2); ?>"
                                           name="total" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>




<script src="asset/js/jquery-3.3.1.slim.min.js"></script>
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/sweetalert2.js"></script>
<script src="asset/js/script.js"></script>
</body>
</html>