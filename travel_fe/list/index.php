<?php

if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
require("./connection/connect.php");



?>

<div class="w3-container">
	<div class="w3-container">
		<h2>ค้นหากิจกรรม</h2>
	</div>
	<div class="w3-row-padding">
		<div class="w3-half">
	 	   <input class="w3-input" type="search" id="dom_search">
	 	 </div>
	 	 <div class="w3-half">
			<button class="w3-button" id="dom_bt_se"><span class="fa fa-search"></span></button>
		</div>
	</div>
	<div class="w3-container" >
		<ul class="w3-ul" id="dom_list_output">
			
		</ul>


	</div>

</div>
<script src="./list/listHelper.js"></script>
<script >
let gmap_baseurl = "https://www.google.com/maps/place/"
function render_node(dataList,coord){

	dom_list_output.innerText = "";
	if(dataList.length == 0){
		dom_list_output.innerText = "ไม่มีรายการที่คุณเลือกไว้";
	}


	for(let i = 0,len = dataList.length;i < len; i++ ){
		let baseLI = document.createElement("li");
		let nameNode = document.createElement("h3");
		nameNode.innerText = dataList[i].ev_name;
		baseLI.appendChild(nameNode);
		let nodeLocal = document.createElement("div");
		let local_names = dataList[i].lc_name.split(",");
		nodeLocal.innerText = "ตำบล "+local_names[1] + " อำเภอ " + local_names[0];
		baseLI.appendChild(nodeLocal);
		if(coord){
			let nodeCoord = document.createElement("div");
			let lat1 = Number(dataList[i].pl_geo_lat);
			let lat2 = coord.latitude;
			let lon1 = Number(dataList[i].pl_geo_lon);
			let lon2 = coord.longitude;
			let distance = haversine(lat1,lon1,lat2,lon2);
			nodeCoord.innerText = "ระยะทาง " + distance.toFixed(5) + " กิโลเมตร";
			baseLI.appendChild(nodeCoord);
			
		}
		{
			let node_pl_name = document.createElement("div");
			node_pl_name.innerText = "" + dataList[i].pl_name;
			baseLI.appendChild(node_pl_name);
		}
		//Google map Div
		{
			let node_gmap = document.createElement("div");
			node_gmap.innerHTML = `
			<a href="${gmap_baseurl + dataList[i].pl_geo_lat + "," + dataList[i].pl_geo_lon}"><span class="fa fa-map-marker"></span> Show in map</a>

			`;
			baseLI.appendChild(node_gmap);
		}
		

		dom_list_output.appendChild(baseLI);
	}
}



</script>