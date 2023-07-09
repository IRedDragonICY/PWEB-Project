<?php
// Konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
// $username = "username";
// $password = "password";
$database = "database_name";

// Membuat koneksi ke database
// $conn = mysqli_connect($host, $username, $password, $database);
$conn = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengambil data dari form
  $amount = $_POST["amount"];
  $recipient = $_POST["recipient"];

  // Menyimpan data ke dalam database
  $sql = "INSERT INTO transfers (amount, recipient) VALUES ('$amount', '$recipient')";

  if (mysqli_query($conn, $sql)) {
    echo "Data berhasil disimpan";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Menutup koneksi
mysqli_close($conn);
?>