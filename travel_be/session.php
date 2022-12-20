<?php

session_start();
function getUserAndPass(){
	$username = isset($_SESSION["username"]) ? $_SESSION["username"] : false;
	$password = isset($_SESSION["password"]) ? $_SESSION["password"] : false;
	return [$username,$password];
	 
}
function setUserAndPass($username,$password){
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;

}
function getUserInfo($conn){
	$stmt = $conn->prepare("SELECT * FROM table_user WHERE us_name = ? AND us_pass = ?");
	[$username,$password] = getUserAndPass();
	$stmt->bind_param("ss",$username,$password);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result->fetch_all(MYSQLI_ASSOC)[0];
}






?>