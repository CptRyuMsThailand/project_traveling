<?php
if(
	!isset($FROM_INDEX) ||
	!isset($_GET["articleid"])
)header("Location:./../index.php");
$article_id = $_GET["articleid"];


?>
<div id="iiii" class="w3-container">
	
	<ul class="w3-ul">

		<li class="w3-white"><h2 id="dom_header" class="w3-header"></h2></li>
		<li>
			<div class="w3-bar w3-white" >
				<button onclick="article_set_tab(tab_main_article,0);" class="w3-bar-item w3-button cpt_tab"> รายละเอียด </button>
				<button onclick="article_set_tab(tab_view_article,1);" class="w3-bar-item w3-button cpt_tab"> จุดชมวิว </button>
				<button onclick="article_set_tab(tab_view_location,2);" class="w3-bar-item w3-button cpt_tab"> สถานที่ </button>
				
			</div>
		</li>
		<li>

			<ul class="w3-ul w3-bottombar" id="tab_main_article">
		
				<li><div id="dom_detail" class="w3-container w3-white"></div></li>
			</ul>
			<ul class="w3-ul w3-bottombar" id="tab_view_article">
				<li class="w3-white"> <h2> จุดชมวิว </h2></li>
				<li class="w3-white"><div id="dom_viewpoint" class="w3-container"></div></li>
			</ul>
			<ul class="w3-ul w3-bottombar" id="tab_view_location">
				<li class="w3-white"> <h2> ข้อมูลเส้นทาง</h2></li>
				<li class="w3-white"><div  class="w3-container">
					<?php
					include("./article/articleCredit.php");
					?>

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
function article_set_tab(elem,ind){
	article_reset_tab();
	elem.style.display = "block";
	let className = document.getElementsByClassName("cpt_tab");
	className[ind].classList.add("w3-green");
}
function article_reset_tab(){
	tab_view_article.style.display = "none";
	tab_main_article.style.display = "none";
	tab_view_location.style.display = "none";
	
	let className = document.getElementsByClassName("cpt_tab");
	for(let i = 0;i<className.length;i++){
		className[i].classList.remove("w3-green");
	}
}



window.addEventListener("load",loading_article);
async function loading_article(){
	article_reset_tab();
	article_set_tab(tab_main_article,0);
	const queryString = window.location.search;
	const searchParam = new URLSearchParams(queryString);
	const article = searchParam.get("articleid");
	console.log(article);
	//document.getElementById("iiii").innerText = JSON.stringify(await getArticle(article));

	let returnedData = await getArticle(article);
	let returnedData2 = await get_viewpoint(returnedData.value[0].ev_ref_place_id);
	dom_viewpoint.innerHTML = returnedData2;
	console.log(returnedData);
	//iiii.innerText = returnedData;
	dom_header.innerText = returnedData.value[0].ev_name;
	dom_detail.innerHTML = marked.parse(returnedData.value[0].ev_desc);
	if(returnedData.status == 404){
		modal_error.style.display = "block";
	}
}


</script>