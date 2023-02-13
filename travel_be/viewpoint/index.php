<?php 
if(!isset($page_id)){
	header("Location:./../index.php");
}
?>
<div class="w3-container">
	<h2> Viewpoint </h2>
	<div class="w3-bar" >
		<a href="./index.php?page=ADD_VIEWPOINT" class="w3-bar-item w3-button w3-green w3-border">Add Viewpoint</a>

	</div>
	<table class="w3-table w3-border w3-round w3-striped">
		<thead>
			<tr class="w3-border w3-round w3-green">
				<th> Viewpoint Image </th>
				<th> Viewpoint Name </th>
				<th> Viewpoint Of Event </th>
				<th> Viewpoint Lat </th>
				<th> Viewpoint Lon </th>
				<th> Street View </th>
				<th> Edit </th>
				<th> Delete </th>
			</tr>
		</thead>
		<tbody class="w3-white" id="table_main">
			
		</tbody>

	</table>


</div>
<script defer="true">
window.addEventListener("load",homeload);
function getInternalPath(path){
	if(path.substring(0,9).toLowerCase() == "./images/"){
		return "./../travel_fe/images/" + path.substring(9);
	}else{
		return path;
	}
}
async function homeload(){
	let pathImage = "";
	let streetViewBasePath = "https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=";
	let rawJSON = await web_request("./viewpoint/viewpointHelper.php",null);
	console.log(rawJSON);
	//console.log(rawJSON);
	let dataLoad = JSON.parse(rawJSON);
	
	let element = ``;
	for(let i of dataLoad){
		let image = i.vp_img.split(",")[0];
		element += `
			<tr>
				<td class="w3-border-left-right"> <img class="w3-image" style="height:100px;width:100px;object-fit: cover;" src="${getInternalPath(image)}"> </td>
				<td> 
				${i.vp_name} 
				</td>
				<td>
				${i.pl_name}
				</td>
				<td>
				${i.vp_lat}
				</td>
				<td>
				${i.vp_lon}
				</td>
				<td>
				<a href="${streetViewBasePath + i.vp_lat + "," + i.vp_lon}"> Street View </a>
				</td>
				<td>
				<a href="./index.php?page=EDIT_VIEWPOINT&edit_id=${i.vp_id}" class="fa">&#xf040;</a>
				</td>
				<td>
				<a href="./index.php?page=DELETE_VIEWPOINT&delete_id=${i.vp_id}" onclick="return confirm('Delete ? ');">&times;</a>
				</td>
				
			</tr>

		`;

	}
	table_main.innerHTML = element;
}


</script>