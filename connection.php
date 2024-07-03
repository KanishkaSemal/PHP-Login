<?php
$servername = "localhost";
$username = "root";
$password = "Shemal@12";
$db_name = "db";
$port = 3307; // Make sure this is the correct port

$conn = new mysqli($servername, $username, $password, $db_name, $port);

echo "Connection successful";
?>

