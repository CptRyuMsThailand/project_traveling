<?php
if(
	!isset($FROM_INDEX) ||
	!isset($_GET["articleid"])
)header("Location:./../index.php");
$article_id = $_GET["articleid"];


?>
<div id="iiii">
	

</div>
<script src="./article/articleHelper.js" defer="true"></script>
<script defer>
window.addEventListener("load",loading);
async function loading(){
	const queryString = window.location.search;
	const searchParam = new URLSearchParams(queryString);
	const article = searchParam.get("articleid");
	console.log(article);
	document.getElementById("iiii").innerText = JSON.stringify(await getArticle(article));
}


</script>