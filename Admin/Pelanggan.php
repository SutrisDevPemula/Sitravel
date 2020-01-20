<?php
include('includes/header.php');
?>
<div class="main_content">
    <div class="header">Pelanggan</div>
    <div class="container">
        <h4 style="text-align: center">DAFTAR PELANGGAN</h4>
        <div class="table-responsive">
            <a href="tambah_mhs.php" style="float: right" class="btn btn-success">Simpan</a>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>ID Customer</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
            </table>
        </div>
        <?php
  include('includes/footer.php');
 ?>