<?php
if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
function date_iterate_month($ymd){
	$dobj = new DateTime($ymd);
	$y = intval($dobj->format("Y"));
	$m = intval($dobj->format("m"));
	$d = intval($dobj->format("d"));
	$wdate_start = zeller_congruence(1,$m,$y);
	$m_length = month_length($m - 1,$y);
	for($i = 0;$i<intval($wdate_start);$i++){
		yield -1;
	}
	for($i = 1;$i <= $m_length;$i++){
		yield $i;
	}
}


$date_now = DATE("Y-m");
if(isset($_GET["date"])){
	$date_now = $_GET["date"];
}
$curr_month = (new DateTime($date_now))->format("m");
$curr_year = (new DateTime($date_now))->format("Y");
//echo date_iterate_month($date_now);
?>
<link rel="stylesheet" href="./calendar/calendar_helper.css">
<div class="w3-rows w3-centered" style="width:100%;">
	<div class="w3-cols s12">
		<form method="GET" id="ssubmit">
			<label><h3 style="display:inline;">เลือกเดือน</h3><input type="month" name="date" value="<?=$date_now;?>" class="w3-button" style="font-size:18px;" onchange="ssubmit.submit();"></label>
			<input type="hidden" name="pageName" value="calendar" >
			
		</form>
		<center class="w3-responsive">
			<table class="w3-table mycalendar w3-mobile" style="max-width: 350px;">
				<tr>
					<th > อา </th>
					<th > จ </th>
					<th > อ </th>
					<th > พ </th>
					<th > พฤ </th>
					<th > ศ </th>
					<th > ส </th>
				</tr>
				<?php
				$wd_count = 0;
				$sql = "SELECT * FROM table_event WHERE ? BETWEEN ev_date_beg AND ev_date_end";
				$stmt = $conn->prepare($sql);
				
				$stmt->bind_param("s",$date_full);
				echo "<tr>";
				foreach(date_iterate_month($date_now) as $dite){
					if($wd_count >= 7){
						$wd_count = 0;
						echo "</tr><tr>";
					}
					$wd_count+=1;

					?>
					<td class="w3-display-container">
						<?php 
						if($dite > -1){

							$date_full = Date("$curr_year-$curr_month-$dite");
							$stmt->execute();
							$res = $stmt->get_result()->num_rows;

							?>
							<a class="date-valid w3-button" href="JavaScript:calendar_get_data('<?=$date_full;?>')">
							<h3 > <?="$dite";?></h3>
							<div class="w3-display-topright w3-container"><span class="w3-badge w3-red"><?php if($res > 0)echo $res;?></span></div>
						</a>
							<?php 
						}
						?>
					</td>
					<?php
				}
				echo "</tr>";
				?>
			</table>
		</center>
	</div>

</div>