<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require_once("./connection/connect.php");
if(isset($_POST["form_post"])){
	//require("imageUpload.php");
	//print_r($_FILES["form_image"]);
	//$image_list_name = implode(",",upload_image($_FILES["form_image"]));
	//print($image_list_name);
	
	$stmt = $conn->prepare("INSERT INTO table_event(ev_name,ev_date_beg,ev_date_end,ev_img_list,ev_desc,ev_origin,ev_ref_place_id) VALUES (?,?,?,?,?,?,?)");

	$stmt->bind_param("sssssii",$_POST["form_name"],$_POST["form_date_start"],$_POST["form_date_end"],$_POST["form_image"],$_POST["form_desc_value"],getUserInfo($conn)["us_id"],$_POST["form_place_id"]);

	
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php");
		exit;
	}
}
?>
<style>
	
</style>
<form class="w3-container" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<div class="w3-row-padding">
		<div class="w3-full w3-padding">
			<h2> Add Event </h2>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">Name <input type="text" name="form_name" class="w3-input w3-border" required> </label>
		</div>
		<div class="w3-half w3-padding">
			<label class="w3-label">Start Date
				<input type="date" class="w3-input w3-border" name="form_date_start" id="form_date_start" required>  
			</label>
		</div>
		<div class="w3-half w3-padding">
			<label class="w3-label">End Date 
				<input type="date" class="w3-input w3-border" name="form_date_end" id="form_date_end" required> 
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">Data
				<textarea class="w3-input w3-border" name="form_desc_value"></textarea>
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
				Referenced Places
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
			<button type="submit" name="form_post" class="w3-button w3-input w3-green"> POST </button>
		</div>
	</div>
</form>

<script defer="true">
	
	async function testSubmit(){
		let s_date = new Date(form_date_start.value);
		let e_date = new Date(form_date_end.value);
		if(s_date > e_date){
			alert("end date must be after start date");
			return false;
		}
		return true;

	}
</script>
<?php

$conn->close();
?>


