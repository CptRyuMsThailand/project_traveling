<?php
require("./../connection/connect.php");

$dateNow = "2022-10-15";
if(isset($_GET["date"])){
	$dateNow = $_GET["date"];
}

$sql = "SELECT * FROM ((`table_event` INNER JOIN table_place ON table_event.ev_ref_place_id = table_place.pl_id) INNER JOIN table_local ON table_place.pl_amphoe = table_local.lc_id) WHERE Date(?) BETWEEN ev_date_beg AND ev_date_end";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$dateNow);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC) );


?>