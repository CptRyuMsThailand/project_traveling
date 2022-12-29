<?php
if(
	!isset($FROM_INDEX) ||
	!isset($_GET["articleid"])
)header("Location:./../index.php");
$article_id = $_GET["articleid"];


?>
<div id="iiii" class="w3-container">
	<h2></h2>

</div>
<div class="w3-modal w3-opacity" id="modal_error" style='display: none;'>
	<div class="w3-modal-content w3-animate-zoom">
		<h3 class="w3-text-black">Oops, Not found</h3><br>
		<a href="index.php" class="w3-button w3-red"> Go back</a>
	
	</div>	

</div>
<script src="./article/articleHelper.js" defer="true"></script>
<script defer>
window.addEventListener("load",loading);
async function loading(){
	const queryString = window.location.search;
	const searchParam = new URLSearchParams(queryString);
	const article = searchParam.get("articleid");
	console.log(article);
	//document.getElementById("iiii").innerText = JSON.stringify(await getArticle(article));

	let returnedData = await getArticle(article);
	console.log(returnedData);
	iiii.innerText = returnedData;
	if(returnedData.status == 404){
		modal_error.style.display = "block";
	}
}


</script>