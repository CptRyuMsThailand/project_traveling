<?php
$FROM_INDEX = true;
require("./connection/connect.php");
require("date_helper.php");
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php require("bootstrap.php"); ?>
	</head>
	<body style="margin:0px; background-image: linear-gradient(to bottom,cyan,blue);">
		<div style="width:100%; position: fixed; text-align:center; z-index:0; top:20%;">
			<h2>ให้กูผ่านเหอะ กูไหว้ละ</h2>
		</div>
		<?php require("./tab/tab.php"); ?>

	</body>
	<script src="./tab/tabopen.js" defer="true"></script>
	<script src="./tab/slideHelper.js" defer="true"></script>
</html>
<?php
$conn->close();
?>