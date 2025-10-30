<?php
// Inisialisasi array transaksi.
$transactions = [];

// Ambil data transaksi dari form sebelumnya (jika ada)
// Data ini dikirim lewat input tersembunyi agar tidak hilang saat menambah data baru.
if (isset($_POST['transactions_json'])) {
  $transactions = json_decode($_POST['transactions_json'], true);
}

// Cek apakah ada form yang di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  $action = $_POST['action'];
  $next_id = count($transactions) + 1;

  if ($action === 'add_income') {
    $transactions[] = [
      'id' => $next_id,
      'type' => 'income',
      'date' => $_POST['date'],
      'amount' => (float)$_POST['amount'],
      'category' => $_POST['category'],
      'asset' => $_POST['asset'],
      'note' => $_POST['note'] ?? '',
    ];
  }

  if ($action === 'add_expense') {
    $transactions[] = [
      'id' => $next_id,
      'type' => 'expense',
      'date' => $_POST['date'],
      'amount' => (float)$_POST['amount'],
      'category' => $_POST['category'],
      'asset' => $_POST['asset'],
      'note' => $_POST['note'] ?? '',
    ];
  }

  if ($action === 'add_transfer') {
    $transactions[] = [
      'id' => $next_id,
      'type' => 'transfer',
      'date' => $_POST['date'],
      'amount' => (float)$_POST['amount'],
      'category' => 'Transfer',
      'asset' => $_POST['from'] . ' → ' . $_POST['to'],
      'note' => $_POST['note'] ?? '',
    ];
  }
}

// ===== BAGIAN FUNGSI-FUNGSI BANTU =====
// Fungsi untuk format mata uang Rupiah
function fmtIDR($n)
{
  return "Rp " . number_format($n, 2, ',', '.');
}

// Fungsi untuk menghitung total KPI
function get_totals($transactions)
{
  $income = 0;
  $expense = 0;
  foreach ($transactions as $t) {
    if ($t['type'] === 'income') $income += $t['amount'];
    if ($t['type'] === 'expense') $expense += $t['amount'];
  }
  return ['income' => $income, 'expense' => $expense, 'total' => $income - $expense];
}

// Fungsi untuk statistik pengeluaran
function get_expense_stats($transactions)
{
  $expense_tx = array_filter($transactions, fn($t) => $t['type'] === 'expense');
  $sum_expense = array_sum(array_column($expense_tx, 'amount'));
  if ($sum_expense === 0) return [];

  $by_cat = [];
  foreach ($expense_tx as $t) {
    $by_cat[$t['category']] = ($by_cat[$t['category']] ?? 0) + $t['amount'];
  }
  arsort($by_cat);

  $stats = [];
  foreach ($by_cat as $category => $amount) {
    $stats[] = [
      'category' => $category,
      'amount' => $amount,
      'pct' => round(($amount / $sum_expense) * 100),
    ];
  }
  return $stats;
}

// Urutkan transaksi sebelum ditampilkan
usort($transactions, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));

// Hitung nilai-nilai yang akan ditampilkan
$totals = get_totals($transactions);
$expense_stats = get_expense_stats($transactions);

// Encode transaksi ke JSON untuk dikirim kembali ke form
$transactions_json = htmlspecialchars(json_encode($transactions));

?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Aplikasi Keuangan</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>

