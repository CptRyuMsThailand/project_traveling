<?php
if(!isset($FROM_INDEX) )header("Location:./../index.php");
require_once("./connection/connect.php");


$stmt = $conn->prepare("SELECT ev_id,table_place.*,table_local.* FROM table_event LEFT JOIN table_place ON ev_ref_place_id = pl_id LEFT JOIN table_local ON pl_amphoe = lc_id WHERE ev_id = ?");
$stmt->bind_param("i",$article_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);

$google_map_ext_url = "https://www.google.com/maps/place/";
?>

<div class="w3-container">
	<p>สถานที่ : <?=$result["pl_name"]?></p>
	<p> เขต : <?= namedAuthorized($result["lc_province"],$result["lc_amphoe"],$result["lc_tumbol"]); ?></p>
	<p> พิกัด : <?= $result["pl_geo_lat"]?> , <?= $result["pl_geo_lon"]?></p>
	<a href="<?=$google_map_ext_url.$result["pl_geo_lat"]." , ".$result["pl_geo_lon"]?>" class="w3-button w3-input w3-green" target="new">เปิดใน Google Maps</a>



</div>