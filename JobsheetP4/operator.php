<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "a = {$a}, b = {$b} <br><br>";
echo "Hasil Tambah: {$hasilTambah} <br>";
echo "Hasil Kurang: {$hasilKurang} <br>";
echo "Hasil Kali: {$hasilKali} <br>";
echo "Hasil Bagi: {$hasilBagi} <br>";
echo "Sisa Bagi: {$sisaBagi} <br>";
echo "Pangkat: {$pangkat} <br><br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "Hasil Sama: {$hasilSama} <br>";
echo "Hasil Tidak Sama: {$hasilTidakSama} <br>";
echo "Hasil Lebih Kecil: {$hasilLebihKecil} <br>";
echo "Hasil Lebih Besar: {$hasilLebihBesar} <br>";
echo "Hasil Lebih Kecil Sama: {$hasilLebihKecilSama} <br>";
echo "Hasil Lebih Besar Sama: {$hasilLebihBesarSama} <br><br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "Hasil AND: {$hasilAnd} <br>";
echo "Hasil OR: {$hasilOr} <br>";
echo "Hasil NOT A: {$hasilNotA} <br>";
echo "Hasil NOT B: {$hasilNotB} <br><br>";

$a += $b;
echo "Nilai a sekarang: {$a} <br>";
$a -= $b;
echo "Nilai a sekarang: {$a} <br>";
$a *= $b;
echo "Nilai a sekarang: {$a} <br>";
$a /= $b;
echo "Nilai a sekarang: {$a} <br>";
$a %= $b;
echo "Nilai a sekarang: {$a} <br><br>";

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "Hasil Identik: {$hasilIdentik} <br>";
echo "Hasil Tidak Identik: {$hasilTidakIdentik} <br><br>";

$total = 45;
$terpakai = 28;
$persenKosong = (($total - $terpakai) / $terpakai) * 100;
echo "Dengan {$terpakai} kursi terpakai, ada {$persenKosong}% kursi yang kosong";

?>
