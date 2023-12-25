<?php
session_start();
$unam = $_SESSION["username"];
$pass = $_SESSION["password"];

echo "<h1>Error!</h1>";
echo "Username: <em> $unam </em><br>";
echo "Password: <em> $pass </em><br>";

echo "<strong>Wrong Email and/or Password!</strong>";
session_destroy();