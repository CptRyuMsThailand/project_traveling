<?php
include_once("session.php");
[$username,$password] = getUserAndPass();
if(!$username || !$password){

	header("Location:./login.php");
}


?>