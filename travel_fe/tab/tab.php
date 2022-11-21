<?php
require("tabHelper.php");



?>

<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:150px;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close('mySidebar')">Close &times;</button>

  <a href="?pageName=<?php echo $TAB_HOME;?>" class="w3-bar-item w3-button">Home</a>
  <a href="?pageName=<?php echo $TAB_LINEARLIST;?>" class="w3-bar-item w3-button">List</a>
  <a href="?pageName=<?php echo $TAB_CALENDAR;?>" class="w3-bar-item w3-button">Calendar</a>
</div>
<div class="w3-main" style="margin-left:150px; height:auto;">
  <div class="w3-teal">
    <div class="w3-container w3-hide-large w3-red">
     <button class="w3-button w3-xlarge w3-hide-large" onclick="w3_open('mySidebar')">&#9776;</button>
   </div>
   <div class="w3-container w3-cell">
     
     <h1>My Page - <?php echo $TAB_ENUM[$tabSelected];?></h1>
   </div>
 </div>

 <!-- This is body of programs -->
 <?php 
 switch($tabSelected){
  case $TAB_HOME : require("./homepage/index.php");break;
  case $TAB_CALENDAR : require("./calendar/index.php");break;
}

?>

</div>
