<?php
if(
	!isset($FROM_INDEX) ||
	!isset($_GET["articleid"])
)header("Location:./../index.php");
$article_id = $_GET["articleid"];


?>
<div id="iiii" class="w3-container">
	<ul class="w3-ul w3-bottombar">
		<li><h2 id="dom_header" class="w3-header"></h2></li>
		<li><div id="dom_detail" class="w3-container"></div></li>
	</ul>
	<ul class="w3-ul w3-bottombar">
		<li> <h2> Viewpoint </h2></li>
		<li><div id="dom_viewpoint" class="w3-container"></div></li>
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
window.addEventListener("load",loading_article);
async function loading_article(){
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