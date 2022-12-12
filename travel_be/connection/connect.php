<?php


$conn = new mysqli("localhost","root","12345","project_traveling");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>