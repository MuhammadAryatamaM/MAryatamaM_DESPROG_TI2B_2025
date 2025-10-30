<?php
$input_result = "";
$email_result = "";

if (isset($_POST['submit_input'])) {
  $input = $_POST['input'];
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

  $input_result = "Teks yang sudah diamankan: " . $input;
}

if (isset($_POST['submit_email'])) {
  $email = $_POST['email'];

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_result = "Email Anda: " . htmlspecialchars($email) . " adalah valid.";
  } else {
    $email_result = "Input '" . htmlspecialchars($email) . "' BUKAN email yang valid.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <title>Latihan HTML Aman</title>

<body>
  <h2>Latihan 1: htmlspecialchars</h2>
  <form action="html_aman.php" method="post">
    <label for="input">Masukkan teks: </label>
    <input type="text" id="input" name="input" size="30">
    <input type="submit" name="submit_input" value="Kirim Teks">
  </form>

  <?php if ($input_result): ?>
    <p class="result"><?php echo $input_result; ?></p>
  <?php endif; ?>

  <hr>

  <h2>Latihan 2: filter_var</h2>
  <form action="html_aman.php" method="post">
    <label for="email">Masukkan email:</label>
    <input type="text" id="email" name="email" size="30">
    <input type="submit" name="submit_email" value="Validasi Email">
  </form>

  <?php if ($email_result): ?>
    <p class="<?php echo (strpos($email_result, 'BUKAN') !== false) ? 'error' : 'result'; ?>">
      <?php echo $email_result; ?>
    </p>
  <?php endif; ?>

</body>

</html>
