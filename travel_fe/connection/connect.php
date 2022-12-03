<?php

$servername = "localhost";
$username = "root";
$password = "12345";
$dbName = "project_traveling";
$conn = new mysqli($servername, $username, $password,$dbName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>