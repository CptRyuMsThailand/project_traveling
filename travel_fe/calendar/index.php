<?php

function date_clamp($date_value_ym,$date_in_compare){
	for($i=0;$i<2;$i++){
		if($date_value_ym[$i] > $date_in_compare[$i]){//Past Year or future month
			return 1;
		}	
		if($date_value_ym[$i] < $date_in_compare[$i]){//Future Year or future month
			return 31;
		}
	}
	return $date_in_compare[2];
}
if(!isset($FROM_INDEX)){
	header("Location:./../index.php");
}
$date_value_str;
$date_now_str = date("Y-m-d");
$date_now = explode("-",$date_now_str);
if(!isset($_GET["date"])){ // IF date is not included
	$date_value_str = date("Y-m");
}else{
	$date_value_str = htmlentities($_GET["date"]);
}
$date_value = explode("-",$date_value_str);

$start_wdate = zeller_congruence(1,0+$date_value[1]-1,0+$date_value[0]);
$date_length = month_length(0+$date_value[1]-1,0+$date_value[0]);

// Get all available event in month
$arr_of_ev_remember = [];
$result_query = $conn->query("SELECT ev_date_beg,ev_date_end FROM table_event WHERE (ev_date_beg >= '".$date_value_str."-01' AND ev_date_beg <= '".$date_value_str."-31') OR (ev_date_end >= '".$date_value_str."-01' AND ev_date_end <= '".$date_value_str."-31')");
print_r($result_query);
if($result_query->num_rows > 0){
	while($row = $result_query->fetch_assoc()){
		echo "<br>";
		print_r($row);
		$date_beg = date_clamp($date_value,explode("-",$row["ev_date_beg"]));
		$date_end = date_clamp($date_value,explode("-",$row["ev_date_end"]));
		for($i = $date_beg; $i <= $date_end; $i++){
			if(!array_key_exists($i, $arr_of_ev_remember)){
				$arr_of_ev_remember[$i] = 1;
			}else{
				$arr_of_ev_remember[$i]+= 1;
			}
		}
		
	}
}

?>
<link rel="stylesheet" href="./calendar/calendar_helper.css">
<script src="./calendar/calendar_helper.js" defer="true">
	
</script>
<div class="w3-container s12" >
	<div class="w3-row" >
		<div class="w3-col m12 l7">



			<div class="w3-row">
				<div class="w3-col w3-cyan">
					<h2 class="w3-center">
						<a href="?pageName=<?php echo $TAB_CALENDAR;?>&date=<?php echo implode("-",prev_month($date_value[0],$date_value[1]));?>"><button class="w3-button">&lt;</button></a>
						<?php 
						echo $MONTH_ENUM_THAI[$date_value[1]-1]." พ.ศ. ".($date_value[0] + 543);
						?>
						<a href="?pageName=<?php echo $TAB_CALENDAR;?>&date=<?php echo implode("-",next_month($date_value[0],$date_value[1]));?>"><button class="w3-button">&gt;</button></a>
					</h2>
				</div>

				<!-- This is side info -->
			</div>
			<div class="w3-row">
				<div class="w3-col">
					<table class="w3-table w3-striped w3-border">
						<tr>
							<?php
							for($i=0;$i<7;$i++){
								?>
								<th>
									<?php echo $SDATE_ENUM_THAI[$i];?>

								</th>
								<?php
							}
							?>
						</tr>
						<?php
						$temp_date = 1;
						for($j=0;$j<7;$j++)
						{
							if($temp_date >= ($start_wdate + $date_length + 1)){
								break;
							}
							?>
							<tr>
								<?php
								for($i=0;$i<7;$i++)
								{
									$date_actual = $temp_date - $start_wdate;
									$date_actual_str = str_pad($date_actual,2,"0",STR_PAD_LEFT);
									$data_is_valid_date = $temp_date > ($start_wdate) && $temp_date < ($start_wdate + $date_length + 1);
									

									?>
									<td 
									style="cursor: pointer;"
									<?php
									$class_temp = " class='";
									$is_exists = array_key_exists($date_actual,$arr_of_ev_remember);
									$is_today  = (($date_value_str."-".$date_actual_str) == $date_now_str);

									if($is_exists && $is_today){
										$class_temp.="w3-black ";
									}else if($is_exists){
										$class_temp.="w3-aqua ";
									}else if($is_today){
										echo "Hello world";
										$class_temp.="w3-green selectioned ";
									}
									if($data_is_valid_date){
										$class_temp.="date-valid ";
									}
									$class_temp .= "'";

									echo $class_temp;
									
									if($data_is_valid_date){
										echo "onclick=\"calendar_get_data('$date_value_str-$date_actual_str')\"";	
									}
									
									?>
									>
									<?php if(
										$data_is_valid_date
									){
										$text_temp = "<h3>".$date_actual."</h3><br>";
										if($is_exists){
											$text_temp .= $arr_of_ev_remember["$date_actual"];
										}else{
											$text_temp .= "0";
										}
										$text_temp .= " กิจกรรม";										
										echo $text_temp;
										
									}
									?>
								</td>

								<?php
								$temp_date++;
							}
							?>
						</tr>
						<?php
					}
					?>

				</table>
			</div>
		</div>
	</div>
	<!-- Greeny bar -->
	<div class="w3-col m12 l5 w3-green" >
		<div class="w3-container w3-border">
			<h2 id="dom_calendar_dateHeader"> Date  </h2>
		</div>
		<div class="w3-container" id="dom_calendar_card_container">

		</div>
	</div>
</div>
</div>




