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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js" defer></script>

	<body>
		<?php include("./tab/index.php"); ?>


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