<?php
if(!isset($page_id)){
	header("Location:./../index.php");
	exit;
}
?>

<div class="w3-sidebar w3-bar-block" style="width: 15%;">
	<a href="index.php?page=event" class="w3-bar-item w3-button"> Event </a>
	<a href="index.php?page=place" class="w3-bar-item w3-button"> Place </a>
	<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
</div>
<div style="margin-left:15%;">
<?php
	switch($page_id){
		case "event" : require("./event/index.php");break;
		case "ADD_EVENT" : require("./add/index.php");break;
		case "EDIT_EVENT" : require("./edit/index.php");break;
		case "DELETE_EVENT" : require("./delete/index.php");break;
	}

?>
</div>