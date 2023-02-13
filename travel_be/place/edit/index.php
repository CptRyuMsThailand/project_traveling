<?php

if(!isset($page_id)){
	header("Location:./../index.php");
}
if(!isset($_GET["edit_id"])){
	header("Location:./index.php?page=place");	
}
require("./connection/connect.php");
$editid = $_GET["edit_id"];

if(isset($_POST["form_post"])){
	//print($image_list_name);
	$value_latlon_list = explode(",",$_POST["form_geolatlon"]);
	$stmt = $conn->prepare("UPDATE table_place SET pl_name = ?,pl_geo_lat = ?,pl_geo_lon = ?,pl_amphoe = ? WHERE pl_id = ?");

	$stmt->bind_param("sddii",$_POST["form_name"],$value_latlon_list[0],$value_latlon_list[1],$_POST["form_amphoe"],$editid);
	
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php?page=place");
		exit;
	}
	
}

$dataToEdit = null;

$stmt1 = $conn->prepare("SELECT * FROM table_place WHERE pl_id = ? ");
$stmt1->bind_param("i",$editid);

$stmt1->execute();
$result = $stmt1->get_result();
if($result->num_rows == 0){
	header("Location:./index.php?page=place");
}
$dataToEdit = $result->fetch_all(MYSQLI_ASSOC)[0];


?>
<style>
	
</style>
<form class="w3-container" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<h2> Edit Place </h2>
	<label class="w3-label">Name <input type="text" name="form_name" class="w3-input w3-border" required value="<?=$dataToEdit["pl_name"];?>"> </label><br>
	<label class="w3-label">LatLon <input type="text" name="form_geolatlon" class="w3-input w3-border" required value="<?=$dataToEdit["pl_geo_lat"].",".$dataToEdit["pl_geo_lon"];?>"></label><br>
	<label class="w3-label">
		Local Authority
		<select name="form_amphoe" class="w3-input w3-border">
			<option value="0"> ไม่ระบุ</option>
			<?php

				$stmt2 = $conn->prepare("SELECT * FROM table_local ORDER BY lc_province ASC,lc_amphoe ASC,lc_tumbol ASC");
				$stmt2->execute();
				$result2 = $stmt2->get_result();
				if($result2){
					while($node = $result2->fetch_array(MYSQLI_ASSOC)){
						$node_id = $node["lc_id"];
						$node_tumbol = $node["lc_tumbol"];
						$node_amphoe = $node["lc_amphoe"];
						$node_province = $node["lc_province"];
						if($node_id == $dataToEdit["pl_amphoe"]){
							echo "<option value=\"$node_id\" selected>ตำบล $node_tumbol อำเภอ $node_amphoe จังหวัด $node_province</option>";	
						}else{
							echo "<option value=\"$node_id\">ตำบล $node_tumbol อำเภอ $node_amphoe จังหวัด $node_province</option>";	
						}
						
					}
				}


			?>


		</select>


	</label><br>
	<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Edit </button>
</form>





<?php

$conn->close();
?>


