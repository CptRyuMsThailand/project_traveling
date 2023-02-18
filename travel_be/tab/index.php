<?php
if(!isset($page_id)){
	header("Location:./../index.php");
	exit;
}
?>

<div class="w3-sidebar w3-bar-block w3-black" style="width: 15%;">
	<a href="index.php?page=event" class="w3-bar-item w3-button"> <h3>Event</h3> </a>
	<a href="index.php?page=place" class="w3-bar-item w3-button"> <h3>Place</h3> </a>
	<a href="index.php?page=files" class="w3-bar-item w3-button"> <h3>Files</h3> </a>
	
	
	<a href="logout.php" class="w3-bar-item w3-button"><h3>Logout</h3></a>
</div>
<div style="margin-left:15%;">
<?php
	switch($page_id){
		case "event" : require("./event/index.php");break;
		case "ADD_EVENT" : require("./add/index.php");break;
		case "EDIT_EVENT" : require("./edit/index.php");break;
		case "DELETE_EVENT" : require("./delete/index.php");break;

		case "place" : require("./place/index.php");break;
		case "ADD_PLACE" : require("./place/add/index.php");break;
		case "EDIT_PLACE" : require("./place/edit/index.php");break;
		case "DELETE_PLACE" : require("./place/delete/index.php");break;

		case "files" : require("./fileUpload/index.php");break;
		case "DELETE_FILE" : require("./fileUpload/delete.php");break;

		case "viewpoint" : require("./viewpoint/index.php");break;
		case "otop" : require("./otop/index.php");break;
		case "hotel" : require("./hotel/index.php");break;
	}

?>
</div>