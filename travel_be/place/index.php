<?php 
if(!isset($page_id)){
	header("Location:./../index.php");
}
?>
<div class="w3-container">
	<div class="w3-bar" >
		<a href="./index.php?page=ADD_PLACE" class="w3-bar-item w3-button w3-green w3-border">Add Places</a>

	</div>
	<table class="w3-table">
		<thead>
			<tr>
				<th> Name </th>
				<th> Link </th>
				<th> Edit </th>
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
	let basePlaceMap = "https://www.google.co.th/maps/place/";
	let rawJSON = await web_request("./place/getDataList.php",null);
	//console.log(rawJSON);
	let dataLoad = JSON.parse(rawJSON);
	
	let element = ``;
	for(let i of dataLoad){
		element += `
			<tr>
				<td> 
				${i.pl_name} 
				</td>
				<td>
				<a target="new" href="${basePlaceMap + i.pl_geo_lat + "," + i.pl_geo_lon}"> Show in map</a>
				</td>
				<td>
				<a href="./index.php?page=EDIT_PLACE&edit_id=${i.pl_id}" class="fa">&#xf040;</a>
				</td>
				<td>
				<a href="./index.php?page=DELETE_PLACE&delete_id=${i.pl_id}">&times;</a>
				</td>
				
			</tr>

		`;

	}
	table_main.innerHTML = element;
}


</script>