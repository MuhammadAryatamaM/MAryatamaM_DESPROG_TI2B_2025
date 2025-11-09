<?php
date_default_timezone_set("Asia/Jakarta");
$koneksi = mysqli_connect("db", "rya", "itzarya", "prakwebdb");

if (mysqli_connect_errno()) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
