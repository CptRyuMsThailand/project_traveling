<?php
require("tabHelper.php");



?>
<div class="w3-top" style="z-index: 3;">
  <div class="w3-bar w3-black">
    <a href="./index.php?pageName=home" class="w3-bar-item w3-button"><b>HOME</b></a>
    <a href="./index.php?pageName=linearlist" class="w3-bar-item w3-button"><b>List</b></a>

  </div>

</div>
<div class="w3-container w3-white" style="margin-top:20%; margin-left:20px; margin-right:20px; height:100%; z-index:2; position:relative;">

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
<footer class="w3-container w3-black">
  Hello world
</footer>