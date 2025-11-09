<?php
include 'header.php';
?>

<h2>Statistik Gaji per Departemen</h2>

<table class="stats-table">
  <thead>
    <tr>
      <th>Departemen</th>
      <th>Rata-rata Gaji</th>
      <th>Gaji Tertinggi</th>
      <th>Gaji Terendah</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $salaryStats->fetch(PDO::FETCH_ASSOC)): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['department']); ?></td>
        <td>Rp <?php echo number_format($row['avg_salary'], 2, ',', '.'); ?></td>
        <td>Rp <?php echo number_format($row['max_salary'], 2, ',', '.'); ?></td>
        <td>Rp <?php echo number_format($row['min_salary'], 2, ',', '.'); ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
include 'footer.php';
?>
