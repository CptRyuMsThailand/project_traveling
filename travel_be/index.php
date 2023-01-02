<?php 
include_once("redirect.php");
$page_id = "event";
if(isset($_GET["page"])){
	$page_id = $_GET["page"];
}


?>
<html>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./css/w3.css">

	<body>
		<?php
			switch($page_id){
				case "event" : require("./event/index.php");break;
				case "ADD_EVENT" : require("./add/index.php");break;
				case "DELETE_EVENT" : require("./delete/index.php");break;
			}

		?>


	</body>
	<script src="xhttp.js"></script>
	<script>
		window.addEventListener("load",getUserData);
		async function getUserData(){
			let userData = JSON.parse(await web_request("./get_user.php",null));
			console.log(userData);
		}
		
	</script>
</html>