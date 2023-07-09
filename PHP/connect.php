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
?>