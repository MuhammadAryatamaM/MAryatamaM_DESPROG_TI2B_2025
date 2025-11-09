<?php
include 'header.php';
?>

<h2>Ringkasan Karyawan</h2>

<div class="stats-grid">
  <div class="card">
    <h3>Total Karyawan</h3>
    <div class="number"><?php echo $overview['total_employees']; ?></div>
  </div>
  <div class="card">
    <h3>Total Gaji per Bulan</h3>
    <div class="number">Rp <?php echo number_format($overview['total_salary'], 2, ',', '.'); ?></div>
  </div>
  <div class="card">
    <h3>Rata-rata Masa Kerja</h3>
    <div class="number"><?php echo number_format($overview['avg_tenure'], 1, ',', '.'); ?> tahun</div>
  </div>
</div>

<?php
include 'footer.php';
?>
