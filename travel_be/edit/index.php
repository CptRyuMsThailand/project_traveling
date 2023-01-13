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
	if(!empty($_POST["form_image"])){
		delete_image(explode(",",$image_data_current));
		$image_data_current = implode(",",upload_image($_FILES["form_image"]));
	}
	$stmt4 = $conn->prepare("UPDATE table_event SET ev_name = ?,ev_date_beg = ?,ev_date_end = ?,ev_img_list = ?,ev_desc = ?,ev_ref_place_id = ? WHERE ev_id = ?");
	$stmt4->bind_param(
		"sssssii",
		$_POST["form_name"],
		$_POST["form_date_start"],
		$_POST["form_date_end"],
		$image_data_current,
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
	<h2> Edit Event </h2>
	<input type="hidden" name="form_image_old" value="<?=$result2['ev_img_list'];?>">
	<label class="w3-label">Name 
	<input type="text" name="form_name" class="w3-input w3-border" required value="<?=$result2['ev_name']?>"> </label><br>
	<label class="w3-label">Start Date
	<input type="date" class="w3-input w3-border" name="form_date_start" id="form_date_start" required value="<?=$result2['ev_date_beg']?>">  </label><br>
	<label class="w3-label">End Date 
		<input type="date" class="w3-input w3-border" name="form_date_end" id="form_date_end" required value="<?=$result2['ev_date_end'];?>"> </label><br>
	<label class="w3-label">Heading
		<textarea class="w3-input w3-border" name="form_desc_value"><?=$result2["ev_desc"];?></textarea>
	</label><br>

	<label> Upload Image
	<input type="file" id="form_image" name="form_image[]" accept=".jpg,.jpeg,.png" multiple class="w3-input"/>
	</label><br>
	<label class="w3-label">
		สถานที่อ้างอิง
		<select name="form_place_id" class="w3-input" required>
			<option value="0"> ไม่ระบุ</option>
			<?php
				$stmt1 = $conn->prepare("SELECT pl_id,pl_name FROM table_place ORDER BY pl_name ASC");
				$stmt1->execute();
				$result = $stmt1->get_result();
				if($result){
					while($node = $result->fetch_array(MYSQLI_ASSOC)){
						?>
						<option 
						value="<?=$node['pl_id'];?>"
						<?php if($node['pl_id'] == $result2['ev_ref_place_id'])echo "selected";?>
						>
							<?=$node['pl_name'];?>
						</option>
						<?php
					}	
				}


			?>
		</select>
	</label>
	<br>
	<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Edit </button>
</form>
<div class="w3-container" >
	<h3>
		Image Preview
	</h3>
	<ul class="w3-ul">
		<li style="overflow: scroll;" id="preview">
			
		</li>
	</ul>

</div>
<div class="w3-modal w3-black" id="image_preview" onclick="this.style.display = 'none';">
	<span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
	<div class="w3-modal-content w3-animate-zoom">
		<img id="image_preview_img" src="" style="width:100%">
	</div>


		
</div>




<script defer="true">
window.addEventListener("load",js_img_preview);
form_image.addEventListener("change",js_img_preview);
async function js_img_preview(){
	while(preview.firstChild){
		preview.removeChild(preview.firstChild);
	}
	const curFiles = form_image.files;
	if(curFiles.length == 0){
		preview.innerHTML = `No image uploaded yet`;
	}else{
		for(let file of curFiles){
			const imageContainer = new Image();
			imageContainer.src = URL.createObjectURL(file);
			imageContainer.height = 100;
			imageContainer.onclick = function(){
				
				image_preview_img.src = this.src;
				image_preview.style.display = "block";

			}
			//listItem.style.width = imageContainer.width*1.2+"px";
			//listItem.style.height = imageContainer.height*1.2+"px";
			

			preview.appendChild(imageContainer);
		}
		
	}

}
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
