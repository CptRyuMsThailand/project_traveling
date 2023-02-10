<?php
if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}

?>
<div class="w3-container">

	<div class="w3-row-padding">
		<div class="w3-full w3-container w3-center"><h3>ค้นหากิจกรรมผ่านระบบ GPS</h3></div>
		<div class="w3-half">
			<label><b> รัศมีการค้นหา </b></label>
			<select class="w3-select w3-white" id="dom_dist_select">
				<option value="5"> 5 กิโลเมตร</option>
				<option value="10"> 10 กิโลเมตร</option>
				<option value="15"> 15 กิโลเมตร</option>
				<option value="20"> 20 กิโลเมตร</option>
				<option value="25"> 25 กิโลเมตร</option>
				<option value="30"> 30 กิโลเมตร</option>
			</select>
			</div>
			<div class="w3-half">
				<label class="w3-hide-small"><b>ค้นหา</b></label>
			<button class="w3-button w3-input w3-green" onclick="retrieveEventFromGpsData();"> <i class="fa fa-search"></i> ค้นหา </button>
			</div>

	</div>
</div>
<div class="w3-container w3-padding" >
	<ul class="w3-ul w3-padding" id="dom_output_list">
		
	</ul>
</div>
<script src="./gpsSearch/gpsHelper.js"></script>
<script>
	


</script>