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

$sql = "SELECT * FROM ((`table_event` INNER JOIN table_place ON table_event.ev_ref_place_id = table_place.pl_id) INNER JOIN table_local ON table_place.pl_amphoe = table_local.lc_id) WHERE ev_name LIKE ? OR pl_name LIKE ? or lc_amphoe LIKE ? or lc_tumbol LIKE ? or lc_province LIKE ?";


$stmt = $conn->prepare($sql);
$kword1 = "%".$kword."%";
$kword2 = "%".$kword."%";
$kword3 = "%".$kword."%";
$kword4 = "%".$kword."%";
$kword5 = "%".$kword."%";



$stmt->bind_param("sssss",$kword1,$kword2,$kword3,$kword4,$kword5);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC) );


?>