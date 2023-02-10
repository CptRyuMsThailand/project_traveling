<?php


if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
?>
<script src="./calendar/calendar_helper.js"></script>
<div class="w3-container w3-padding">
	<ul class="w3-ul">
		<li class="w3-white">
			<center><h2>ค้นหากิจกรรมผ่านปฏิทิน</h2></center>
		</li>
		<li class="w3-white w3-padding">
			<div class="w3-row-padding w3-center" style="width: 100%;">
				<div class="w3-cols s12">
					<?php
					include "./calendar/calendar.php";
					?>
				</div>
			</div>
		</li>
		<li><h3 id="headList">รายการประจำวันที่ได้เลือกไว้</h3></li>
		<li>
			<ul class="w3-ul w3-white" id="list_of_output">
				

				
			</ul>

		</li>
	</ul>
</div>

