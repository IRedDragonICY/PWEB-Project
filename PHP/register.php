<?php
include('connect.php');
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO accountdb (name, email, password, role)
VALUES ('$name', '$email', '$password', 0)";

if ($conn->query($sql) === TRUE) {
  echo "User berhasil didaftarkan";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: ../dashboard.html");
?>