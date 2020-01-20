<?php
include "koneksi.php";

function query($tampil)
{
  global $con;

  $result = mysqli_query($con, $tampil);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {

    $rows[] = $row;
  }

  return $rows;
}
