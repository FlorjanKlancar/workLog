<?php
    include 'db.php';
    $username=($_POST['username']);
    $password=($_POST['password']);
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    $id = $row[0];
    if ($result->num_rows == 1) {
        echo json_encode(array("statusCode"=>200));
        setcookie("user", $id, time() + (86400 * 30));
    }
    else 
        echo json_encode(array("statusCode"=>201));
?>