<?php
$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType != 'POST'){
	header("Location:./../index.php");
}
header("Content-Type: application/json; charset=UTF-8");
require("./../connection/connect.php");

$article_input = $_POST['articleid'];

$stmt = $conn->prepare("SELECT * FROM table_event LEFT JOIN table_place on ev_ref_place_id = pl_id WHERE ev_id = ? ");
$stmt->bind_param("i",$article_input);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);
if(count($outp) > 0){
	
	echo json_encode((object)array("status" => 200,"value" => $outp));

}else{
	echo json_encode((object)array("status" => 404));
}



?>