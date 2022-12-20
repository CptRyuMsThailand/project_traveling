<?php
function delete_image($arr_of_image){
	$basePath = "./../travel_fe/images/";
	for($i = 0 ; $i < count($arr_of_image) ; $i++){
		unlink($basePath.$arr_of_image[$i]);
	}
	
}


?>