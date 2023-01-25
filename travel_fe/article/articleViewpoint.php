<?php




function viewpoint_generates($place_id){
	require("./../connection/connect.php");

	$sql = "SELECT * FROM table_viewpoint WHERE vp_place_ref = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$place_id);
	$stmt->execute();
	?>
	<table class="w3-table">
		<tr>
			<th> Images </th>
			<th> Short Desc </th>
			<th> Street View </th>
			
		</tr>
	<?php
	$result = $stmt->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$v_img = $row["vp_img"];
		$v_name = $row["vp_name"];
		$v_geolatlon = urlencode($row["vp_lat"].",".$row["vp_lon"]);
		?>

		<tr>
			<td><img class="w3-image" width="200" src="<?=$v_img;?>"></td>
			<td><?=$v_name;?></td>
			<td><a href="https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=<?=$v_geolatlon;?>" class="w3-button w3-green"> Show in Street View</a></td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}
$place_id = $_POST["place_id"];
viewpoint_generates($place_id);
?>