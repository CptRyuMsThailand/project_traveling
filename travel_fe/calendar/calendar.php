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

function getMoonDate($result_moon_year,$datein){
	if(!$result_moon_year){
		return "";
	}
	$year = $datein->format("Y");
	$date_first_jan = date_create("$year-01-01");
	
	$result_diff = date_diff($date_first_jan,$datein);
	//echo $result_diff->format("%R%a");
	$dateNum = intval($result_diff->format("%R%a")) + $result_moon_year["moon_start_date"] - 1;
	$moon_smonth = $result_moon_year["moon_start_month"];
	$moon_slong = $result_moon_year["moon_start_long"];
	$moon_db8 = $result_moon_year["moon_double_eighth"];
	while($dateNum >= 29 + $moon_slong){
		$dateNum -= 29 + $moon_slong;
		$moon_smonth += 1;
		if($moon_smonth != 9 and $moon_db8){
			$moon_slong += 1;
			$moon_slong	 %= 2;
		}
		
	}
	$date_phase = ($dateNum % 15) + 1;
	$date_risend_lit = ["ขึ้น","แรม"][($dateNum >= 15) ? 1 : 0];
	$moon_lmonth = $moon_smonth - ($moon_smonth > 12 ? 12 : 0);
	if ($moon_smonth == 9 and $moon_db8){
		$moon_lmonth = "8(8)";
	}else if($moon_smonth >= 9 and $moon_db8){
		$moon_lmonth = ($moon_smonth - 1) - ($moon_smonth - 1 > 12 ? 12 : 0);
	}
	return $date_risend_lit." ".$date_phase." ค่ำ <br> เดือน".$moon_lmonth;

}
$date_now = DATE("Y-m");
if(isset($_GET["date"])){
	$date_now = $_GET["date"];
}
$curr_month = (new DateTime($date_now))->format("m");
$curr_year = (new DateTime($date_now))->format("Y");
$res_query = $conn->query("SELECT * FROM table_moon_calendar WHERE ".$curr_year." = moon_year");
$result_moon_year = $res_query->fetch_array(MYSQLI_ASSOC);


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
				$sql = "SELECT ev_id FROM table_event WHERE ? BETWEEN ev_date_beg AND ev_date_end";



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
							$textMoon = getMoonDate($result_moon_year,date_create($date_full));
							?>
							<a class="date-valid w3-button" href="JavaScript:calendar_get_data('<?=$date_full;?>')">
							<h3 > <?="$dite";?></h3>
							<p><?=$textMoon;?></p>
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