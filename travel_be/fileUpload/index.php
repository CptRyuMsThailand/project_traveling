<?php
if(!isset($page_id)){
	header("Location:./index.php");
}

?>

<div class="w3-container">
	
	<div class="w3-bar w3-black">
		
		<button class="w3-button w3-bar-item"> Image </button>
		<button class="w3-button w3-bar-item"> Video </button>
		


	</div>
	<div class="w3-container">
		<button onclick="dom_imageUpload.style.display='block';" class="w3-button "> Upload Images </button>
		<button onclick="" class="w3-button "> Upload Videos </button>
	</div>


</div>
<div class="w3-modal" id="dom_imageUpload" style="display: none;">
	<div class="w3-modal-content">
		<div class="w3-container">
		<form class="w3-container" id="f_img_upload">
		<h3> Image Upload </h3>
		<input type="file" accept="image" class="w3-input"/>
		
		</form>
		
		<button onclick="dom_imageUpload.style.display='none';" class="w3-button w3-grey w3-right"> Close </button>
		<button name="image_upload" type="submit" class="w3-button w3-green w3-right" form="f_img_upload"> Upload </button>

		</div>
	</div>


</div>



