<?php 
require("./session.php");
require("./connection/connect.php");

//if($_SERVER["REQUEST_METHOD"] != "POST")die("Invalid Response:404");


$stmt = $conn->prepare("SELECT us_name,us_fname FROM table_user WHERE us_name = ? AND us_pass = ?");
$stmt->bind_param("ss",...getUserAndPass());
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_all(MYSQLI_ASSOC));

?>