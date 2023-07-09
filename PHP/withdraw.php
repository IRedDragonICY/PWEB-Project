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

      // check balance
      $checkBalanceQuery = "SELECT amount FROM balance WHERE name = ? AND category = ?";
      $checkBalanceStmt = $conn->prepare($checkBalanceQuery);
      $checkBalanceStmt->bind_param("ss", $name, $category);
      $checkBalanceStmt->execute();
      $balanceResult = $checkBalanceStmt->get_result();

      if ($balanceResult->num_rows > 0) {
        $balanceRow = $balanceResult->fetch_assoc();
        $currentBalance = $balanceRow['amount'];

        // check if the balance is enough
        if ($currentBalance >= $amount) {
          // get the current time
          $timestamp = date('Y-m-d H:i:s');

          // insert data transaction to table withdraw in database
          $insertWithdrawQuery = "INSERT INTO withdraw (name, amount, category, timestamp) VALUES (?, ?, ?, ?)";
          $insertWithdrawStmt = $conn->prepare($insertWithdrawQuery);
          $insertWithdrawStmt->bind_param("siss", $name, $amount, $category, $timestamp);
          if ($insertWithdrawStmt->execute()) {
            // update the amount in table balance
            $updateBalanceQuery = "UPDATE balance SET amount = amount - $amount WHERE name = '$name' AND category = '$category'";
            $updateBalanceStmt = $conn->prepare($updateBalanceQuery);
            $updateBalanceStmt->bind_param("iss", $amount, $name, $category);
            if ($updateBalanceStmt->execute()) {
              echo "Penarikan berhasil. Saldo berkurang.";
            } else {
              echo "Error: " . $updateBalanceStmt->error;
            }
          } else {
            echo "Error: " . $insertWithdrawStmt->error;
          }
        } else {
          echo "Uang Anda kurang. Saldo tidak mencukupi untuk penarikan.";
        }
      } else {
        echo "Error: Tidak dapat menemukan saldo untuk akun dan kategori ini.";
      }
    } else {
      echo "Password tidak valid!";
    }

    // close the statements
    $checkPasswordStmt->close();
    $checkBalanceStmt->close();
    $insertWithdrawStmt->close();
    $updateBalanceStmt->close();

    // close the connection
    $conn->close();

    // Redirect to HTML page
    header("Location: dashboard.html");
    exit;
  }
?>