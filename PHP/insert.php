<?php
// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validate the form data
    if (empty($name) || empty($email) || empty($password)) {
        $response = array('status' => 'error', 'message' => 'Harap isi semua kolom.');
        echo json_encode($response);
        exit;
    }

    // insert the data into the database
    try {
        $conn = new PDO("sqlsrv:server = tcp:pweb-project.database.windows.net,1433; Database = account-db", "CloudSAad3d3a55", "{your_password_here}");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO account_tb (username, password, email, reg_date) VALUES (:username, :password, :email, GETDATE())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $response = array('status' => 'success');
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = array('status' => 'error', 'message' => 'Terjadi kesalahan pada server.');
        echo json_encode($response);
    }
}
?>