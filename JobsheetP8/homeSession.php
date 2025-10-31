<?php
session_start();
?>
<html>

<head>
  <title>Halaman Home</title>
</head>

<body>
  <?php
  if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') { // Tambahkan 'isset' untuk keamanan
    echo "Selamat datang " . $_SESSION['username'];
  ?>
    <br><a href="sessionLogout.php">Logout</a>
  <?php
  } else {
    echo "Anda belum login, silahkan";
  ?>
    <a href="sessionLoginForm.html">Login</a>
  <?php
  }
  ?>
</body>

</html>
