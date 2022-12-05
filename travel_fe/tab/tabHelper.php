<?php

$TAB_HOME = 0;
$TAB_LINEARLIST = 1;
$TAB_CALENDAR = 2;
$TAB_ARTICLE = 3;
$TAB_ENUM = ["Home","List","Calendar","Article"];
$tabSelected = 0; 
if( !isset($_GET["pageName"]) ){
	$tabSelected = $TAB_HOME;
}else{
	$tabSelected = $_GET["pageName"];
}



?>