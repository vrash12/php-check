<?php
session_start();
require_once('db_connection.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = MD5('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: main_menu.php");
        exit;
    } else {
        echo "Incorrect username or password.";
    }
}

$conn->close();
?>
