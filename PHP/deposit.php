<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Mengambil nilai jumlah dari formulir
  $amount = $_POST['amount'];

  // TODO: Lakukan logika untuk melakukan deposit

  // Redirect ke halaman yang sesuai setelah deposit berhasil
  header('Location: home.php');
  exit;
}
?>