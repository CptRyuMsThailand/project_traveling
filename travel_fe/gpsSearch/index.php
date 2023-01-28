<?php
if(!isset($FROM_INDEX)){
  header("Location:./../index.php");
}

?>
<div class="w3-container">
	<div>
		<select class="w3-button w3-white" id="dom_dist_select">
			<option value="5"> 5 กิโลเมตร</option>
			<option value="10"> 10 กิโลเมตร</option>
			<option value="15"> 15 กิโลเมตร</option>
			<option value="20"> 20 กิโลเมตร</option>
			<option value="25"> 25 กิโลเมตร</option>
			<option value="30"> 30 กิโลเมตร</option>
		</select>
		<button class="w3-button w3-white" onclick="retrieveEventFromGpsData();"> Search </button>
	</div>
</div>
<div class="w3-container" >
	<ul class="w3-ul" id="dom_output_list">
		
	</ul>
</div>
<script src="./gpsSearch/gpsHelper.js"></script>
<script>
	


</script>