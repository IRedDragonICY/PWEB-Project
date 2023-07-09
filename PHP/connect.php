<?php
$host = "localhost";
$user = "admin";
$password = "admin";
$database = "tabunganku";

// create a connection
$conn = mysqli_connect($host, $user, $password, $database);
// check the connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connection successful";

// get total pemasukan
$sql = "SELECT SUM(jumlah) AS total_pemasukan FROM transaksi WHERE jenis_transaksi = 'pemasukan'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_pemasukan = $row['total_pemasukan'];

// get total pengeluaran
$sql = "SELECT SUM(jumlah) AS total_pengeluaran FROM transaksi WHERE jenis_transaksi = 'pengeluaran'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_pengeluaran = $row['total_pengeluaran'];

// calculate total saldo
$total_saldo = $total_pemasukan - $total_pengeluaran;

// close the database connection
mysqli_close($conn);
?>