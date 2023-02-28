<?php
$FROM_INDEX = true;
require("./connection/connect.php");
require("date_helper.php");
function namedAuthorized($province,$amphoe,$tumbol){
	$arr = [
		" ตำบล"," อำเภอ",
		" แขวง"," เขต"
		];
	if($province == "กรุงเทพมหานคร"){
		return $arr[2] . $tumbol . $arr[3] . $amphoe . " กรุงเทพมหานคร";
	}
	return $arr[0] . $tumbol . $arr[1] . $amphoe . " จังหวัด " . $province;

}
?>

<!doctype html>
<html lang="th">
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php require("bootstrap.php"); ?>
		<title> Travel Event Recommendation</title>
	</head>
	<style>
		*{
			/*font-family : myWebFont;*/
			font-size: 20px;
		}
		body{
			margin:0px;
			
			
		}

	</style>
	<body class="w3-content w3-light-grey" style="max-width:1600px;">
		<div >
			
		</div>
		<?php require("./tab/tab.php"); ?>

	</body>
	<script src="./tab/tabopen.js" defer="true"></script>
	<script src="./tab/slideHelper.js" defer="true"></script>
</html>
<?php
$conn->close();
?>