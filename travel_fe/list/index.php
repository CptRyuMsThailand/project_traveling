<?php

if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
require("./connection/connect.php");



?>

<div class="w3-container">
	<div class="w3-contents">
		Selet Date <input class="w3-input" type="date" id="dom_date_select">

	</div>
	<div class="w3-container" >
		<ul class="w3-ul" id="dom_list_output">
			
		</ul>


	</div>

</div>
<script src="./list/listHelper.js"></script>
<script >
function render_node(dataList,coord){

	dom_list_output.innerText = "";
	if(dataList.length == 0){
		dom_list_output.innerText = "ไม่มีรายการที่คุณเลือกไว้";
	}


	for(let i = 0,len = dataList.length;i < len; i++ ){
		let baseLI = document.createElement("li");
		let nameNode = document.createElement("div");
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
			nodeCoord.innerText = distance.toFixed(5) + "km";
			baseLI.appendChild(nodeCoord);
			
		}

		dom_list_output.appendChild(baseLI);
	}
}



</script>