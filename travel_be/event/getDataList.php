<?php
//if($_SERVER["REQUEST_METHOD"] != "POST")die("Invalid request type");
require("./../session.php");
require("./../connection/connect.php");
$stmt1 = $conn->prepare("SELECT us_id,us_superuser FROM table_user WHERE us_name = ? AND us_pass = ?");
$stmt1->bind_param("ss",...getUserAndPass());
$stmt1->execute();
$result1 = $stmt1->get_result();
 
$user_info = $result1->fetch_all(MYSQLI_ASSOC)[0];
//print_r($user_info);
$stmt2 = $conn->prepare("SELECT * FROM table_event WHERE ? = 1 or ev_origin = ?");
$stmt2->bind_param("ss",$user_info["us_superuser"],$user_info["us_id"]);
$stmt2->execute();
$result2 = $stmt2->get_result();

echo json_encode($result2->fetch_all(MYSQLI_ASSOC));



?>