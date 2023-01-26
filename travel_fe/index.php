<?php
$FROM_INDEX = true;
require("./connection/connect.php");
require("date_helper.php");
?>

<!doctype html>
<html lang="th">
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php require("bootstrap.php"); ?>
	</head>
	<style>
		body{
			margin:0px; 
			
		}
	</style>
	<body style=" ">
		<div >
			<h2>แนะนำกิจกรรมท่องเที่ยวเชิงวัฒนธรรม</h2>
		</div>
		<?php require("./tab/tab.php"); ?>

	</body>
	<script src="./tab/tabopen.js" defer="true"></script>
	<script src="./tab/slideHelper.js" defer="true"></script>
</html>
<?php
$conn->close();
?>