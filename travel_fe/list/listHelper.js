let gps_options = {
	enableHighAccuracy : true,
	timeout : 5000,
	maximumAge : 0

};

window.addEventListener("load",windowload);
dom_search.addEventListener("search",search_data);
dom_bt_se.addEventListener("click",search_data);
function search_data(){
	history.replaceState(null,null,"index.php?pageName=linearlist&kword="+encodeURIComponent(dom_search.value));
	interval();
}
let coord;
async function windowload(){
	//console.log(await getList());
	const qString = window.location.search;
	const urlParams = new URLSearchParams(qString);
	if(urlParams.has("kword")){
		dom_search.value = decodeURIComponent(urlParams.get("kword"));
	}
	await interval();
}

let geo_f_load = true;

async function interval(){
	coord = await getCoord();
	render_node(await getList(),coord);
	
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

function getList(){
	return new Promise(resolve =>{
		let xhttp = new XMLHttpRequest();

		xhttp.onload = function(){
			let result = JSON.parse(xhttp.response);
			resolve(result);
		}
		xhttp.open("post","./list/get_list.php?kword="+dom_search.value,true);
		xhttp.send();


	});


}
function haversine(lat1,lon1,lat2,lon2){
	let R = 6371;
	let phi1 = lat1 * Math.PI / 180;
	let phi2 = lat2 * Math.PI / 180;
	let dphi = (lat2 - lat1) * Math.PI / 180;
	let dlam = (lon2 - lon1) * Math.PI / 180;
	let a = Math.sin(dphi / 2) * Math.sin(dphi / 2) +
			Math.cos(phi1) * Math.cos(phi2) *
			Math.sin(dlam / 2) * Math.sin(dlam / 2);

	let c = 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a));
	return R * c;
		
}
function wait16(){
	return new Promise(r=>{requestAnimationFrame(r);});
}