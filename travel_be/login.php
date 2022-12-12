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
		<form action="./login.php" method="POST">
			<label><input type="text" name="username"> Username </label><br>
			<label><input type="password" name="password"> Password </label><br>
			<button class="w3-button" name="login">Login</button>

		</form>
	</body>


</html>