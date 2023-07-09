<?php
  // connect to database
  require_once "connect.php";

  // check if the required form fields are set
  if (isset($_POST['amount'], $_POST['category'], $_POST['password'])) {
    // get input
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $password = $_POST['password'];

    // check password
    $checkPasswordQuery = "SELECT name FROM accountdb WHERE password = ?";
    $checkPasswordStmt = $conn->prepare($checkPasswordQuery);
    $checkPasswordStmt->bind_param("s", $password);
    $checkPasswordStmt->execute();
    $result = $checkPasswordStmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $name = $row['name'];

      // get the current time
      $timestamp = date('Y-m-d H:i:s');

      // insert data transaction to table deposit in database
      $insertDepositQuery = "INSERT INTO deposit (name, amount, category, timestamp) VALUES (name, amount, category, timestamp)";
      $insertDepositStmt = $conn->prepare($insertDepositQuery);
      $insertDepositStmt->bind_param("siss", $name, $amount, $category, $timestamp);
      if ($insertDepositStmt->execute()) {
        // update the amount in table balance
        $updateBalanceQuery = "UPDATE balance SET amount = amount + $amount WHERE name = '$name' AND category = '$category'";
        $updateBalanceStmt = $conn->prepare($updateBalanceQuery);
        $updateBalanceStmt->bind_param("iss", $amount, $name, $category);
        if ($updateBalanceStmt->execute()) {
          echo "Setoran berhasil. Saldo bertambah.";
        } else {
          echo "Error: " . $updateBalanceStmt->error;
        }
      } else {
        echo "Error: " . $insertDepositStmt->error;
      }
    } else {
      echo "Password tidak valid!";
    }

    // close the statements
    $checkPasswordStmt->close();
    $insertDepositStmt->close();
    $updateBalanceStmt->close();

    // close the connection
    $conn->close();

    // Redirect to HTML page
    header("Location: dashboard.html");
    exit;
  }
?>