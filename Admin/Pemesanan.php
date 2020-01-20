<?php
include('includes/header.php');
?>
<div class="main_content">
    <div class="header">Pemesanan</div>
    <div class="container">
        <h4 style="text-align: center">DAFTAR AGENT</h4>
        <div class="table-responsive">
            <a href="tambah_mhs.php" style="float: right" class="btn btn-success">Simpan</a>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pesan</th>
                        <th>ID Customer</th>
                        <th>ID Paket Wisata</th>
                        <th>ID Fasilitas</th>
                        <th>ID Hotel</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Berakhir</th>
                        <th>Durasi</th>
                        <th>Kapasitas Pengunjung</th>
                    </tr>
                </thead>
            </table>
        </div>
        <?php
  include('includes/footer.php');
 ?>