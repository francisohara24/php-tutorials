<?php
session_start();
$unam = $_SESSION["username"];
$pass = $_SESSION["password"];

echo "<h1>Welcome $unam!</h1>";
echo "<strong>You have logged in successfully!</strong>";
session_destroy();
