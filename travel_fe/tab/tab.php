  <?php
require("tabHelper.php");



?>
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="dom_tab_main"><br>
  
    <a href="JavaScript:void(0)" onclick="w3_close('dom_tab_main');" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="./favicon.jpg" style="width:100px; height:100px; object-fit:cover;" class="w3-round"><br><br>
    <div class="w3-bar-block">
    <a href="./index.php?pageName=home" class="w3-bar-item w3-button w3-padding <?php if($tabSelected == "home")echo "w3-green";?>" >
      <span><i class="fa fa-home fa-th-large"></i> หน้าหลัก </span>
    </a>
    <a href="./index.php?pageName=gpssearch" class="w3-bar-item w3-button w3-padding <?php if($tabSelected == "gpssearch")echo "w3-green";?>">
      <span><i class="fa fa-map-marker"></i> ค้นหากิจกรรมใกล้ๆ คุณ </span>
    </a>
    <a href="./index.php?pageName=linearlist" class="w3-bar-item w3-button w3-padding <?php if($tabSelected == "linearlist")echo "w3-green";?>">
      <span><i class="fa fa-search"></i> ค้นหากิจกรรม </span>
    </a>
    <a href="./index.php?pageName=calendar" class="w3-bar-item w3-button w3-padding <?php if($tabSelected == "calendar")echo "w3-green";?>">
      <span><i class="fa fa-calendar"></i> ปฏิทินกิจกรรม </span>

    </a>
  </div>

</nav>

<div class="w3-main" style="margin-left:300px;">

 <!-- This is body of programs -->
 <header>
  <div class="w3-bar">
  <span class="w3-bar-item w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open('dom_tab_main');"><i class="fa fa-bars"></i></span>
  <a href="./index.php?pageName=home"><span class="w3-bar-item w3-button w3-hide-large w3-xxlarge w3-hover-text-grey <?php if($tabSelected == "home")echo "w3-green";?>"><i class="fa fa-home"></i> </span></a>
  <a href="./index.php?pageName=gpssearch"><span class="w3-bar-item w3-button w3-hide-large w3-xxlarge w3-hover-text-grey <?php if($tabSelected == "gpssearch")echo "w3-green";?>"><i class="fa fa-map-marker"></i> </span></a>
  <a href="./index.php?pageName=linearlist"><span class="w3-bar-item w3-button w3-hide-large w3-xxlarge w3-hover-text-grey <?php if($tabSelected == "linearlist")echo "w3-green";?>"><i class="fa fa-search"></i> </span></a>
  <a href="./index.php?pageName=calendar"><span class="w3-bar-item w3-button w3-hide-large w3-xxlarge w3-hover-text-grey <?php if($tabSelected == "calendar")echo "w3-green";?>"><i class="fa fa-calendar"></i> </span></a>
  
  
  <img src="./favicon.jpg" style="width:50px; height:50px; object-fit:cover;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity">
  </div>
  <div class="w3-container w3-center">
   <h1>เว็บแอปพลิเคชันแนะนำกิจกรรมท่องเที่ยวเชิงวัฒนธรรมจังหวัดสมุทรปราการ</h1>
 </div>
</header>
<div class="w3-container w3-main">
 <?php 
 switch($tabSelected){
  case "home" : require("./homepage/index.php");break;
  case "linearlist" : require("./list/index.php");break;
  case "calendar" : require("./calendar/index.php");break; 
  case "article" : require("./article/index.php");break;
  case "gpssearch" : require("./gpsSearch/index.php");break;
}

?>
</div>
<div class="w3-footer">
  


</div>
</div>

<script>

</script>