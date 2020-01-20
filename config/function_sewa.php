<?php

require "koneksi.php";

function sewa($data)
{

    global $con;

//    to table "tb_pemesanan"
    $id_transaksi = $data["id_transaksi"];
    $ktp = $data["noktp"];
    $id_paket = $data["id_paket"];
    $tgl_pesan = $data["tanggal_sewa"];
    $tg_berakhir = $data["tanggal_berakhir"];
    $id_lokasi = $data["lokasi_jemput"];
    $durasi = $data["durasi"];
    $pengunjung = $data["guest"];
    $status_pesan = "menunggu";
    $id_agen = $data["agen"];


    $tb_pemesanan = "INSERT INTO tb_pemesanan 
                                                    VALUES 
                                ('$id_transaksi','$ktp','$id_paket','$tgl_pesan','$tg_berakhir','$id_lokasi',
                                '$durasi','$pengunjung','$status_pesan','$id_agen')";

//==================================

//    to table tb_pembayran
    $id_tagihan = uniqid();
    $id_tagihan = strtoupper($id_tagihan);
    $biaya_pj = $data["biaya_pp"];
    $biaya_hotel = $data["harga_hotel"];
    $total = $data["total"];
    $status_bayar = "Unpayred";


    $tb_pembayaran = "INSERT INTO tb_pembayaran 
                                                VALUES 
                                                ('$id_tagihan','$id_transaksi','$biaya_hotel','$biaya_pj','$total','$status_bayar','')";


    if (mysqli_query($con, $tb_pemesanan) && mysqli_query($con, $tb_pembayaran)) {

        return mysqli_affected_rows($con);
    }

}

function ubah($data)
{
    global $con;

    $id_tagihan = $data['id_tagihan'];
    $buktiBayar = Upload();

    $query = "UPDATE `tb_pembayaran` SET Bukti_pembayaran = '$buktiBayar', Status_bayar = 'Payred' WHERE `tb_pembayaran`.`Id_tagihan` = '$id_tagihan'";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}

function Upload()
{
    $namaFoto = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $tmp = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

//    Cek upload file atau tidak
    if ($error === 4) {
        return false;
    }


//    cek format file
    $formatValid = ['jpg', 'jpeg', 'png'];
    $formatFoto = explode('.', $namaFoto);
    $formatFoto = strtolower(end($formatFoto));

    if (!in_array($formatFoto, $formatValid)) {

        $error = "Format gambar tidak di dukung";
        return $error;

    }

    // cek size gambar

    if ($ukuran > 2000000) {

        $error = "Ukuran gambar terlalu besar";
        return $error;

    }

    $newNamaFoto = uniqid();
    $newNamaFoto .= '.';
    $newNamaFoto .= $formatFoto;
    $folder = "../asset/Upload/BuktiBayar/";

//  Upload berhasil

    move_uploaded_file($tmp, $folder . $newNamaFoto);

    return $folder . $newNamaFoto;

}

function hapus($id)
{
    global $con;

    $tb_bayar = "DELETE FROM tb_pembayaran WHERE Id_transaksi = '$id' ";
//    $tb_pesanr = "DELETE FROM tb_pemesanan WHERE Id_transaksi = '$id' ";
    mysqli_query($con, $tb_bayar);

    return mysqli_affected_rows($con);
}