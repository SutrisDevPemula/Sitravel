<?php
$tanggal = mktime(date("m"), date("d"), date("Y"));
date_default_timezone_set('Singapore');
$jam = date("H:i:s");
$a = date("H");
$pesan = "";

if (($a >= 6) && ($a <= 11)) {
    $pesan = "Selamat Pagi, Tamu!";
} elseif (($a > 11) && ($a <= 15)) {
    $pesan = "Selamat Siang, Tamu!";
} elseif (($a > 15) && ($a <= 18)) {
    $pesan = "Selamat Sore, Tamu!";
} else {
    $pesan = "Selamat Malam, Tamu!";
}
