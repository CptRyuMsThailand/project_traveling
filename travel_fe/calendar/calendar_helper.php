<?php
$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType != 'POST'){
	header("Location:./../index.php");
}
header("Content-Type: application/json; charset=UTF-8");
require("./../connection/connect.php");
$dateNow = $_POST["date"];
$sql = "SELECT table_event.*,table_place.*,table_local.*,haversine(?,?,pl_geo_lat,pl_geo_lon) as dist FROM ((`table_event` INNER JOIN table_place ON table_event.ev_ref_place_id = table_place.pl_id) INNER JOIN table_local ON table_place.pl_amphoe = table_local.lc_id) WHERE Date(?) BETWEEN ev_date_beg AND ev_date_end HAVING dist < 30.0 order by dist asc";

$stmt = $conn->prepare($sql);
$stmt->bind_param("dds",$_POST["lat"],$_POST["lon"],$dateNow);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC) );





?>