<?php
  // connect to database
  $host = "localhost";
  $user = "admin";
  $pass = "admin";
  $db = "tabunganku";
  $conn = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($conn));

  // check if the required form fields are set
  if (isset($_POST['amount'], $_POST['category'], $_POST['password'])) {
    // get input
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $password = $_POST['password'];

    // check password
    $checkPasswordQuery = "SELECT name FROM accountdb WHERE password = '$password'";
    $result = $conn->query($checkPasswordQuery);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $name = $row['name'];

      // get the current time
      $timestamp = date('Y-m-d H:i:s');

      // insert data transaction to table deposit in database
      $insertDepositQuery = "INSERT INTO deposit (name, amount, category, timestamp) VALUES ('$name', $amount, '$category', '$timestamp')";
      if ($conn->query($insertDepositQuery) === TRUE) {
        // update the amount in table balance
        $updateBalanceQuery = "UPDATE balance SET amount = amount + $amount WHERE name = '$name'";
        if ($conn->query($updateBalanceQuery) === TRUE) {
          echo "Setoran berhasil. Saldo bertambah.";
        } else {
          echo "Error: " . $updateBalanceQuery . "<br>" . $conn->error;
        }
      } else {
        echo "Error: " . $insertDepositQuery . "<br>" . $conn->error;
      }
    } else {
      echo "Password tidak valid!";
    }

    // close the connection
    $conn->close();

    // Redirect to HTML page
    header("Location: dashboard.html");
    exit;
  }
?>