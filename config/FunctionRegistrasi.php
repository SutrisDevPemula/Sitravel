<link rel="stylesheet" href="../asset/SwitAlert2/sweetalert2.scss">
<?php
include "koneksi.php";

function Registrasi($data)
{
    global $con;

    $noKtp = $data['noktp'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $noTelp = $data['notelp'];
    $email = $data['email'];
    $password = $data['password'];
    $foto = upload();


//    if ($data === "") {
//        return 0;
//    } else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($con, "INSERT INTO tb_costumer VALUES ('$noKtp','$nama','$alamat','$noTelp','$email','$foto','$password')");

    return mysqli_affected_rows($con);
//    }
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
    $folder = "asset/Upload/Costumer/";

//  Upload berhasil

    move_uploaded_file($tmp, $folder . $newNamaFoto);

    return $folder . $newNamaFoto;

}

?>


