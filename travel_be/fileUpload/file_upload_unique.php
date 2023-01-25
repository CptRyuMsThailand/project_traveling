<?php

function upload_generate_name(){
	$date = date_create();
	return date_timestamp_get($date);
}
function upload_move_file($basePath,$tmpName,$fileExtension){
	$fileName = upload_generate_name();
	while(file_exists($basePath.$fileName.".".$fileExtension)){
		$fileName = upload_generate_name();
	}
	
	move_uploaded_file($tmpName, $basePath.$fileName.".".$fileExtension);
	return $fileName.".".$fileExtension;
}

?>