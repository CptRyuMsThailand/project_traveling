<?php
if(!isset($page_id) ){
	header("Location:./../index.php");
}
if(!isset($_GET["delete_id"])){
	header("Location:./index.php?page=place");	
}
require("./connection/connect.php");
$deleteid = $_GET["delete_id"];
$stmt = $conn->prepare("SELECT * FROM table_place WHERE pl_id = ?");
$stmt->bind_param("i",$deleteid);
$stmt->execute();
$result_s = $stmt->get_result();

if($result_s->num_rows == 0){
	header("Location:./index.php?page=place");
	exit;
}
if(isset($_POST["deleter"])){
	$stmt = $conn->prepare("DELETE FROM table_place WHERE pl_id = ?");
	$stmt->bind_param("i",$deleteid);
	$stmt->execute();
	header("location:./index.php?page=place");
}
?>

<form method="POST">
<div class="w3-container">
	
	<h3>Want to delete ? </h3>
	<button type="submit" name="deleter" class="w3-button w3-red"> Yes </button>
	<a href="./index.php?page=place" class="w3-button w3-black">No</a>

</div>
</form>