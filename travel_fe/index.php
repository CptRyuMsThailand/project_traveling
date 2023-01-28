<?php
$FROM_INDEX = true;
require("./connection/connect.php");
require("date_helper.php");
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