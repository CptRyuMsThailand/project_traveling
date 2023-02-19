<?php




function otop_generates($event_id){
	require("./connection/connect.php");

	$sql = "SELECT * FROM table_otop WHERE otop_event_ref = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$event_id);
	$stmt->execute();
	?>

	<table class="w3-table w3-striped">
		<tr class="w3-green">
			<th>รูปภาพ</th>
			<th>คำอธิบาย</th>
		</tr>
	<?php
	$result = $stmt->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$v_img = $row["otop_img"];
		$v_name = $row["otop_name"];
		?>

		<tr>
			<td><img class="w3-image" style="object-fit: cover; width:300px; height:200px;" width="200" src="<?=$v_img;?>"></td>
			<td><?=$v_name;?></td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}
otop_generates($article_id);
?>