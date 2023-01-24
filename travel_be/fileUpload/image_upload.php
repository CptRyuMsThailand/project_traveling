<?php 

require("./connection/connect.php");

if(isset($_POST["f_img_upload"])){
	$stmt1 = $conn->prepare("INSERT INTO table_file (file_name,file_uploader) VALUES (?,?)");
	$stmt2 = $conn->prepare("UPDATE table_file SET file_path=? WHERE file_id = ? ");

	

}
?>


