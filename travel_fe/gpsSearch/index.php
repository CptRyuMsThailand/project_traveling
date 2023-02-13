<?php
if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}

?>
<header>
	<div class="w3-container">
		<h2>ค้นหาผ่านระบบ GPS</h2>
	</div>
</header>
<div class="w3-container">
	<div class="w3-half">
		<select id="dom_dist_select" class="w3-select">
			<option value="5">5 km </option>
			<option value="10">10 km </option>
			<option value="15">15 km </option>
			<option value="20">20 km </option>
			<option value="25">25 km </option>
			<option value="30">30 km </option>
			<option value="60">60 km </option>

		</select>

	</div>
	<div class="w3-half">
		<button onclick="retrieveEventFromGpsData();" class="w3-input w3-button"> Search</button>
	</div>
</div>
<div class="w3-container w3-padding" >
	<ul class="w3-ul w3-padding" id="dom_output_list">
		
	</ul>
</div>
<script src="./gpsSearch/gpsHelper.js"></script>
<script>
	


</script>
