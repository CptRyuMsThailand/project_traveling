
let gps_options = {
	enableHighAccuracy : true,
	timeout : 5000,
	maximumAge : 0

};
function search_with_gps_data(lat,lon,dist_limit){
	return new Promise((resolve,reject)=>{
		let xhttp = new XMLHttpRequest();		
		xhttp.onload = function(){
			try{
				let result = JSON.parse(xhttp.response);
				resolve(result);	
			}catch(e){
				throw xhttp.response;
			}
			
		}
		xhttp.onerror = function(){
			reject(xhttp.status);
		}
		xhttp.open("POST","./gpsSearch/get_list.php",true);
		xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xhttp.send(`lat=${lat}&lon=${lon}&dist_limit=${dist_limit}`);
	})
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
async function retrieveEventFromGpsData(){
	let {latitude:lat,longitude:lon} = await getCoord();
	console.log(lat,lon);
	let datas;
	try{
		datas = await search_with_gps_data(lat,lon,Number(dom_dist_select.value));	
	}catch(e){
		throw "E";
	}
	
	let toPrintSum = "";
	for(let data of datas){
		let toPrint = `
			<li class="w3-white w3-animate-left">
				<div class="w3-row-padding w3-animate-left">
					<div class="w3-col s12 m2 ">
						<img src="${data.ev_img_list.split(",")[0]}" style="object-fit:cover; width:100%; height:100px;">
					</div>
					<div class="w3-col s12 m10">
						<h3>${data.ev_name}</h3>
					</div>
				</div>
			</li>
		`;
		toPrintSum += toPrint;
	}
	dom_output_list.innerHTML = toPrintSum;
}
window.onload = function(){
	retrieveEventFromGpsData();	
}
