<?php
if(
	!isset($FROM_INDEX) ||
	!isset($_GET["articleid"])
)header("Location:./../index.php");
$article_id = $_GET["articleid"];
$google_map_ext_url = "https://www.google.com/maps/place/";

$stmt = $conn->prepare("SELECT pl_geo_lat,pl_geo_lon FROM table_place LEFT JOIN table_event ON ev_ref_place_id = pl_id WHERE ? = ev_id");
$stmt->bind_param("i",$article_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
$stmt->close();
$maps_url = $google_map_ext_url . $result["pl_geo_lat"] . "," . $result["pl_geo_lon"];

?>
<div id="iiii" class="w3-container">
	
	<ul class="w3-ul">

		<li class="w3-white"><h2 id="dom_header" class="w3-header"></h2></li>
		<li>
			<div class="w3-bar w3-white" >
				<button onclick="article_set_tab(0);" class="w3-bar-item w3-button cpt_tab"> รายละเอียด </button>
				<button onclick="article_set_tab(1);" class="w3-bar-item w3-button cpt_tab"> รูปภาพ </button>
				<button onclick="article_set_tab(2);" class="w3-bar-item w3-button cpt_tab"> ข้อมูลการจัดงาน </button>
				<button onclick="article_set_tab(3);" class="w3-bar-item w3-button cpt_tab"> โรงแรม/ที่พัก </button>
				<a href="<?=$maps_url?>" target="new" class="w3-bar-item w3-button w3-yellow"> Maps </a>
				
			</div>
		</li>
		<li>

			<ul class="w3-ul w3-bottombar" id="tab_main_article">
		
				<li class="w3-white"><div id="dom_detail" class="w3-container"></div></li>
			</ul>
			<ul class="w3-ul w3-bottombar" id="tab_view_article">
				<li class="w3-white"> <h2> ภาพบรรยากาศ </h2></li>
				<li class="w3-white"><div id="dom_viewpoint" class="w3-container"></div></li>
			</ul>
			<ul class="w3-ul w3-bottombar" id="tab_view_location">
				<li class="w3-white"> <h2> ข้อมูลการจัดงาน</h2></li>
				<li class="w3-white"><div  class="w3-container">
					<?php
					include("./article/articleCredit.php");
					?>

				</div></li>
			</ul>
			<ul class="w3-ul w3-bottombar" id="tab_view_hotel">
				<li class="w3-white"> <h2> โรงแรม / ที่พัก </h2></li>
				<li class="w3-white"><div  class="w3-container" id="dom_hotel">
					

				</div></li>
			</ul>
			
			
		</li>
	</ul>
	

</div>
<div class="w3-modal w3-opacity" id="modal_error" style='display: none;'>
	<div class="w3-modal-content w3-animate-zoom">
		<h3 class="w3-text-black">Oops, Not found</h3><br>
		<a href="index.php" class="w3-button w3-red"> Go back</a>
		
	</div>	

</div>
<script src="./article/articleHelper.js" defer="true"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js" defer></script>
<script defer>
let tabContentDom = [
	tab_main_article,
	tab_view_article,
	tab_view_location,
	tab_view_hotel
	];
let article_id = 0;
function article_set_tab(ind){
	article_reset_tab();
	tabContentDom[ind].style.display = "block";
	let className = document.getElementsByClassName("cpt_tab");
	className[ind].classList.add("w3-green");
	history.replaceState(null,null,"index.php?pageName=article&articleid="+article_id+"&article_tab="+ind);
}
function article_reset_tab(){
	for(let i=0;i<4;i++)tabContentDom[i].style.display = "none";
	
	let className = document.getElementsByClassName("cpt_tab");
	for(let i = 0;i<className.length;i++){
		className[i].classList.remove("w3-green");
	}
}



window.addEventListener("load",loading_article);
async function loading_article(){
	const queryString = window.location.search;
	const searchParam = new URLSearchParams(queryString);
	article_id = searchParam.get("articleid");
	let se_tab = 0;
	if(searchParam.has("article_tab")){
		se_tab = Number(searchParam.get("article_tab"));
	}
	
	article_set_tab(se_tab);
	//console.log(article);
	//document.getElementById("iiii").innerText = JSON.stringify(await getArticle(article));

	let [returnedData,returnedData2] = await Promise.all([getArticle(article_id),get_viewpoint(article_id)]);
	let returnedData3 = await requestData("./article/articleHotel.php",{place_id:returnedData.value[0].pl_id});
	dom_viewpoint.innerHTML = returnedData2;
	//console.log(returnedData);
	//iiii.innerText = returnedData;
	dom_header.innerText = returnedData.value[0].ev_name;
	dom_detail.innerHTML = marked.parse(returnedData.value[0].ev_desc);
	dom_hotel.innerHTML = returnedData3;
	if(returnedData.status == 404){
		modal_error.style.display = "block";
	}
}


</script>