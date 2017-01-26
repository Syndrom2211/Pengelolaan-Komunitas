<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['no_ktp'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "include/header.php"; ?>
      <?php include "include/navigation.php"; ?>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Total Keseluruhan Data </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <h6 class="bigstats">Berikut ini adalah total dari keseluruhan data anggota dari komunitas yang anda ikuti termasuk penanggung jawabnya : </h6>
                  <div id="big_stats" class="cf">
                    <?php
                    include "../include/koneksi.php";
					$id_komun = $_SESSION['id_komunitas'];
                    $sql3 = mysql_query("SELECT * FROM tbl_anggota INNER JOIN tbl_detail_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp WHERE tbl_detail_anggota.id_komunitas = '$id_komun'");
                    $num3 = mysql_num_rows($sql3);
                    ?>

                    <div class="stat"> <i class="icon-user"></i> <span class="value"><?php echo $num3; ?></span> </div>
                    <!-- .stat -->

                    <!-- .stat -->
                  </div>
                </div>
                <!-- /widget-content -->

              </div>
            </div>
          </div>
          <!-- /widget -->


          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="span6">

          </div>
          <!-- /widget -->
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<?php include "include/footer.php"; ?>
</body>
</html>
<?php
}else{
    header("location:../relog.php");
}
?>