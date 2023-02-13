<?php
if(!isset($FROM_INDEX)){
  header("Location:./../index.php");
}
$page_number = 0;
$show_count = 3;
if(isset($_GET["page_number"])){
  $page_number = $_GET["page_number"];
}
$clen = $conn->query("SELECT Count(*) As CountRes FROM table_event INNER JOIN table_place ON pl_id = ev_ref_place_id WHERE DATE(ev_date_beg) >= NOW()")->fetch_all(MYSQLI_ASSOC)[0]["CountRes"];
$clen_padded = ceil($clen / $show_count);
$page_num_prev = max($page_number - 1,0);
$page_num_next = min($page_number + 1,$clen_padded - 1);
$stmt = $conn->prepare("SELECT * FROM table_event  INNER JOIN table_place ON pl_id = ev_ref_place_id INNER JOIN table_local ON lc_id = pl_amphoe WHERE DATE(ev_date_beg) >= NOW() OR NOW() BETWEEN DATE(ev_date_beg) AND DATE(ev_date_end) ORDER BY ev_date_beg ASC LIMIT ?,?");
$real_page_number = $page_number * $show_count;
$stmt->bind_param("ii",$real_page_number,$show_count);
$stmt->execute();
$result1 = $stmt->get_result();
$google_map_ext_url = "https://www.google.com/maps/place/";
?>
<style type="text/css">

  img{

  }


</style>
<div class="">
  <div class="w3-container">
    <h2>ประกาศกิจกรรม</h2>
  </div>
  <ul class="w3-ul" id="dom_main_ul">
    <?php if($result1 && $result1->num_rows > 0){?>
      <li class="w3-white">
        <h3> กิจกรรมที่กำลังจะเริ่ม </h3>
      </li>
      <li>
        <div class="w3-row-padding" >
          <?php
          while($rows = $result1->fetch_assoc()){
            $t_id = $rows["ev_id"];
            $t_name = $rows["ev_name"];
            $t_img = explode(",",$rows["ev_img_list"])[0];
            $t_sdate = $rows["ev_date_beg"];
            $t_edate = $rows["ev_date_end"];
            $pl_geo_lat = $rows["pl_geo_lat"];
            $pl_geo_lon = $rows["pl_geo_lon"];
            ?>
            <div class="w3-third w3-content w3-margin-bottom w3-animate-left" >
              <div class="w3-row-padding">
                <img src="<?=$t_img;?>" style="width:100%; height:300px; object-fit: cover;">
                <div class="w3-container w3-white">
                  <div class="w3-row-padding">
                    <div class="w3-full w3-padding" ><h3 style="text-overflow : ellipsis ; overflow: hidden; white-space: nowrap;"><?=$t_name;?></h3></div>
                    <div class="w3-full w3-padding"><?=$t_sdate;?> | <?=$t_edate?></div>
                    <div class="w3-full w3-padding">
                      <a href="./index.php?pageName=article&articleid=<?=$t_id;?>" class="w3-input w3-button w3-green w3-round">
                        <i class="fa fa-info-circle"></i>
                        รายละเอียด
                      </a>
                    </div>
                    <div class="w3-full w3-padding">
                      <a href="<?=$google_map_ext_url.$pl_geo_lat.",".$pl_geo_lon?>" class="w3-input w3-button w3-green w3-round" target="new">
                        <i class="fa fa-map-marker"></i>
                        เปิดในกูเกิ้ลแมพ
                      </a>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
        
      </li>
    <?php }?>
    <li>
      <div class="w3-bar w3-white w3-center">
        <a href="./index.php?page_number=<?=$page_num_prev;?>" class="w3-button"> &lt; </a>
        <?php
        for ($i = 0 ; $i < $clen_padded ; $i++)
        {
         ?>
         <a href="./index.php?page_number=<?=$i;?>" class="w3-button <?php if($i == $page_number)echo "w3-green";?>"> <?=$i + 1;?></a>

         <?php
       }
       ?>
       <a href="./index.php?page_number=<?=$page_num_next;?>" class="w3-button"> &gt; </a>
     </div>
   </li>
 </ul>
</div>
<?php
$stmt->close();
$result1->close();
?>