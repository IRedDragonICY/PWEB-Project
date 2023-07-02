<?php
include('connect.php');
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

//membuat query untuk insert data ke database
$sql = "INSERT INTO accountdb (name, email, password, role)
VALUES ('$name', '$email', '$password', 0)";

// membuat database untuk user sesuai dengan username


//mengeksekusi query dan mengecek apakah berhasil atau tidak
if ($conn->query($sql) === TRUE) {
  echo "User berhasil didaftarkan";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// redirect ke dashboard
header("Location: ../dashboard.html");
?>