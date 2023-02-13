<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require_once("./connection/connect.php");
$viewpoint_id = $_GET["edit_id"];

if(isset($_POST["form_post"])){
	//require("imageUpload.php");
	//print_r($_FILES["form_image"]);
	//$image_list_name = implode(",",upload_image($_FILES["form_image"]));
	//print($image_list_name);
	
	$stmt = $conn->prepare("UPDATE table_viewpoint SET vp_name = ?,vp_lat = ?,vp_lon = ?,vp_img = ?,vp_place_ref = ? WHERE vp_id=?");

	$value_lat_lon = explode(",",$_POST["form_lat_lon"]);
	$stmt->bind_param("sddsii",$_POST["form_name"],$value_lat_lon[0],$value_lat_lon[1],$_POST["form_image"],$_POST["form_place_id"],$viewpoint_id);
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php");	
	}
	
}
$stmt = $conn->prepare("SELECT * FROM table_viewpoint WHERE vp_id = ?");
$stmt->bind_param("i",$viewpoint_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);

?>
<style>
	
</style>
<form class="w3-container" method="POST" enctype="multipart/form-data">
	<div class="w3-row-padding">
		<div class="w3-full w3-padding">
			<h2> Edit Viewpoint </h2>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">Name <input type="text" name="form_name" class="w3-input w3-border" required value="<?=$result['vp_name'];?>"> </label>
		</div>
		<div class="w3-full w3-padding">
			<label> Lat Lon (Separate by Comma (,))
				<input type="text" name="form_lat_lon" class="w3-input w3-border" required value="<?=$result['vp_lat'].','.$result['vp_lon'];?>">
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label> Thumbnail URL
				<!--input type="file" id="form_image" name="form_image" accept="image/*" class="w3-input"/-->
				<input type="text" id="form_image" name="form_image" class="w3-input" value="<?=$result['vp_img']?>">
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">
				สถานที่อ้างอิง
				<select name="form_place_id" class="w3-select w3-border">
					<option value="0">ไม่ระบุ</option>
					<?php
					$stmt1 = $conn->prepare("SELECT pl_id,pl_name FROM table_place ORDER BY pl_name ASC");
					$stmt1->execute();
					$result1 = $stmt1->get_result();
					if($result1){
						while($node = $result1->fetch_array(MYSQLI_ASSOC)){
							?>
							<option value="<?=$node['pl_id'];?>" <?php if($result['vp_place_ref'] == $node['pl_id']){echo "selected";}?> ><?=$node['pl_name'];?></option>
							<?php
						}	
					}


					?>
				</select>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Edit Viewpoint </button>
		</div>
	</div>
</form>


<?php

$conn->close();
?>


