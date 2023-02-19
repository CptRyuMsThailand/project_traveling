<?php




function hotel_generates($place_id){
	require("./../connection/connect.php");

	$sql = "SELECT * FROM table_hotel WHERE ht_place_ref = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$place_id);
	$stmt->execute();
	$google_map_ext_url = "https://www.google.com/maps/place/";
	?>

	<table class="w3-table w3-striped w3-white">
		<tr class="w3-green">
			<th>รูปภาพ</th>
			<th>คำอธิบาย</th>
			<th>ลิงก์</th>
			
		</tr>
	<?php
	$result = $stmt->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$v_img = $row["ht_img"];
		$v_name = $row["ht_name"];
		$v_url = $row["ht_url"];
		$v_geolat = $row["ht_lat"];
		$v_geolon = $row["ht_lon"];
		$maps_url = $google_map_ext_url . $v_geolat . "," . $v_geolon;
		?>

		<tr>
			<td><img class="w3-image" style="object-fit: cover;" width="200" src="<?=$v_img;?>"></td>
			<td><h2><?=$v_name;?></h2></td>
			<td>
				<h2><a href="<?=$v_url?>" target="new"> <i class="fa fa-external-link"></i> หน้าเว็บ</a></h2>
				<h2><a href="<?=$maps_url?>" target="new"> <i class="fa fa-map-marker"></i> พิกัด </a></h2>
				
			</td>
		</tr>
		<?php
	}
	?>
	</div>
	<?php
}
hotel_generates($_POST["place_id"]);
?>