<?php
  // Menghubungkan ke database
  require_once "connect.php";

  // Query untuk menghitung total saldo berdasarkan kategori
  $query = "SELECT category, SUM(amount) AS balance FROM balance GROUP BY category";
  $result = $conn->query($query);

  // Membuat array untuk menyimpan saldo berdasarkan kategori
  $balances = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $category = $row['category'];
      $balance = $row['balance'];

      // Menyimpan saldo ke dalam array
      $balances[$category] = $balance;
    }
  }

  // Menutup koneksi
  $conn->close();

  // Mengembalikan hasil sebagai response JSON
  header("Content-Type: application/json");
  echo json_encode($balances);
?>