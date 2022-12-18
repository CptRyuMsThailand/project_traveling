<?php 
include_once("redirect.php");
$page_id = "HOME";
if(isset($_GET["page"])){
	$page_id = $_GET["page"];
}


?>
<html>
	<link rel="stylesheet" href="./css/w3.css">

	<body>
		<?php
			switch($page_id){
				case "HOME" : require("./home/index.php");break;
				case "ADD_PLACE" : require("./add/index.php");break;

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