<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
//print_r($user_info);
$stmt2 = $conn->prepare("SELECT * FROM table_file WHERE (? = 1 or file_uploader = ?) AND file_type = 'image' ORDER BY file_name ASC");
$stmt2->bind_param("ss",$user_info["us_superuser"],$user_info["us_id"]);
$stmt2->execute();
$result2 = $stmt2->get_result();

?>
<table class="w3-table">
	<tr>
		<th> ID </th><th> Image </th><th> File Name </th><th> File Path</th>
	</tr>
<?php
if($result2){
	while($row = $result2->fetch_array(MYSQLI_ASSOC)){
		?>
		<tr>
			<td><?=$row["file_id"]?></td>
			<td><img width="100" src="./../travel_fe/images/<?=$row['file_path']?>" onclick="dom_image_review_img.src=this.src; dom_image_review.style.display='block';"></td>
			<td><?=$row["file_name"]?></td>
			<td><?="./images/".$row["file_path"]?></td>
			



		</tr>
		<?php
	}
}
$stmt2->close();
?>
</table>
<div id="dom_image_review" class="w3-modal" >
	<div class="w3-modal-content">
		<button onclick="dom_image_review.style.display='none';" class="w3-button"><span class="fa fa-close"></span></button>
		<img src="" id="dom_image_review_img" width="600">
	</div>


</div>