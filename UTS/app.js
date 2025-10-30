// --- FUNGSI UNTUK MEMBUKA DIALOG --- 
function openIncomeDialog() {
  $("#income-error").text("");
  $("#form-income")[0].reset();
  $("#dialog-income").dialog({ modal: true, width: 420, closeText: "Tutup" });
}

function openExpenseDialog() {
  $("#expense-error").text("");
  $("#form-expense")[0].reset();
  $("#dialog-expense").dialog({ modal: true, width: 420, closeText: "Tutup" });
}

function openTransferDialog() {
  $("#transfer-error").text("");
  $("#form-transfer")[0].reset();
  $("#dialog-transfer").dialog({ modal: true, width: 420, closeText: "Tutup" });
}

// --- FUNGSI VALIDASI --- 
function required(v) {
  return v !== undefined && v !== null && String(v).trim() !== "";
}

function validAmount(n) {
  return Number.isFinite(+n) && +n > 0;
}

// --- EVENT LISTENER UNTUK VALIDASI FORM --- 
$("#form-income").on("submit", function (e) {
  const date = $("#income-date").val();
  const amount = +$("#income-amount").val();
  const category = $("#income-category").val();
  const asset = $("#income-asset").val();

  if (!required(date) || !validAmount(amount) || !required(category) || !required(asset)) {
    e.preventDefault(); // Hentikan pengiriman form
    $("#income-error").text("Harap isi semua bidang wajib dengan benar.");
  }
});

$("#form-expense").on("submit", function (e) {
  const date = $("#expense-date").val();
  const amount = +$("#expense-amount").val();
  const category = $("#expense-category").val();
  const asset = $("#expense-asset").val();

  if (!required(date) || !validAmount(amount) || !required(category) || !required(asset)) {
    e.preventDefault(); // Hentikan pengiriman form
    $("#expense-error").text("Harap isi semua bidang wajib dengan benar.");
  }
});

$("#form-transfer").on("submit", function (e) {
  const date = $("#transfer-date").val();
  const amount = +$("#transfer-amount").val();
  const from = $("#transfer-from").val();
  const to = $("#transfer-to").val();

  if (!required(date) || !validAmount(amount) || !required(from) || !required(to)) {
    e.preventDefault(); // Hentikan pengiriman form
    $("#transfer-error").text("Harap isi semua bidang wajib dengan benar.");
    return;
  }
  if (from === to) {
    e.preventDefault(); // Hentikan pengiriman form
    $("#transfer-error").text("Aset awal dan aset tujuan harus berbeda.");
  }
});

// --- EVENT LISTENER UNTUK TOMBOL AKSI ---
$("#btn-income").on("click", openIncomeDialog);
$("#btn-expense").on("click", openExpenseDialog);
$("#btn-transfer").on("click", openTransferDialog);
