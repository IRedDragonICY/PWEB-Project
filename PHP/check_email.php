<?php
$host = "localhost";
$user = "admin";
$pass = "admin";
$db = "tabunganku";
$conn = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($con));

if (isset($_POST["email"]))
{
    $email = $_POST["email"];
    $sql = "SELECT tabunganku FROM accountdb WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}
?>