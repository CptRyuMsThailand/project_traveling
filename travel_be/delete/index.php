<?php
require("./delete/deleteImage.php");
require("./connection/connect.php");
if(!isset($page_id)){
	header("Location:./../index.php");
}
$is_exists = false;
$img_list = [];
if(isset($_GET["delete_id"])){
	$stmt = $conn->prepare("SELECT ev_img_list FROM table_event WHERE ? = ev_id");

	$stmt->bind_param("i",$_GET["delete_id"]);
	$stmt->execute();
	$result = $stmt->get_result();
	$res = $result->fetch_all(MYSQLI_ASSOC);
	$is_exists = true;
}
if(isset($_POST["ch_yes"]) && $is_exists){
	$stmt = $conn->prepare("DELETE FROM table_event WHERE ? = ev_id");
	$stmt->bind_param("i",$_GET["delete_id"]);
	$stmt->execute();
	header("Location:./index.php");

}

if($is_exists){
?>

<form class="w3-form" method="POST">
	<h2> Are you want to Delete?? </h2>
	<button type="submit" name="ch_yes" class="w3-button w3-red"> Yes </button>
	<a href="./index.php?" class="w3-button w3-black">No</a>

</form>
<?php
}
if(!$is_exists){
?>
<div class="w3-container">
		<h2> Item do not exists anymore </h2>
		
		<a href="./index.php"><button name="ch_no" class="w3-button w3-black"> OK </button></a>
</div>

<?php
}
?>