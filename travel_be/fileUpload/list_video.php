<?php
if(!isset($page_id)){
	header("Location:./../index.php");
}
//print_r($user_info);
$stmt2 = $conn->prepare("SELECT * FROM table_file WHERE (? = 1 or file_uploader = ?) AND file_type = 'video' ORDER BY file_name ASC");
$stmt2->bind_param("ss",$user_info["us_superuser"],$user_info["us_id"]);
$stmt2->execute();
$result2 = $stmt2->get_result();

?>
<table class="w3-table w3-white w3-border w3-striped">
	<tr class="w3-green">
		<th> ID </th><th> Video </th><th> File Name </th><th> File Path</th><th> Delete </th>
	</tr>
<?php
if($result2){
	while($row = $result2->fetch_array(MYSQLI_ASSOC)){
		?>
		<tr>
			<td><?=$row["file_id"]?></td>
			<td><button  onclick="dom_video_review_ctrl.src=this.getElementsByTagName('input')[0].value; console.log(this.getElementsByTagName('input')[0].value); dom_video_review.style.display='block';"> <input type="hidden" value="<?="./../travel_fe/videos/".$row["file_path"];?>">Preview </button></td>
			<td><?=$row["file_name"]?></td>
			<td><?="./videos/".$row["file_path"]?></td>
			<td><a href="./index.php?page=DELETE_FILE&delid=<?=$row["file_id"];?>"> X </a></td>
			



		</tr>
		<?php
	}
}
$stmt2->close();
?>
</table>
<div id="dom_video_review" class="w3-modal" >
	<div class="w3-modal-content">
		<button onclick="dom_video_review.style.display='none'; dom_video_review_ctrl.pause();" class="w3-button"><span class="fa fa-close"></span></button>
		<video width="400" controls id="dom_video_review_ctrl">
			
		</video>
	</div>


</div>