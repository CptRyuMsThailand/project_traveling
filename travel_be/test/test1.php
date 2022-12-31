<?php
require("./../connection/connect.php");
$index = 18;
if(isset($_GET["article"])){
	$index = $_GET["article"];
}
$imgno = 0;
$stmt2 = $conn->prepare("SELECT ev_img_list FROM table_event WHERE ev_id = ?");
$stmt2->bind_param("i",$index);
$stmt2->execute();
$result2 = $stmt2->get_result();
$img_list = $result2->fetch_all(MYSQLI_ASSOC);

if(count($img_list) == 1){
	$img_list = explode(",",$img_list[0]["ev_img_list"]);
	
	$sel_img = $img_list[$imgno];
	$file_location = "./../../travel_fe/images/".$sel_img;
	//print $sel_img;
	header("Content-Type: ".mime_content_type($file_location));
	//header("Location : ".$file_location);
	echo file_get_contents($file_location) ;
	exit;
}else{

	header("Content-Type: image/png");
	echo file_get_contents("./../../travel_fe/images/noimage.png");
	exit;
}





?>