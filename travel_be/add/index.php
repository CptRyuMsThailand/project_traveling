<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require("./connection/connect.php");
if(isset($_POST["form_post"])){
	require("imageUpload.php");
	upload_image($_FILES["form_image"]);

	header("Location:./index.php");
}
?>

<form class="w3-form" method="POST" enctype="multipart/form-data">
	<input type="text" name="form_text">
	<input type="file" id="form_image" name="form_image[]" accept=".jpg,.jpeg,.png" multiple class="w3-button">
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
form_image.addEventListener("load",js_img_preview);
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

</script>
<?php

$conn->close();
?>


