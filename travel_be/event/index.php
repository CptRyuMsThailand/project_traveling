<?php 
if(!isset($page_id)){
	header("Location:./../index.php");
}
?>
<div class="w3-container">
	<div class="w3-bar" >
		<a href="./index.php?page=ADD_EVENT" class="w3-bar-item w3-button">Add Posts</a>

	</div>
	<table class="w3-table">
		<thead>
			<tr>
				<th> Image </th>
				<th> Name </th>
				<th> Delete </th>
			</tr>
		</thead>
		<tbody  id="table_main">
			
		</tbody>

	</table>


</div>
<script defer="true">
window.addEventListener("load",homeload);
async function homeload(){
	let pathImage = "./../travel_fe/images/";
	let rawJSON = await web_request("./event/getDataList.php",null);
	//console.log(rawJSON);
	let dataLoad = JSON.parse(rawJSON);
	
	let element = ``;
	for(let i of dataLoad){
		let image = i.ev_img_list.split(",")[0];
		element += `
			<tr>
				<td> <img class="w3-image" style="height:100px;" src="${pathImage+image}"> </td>
				<td> 
				${i.ev_name} 
				</td>
				<td>
				<a href="./index.php?page=DELETE_EVENT&delete_id=${i.ev_id}">&times;</a>
				</td>
				
			</tr>

		`;

	}
	table_main.innerHTML = element;
}


</script>