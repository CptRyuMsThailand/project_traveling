<?php




function viewpoint_generates($event_id){
	require("./../connection/connect.php");

	$sql = "SELECT * FROM table_viewpoint WHERE vp_event_ref = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$event_id);
	$stmt->execute();
	?>

	<table >
		<tr>
			<th>รูปภาพ</th>
			<th>คำอธิบาย</th>
		</tr>
	<?php
	$result = $stmt->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$v_img = $row["vp_img"];
		$v_name = $row["vp_name"];
		?>

		<tr>
			<td><img class="w3-image" style="object-fit: cover;" width="200" src="<?=$v_img;?>"></td>
			<td><?=$v_name;?></td>
		</tr>
		<?php
	}
	?>
	</div>
	<?php
}
viewpoint_generates($_POST["event_id"]);
?>