<?php
function upload_generate_name(){
	$date = date_create();
	return date_timestamp_get($date);
}
function upload_move_file($tmpName,$fileExtension){
	$basePath = "./../travel_fe/images/";
	$fileName = upload_generate_name();
	while(file_exists($basePath.$fileName.$fileExtension)){
		$fileName = upload_generate_name();
	}
	
	move_uploaded_file($tmpName, $basePath.$fileName.".".$fileExtension);
	return $fileName.".".$fileExtension;
}
function upload_image($inFiles){
	$total_count = count($inFiles["name"]);
	$arrOfFiles = [];
	//print_r($inFiles);
	for($i=0;$i<$total_count;$i++){
		$arrOfFiles[$i] = upload_move_file(
			$inFiles["tmp_name"][$i],
			pathinfo($inFiles["name"][$i])["extension"]
		);
	}
	return $arrOfFiles;
	
}

?>