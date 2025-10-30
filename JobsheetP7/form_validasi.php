<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST["nama"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $errors = array();

  // Validasi Nama
  if (empty($nama)) {
    $errors[] = "Nama harus diisi.";
  }

  // Validasi Email
  if (empty($email)) {
    $errors[] = "Email harus diisi.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
  }

  // Validasi Password
  if (empty($password)) {
    $errors[] = "Password harus diisi.";
  } elseif (strlen($password) < 8) {
    $errors[] = "Password minimal 8 karakter.";
  }

  // Jika ada kesalahan validasi
  if (!empty($errors)) {
    foreach ($errors as $Error) {
      echo $Error . "<br>";
    }
  } else {
    // Lanjutkan dengan pemrosesan data jika semua validasi berhasil
    echo "Data berhasil dikirim: Nama = $nama, Email = $email";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Form Input dengan Validasi</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <h1>Form Input dengan Validasi</h1>
  <form id="myForm" method="post" action="form_validasi.php">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama">
    <span id="nama-error" style="color: red;"></span><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email">
    <span id="email-error" style="color: red;"></span><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <span id="password-error" style="color: red;"></span><br>

    <input type="submit" value="Submit">
  </form>

  <div id="hasil" style="margin-top: 15px; font-weight: bold;"></div>


  <script>
    $(document).ready(function() {
      $("#myForm").submit(function(event) {

        event.preventDefault();

        $("#nama-error").text("");
        $("#email-error").text("");
        $("#password-error").text("");
        $("#hasil").html("");

        var nama = $("#nama").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var valid = true;

        // Validasi Nama
        if (nama === "") {
          $("#nama-error").text("Nama harus diisi.");
          valid = false;
        }

        // Validasi Email
        if (email === "") {
          $("#email-error").text("Email harus diisi.");
          valid = false;
        }

        // Validasi Password
        if (password === "") {
          $("#password-error").text("Password harus diisi.");
          valid = false;
        } else if (password.length < 8) {
          $("#password-error").text("Password minimal 8 karakter.");
          valid = false;
        }

        if (!valid) {
          return;
        }

        var formData = $("#myForm").serialize();

        $.ajax({
          url: "form_validasi.php",
          type: "POST",
          data: formData,
          success: function(response) {
            $("#hasil").html(response);
          },
          error: function() {
            $("#hasil").html("Terjadi kesalahan koneksi.");
          }
        });

      });
    });
  </script>
</body>

</html>
