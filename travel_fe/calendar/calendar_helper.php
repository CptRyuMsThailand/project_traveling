<?php
$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType != 'POST'){
	header("Location:./../index.php");
}
header("Content-Type: application/json; charset=UTF-8");
require("./../connection/connect.php");

$date_input = $_POST['date'];

$stmt = $conn->prepare("SELECT ev_name,ev_img_list FROM table_event WHERE ? BETWEEN table_event.ev_date_beg AND table_event.ev_date_end");
$stmt->bind_param("s",$date_input);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);



?>