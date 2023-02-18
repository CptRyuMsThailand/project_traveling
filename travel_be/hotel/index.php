<?php 
require_once("./connection/connect.php");
if(!isset($_GET['place_id'])){
	header("Location:./index.php?page=place");
	exit;
}
if(!isset($page_id)){
	header("Location:./../index.php");
	exit;
}


$place_id = $_GET["place_id"];

if(isset($_POST["formSubmitted"]) && isset($_POST["form_vp_id"])){
	$f_vp_id = $_POST["form_vp_id"];
	$f_vp_img = $_POST["form_images"];
	$f_vp_name = $_POST["form_names"];
	$f_vp_url = $_POST["form_url"];
	$len = count($f_vp_id);
	$input_name;
	$input_image;
	$input_id;
	$input_url;
	$up_stmt = $conn->prepare("UPDATE table_hotel SET ht_name = ? , ht_img = ? , ht_url = ? WHERE ht_id = ?");
	$up_stmt->bind_param("sssi",$input_name,$input_image,$input_url,$input_id);
	for($i = 0 ; $i < $len ; $i++){
		$input_name = $f_vp_name[$i];
		$input_image = $f_vp_img[$i];
		$input_id = $f_vp_id[$i];
		$input_url = $f_vp_url[$i];
		$up_stmt->execute();
	}
	$up_stmt->close();	
}
if(isset($_POST["button_ok"])){
	header("Location:./index.php?page=place");
	exit;
}
if(isset($_POST["form_remove"])){
	$rem = $_POST["form_remove"][0];
	$del_prepare = $conn->prepare("DELETE FROM table_hotel WHERE ht_id = ?");
	$del_prepare->bind_param("i",$_POST["form_vp_id"][$rem]);
	$del_prepare->execute();
	$del_prepare->close();
	header("Location:./index.php?page=hotel&place_id=".$place_id);
	exit;
		
}


if(isset($_POST["button_add"])){
	$insert_prepare = $conn->prepare("INSERT INTO table_hotel (ht_place_ref) VALUES (?)");
	$insert_prepare->bind_param("i",$place_id);
	$insert_prepare->execute();
	header("Location:./index.php?page=hotel&place_id=".$place_id);
	exit;
}

$event_statement = $conn->prepare("SELECT * FROM table_place WHERE pl_id = ?");
$event_statement->bind_param("i",$place_id);
$event_statement->execute();
$event_result = $event_statement->get_result()->fetch_all(MYSQLI_ASSOC)[0];
$event_statement->close();


$viewpoint_statement = $conn->prepare("SELECT * FROM table_hotel WHERE ht_place_ref = ?");
$viewpoint_statement->bind_param("i",$place_id);
$viewpoint_statement->execute();
$result_viewpoint = $viewpoint_statement->get_result();
?>
<form method="POST">
	<input type="hidden" name="formSubmitted">
<div class="w3-container">
	<h2> Hotel </h2>
	<div class="w3-container">
		<div class="w3-row-padding">
			<div class="w3-col">
				<h3> <?= $event_result["pl_name"]; ?></h3>
			</div>
		</div>
	</div>
	
	<table class="w3-table w3-border w3-round w3-striped">
		<thead>
			<tr class="w3-border w3-round w3-green">
				<th> Hotel Image</th>
				<th> Hotel Name </th>
				<th> Hotel URL </th>
				<th> Remove </th>
			</tr>
		</thead>
		<tbody class="w3-white w3-border" id="table_main">
			<?php 
				$i = 0;
				while($row = $result_viewpoint->fetch_array(MYSQLI_ASSOC)){
					$hotel_name = $row["ht_name"];
					$hotel_img = $row["ht_img"];
					$hotel_url = $row["ht_url"];
					$hotel_id = $row["ht_id"];
				?>  
				<tr>
					
					<td >
						<input type="hidden" name="form_vp_id[]" value="<?=$hotel_id;?>">
						<input class="w3-input w3-border" placeholder="Image" name="form_images[]" value="<?=$hotel_img;?>">
					</td>
					<td ><input class="w3-input w3-border" placeholder="Name" name="form_names[]" value="<?=$hotel_name;?>"></td>
					<td ><input class="w3-input w3-border" type="url" placeholder="URL" name="form_url[]" value="<?=$hotel_url;?>"></td>
					
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