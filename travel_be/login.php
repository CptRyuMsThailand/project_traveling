<?php

include_once("./session.php");
if(getUserAndPass()[0]){
	header("Location:./index.php");
}

if(isset($_POST["login"])){
	require("./connection/connect.php");
	$statement = $conn->prepare("SELECT * FROM table_user WHERE us_name = ? and us_pass = ?");

	$statement->bind_param("ss",$_POST["username"],$_POST["password"]);
	$statement->execute();
	$result = $statement->get_result();
	if($result->num_rows == 1){
		setUserAndPass($_POST["username"],$_POST["password"]);
		header("Location:./index.php");		
	}

	$conn->close();
}
?>

<html>
<head>
	<meta charset="utf-8">
	<title > Login required </title>
</head>
<link rel="stylesheet" href="./css/w3.css">
<body>



<center style="padding-top:10%;">
	<div class="w3-container w3-margin-" style="width:320px; ">
		
		<form class="w3-container w3-card-4" action="./login.php" method="POST">
			<h1>เข้าสู่ระบบ</h1>
			<br>
			<input class="w3-input" type="text" style="width:90%" required name="username">
			<label class="w3-label w3-validate">Username</label></br>
			<br>
			<input class="w3-input" type="password" style="width:90%" required name="password">
			<label class="w3-label w3-validate">Password</label></br>


			<button class="w3-btn w3-section w3-teal w3-ripple" type="submit" name="login"> Log in </button><br>

		</form>
	
	</div>
	</center>
</body>


</html>