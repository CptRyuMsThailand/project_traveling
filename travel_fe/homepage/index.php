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
$stmt = $conn->prepare("SELECT * FROM table_event  INNER JOIN table_place ON pl_id = ev_ref_place_id WHERE DATE(ev_date_beg) >= NOW() ORDER BY ev_date_beg ASC LIMIT ?,?");
$real_page_number = $page_number * $show_count;
$stmt->bind_param("ii",$real_page_number,$show_count);
$stmt->execute();
$result1 = $stmt->get_result();
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
            ?>
            <div class="w3-third w3-content w3-margin-bottom w3-animate-left" >
              <img src="<?="./images/".$t_img;?>" style="width:100%; height:300px; object-fit: cover;">
              <div class="w3-container w3-white">
                <p ><?=$t_name;?></p>
                <p><?=$t_sdate;?> | <?=$t_edate?></p>
                <a href="./index.php?pageName=article&articleid=<?=$t_id;?>" class="w3-button w3-green">
                  รายละเอียด
                </a>
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