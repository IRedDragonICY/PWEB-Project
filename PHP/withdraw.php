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

      // check balance
      $checkBalanceQuery = "SELECT amount FROM balance WHERE name = '$name'";
      $balanceResult = $conn->query($checkBalanceQuery);

      if ($balanceResult->num_rows > 0) {
        $balanceRow = $balanceResult->fetch_assoc();
        $currentBalance = $balanceRow['amount'];

        // check if the balance is enough
        if ($currentBalance >= $amount) {
          // get the current time
          $timestamp = date('Y-m-d H:i:s');

          // insert data transaction to table withdraw in database
          $insertWithdrawQuery = "INSERT INTO withdraw (name, amount, category, timestamp) VALUES ('$name', $amount, '$category', '$timestamp')";
          if ($conn->query($insertWithdrawQuery) === TRUE) {
            // update the amount in table balance
            $updateBalanceQuery = "UPDATE balance SET amount = amount - $amount WHERE name = '$name'";
            if ($conn->query($updateBalanceQuery) === TRUE) {
              echo "Penarikan berhasil. Saldo berkurang.";
            } else {
              echo "Error: " . $updateBalanceQuery . "<br>" . $conn->error;
            }
          } else {
            echo "Error: " . $insertWithdrawQuery . "<br>" . $conn->error;
          }
        } else {
          echo "Uang Anda kurang. Saldo tidak mencukupi untuk penarikan.";
        }
      } else {
        echo "Error: Tidak dapat menemukan saldo untuk akun ini.";
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