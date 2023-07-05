<?php
$host = "localhost";
$user = "admin";
$pass = "admin";
$db = "tabunganku";
$con = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($con));

if (isset($_POST["username"]))
{
    $username = $_POST["username"];
    $sql = "SELECT tabunganku FROM accountdb WHERE name='$username'";
    $result = mysqli_query($con, $sql);
    echo mysqli_num_rows($result);
}
?>