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
async function calendar_get_data(str,isSelect=true){
	let date_str_obj = str.split("-");
	dom_calendar_dateHeader.innerText = date_str_obj[2] + " " + 
	$MONTH_ENUM_THAI[Number(date_str_obj[1])-1] + " พ.ศ. " + 
	(Number(date_str_obj[0]) + 543);
	let obj_json_arr = await get_eventInDate(str);
	//console.log(obj_json_arr);
	dom_calendar_card_container.innerHTML = "";
	let elem_text = "";
	for(let i of obj_json_arr){

		elem_text += `
			<div class="w3-card-4">
				<div class="w3-display-container w3-text-white">
					<img class="w3-hover-opacity" style="width:100%" src="./images/${i.ev_img_list}">
					<div class="w3-medium w3-display-bottomleft w3-padding">${i.ev_name}</div>
				</div>
			</div>
		`;
	}

	dom_calendar_card_container.innerHTML = elem_text;
	
	if(isSelect){
		calendar_reset_selector();
		calendar_set_selector(Number(date_str_obj[2] - 1));	
	}
	
}
function calendar_reset_selector(){
	let dom_valid_class_date = document.getElementsByClassName("date-valid");
	for(let i of dom_valid_class_date){
		i.classList.remove("selectioned");
	}
}
function calendar_set_selector(date_num){
	let dom_selected_date = document.getElementsByClassName("date-valid")[date_num];
	dom_selected_date.classList.add("selectioned");
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
window.addEventListener("load",
	async function(){
		let date_obj = new Date();
		let str1 = date_obj.getFullYear().toString().padStart(4,"0");
		let str2 = (date_obj.getMonth() + 1).toString().padStart(2,"0");
		let str3 = date_obj.getDate().toString().padStart(2,"0");
		await calendar_get_data(`${str1}-${str2}-${str3}`,false);
	}
);