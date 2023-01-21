<?php
$MONTH_ENUM_THAI = [
	"มกราคม",
	"กุมภาพันธ์",
	"มีนาคม",
	"เมษายน",
	"พฤษภาคม",
	"มิถุนายน",
	"กรกฏาคม",
	"สิงหาคม",
	"กันยายน",
	"ตุลาคม",
	"พฤศจิกายน",
	"ธันวาคม"
];
$DATE_ENUM_THAI = [
	"อาทิตย์"
];
$SDATE_ENUM_THAI = [
	"อา","จ","อ",
	"พ","พฤ","ศ","ส"
];

function month_length($month,$year){ // Month - 1, year in bc format
	switch($month){
		case 0 : return 31;break;
		case 1 : {
			if(($year % 4) != 0){
				return 28;
			}else if(($year % 100) != 0){
				return 29;
			}else if(($year % 400) != 0){
				return 28;
			}else{
				return 29;
			}
		};break;
		case 2 : return 31;break;
		case 3 : return 30;break;
		case 4 : return 31;break;
		case 5 : return 30;break;
		case 6 : return 31;break;
		case 7 : return 31;break;
		case 8 : return 30;break;
		case 9 : return 31;break;
		case 10 : return 30;break;
		case 11 : return 31;break;
		default : throw "Error";
	}
}
function zeller_congruence($d,$m,$y){ // 0 is sunday, this function do not check whether day that input is real or not
	// date from 1 - 31 [can be out of range]
	// month from 1 = January
	// Year in christian epoch format eg 2000
	/*if($m < 3){ // Less than march
		$m = $m + 12;
		$y = $y - 1;
	}
	$k = ($y % 100);
	$j = floor($y / 100);
	$h = (($d + floor((13*($m + 1))/5) + $k + floor($k / 4) + floor($j / 4) - 2 * $j)% 7 + 7) % 7;
	return (($h + 2) % 7);*/

	return Date("w",mktime(0,0,0,$m,$d,$y));
}
function next_month($year,$month){
	if($month >= 12){
		return [$year + 1,1];
	}
	return [$year,$month + 1];
}
function prev_month($year,$month){
	if($month <= 1){
		return [$year - 1,12];
	}
	return [$year,$month - 1];
}
?>