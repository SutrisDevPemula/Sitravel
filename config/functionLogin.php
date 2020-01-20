<?php

require "koneksi.php";

function loginCostumer($email, $password)
{
    global $con;


    $email = strtolower($email);

    $result = mysqli_query($con, "SELECT * FROM `tb_costumer` WHERE e_mail = '$email'");

//    Cek Email

    if (mysqli_num_rows($result) > 0) {

        $rows = mysqli_fetch_assoc($result);

        if (password_verify($password, $rows['Password'])) {
            return $rows['Nama'];
        }

    } else {
        return false;


    }

}

