<?php 
require_once("./connection/connect.php");
if(!isset($_GET['event_id'])){
	header("Location:./index.php?page=event");
	exit;
}
if(!isset($page_id)){
	header("Location:./../index.php");
	exit;
}


$event_id = $_GET["event_id"];
if(isset($_POST["formSubmitted"])){
	$rem = $_POST["form_remove"];
	$len = count($rem);
	for($i = 0 ; $i < $len ; $i++){
		if( isset($rem[$i]) ){
			$del_prepare = $conn->prepare("DELETE FROM table_viewpoint WHERE vp_id = ?");
			$del_prepare->bind_param("i",$_POST["form_vp_id"][$i]);
			$del_prepare->execute();
			$del_prepare->close();
			header("Location:./index.php?page=viewpoint&event_id=".$event_id);
			exit;
		}
	}
}
if(isset($_POST["button_ok"])){
	$f_vp_id = $_POST["form_vp_id"];
	$f_vp_img = $_POST["form_images"];
	$f_vp_name = $_POST["form_names"];
	$len = count($f_vp_id);
	$input_name;
	$input_image;
	$input_id;
	$up_stmt = $conn->prepare("UPDATE table_viewpoint SET vp_name = ? , vp_img = ? WHERE vp_id = ?");
	$up_stmt->bind_param("ssi",$input_name,$input_image,$input_id);
	for($i = 0 ; $i < $len ; $i++){
		$input_name = $f_vp_name[$i];
		$input_image = $f_vp_img[$i];
		$input_id = $f_vp_id[$i];
		$up_stmt->execute();
	}
	header("Location:./index.php?page=event");
	exit;
}



if(isset($_POST["button_add"])){
	$insert_prepare = $conn->prepare("INSERT INTO table_viewpoint (vp_event_ref) VALUES (?)");
	$insert_prepare->bind_param("i",$event_id);
	$insert_prepare->execute();
	header("Location:./index.php?page=viewpoint&event_id=".$event_id);
	exit;
}

$event_statement = $conn->prepare("SELECT * FROM table_event WHERE ev_id = ?");
$event_statement->bind_param("i",$event_id);
$event_statement->execute();
$event_result = $event_statement->get_result()->fetch_all(MYSQLI_ASSOC)[0];
$event_statement->close();


$viewpoint_statement = $conn->prepare("SELECT * FROM table_viewpoint WHERE vp_event_ref = ?");
$viewpoint_statement->bind_param("i",$event_id);
$viewpoint_statement->execute();
$result_viewpoint = $viewpoint_statement->get_result();
?>
<form method="POST">
	<input type="hidden" name="formSubmitted">
<div class="w3-container">
	<h2> Viewpoint </h2>
	<div class="w3-container">
		<div class="w3-row-padding">
			<div class="w3-col">
				<h3> <?= $event_result["ev_name"]; ?></h3>
			</div>
		</div>
	</div>
	
	<table class="w3-table w3-border w3-round w3-striped">
		<thead>
			<tr class="w3-border w3-round w3-green">
				<th> Gallery Image</th>
				<th> Gallery Short Desc</th>
				<th> Remove </th>
			</tr>
		</thead>
		<tbody class="w3-white w3-border" id="table_main">
			<?php 
				while($row = $result_viewpoint->fetch_array(MYSQLI_ASSOC)){
					$vp_name = $row["vp_name"];
					$vp_img = $row["vp_img"];
					$vp_id = $row["vp_id"];
				?>
				<tr>
					<input type="hidden" name="form_vp_id[]" value="<?=$vp_id;?>">
					<td ><input class="w3-input w3-border" placeholder="Image" name="form_images[]" value="<?=$vp_img;?>"></td>
					<td ><input class="w3-input w3-border" placeholder="Image" name="form_names[]" value="<?=$vp_name;?>"></td>
					<td ><button class="w3-button w3-circle w3-red" name="form_remove[]"> X</button> </td>
				</tr>
				<?php
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2" class="w3-container"><button name="button_add" type="submit" class="w3-xlarge w3-button w3-circle w3-green">+</button>
				<button class="w3-button w3-green w3-xlarge" name="button_ok"> OK </button>
				</td>
			</tr>
		</tfoot>
	</table>
	


</div>

<div class="w3-bottom">
	<div class="w3-bar w3-white">
		

	</div>
</div>
</form>