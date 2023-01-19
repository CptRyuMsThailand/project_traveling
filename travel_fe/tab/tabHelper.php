<?php

$tabSelected = 0; 
if( !isset($_GET["pageName"]) ){
	$tabSelected = "home";
}else{
	$tabSelected = $_GET["pageName"];
}



?>