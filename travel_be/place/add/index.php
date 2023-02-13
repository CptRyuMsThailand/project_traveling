<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
require("./connection/connect.php");
if(isset($_POST["form_post"])){
	//print($image_list_name);
	$value_latlon_list = explode(",",$_POST["form_geolatlon"]);
	$stmt = $conn->prepare("INSERT INTO table_place(pl_name,pl_geo_lat,pl_geo_lon,pl_amphoe,pl_origin) VALUES (?,?,?,?,?)");

	$stmt->bind_param("sddii",$_POST["form_name"],$value_latlon_list[0],$value_latlon_list[1],$_POST["form_amphoe"],getUserInfo($conn)["us_id"]);
	
	if(!$stmt->execute()){
		echo $stmt->error();
	}else{
		header("Location:./index.php?page=place");
		exit;
	}
	
}
?>
<style>
	
</style>
<form class="w3-container" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<h2> Add Place </h2>
	<label class="w3-label">Name <input type="text" name="form_name" class="w3-input w3-border" required> </label><br>
	<label class="w3-label">LatLon <input type="text" name="form_geolatlon" class="w3-input w3-border" required></label><br>
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
						echo "<option value=\"$node_id\">ตำบล $node_tumbol อำเภอ $node_amphoe จังหวัด $node_province</option>";
					}
				}


			?>


		</select>


	</label><br>
	<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Add </button>
</form>





<?php

$conn->close();
?>


