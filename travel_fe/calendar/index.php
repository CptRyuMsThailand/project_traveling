<?php


if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
?>
<script src="./calendar/calendar_helper.js"></script>
<div class="w3-container w3-padding">
	<ul class="w3-ul">
		<li class="w3-white">
			<center><h2>ค้นหากิจกรรมผ่านปฏิทิน</h2></center>
		</li>
		<li class="w3-white w3-padding">
			<div class="w3-row-padding w3-center" style="width: 100%;">
				<div class="w3-cols s12" id="calendar_container">
					<?php
					//include "./calendar/calendar.php";
					?>
				</div>
			</div>
		</li>
		<li><h3 id="headList">รายการประจำวันที่ได้เลือกไว้</h3></li>
		<li>
			<ul class="w3-ul w3-white" id="list_of_output">
				

				
			</ul>

		</li>
	</ul>
</div>

<script>


	window.onload = async function(){
		let geocoord = await getCoord();
		const qString = window.location.search;
		const urlParams = new URLSearchParams(qString);
		let date = `${new Date().getFullYear()}-${(new Date().getMonth() + 1).toString().padStart(2,"0")}`;
		
		if(urlParams.has("date")){
			date = decodeURIComponent(urlParams.get("date"));
		}
		calendar_container.innerHTML = await get_calendar(date,geocoord.latitude,geocoord.longitude);
	}


	async function get_calendar(ymd_string,geolat,geolon){
	try{
		let data = await new Promise(
			(resolve,reject)=>{
				xhttp.onload = function(){
					try{
						resolve(this.responseText);	
					}catch(e){
						reject(xhttp.responseText);
					}
					
				}
				xhttp.onerror = function(){
					reject(xhttp.responseText);
				}
				xhttp.open("POST","./calendar/calendar.php?date="+encodeURIComponent(ymd_string),true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("lat="+encodeURIComponent(geolat)+"&lon="+encodeURIComponent(geolon));
			}

		);
		return data;
		
	}catch(e){
		throw e;
	}
	
}
async function getCoord(){
	let prom1 = new Promise(
			(resolve,reject)=>{
				navigator.geolocation.getCurrentPosition(resolve,reject,gps_options);
			}
		);
	try{
		let res = await prom1;
		return res.coords;
	}catch(e){
		return false;
	}
}


</script>