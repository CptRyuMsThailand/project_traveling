<?php
require("tabHelper.php");



?>
  <div class="w3-bar w3-black">
    <a href="./index.php?pageName=home" class="w3-bar-item w3-button w3-border <?php if($tabSelected == "home")echo "w3-green";?>" ><b> ประกาศกิจกรรม </b></a>
    <a href="./index.php?pageName=linearlist" class="w3-bar-item w3-button w3-border <?php if($tabSelected == "linearlist")echo "w3-green";?>"><b>ค้นหากิจกรรม</b></a>
    <a href="./index.php?pageName=calendar" class="w3-bar-item w3-button w3-border <?php if($tabSelected == "calendar")echo "w3-green";?>"><b>ปฏิทินกิจกรรม</b></a>
    

  </div>

<div class="w3-container w3-white">

 <!-- This is body of programs -->
 <?php 
 switch($tabSelected){
  case "home" : require("./homepage/index.php");break;
  case "linearlist" : require("./list/index.php");break;
  case "calendar" : require("./calendar/index.php");break; 
  case "article" : require("./article/index.php");break;
}

?>

</div>