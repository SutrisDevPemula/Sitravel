<?php

require "function_sewa.php";

$id = $_GET['id_transaksii'];

if (hapus($id) > 0) {
    echo "<script language = 'JavaScript'>
                    alert('data berhasil dihapus');
    document.location = '../DaftarPesanan.php';
    </script>";
} else {
    echo "<script language = 'JavaScript'>
    alert('data gagal dihapus');
    document.location = '../DaftarPesanan.php';
    </script>";

}