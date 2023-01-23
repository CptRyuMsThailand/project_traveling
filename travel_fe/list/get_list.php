<?php
require("./../connection/connect.php");

$kword = "";
if(isset($_GET["kword"])){
	$kword = $_GET["kword"];
}
if($kword == ""){
	echo json_encode([]);
	exit;	
}

$sql = "SELECT * FROM ((`table_event` INNER JOIN table_place ON table_event.ev_ref_place_id = table_place.pl_id) INNER JOIN table_local ON table_place.pl_amphoe = table_local.lc_id) WHERE ev_name LIKE ? OR lc_name LIKE ? OR pl_name LIKE ?";


$stmt = $conn->prepare($sql);
$kword1 = "%".$kword."%";
$kword2 = "%".$kword."%";
$kword3 = "%".$kword."%";

$stmt->bind_param("sss",$kword1,$kword2,$kword3);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC) );


?>