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






?>