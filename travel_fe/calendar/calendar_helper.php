<?php
$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType != 'POST'){
	header("Location:./../index.php");
}
header("Content-Type: application/json; charset=UTF-8");
require("./../connection/connect.php");
$dateNow = $_POST["date"];
$sql = "SELECT * FROM ((`table_event` INNER JOIN table_place ON table_event.ev_ref_place_id = table_place.pl_id) INNER JOIN table_local ON table_place.pl_amphoe = table_local.lc_id) WHERE Date(?) BETWEEN ev_date_beg AND ev_date_end";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$dateNow);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC) );





?>