<?php 
if(!isset($page_id)){
	header("Location:./index.php");
}

require_once("./connection/connect.php");
require_once("./fileUpload/file_upload_unique.php");



if(isset($_POST["f_video_upload_button"])){
	$stmt1 = $conn->prepare("INSERT INTO table_file (file_name,file_path,file_uploader,file_type) VALUES (?,?,?,'video')");
	$stmt2 = $conn->prepare("SELECT Count(*) AS res FROM table_file WHERE file_name = ?");
	$stmt1->bind_param("ssi",$f_name,$f_path,getUserInfo($conn)["us_id"]);
	$stmt2->bind_param("s",$f_name);
	
	$image_form = $_FILES["form_video"];
	$image_count = count($image_form["tmp_name"]);
	for($i = 0;$i < $image_count;$i++){
		$extension = pathinfo($image_form["name"][$i],PATHINFO_EXTENSION);
		$f_path = upload_move_file("./../travel_fe/videos/",$image_form["tmp_name"][$i],$extension);
		$file_name = pathinfo($image_form["name"][$i],PATHINFO_FILENAME);
		$f_name = $file_name.".".$extension;
		$ti = 0;
		while(true){
			$stmt2->execute();
			$stmt_res = $stmt2->get_result();
			$cres = $stmt_res->fetch_all(MYSQLI_ASSOC)[0]["res"];
			if($cres != 0){
				$ti++;
				$f_name = $file_name . "(".$ti.")".$extension;
			}else{
				break;
			}
		}
		$stmt1->execute();

	}
	$stmt1->close();
	$stmt2->close();
	header("Location:./index.php?page=files");
	exit;
	

}
?>