<body>
  <header class="topbar">
    <h1 class="app-title">Aplikasi Keuangan</h1>
  </header>

  <main class="container">
    <section class="greeting">
      <h2>Selamat Datang!</h2>
    </section>

    <!-- Bagian KPI -->
    <section class="kpi-row">
      <article class="card kpi">
        <p class="kpi-label">Total</p>
        <p class="kpi-value"><?php echo fmtIDR($totals['total']); ?></p>
      </article>

      <article class="card kpi kpi-income">
        <p class="kpi-label">Pendapatan</p>
        <p class="kpi-value"><?php echo fmtIDR($totals['income']); ?></p>
      </article>

      <article class="card kpi kpi-expense">
        <p class="kpi-label">Pengeluaran</p>
        <p class="kpi-value"><?php echo fmtIDR($totals['expense']); ?></p>
      </article>
    </section>

    <!-- Bagian Tombol Aksi -->
    <section class="actions-row">
      <button class="card action" id="btn-transfer">
        <div class="action-icon">⇄</div>
        <div class="action-text">
          <strong>Transfer uang</strong>
          <span>Pindahkan aset</span>
        </div>
      </button>

      <button class="card action" id="btn-income">
        <div class="action-icon action-icon-blue">＋</div>
        <div class="action-text">
          <strong>Tambah pendapatan</strong>
          <span>Masukkan nominal pendapatan</span>
        </div>
      </button>

      <button class="card action" id="btn-expense">
        <div class="action-icon action-icon-red">－</div>
        <div class="action-text">
          <strong>Tambah pengeluaran</strong>
          <span>Masukkan nominal pengeluaran</span>
        </div>
      </button>
    </section>

    <!-- Bagian Statistik dan Riwayat -->
    <section class="cols">
      <div class="col">
        <article class="card">
          <header class="card-header">
            <h3>Statistik pengeluaran</h3>
          </header>
          <ul class="stats-list">
            <?php foreach ($expense_stats as $index => $stat): ?>
              <?php $color = ['orange', 'slate', 'lime', 'red', 'blue'][$index % 5]; ?>
              <li class="stat-item">
                <div class="stat-left">
                  <div class="dot <?php echo $color; ?>">•</div>
                  <div class="stat-label"><?php echo htmlspecialchars($stat['category']); ?></div>
                </div>
                <div class="stat-right">
                  <span class="amount"><?php echo fmtIDR($stat['amount']); ?></span>
                  <span class="pct"><?php echo $stat['pct']; ?>%</span>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </article>
      </div>

      <div class="col">
        <article class="card">
          <header class="card-header">
            <h3>Riwayat transaksi</h3>
          </header>
          <div class="table-wrap">
            <table class="table">
              <thead>
                <tr>
                  <th>Kategori</th>
                  <th>Aset</th>
                  <th>Tanggal</th>
                  <th class="text-right">Jumlah</th>
                </tr>
              </thead>

              <tbody>
                <?php if (empty($transactions)): ?>
                  <tr>
                    <td colspan="4" style="text-align:center;color:#6b7280;padding:16px;">Belum ada transaksi</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($transactions as $t): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($t['category']); ?></td>
                      <td><?php echo htmlspecialchars($t['asset']); ?></td>
                      <td><?php echo htmlspecialchars($t['date']); ?></td>
                      <td class="text-right">
                        <?php
                        $sign = $t['type'] === 'income' ? '+' : ($t['type'] === 'expense' ? '-' : '');
                        $cls = $t['type'] === 'income' ? 'amount-income' : ($t['type'] === 'expense' ? 'amount-expense' : 'amount-neutral');
                        echo "<span class='{$cls}'>{$sign}" . fmtIDR($t['amount']) . "</span>"; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </article>
      </div>
    </section>
  </main>

  <!-- ===== BAGIAN DIALOG/POP-UP ===== -->

  <!-- Setiap form di bawah ini akan POST ke index.php itu sendiri -->
  <!-- Input tersembunyi 'action' digunakan untuk memberitahu PHP form mana yang dikirim -->
  <!-- Input tersembunyi 'transactions_json' membawa data yang sudah ada ke request berikutnya -->

  <div id="dialog-income" class="form-dialog" title="Tambah pendapatan" hidden>
    <form method="POST" action="index.php" id="form-income" class="form">
      <input type="hidden" name="action" value="add_income">
      <input type="hidden" name="transactions_json" value='<?php echo $transactions_json; ?>'>

      <div class="field">
        <label for="income-date">Tanggal*</label>
        <input type="date" name="date" id="income-date" required />
      </div>

      <div class="field">
        <label for="income-amount">Jumlah*</label>
        <input type="number" name="amount" id="income-amount" placeholder="Rp " required />
      </div>

      <div class="field">
        <label for="income-category">Kategori*</label>
        <select name="category" id="income-category" required>
          <option value="">Pilih</option>
          <option>Gaji</option>
          <option>Bonus</option>
        </select>
      </div>

      <div class="field">
        <label for="income-asset">Aset*</label>
        <select name="asset" id="income-asset" required>
          <option value="">Pilih</option>
          <option>Bank</option>
          <option>Tunai</option>
        </select>
      </div>

      <div class="field">
        <label for="income-note">Catatan</label>
        <input type="text" name="note" id="income-note" placeholder="Opsiohal" />
      </div>
      <p class="error" id="income-error"></p>
      <button type="submit" class="btn-primary">Simpan</button>
    </form>
  </div>

  <div id="dialog-expense" class="form-dialog" title="Tambah pengeluaran" hidden>
    <form method="POST" action="index.php" id="form-expense" class="form">
      <input type="hidden" name="action" value="add_expense">
      <input type="hidden" name="transactions_json" value='<?php echo $transactions_json; ?>'>
      <div class="field">
        <label for="expense-date">Tanggal*</label>
        <input type="date" name="date" id="expense-date" required />
      </div>

      <div class="field">
        <label for="expense-amount">Jumlah*</label>
        <input type="number" name="amount" id="expense-amount" required />
      </div>

      <div class="field">
        <label for="expense-category">Kategori*</label>
        <select name="category" id="expense-category" required>
          <option value="">Pilih</option>
          <option>Makanan</option>
          <option>Transportasi</option>
        </select>
      </div>

      <div class="field">
        <label for="expense-asset">Aset*</label>
        <select name="asset" id="expense-asset" required>
          <option value="">Pilih</option>
          <option>Bank</option>
          <option>Tunai</option>
        </select>
      </div>

      <div class="field">
        <label for="expense-note">Catatan</label>
        <input type="text" name="note" id="expense-note" placeholder="Opsional" />
      </div>

      <p class="error" id="expense-error"></p><button type="submit" class="btn-primary">Simpan</button>
    </form>
  </div>

  <div id="dialog-transfer" class="form-dialog" title="Transfer uang" hidden>
    <form method="POST" action="index.php" id="form-transfer" class="form">
      <input type="hidden" name="action" value="add_transfer">
      <input type="hidden" name="transactions_json" value='<?php echo $transactions_json; ?>'>
      <div class="field">
        <label for="transfer-date">Tanggal*</label>
        <input type="date" name="date" id="transfer-date" required />
      </div>

      <div class="field">
        <label for="transfer-amount">Jumlah*</label>
        <input type="number" name="amount" id="transfer-amount" placeholder="Rp " required />
      </div>

      <div class="field">
        <label for="transfer-from">Dari Aset*</label>
        <select name="from" id="transfer-from" required>
          <option value="">Pilih</option>
          <option>Bank</option>
          <option>Tunai</option>
        </select>
      </div>

      <div class="field">
        <label for="transfer-to">Ke Aset*</label>
        <select name="to" id="transfer-to" required>
          <option value="">Pilih</option>
          <option>Bank</option>
          <option>Tunai</option>
        </select>
      </div>

      <div class="field">
        <label for="transfer-note">Catatan</label>
        <input type="text" name="note" id="transfer-note" placeholder="opsional" />
      </div>
      <p class="error" id="transfer-error"></p><button type="submit" class="btn-primary">Simpan</button>
    </form>
  </div>

  <script src="app.js"></script>
</body>

</html>
