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

// get current goal amount from database
$sql = "SELECT goal_amount FROM goals ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_goal = $row['goal_amount'];

// get total savings from database
$sql = "SELECT SUM(amount) AS total_savings FROM transactions WHERE type = 'deposit'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_savings = $row['total_savings'];

// calculate progress percentage
$progress_percentage = ($total_savings / $current_goal) * 100;
?>