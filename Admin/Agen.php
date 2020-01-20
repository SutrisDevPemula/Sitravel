<?php
include('includes/header.php');
?>
    <div class="main_content">
        <div class="header">Agen Travel</div>
        <div class="container">
            <h4 style="text-align: center; margin-bottom: 70px">DAFTAR AGENT</h4>

            <!-- Large modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large
                Tambah Data
            </button>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true" >
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content" style="padding: 25px">
                        <form method="post">
                            <div class="form-group">
                                <label for="id_agen">ID_Travel</label>
                                <input type="text" class="form-control" id="id_agen" name="id_agen">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Agen</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="notelp">No Telp</label>
                                <input type="text" class="form-control" id="notelp" name="no_telp">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- last Modal -->

            <div class="table-responsive" style="margin-top: 30px">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Travel</th>
                        <th>Nama Agensi</th>
                        <th>Alamat Agensi</th>
                        <th>Nomor Hp</th>
                        <th>KTP</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                </table>
            </div>
<?php
include('includes/footer.php');
?>