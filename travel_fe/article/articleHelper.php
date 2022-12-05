<?php
$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType != 'POST'){
	header("Location:./../index.php");
}
header("Content-Type: application/json; charset=UTF-8");
require("./../connection/connect.php");

$article_input = $_POST['articleid'];

$stmt = $conn->prepare("SELECT * FROM table_event WHERE ev_id = ? ");
$stmt->bind_param("s",$article_input);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);



?>