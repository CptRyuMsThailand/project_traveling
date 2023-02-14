<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require_once("./connection/connect.php");
if(isset($_POST["form_post"])){
	$stmt1 = $conn->prepare("SELECT us_id,us_superuser FROM table_user WHERE us_name = ? AND us_pass = ?");
	$stmt1->bind_param("ss",...getUserAndPass());
	$stmt1->execute();
	$result1 = $stmt1->get_result();
	$user_info = $result1->fetch_all(MYSQLI_ASSOC)[0];
	//require("imageUpload.php");
	//print_r($_FILES["form_image"]);
	//$image_list_name = implode(",",upload_image($_FILES["form_image"]));
	//print($image_list_name);
	
	$stmt = $conn->prepare("INSERT INTO table_viewpoint(vp_name,vp_lat,vp_lon,vp_img,vp_place_ref,vp_origin) VALUES (?,?,?,?,?)");

	$value_lat_lon = explode(",",$_POST["form_lat_lon"]);
	$stmt->bind_param("sddsi",$_POST["form_name"],$value_lat_lon[0],$value_lat_lon[1],$_POST["form_image"],$_POST["form_place_id"],$user_info["us_id"]);
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php");	
	}
	
}
?>
<style>
	
</style>
<form class="w3-container" method="POST" enctype="multipart/form-data">
	<div class="w3-row-padding">
		<div class="w3-full w3-padding">
			<h2> Add Viewpoint </h2>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">Name <input type="text" name="form_name" class="w3-input w3-border" required> </label>
		</div>
		<div class="w3-full w3-padding">
			<label> Lat Lon (Separate by Comma (,))
				<input type="text" name="form_lat_lon" class="w3-input w3-border" required>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label> Thumbnail URL
				<!--input type="file" id="form_image" name="form_image" accept="image/*" class="w3-input"/-->
				<input type="text" id="form_image" name="form_image" class="w3-input">
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">
				Local Authority
				<select name="form_place_id" class="w3-select w3-border">
					<option value="0">ไม่ระบุ</option>
					<?php
					$stmt1 = $conn->prepare("SELECT pl_id,pl_name FROM table_place ORDER BY pl_name ASC");
					$stmt1->execute();
					$result = $stmt1->get_result();
					if($result){
						while($node = $result->fetch_array(MYSQLI_ASSOC)){
							?>
							<option value="<?=$node['pl_id'];?>"><?=$node['pl_name'];?></option>
							<?php
						}	
					}


					?>
				</select>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Add Viewpoint </button>
		</div>
	</div>
</form>


<?php

$conn->close();
?>


