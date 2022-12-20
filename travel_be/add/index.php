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
	
	$stmt = $conn->prepare("INSERT INTO table_event(ev_name,ev_date_beg,ev_date_end,ev_img_list,ev_origin) VALUES (?,?,?,(?),?)");

	$stmt->bind_param("ssssi",$_POST["form_name"],$_POST["form_date_start"],$_POST["form_date_end"],$image_list_name,getUserInfo($conn)["us_id"]);

	
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php");	
	}
	
}
?>

<form class="w3-form" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<label class="w3-label"><input type="text" name="form_name" required> Name </label><br>
	<label class="w3-label"><input type="date" name="form_date_start" id="form_date_start" required> Start Date </label><br>
	<label class="w3-label"><input type="date" name="form_date_end" id="form_date_end" required> End Date </label><br>

	<input type="file" id="form_image" name="form_image[]" accept=".jpg,.jpeg,.png" multiple class="w3-button"><br>
	<button type="submit" name="form_post" class="w3-button"> POST </button>
</form>
<div class="w3-container" id="preview">
	

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
		preview.innerHTML = `<p> Not upload image yet </p>`;
	}else{
		for(let file of curFiles){
			const listItem = document.createElement("div");
			listItem.className = "w3-card w3-teal";
			const imageContainer = new Image();
			imageContainer.src = URL.createObjectURL(file);
			imageContainer.height = 100;
			imageContainer.onclick = function(){
				
				image_preview_img.src = this.src;
				image_preview.style.display = "block";

			}
			//listItem.style.width = imageContainer.width*1.2+"px";
			//listItem.style.height = imageContainer.height*1.2+"px";
			

			listItem.appendChild(imageContainer);
			preview.appendChild(listItem);
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


