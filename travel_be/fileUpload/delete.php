<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require_once("./connection/connect.php");
$stmt = $conn->prepare("SELECT file_path,file_type FROM table_file WHERE file_id = ?");
$stmt->bind_param("i",$_GET["delid"]);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows == 0){
	header("Location:.index.php?page=files");
	exit;
}	
if(isset($_POST["confirm"])){
	$f_fetch = $result->fetch_all(MYSQLI_ASSOC)[0];
	$f_path = "./../travel_fe/".$f_fetch["file_type"]."s/".$f_fetch["file_path"];
	unlink($f_path);
	$stmt1 = $conn->prepare("DELETE FROM table_file WHERE file_id = ? ");
	$stmt1->bind_param("i",$_GET["delid"]);
	$stmt1->execute();
	header("Location:./index.php?page=files");
	exit;

}
if(isset($_POST["cancel"])){
	header("Location:./index.php?page=files");
	exit;
}
?>
<form class="w3-container" method="POST">

	<h3> Delete this file? <?=$_GET["delid"];?></h3><br>
	<button name="confirm" class="w3-button w3-red">Confirm </button>
	<button name="cancel" class="w3-button w3-grey">Cancel </button>
	
</div>

