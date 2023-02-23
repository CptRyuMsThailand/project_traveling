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

if(isset($_POST["formSubmitted"]) && isset($_POST["form_vp_id"])){
	$f_vp_id = $_POST["form_vp_id"];
	$f_vp_img = $_POST["form_images"];
	$f_vp_name = $_POST["form_names"];
	$len = count($f_vp_id);
	$input_name;
	$input_image;
	$input_id;
	$up_stmt = $conn->prepare("UPDATE table_otop SET otop_name = ? , otop_img = ? WHERE otop_id = ?");
	$up_stmt->bind_param("ssi",$input_name,$input_image,$input_id);
	for($i = 0 ; $i < $len ; $i++){
		$input_name = $f_vp_name[$i];
		$input_image = $f_vp_img[$i];
		$input_id = $f_vp_id[$i];
		$up_stmt->execute();
	}
	$up_stmt->close();	
}
if(isset($_POST["button_ok"])){
	header("Location:./index.php?page=event");
	exit;
}
if(isset($_POST["form_remove"])){
	$rem = $_POST["form_remove"][0];
	$del_prepare = $conn->prepare("DELETE FROM table_otop WHERE otop_id = ?");
	$del_prepare->bind_param("i",$_POST["form_vp_id"][$rem]);
	$del_prepare->execute();
	$del_prepare->close();
	header("Location:./index.php?page=otop&event_id=".$event_id);
	exit;
		
}


if(isset($_POST["button_add"])){
	$insert_prepare = $conn->prepare("INSERT INTO table_otop (otop_event_ref) VALUES (?)");
	$insert_prepare->bind_param("i",$event_id);
	$insert_prepare->execute();
	header("Location:./index.php?page=otop&event_id=".$event_id);
	exit;
}

$event_statement = $conn->prepare("SELECT * FROM table_event WHERE ev_id = ?");
$event_statement->bind_param("i",$event_id);
$event_statement->execute();
$event_result = $event_statement->get_result()->fetch_all(MYSQLI_ASSOC)[0];
$event_statement->close();


$viewpoint_statement = $conn->prepare("SELECT * FROM table_otop WHERE otop_event_ref = ?");
$viewpoint_statement->bind_param("i",$event_id);
$viewpoint_statement->execute();
$result_viewpoint = $viewpoint_statement->get_result();
?>
<form method="POST">
	<input type="hidden" name="formSubmitted">
<div class="w3-container">
	<h2> Otop </h2>
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
				<th> Otop Image</th>
				<th> Otop Name </th>
				<th> Remove </th>
			</tr>
		</thead>
		<tbody class="w3-white w3-border" id="table_main">
			<?php 
				$i = 0;
				while($row = $result_viewpoint->fetch_array(MYSQLI_ASSOC)){
					$otop_name = $row["otop_name"];
					$otop_img = $row["otop_img"];
					$otop_id = $row["otop_id"];
				?>  
				<tr>
					
					<td >
						<input type="hidden" name="form_vp_id[]" value="<?=$otop_id;?>">
						<input class="w3-input w3-border" placeholder="Image" name="form_images[]" value="<?=$otop_img;?>">
					</td>
					<td ><input class="w3-input w3-border" placeholder="Name" name="form_names[]" value="<?=$otop_name;?>"></td>
					<td ><button class="w3-button w3-circle w3-red" name="form_remove[]" value="<?=$i;?>"> X</button> </td>
				</tr>
				<?php
				$i++;
				}
			?>
			</tbody>
			<tfoot class="w3-white">
			<tr>
				<td colspan="3" class="">
					<div class="w3-right">
					<button name="button_add" type="submit" class="w3-xlarge w3-btn w3-circle w3-green">+</button>
					<button class="w3-btn w3-green w3-xlarge w3-round" name="button_ok"> OK </button>
				</div>
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