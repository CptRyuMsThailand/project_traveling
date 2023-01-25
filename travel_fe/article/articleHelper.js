
async function getArticle(article_id){
	let xhttp = new XMLHttpRequest();
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
				xhttp.open("POST","./article/articleHelper.php",true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("articleid="+encodeURIComponent( article_id));
			}

		);
		return data;
		
	}catch(e){
		throw e;
	}
	
}
async function get_viewpoint(place_id){
	let xhttp = new XMLHttpRequest();
	try{
		let data = await new Promise(
			(resolve,reject)=>{
				xhttp.onload = function(){
					try{
						let myObj = this.responseText;
						resolve(myObj);	
					}catch(e){
						reject(xhttp.responseText);
					}
					
				}
				xhttp.onerror = function(){
					reject(xhttp.responseText);
				}
				xhttp.open("POST","./article/articleViewpoint.php",true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("place_id="+encodeURIComponent( place_id));
			}

		);
		return data;
		
	}catch(e){
		throw e;
	}
}