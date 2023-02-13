<?php
if(!isset($page_id) or !isset($_GET["edit_id"])){
	header("Location:./../index.php");
	exit;
}
require("./connection/connect.php");
require("./add/imageUpload.php");
require("./delete/deleteImage.php");
$edit_id = $_GET["edit_id"];


if(isset($_POST["form_post"])){
	$image_data_current = $_POST["form_image_old"];
	
	$stmt4 = $conn->prepare("UPDATE table_event SET ev_name = ?,ev_date_beg = ?,ev_date_end = ?,ev_img_list = ?,ev_desc = ?,ev_ref_place_id = ? WHERE ev_id = ?");
	$stmt4->bind_param(
		"sssssii",
		$_POST["form_name"],
		$_POST["form_date_start"],
		$_POST["form_date_end"],
		$_POST["form_image"],
		$_POST["form_desc_value"],
		$_POST["form_place_id"],
		$edit_id
	);

	$stmt4->execute();

	header("Location:./index.php");
	exit;
}



$stmt2 = $conn->prepare("SELECT * FROM table_event WHERE ev_id = ?");
$stmt2->bind_param("d",$edit_id);
$stmt2->execute();
$result2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC)[0];
?>

<form class="w3-container" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<div class="w3-row-padding">
		<div class="w3-full w3-padding">
			<h2> Edit Event </h2>
		</div>
		<input type="hidden" name="form_image_old" value="<?=$result2['ev_img_list'];?>">
		<div class="w3full w3-padding">
			<label class="w3-label">Name 
				<input type="text" name="form_name" class="w3-input w3-border" required value="<?=$result2['ev_name']?>"> 
			</label>
		</div>
		
		<div class="w3-half w3-padding">
			<label class="w3-label">Start Date
				<input type="date" class="w3-input w3-border" name="form_date_start" id="form_date_start" required value="<?=$result2['ev_date_beg']?>">  
			</label>
		</div>
		<div class="w3-half w3-padding">
			<label class="w3-label">End Date 
				<input type="date" class="w3-input w3-border" name="form_date_end" id="form_date_end" required value="<?=$result2['ev_date_end'];?>"> 
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">Data
				<textarea class="w3-input w3-border" name="form_desc_value"><?=$result2["ev_desc"];?></textarea>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label> Thumbnail URL
				<input type="text" id="form_image" name="form_image" class="w3-input" value="<?=$result2["ev_img_list"];?>"/>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">
				Referenced Places
				<select name="form_place_id" class="w3-select w3-border" required>
					<option value="0"> ไม่ระบุ</option>
					<?php
					$stmt1 = $conn->prepare("SELECT pl_id,pl_name FROM table_place ORDER BY pl_name ASC");
					$stmt1->execute();
					$result = $stmt1->get_result();
					
					while($node = $result->fetch_array(MYSQLI_ASSOC)){
						?>
						<option value="<?=$node['pl_id'];?>" <?php if($node['pl_id'] == $result2['ev_ref_place_id'])echo "selected";?> >
							<?=$node['pl_name'];?>
						</option>
						<?php

					}


					?>
				</select>
			</label>
		</div>

		<div class="w3-full w3-padding">
		<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Edit </button>
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
