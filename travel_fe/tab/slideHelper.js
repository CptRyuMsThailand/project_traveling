function createSlideshow(baseId,imageList){
	let txt = `
		<div class="w3-content" id="${baseId}">
			${listImageSlideshow(imageList)}
			<input type="hidden" class="tracking" value="0">
			<input type="hidden" class="maxImage" value="${imageList.length}">

			<h3><a class="w3-btn-floating w3-display-topleft numberShow"> 1 / ${imageList.length} </a></h3>
			<h2><a class="w3-btn-floating w3-display-left" onclick="moveSlideshow(\'${baseId}\',-1)">&#10094;</a></h2>
			<h2><a class="w3-btn-floating w3-display-right" onclick="moveSlideshow(\'${baseId}\', 1)">&#10095;</a></h2>
		</div>
	`;
	return txt;
}
function listImageSlideshow(imageList){
	return imageList.reduce(
		(a,x,i)=>{
			return a + `<img class="w3-hover-opacity" src="./images/${x}" style="width : 100%;display : ${(i === 0 ? "block":"none")};">`;
		},"");
}
function moveSlideshow(baseId,count){
	let base = document.getElementById(baseId);
	let trackingVar = base.getElementsByClassName("tracking")[0].value;
	showSlideshow(baseId,Number(trackingVar) + count);

}
function showSlideshow(baseId,position){
	let base = document.getElementById(baseId);
	let maxImage = Number(base.getElementsByClassName("maxImage")[0].value);
	if(position < 0)position = 0;
	if(position >= maxImage)position = maxImage - 1;
	base.getElementsByClassName("tracking")[0].value = position;
	let imageList = base.getElementsByTagName("img");
	for(let i=0;i<maxImage;i++){
		imageList[i].style.display = "none";
	}
	imageList[position].style.display = "block";
	base.getElementsByClassName("numberShow")[0].innerText = `${position + 1} / ${maxImage}`;
}
