<!-- check database -->
<?php
include('connect.php');
// check email and password
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM accountdb WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);
echo $sql;

// if email and password exist
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      // set session
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $row['name'];
      $_SESSION['role'] = $row['role'];
      // redirect to dashboard
      header("Location: ../dashboard.html");
  }
} else {
  // redirect to login
    
}
$conn->close();