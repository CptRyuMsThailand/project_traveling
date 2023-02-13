<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require("./connection/connect.php");
require("./fileUpload/image_upload.php");
require("./fileUpload/video_upload.php");

$stmt1 = $conn->prepare("SELECT us_id,us_superuser FROM table_user WHERE us_name = ? AND us_pass = ?");
$stmt1->bind_param("ss",...getUserAndPass());
$stmt1->execute();
$result1 = $stmt1->get_result();

$user_info = $result1->fetch_all(MYSQLI_ASSOC)[0];
$stmt1->close();
$result1->close();


?>

<div class="w3-container">
	<h2> File Upload </h2>
	<div class="w3-bar w3-black">
		
		<button onclick="select_image_tab();" class="w3-button w3-bar-item"> Image </button>
		<button onclick="select_video_tab();" class="w3-button w3-bar-item"> Video </button>
		


	</div>
	<div class="w3-container">
		
		
	</div>

	<div class="w3-container" id="dom_image_tab">
		<button onclick="dom_imageUpload.style.display='block';" class="w3-button w3-green"> + Upload Images </button>
		<?php
		include("./fileUpload/list_image.php");
		?>
	</div>

	<div class="w3-container" id="dom_video_tab">
		<button onclick="dom_videoUpload.style.display='block';" class="w3-button w3-green"> + Upload Videos </button>
		<?php
		include("./fileUpload/list_video.php");
		?>
	</div>


</div>
<div class="w3-modal" id="dom_imageUpload" style="display: none;">
	<div class="w3-modal-content">
		<div class="w3-container" >
			<form class="w3-container" id="f_img_upload" method="POST" enctype="multipart/form-data">
				<h3> Image Upload </h3>
				<input type="file" accept="image/*" class="w3-input" name="form_image[]" multiple />
				<button name="f_image_upload_button" type="submit" class="w3-button w3-green w3-right" > Upload </button>

			</form>

			<button onclick="dom_imageUpload.style.display='none';" class="w3-button w3-grey w3-right"> Close </button>
		</div>
	</div>



</div>
<div class="w3-modal" id="dom_videoUpload" style="display: none;">
	<div class="w3-modal-content">
		<div class="w3-container" >
			<form class="w3-container" id="f_video_upload" method="POST" enctype="multipart/form-data">
				<h3> Video </h3>
				<input type="file" accept="video/*" class="w3-input" name="form_video[]" multiple />
				<button name="f_video_upload_button" type="submit" class="w3-button w3-green w3-right" > Upload </button>

			</form>

			<button onclick="dom_videoUpload.style.display='none';" class="w3-button w3-grey w3-right"> Close </button>
		</div>
	</div>
	


</div>
<script>
	window.addEventListener("load",select_image_tab);
	function select_image_tab(){
		reset_select_tab();

		dom_image_tab.style.display = "block";
	}
	function select_video_tab(){
		reset_select_tab();

		dom_video_tab.style.display = "block";
	}
	function reset_select_tab(){
		dom_video_tab.style.display = "none";
		dom_image_tab.style.display = "none";
	}

</script>


