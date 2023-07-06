<?php
include('connect.php');
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("INSERT INTO accountdb (name, email, password, role) VALUES (?, ?, ?, 0)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
  echo "User berhasil didaftarkan";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>