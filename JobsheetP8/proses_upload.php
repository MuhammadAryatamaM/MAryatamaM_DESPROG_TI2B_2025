<?php
// Lokasi penyimpanan file yang diunggah
$targetDirectory = "documents/";

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
  mkdir($targetDirectory, 0777, true);
}

$allowedExtensions = array("jpg", "jpeg", "png", "gif");

if ($_FILES['files']['name'][0]) {
  $totalFiles = count($_FILES['files']['name']);

  // Loop melalui semua file yang diunggah
  for ($i = 0; $i < $totalFiles; $i++) {
    $fileName = $_FILES['files']['name'][$i];
    $targetFile = $targetDirectory . $fileName;

    // Dapatkan ekstensi
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah ekstensi file ada di dalam array yang diizinkan
    if (in_array($fileType, $allowedExtensions)) {
      if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
        echo "File gambar $fileName berhasil diunggah.<br>";
      } else {
        echo "Gagal mengunggah file $fileName.<br>";
      }
    } else {
      echo "File bukan gambar dan dilewati.<br>";
    }
    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
      echo "File $fileName berhasil diunggah.<br>";
    } else {
      echo "Gagal mengunggah file $fileName.<br>";
    }
  }
} else {
  echo "Tidak ada file yang diunggah.";
}
