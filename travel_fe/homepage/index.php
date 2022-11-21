<?php
if(!isset($FROM_INDEX)){
  header("Location:./../index.php");
}

$result = $conn->query("SELECT * FROM table_event LIMIT 1");

?>
<div class="w3-container w3-cyan">
<?php
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){

    $dmy_beg = explode("-",$row["ev_date_beg"]);
    $dmy_end = explode("-",$row["ev_date_end"]);
    
?>
    <div class="w3-row w3-lightblue">
      <div class="w3-col m6 l5">
        <div class="w3-card-4">
          <div class="w3-display-container w3-text-white w3-black">
            <img src="<?php echo "./images/".$row["ev_img_list"];?>" style="width:100%" class="w3-hover-opacity">
            <div class="w3-xlarge w3-display-bottomleft w3-padding"><?php echo $row["ev_name"];?></div>
          </div>
        </div>
      </div>

      <div class="w3-col m6 l7">
        <ul class="w3-ul">
          <li class="w3-blue"><h2>ข้อมูล</h2></li>
          <li >เริ่มตั้งแต่ <?php echo $dmy_beg[2]." ".$MONTH_ENUM_THAI[$dmy_beg[1]-1]." พศ ".($dmy_beg[0]+543) ?></li>
          <li >จนถึง <?php echo $dmy_end[2]." ".$MONTH_ENUM_THAI[$dmy_end[1]-1]." พศ ".($dmy_end[0]+543) ?></li>
          

        </ul>
        
      </div>


    </div>
<?php
  }
}
?>
</div>