<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require("./connection/connect.php");
if(isset($_POST["form_post"])){
	require("imageUpload.php");
	print_r($_FILES["form_image"]);
	$image_list_name = implode(",",upload_image($_FILES["form_image"]));
	//print($image_list_name);
	
	$stmt = $conn->prepare("INSERT INTO table_event(ev_name,ev_date_beg,ev_date_end,ev_img_list,ev_desc,ev_origin,ev_ref_place_id) VALUES (?,?,?,(?),?,?,?)");

	$stmt->bind_param("sssssii",$_POST["form_name"],$_POST["form_date_start"],$_POST["form_date_end"],$image_list_name,$_POST["form_desc_value"],getUserInfo($conn)["us_id"],$_POST["form_place_id"]);

	
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php");	
	}
	
}
?>
<style>
	
</style>
<form class="w3-container" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<h2> Add Event </h2>
	<label class="w3-label">Name <input type="text" name="form_name" class="w3-input w3-border" required> </label><br>
	<label class="w3-label">Start Date<input type="date" class="w3-input w3-border" name="form_date_start" id="form_date_start" required>  </label><br>
	<label class="w3-label">End Date <input type="date" class="w3-input w3-border" name="form_date_end" id="form_date_end" required> </label><br>
	<label class="w3-label">Data<textarea class="w3-input w3-border" name="form_desc_value"></textarea></label><br>

	<label> Upload Image
	<input type="file" id="form_image" name="form_image" accept="image/*" class="w3-input"/>
	</label><br>
	<label class="w3-label">
		สถานที่อ้างอิง
		<select name="form_place_id" class="w3-input">
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
	<br>
	<button type="submit" name="form_post" class="w3-button w3-input w3-green"> POST </button>
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


<div class="w3-container">
	
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


