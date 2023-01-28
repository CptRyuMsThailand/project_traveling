<?php
require_once("./../connection/connect.php");
$data_lat = $_POST["lat"];
$data_lon = $_POST["lon"];
$data_dist_limit = $_POST["dist_limit"];

$stmt = $conn->prepare("SELECT *,haversine(pl_geo_lat,pl_geo_lon,?,?) AS calc_dist FROM ((`table_event` INNER JOIN table_place ON table_event.ev_ref_place_id = table_place.pl_id) INNER JOIN table_local ON table_place.pl_amphoe = table_local.lc_id) HAVING calc_dist < ? ORDER BY calc_dist ASC");
$stmt->bind_param("ddd",$data_lat,$data_lon,$data_dist_limit);
$stmt->execute();
$result = $stmt->get_result();
echo json_encode($result->fetch_all(MYSQLI_ASSOC));
$stmt->close();
$conn->close();

?>