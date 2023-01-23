<?php
if(!isset($FROM_INDEX)){
  header("Location:./../index.php");
}

$result1 = $conn->query("SELECT * FROM table_event WHERE DATE(ev_date_end) >= NOW() ORDER BY ev_date_beg ASC LIMIT 3");
$result2 = $conn->query("SELECT * FROM table_event  INNER JOIN table_place ON pl_id = ev_ref_place_id WHERE DATE(ev_date_beg) < NOW() ORDER BY ev_date_end DESC LIMIT 3");
?>
<style type="text/css">
  #dom_main_ul li{
    padding-top : 16px;
  }


</style>
<div class="w3-container">
  <ul class="w3-ul" id="dom_main_ul">
    <?php if($result1 && $result1->num_rows > 0){?>
      <li>
        <h3> Upcoming event </h3>
      </li>
      <li>
        <div class="w3-row-padding">
          <?php
          while($rows = $result1->fetch_assoc()){
            $t_id = $rows["ev_id"];
            $t_name = $rows["ev_name"];
            $t_img = explode(",",$rows["ev_img_list"])[0];
            $t_sdate = $rows["ev_date_beg"];
            $t_edate = $rows["ev_date_end"];
            ?>
            <div class="w3-col s12 m4 l3 w3-center" style="max-width: 400px;">
              <div class="w3-card-4">
                <img src="<?="./images/".$t_img;?>" width="400" class="w3-image w3-responsive">
                <div class="w3-container">
                  <ul class="w3-ul">
                    <li><b><?=$t_name;?></b></li>
                    <li>
                      <a href="./index.php?pageName=linearlist&date=<?=$t_sdate;?>">
                      <span class="fa fa-calendar"></span>
                      <?=$t_sdate;?></a> <br>
                      <b>ถึง</b><br> 
                      <a href="./index.php?pageName=linearlist&date=<?=$t_edate;?>">
                      <span class="fa fa-calendar"></span>
                      <?=$t_edate;?></a>
                    </li>
                    <li><a href="./index.php?pageName=article&articleid=<?=$t_id;?>" class="w3-button"> Read more</a></li>

                  </ul>

                </div>

              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </li>
    <?php }?>
    <?php if($result2 && $result2->num_rows > 0){?>
      <li>
        <h3> Past events </h3>
      </li>
      <li>
        <div class="w3-row-padding">
          <?php
          while($rows = $result2->fetch_assoc()){
            $t_id = $rows["ev_id"];
            $t_name = $rows["ev_name"];
            $t_img = explode(",",$rows["ev_img_list"])[0];
            $t_sdate = $rows["ev_date_beg"];
            $t_edate = $rows["ev_date_end"];
            ?>
            <div class="w3-col s12 m4 l3 w3-center" style="max-width: 400px;">
              <div class="w3-card-4">
                <img src="<?="./images/".$t_img;?>" width="400" class="w3-image w3-responsive">
                <div class="w3-container">
                  <ul class="w3-ul">
                    <li><b><?=$t_name;?></b></li>
                    <li>
                      <a href="./index.php?pageName=linearlist&date=<?=$t_sdate;?>">
                      <span class="fa fa-calendar"></span>
                      <?=$t_sdate;?></a> <br>
                      <b>ถึง</b><br> 
                      <a href="./index.php?pageName=linearlist&date=<?=$t_edate;?>">
                      <span class="fa fa-calendar"></span>
                      <?=$t_edate;?></a>
                    </li>
                    <li><a href="./index.php?pageName=article&articleid=<?=$t_id;?>" class="w3-button"> Read more</a></li>

                  </ul>

                </div>

              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </li>
    <?php }?>
  </ul>

</div>
