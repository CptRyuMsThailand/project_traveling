<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require_once("./connection/connect.php");
$viewpoint_id = $_GET["delete_id"];

if(isset($_POST["form_post"])){
	//require("imageUpload.php");
	//print_r($_FILES["form_image"]);
	//$image_list_name = implode(",",upload_image($_FILES["form_image"]));
	//print($image_list_name);
	
	$stmt = $conn->prepare("DELETE FROM table_viewpoint WHERE vp_id=?");

	$stmt->bind_param("i",$viewpoint_id);
	$stmt->execute();
	header("Location:./index.php");	
	
	
}

?>