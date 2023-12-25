<?php
session_start();
$unam = $_POST["username"];
$pass = $_POST["password"];
$_SESSION['username'] = $unam;
$_SESSION['password'] = $pass;


// connect to mysql database & verify username, password
$conn = new mysqli("localhost", "root", "password", "login");
$stmt = "SELECT * FROM user WHERE user_name = '$unam' AND user_password = '$pass';"; // SQL statements
$result = $conn->query($stmt);
$conn->close();

if ($result->num_rows > 0)
    header("Location: ./success.php");
else
    header("Location: ./error.php");