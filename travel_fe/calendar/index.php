<?php


if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
?>
<script src="./calendar/calendar_helper.js"></script>
<div class="w3-container">
	<ul class="w3-ul">
		<li>
			<div class="w3-row-padding w3-center" style="width: 100%;">
				<div class="w3-cols s12">
					<?php
					include "./calendar/calendar.php";
					?>
				</div>
			</div>
		</li>
		<li>
			<ul class="w3-ul" id="list_of_output">
				

				
			</ul>

		</li>
	</ul>
</div>

