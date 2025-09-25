<?php
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
  echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
  echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
  echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
  echo "Nilai huruf: D";
}

############################

$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
  $jarakSaatIni += $peningkatanHarian;
  $hari++;
}

echo "<br> Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer. <br>";

############################

$jumlahLahan =  10;
$tanamanPerLahan =  5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) {
  $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}

echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah <br>";

############################

$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
  $totalSkor += $skor;
}

echo "Total skor ujian adalah: $totalSkor <br>";

############################

$nilaiSiswa = [85, 92, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
  if ($nilai < 60) {
    echo "Nilai: $nilai (Tidak lulus) <br>";
    continue;
  }
  echo "Nilai: $nilai (Lulus) <br>";
}

############################

$nilaiMtk = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
$nilaiTerendah1 = 101; 
$nilaiTerendah2 = 101;
$nilaiTertinggi1 = -1;
$nilaiTertinggi2 = -1;

foreach ($nilaiMtk as $nilai) {
  if ($nilai < $nilaiTerendah1) {
    $nilaiTerendah2 = $nilaiTerendah1;
    $nilaiTerendah1 = $nilai;
  } elseif ($nilai < $nilaiTerendah2) {
    $nilaiTerendah2 = $nilai;
  }

  if ($nilai > $nilaiTertinggi1) {
    $nilaiTertinggi2 = $nilaiTertinggi1;
    $nilaiTertinggi1 = $nilai;
  } elseif ($nilai > $nilaiTertinggi2) {
    $nilaiTertinggi2 = $nilai;
  }
}

$total = 0;
$arrayCount = 0;

foreach ($nilaiMtk as $nilai) {
  if ($nilai == $nilaiTerendah1 || $nilai == $nilaiTerendah2 || $nilai == $nilaiTertinggi1 || $nilai == $nilaiTertinggi2) {
    continue;
  }
  $total += $nilai;
  $arrayCount++;
}
$rerata = ($total / $arrayCount);
echo "Rata rata nilainya adalah $rerata <br>";

############################

$hargaBayar = 120000;
$dapatDiskon = 100000;
$diskon = (1 - 0.2); # 0.2 = 20%

if ($hargaBayar > $dapatDiskon) {
  $hargaBayar *= $diskon;
}

echo "Harga yang dibayar adalah Rp$hargaBayar <br>";

############################

$skor1 = 400;
$skor2 = 600;

echo "Total skor 1 adalah: $skor1<br>";
echo "Apakah 1 mendapatkan hadiah tambahan? " . (($skor1 > 500) ? "YA" : "TIDAK" . "<br>");
echo "Total skor 2 adalah: $skor2<br>";
echo "Apakah 2 mendapatkan hadiah tambahan? " . (($skor2 > 500) ? "YA" : "TIDAK" . "<br>");

?>
