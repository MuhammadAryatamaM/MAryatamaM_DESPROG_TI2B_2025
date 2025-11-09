<?php
include 'header.php';
?>

<h2>Statistik Masa Kerja Karyawan</h2>

<table class="stats-table">
  <thead>
    <tr>
      <th>Tingkat Pengalaman</th>
      <th>Jumlah Karyawan</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $tenureStats->fetch(PDO::FETCH_ASSOC)):
    ?>
      <tr>
        <td><?php echo htmlspecialchars($row['experience_level']); ?></td>
        <td><?php echo $row['total_employees']; ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
include 'footer.php';
?>
