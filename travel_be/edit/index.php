<?php
if(!isset($page_id) or !isset($_GET["edit_id"])){
	header("Location:./../index.php");
	exit;
}
require("./connection/connect.php");
require("./add/imageUpload.php");
require("./delete/deleteImage.php");
$edit_id = $_GET["edit_id"];


if(isset($_POST["form_post"])){
	$image_data_current = $_POST["form_image_old"];
	function getMoonToSun($yearin,$datein,$monthin){
		include("./connection/connect.php");
		$res_query = $conn->query("SELECT * FROM table_moon_calendar WHERE ".$yearin." = moon_year");
		$result_moon_year = $res_query->fetch_array(MYSQLI_ASSOC);

		if(!$result_moon_year){
			return "";
		}
		$date_first_jan = date_create("$yearin-01-01");
	//echo $result_diff->format("%R%a");
		$dateNum = -($result_moon_year["moon_start_date"] - 1);
		$moon_smonth = $result_moon_year["moon_start_month"];
		$moon_slong = $result_moon_year["moon_start_long"];
		$moon_db8 = $result_moon_year["moon_double_eighth"];

		$month_out = $moon_smonth;
		$actual_monthin = $moon_db8 + $monthin;
		while($month_out < $actual_monthin){
			$dateNum += 29 + $moon_slong;
			$month_out += 1;
			if(!($month_out == 9 and $moon_db8)){
				$moon_slong += 1;
				$moon_slong	 %= 2;
			}

		}
		$dateNum += $datein - 1;
		date_add($date_first_jan,date_interval_create_from_date_string("$dateNum days"));
		return date_format($date_first_jan,"Y-m-d");
	}
	$now_year=  date("Y");
	$date_start = "";
	$date_end = "";
	$calendar_type = $_POST["form_calendar_type"];
	$form_day_beg = $_POST["form_day_beg"];
	$form_day_end = $_POST["form_day_end"];
	$form_month_beg = $_POST["form_month_beg"];
	$form_month_end = $_POST["form_month_end"];
	
	if($calendar_type == "sun"){
		$date_start = "$now_year-$form_month_beg-$form_day_beg";
		$date_end = "$now_year-$form_month_end-$form_day_end";
	}
	if($calendar_type == "moon"){
		$date_start = getMoonToSun($now_year,$form_day_beg,$form_month_beg);
		$date_end   = getMoonToSun($now_year,$form_day_end,$form_month_end);
	}
	$stmt4 = $conn->prepare("UPDATE table_event SET ev_name = ?,ev_date_beg = ?,ev_date_end = ?,ev_day_beg = ? ,ev_day_end = ?,ev_month_beg = ?,ev_month_end = ?,ev_day_type = ?,ev_img_list = ?,ev_desc = ?,ev_ref_place_id = ? WHERE ev_id = ?");
	$stmt4->bind_param(
		"ssssssssssii",
		$_POST["form_name"],
		$date_start,
		$date_end,
		$form_day_beg,
		$form_day_end,
		$form_month_beg,
		$form_month_end,
		$calendar_type,
		$_POST["form_image"],
		$_POST["form_desc_value"],
		$_POST["form_place_id"],
		$edit_id
	);

	$stmt4->execute();

	header("Location:./index.php");
	exit;
}



$stmt2 = $conn->prepare("SELECT * FROM table_event WHERE ev_id = ?");
$stmt2->bind_param("d",$edit_id);
$stmt2->execute();
$result2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC)[0];
?>

<form class="w3-container" method="POST" enctype="multipart/form-data" onsubmit="return testSubmit();">
	<div class="w3-row-padding">
		<div class="w3-full w3-padding">
			<h2> Edit Event </h2>
		</div>
		<input type="hidden" name="form_image_old" value="<?=$result2['ev_img_list'];?>">
		<div class="w3full w3-padding">
			<label class="w3-label">Name 
				<input type="text" name="form_name" class="w3-input w3-border" required value="<?=$result2['ev_name']?>"> 
			</label>
		</div>
		
		<div class="w3-half w3-padding">
			<div class="w3-container w3-grey">
			<p> Date Begin </p>
			<label class="w3-label"> Day
				<input type="number" name="form_day_beg" class="w3-input w3-border" required value="<?=$result2["ev_day_beg"]?>">
			</label>
			<label class="w3-label"> Month
				<input type="number" name="form_month_beg" class="w3-input w3-border" required value="<?=$result2["ev_month_beg"]?>">
			</label>
			</div>
		</div>
		<div class="w3-half w3-padding">
			<div class="w3-container w3-grey">
			<p> Date End </p>
			<label class="w3-label"> Day
				<input type="number" name="form_day_end" class="w3-input w3-border" required value="<?=$result2["ev_day_end"]?>">
			</label>
			<label class="w3-label"> Month
				<input type="number" name="form_month_end" class="w3-input w3-border" required value="<?=$result2["ev_month_end"]?>">
			</label>
		</div>
		</div>
		<div class="w3-full w3-padding">
			<label>
				Calendar Type
				<select class="w3-input" name="form_calendar_type">
					<option value="sun" <?php if($result2["ev_day_type"] == "sun")echo "selected";?>> Sun </option>
					<option value="moon" <?php if($result2["ev_day_type"] == "moon")echo "selected";?>> Moon </option>
				</select>
			</label>
		</div>

		<div class="w3-full w3-padding">
			<label class="w3-label">Data
				<textarea class="w3-input w3-border" name="form_desc_value"><?=$result2["ev_desc"];?></textarea>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label> Thumbnail URL
				<input type="text" id="form_image" name="form_image" class="w3-input" value="<?=$result2["ev_img_list"];?>"/>
			</label>
		</div>
		<div class="w3-full w3-padding">
			<label class="w3-label">
				Referenced Places
				<select name="form_place_id" class="w3-select w3-border" required>
					<option value="0"> ไม่ระบุ</option>
					<?php
					$stmt1 = $conn->prepare("SELECT pl_id,pl_name FROM table_place ORDER BY pl_name ASC");
					$stmt1->execute();
					$result = $stmt1->get_result();
					
					while($node = $result->fetch_array(MYSQLI_ASSOC)){
						?>
						<option value="<?=$node['pl_id'];?>" <?php if($node['pl_id'] == $result2['ev_ref_place_id'])echo "selected";?> >
							<?=$node['pl_name'];?>
						</option>
						<?php

					}


					?>
				</select>
			</label>
		</div>

		<div class="w3-full w3-padding">
		<button type="submit" name="form_post" class="w3-button w3-input w3-green"> Edit </button>
		</div>
	</div>
</form>





<script defer="true">
	
	async function testSubmit(){
		let s_date = new Date(form_date_start.value);
		let e_date = new Date(form_date_end.value);
		if(s_date > e_date){
			alert("end date must be after start date");
			return false;
		}
		return true;

	}
</script>
<?php

$conn->close();
?>
