let gps_options = {
	enableHighAccuracy : true,
	timeout : 5000,
	maximumAge : 0

};
let google_map_ext_url = "https://www.google.com/maps/place/"
let xhttp = new XMLHttpRequest();
async function get_eventInDate(ymd_string){
	try{
		let data = await new Promise(
			(resolve,reject)=>{
				xhttp.onload = function(){
					try{
						let myObj = JSON.parse(this.responseText);
						resolve(myObj);	
					}catch(e){
						reject(xhttp.responseText);
					}
					
				}
				xhttp.onerror = function(){
					reject(xhttp.responseText);
				}
				xhttp.open("POST","./calendar/calendar_helper.php",true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("date="+encodeURIComponent( ymd_string));
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

async function calendar_get_data(instr){
	
	let date_str_obj = instr.split("-");
	let dataRet = await get_eventInDate(instr);
	list_of_output.innerHTML = "";
	let gps_coord = await getCoord();
	console.log(gps_coord);
	let arr_to_ret = [];
	for(datas of dataRet){
		let data_geolat = Number(datas.pl_geo_lat);
		let data_geolon = Number(datas.pl_geo_lon);
		let user_geolat = (gps_coord ? gps_coord.latitude : data_geolat);
		let user_geolon = (gps_coord ? gps_coord.longitude : data_geolon);
		let geodist = haversine(data_geolat,data_geolon,user_geolat,user_geolon);
	
		let str_to_ret = `
	<li>
		<div class="w3-row w3-light-grey" >
			<div class="w3-col s12"><h2>${datas.ev_name}</h2></div>
			<div class="w3-col s12 m4 w3-responsive">
				<img src="./images/${datas.ev_img_list.split(",")[0]}" class="w3-image" style="max-width:320px;">
			</div>
			<div class="w3-col s12 m8">
				<div class="w3-container">
					<ul class="w3-ul">
						<li>
							<span class="fa fa-calendar"></span> ${datas.ev_date_beg}<br>
							<span class="fa fa-calendar"></span> ${datas.ev_date_end}<br>
						</li>
						<li>
							<span class="fa fa-map-marker"></span> ${datas.pl_name} ${gps_coord ? geodist.toFixed(3) + "km" : ""}
						</li>
						<li>
							<span class="fa fa-graduation-cap"></span> ตำบล ${datas.lc_name.split(",")[1]} อำเภอ ${datas.lc_name.split(",")[0]}
						</li>
						<li>
							<a href="./index.php?pageName=article&articleid=${datas.ev_id}" class="w3-button w3-green"><span class="fa fa-info"></span> Read More</a> 
							<a href="${google_map_ext_url + data_geolat + "," + data_geolon }" class="w3-button w3-green" target="new"><span class="fa fa-map"></span> Open in google map</a> 
							
						</li>
					</ul>
				</div>
			</div>
		</div>
	</li>
	`;
	arr_to_ret.push({dist:geodist,content : str_to_ret});
	}
	arr_to_ret.sort((a,b)=>{return a.dist - b.geodist;});
	for(let i of arr_to_ret){
		list_of_output.innerHTML += i.content;
	}
	
	calendar_reset_selector();
	calendar_set_selector(Number(date_str_obj[2]) - 1);	
	
	
}
const selectioned_color = "w3-green"
function calendar_reset_selector(){
	let dom_valid_class_date = document.getElementsByClassName("date-valid");
	for(let i of dom_valid_class_date){
		i.classList.remove(selectioned_color);
	}
}
function calendar_set_selector(date_num){
	let dom_selected_date = document.getElementsByClassName("date-valid")[date_num];
	dom_selected_date.classList.add(selectioned_color);
}
const $MONTH_ENUM_THAI = [
	"มกราคม",
	"กุมภาพันธ์",
	"มีนาคม",
	"เมษายน",
	"พฤษภาคม",
	"มิถุนายน",
	"กรกฏาคม",
	"สิงหาคม",
	"กันยายน",
	"ตุลาคม",
	"พฤศจิกายน",
	"ธันวาคม"
];
