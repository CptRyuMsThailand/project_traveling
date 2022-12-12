<?php 
include_once("redirect.php");

?>
<html>

	<body>
		


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