<?php 
include_once("redirect.php");
$page_id = "event";
if(isset($_GET["page"])){
	$page_id = $_GET["page"];
}
function namedAuthorized($province,$amphoe,$tumbol){
	$arr = [
		" ตำบล "," อำเภอ ",
		" แขวง "," เขต "
		];
	if($province == "กรุงเทพมหานคร"){
		return $arr[2] . $tumbol . $arr[3] . $amphoe . " กรุงเทพมหานคร";
	}
	return $arr[0] . $tumbol . $arr[1] . $amphoe . " จังหวัด " . $province;

}

?>
<html>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./css/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js" defer></script>
	
<link rel="shortcut icon" href="./../travel_fe/favicon.png">

	<body class="w3-light-grey">
		<?php include("./tab/index.php"); ?>


	</body>
	<script src="xhttp.js"></script>
	<script>
		window.addEventListener("load",getUserData);
		async function getUserData(){
			let userData = JSON.parse(await web_request("./get_user.php",null));
			//console.log(userData);
		}
		
	</script>
</html>