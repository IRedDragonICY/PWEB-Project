<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Mengambil nilai jumlah dari formulir
  $amount = $_POST['amount'];

  // TODO: Lakukan logika untuk melakukan penarikan

  // Redirect ke halaman yang sesuai setelah penarikan berhasil
  header('Location: home.php');
  exit;
}
?>