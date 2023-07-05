<?php
$host = "localhost";
$user = "admin";
$pass = "admin";
$db = "tabunganku";
$conn = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($conn));

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT tabunganku FROM accountdb WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}
?>