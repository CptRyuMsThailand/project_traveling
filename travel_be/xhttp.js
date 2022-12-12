function web_request(url,data,method="POST",headerType="application/x-www-form-urlencoded"){
	return new Promise(
		function(resolve,reject){
			const xhttp = new XMLHttpRequest();
			xhttp.onload = function(){
				resolve(this.responseText);
			}
			xhttp.onerror = function(){
				reject(this.responseText);
			}
			xhttp.open(method,url,true);
			xhttp.setRequestHeader("Content-Type",headerType);
			xhttp.send(data);
		}
	);
	
}