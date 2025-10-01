<?php
$nama = @$_GET['nama'];
$usia = @$_GET['usia']; // pakai @ agar tak ada peringatan error ketika key kosong
echo "Halo {$nama}! Apakah benar anda berusia {$usia} tahun?"
?>
