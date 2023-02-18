
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
async function get_viewpoint(event_id){
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
				xhttp.send("event_id="+encodeURIComponent( event_id));
			}

		);
		return data;
		
	}catch(e){
		throw e;
	}
}
async function requestData(url,params){
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
				xhttp.open("POST",url,true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				let sendText = "";
				let i = 0;
				for(let vars in params){
					if(i != 0){
						sendText += "&";
					}
					sendText += encodeURIComponent( i ) + "=" + encodeURIComponent( vars[i] );
				}
				xhttp.send(sendText);
			}

		);
		return data;
		
	}catch(e){
		throw e;
	}

}