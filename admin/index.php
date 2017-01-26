<!DOCTYPE html>
<?php
error_reporting(0);
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['id_admin'])){
?>
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
                  <h6 class="bigstats">Berikut ini adalah total dari keseluruhan data komunitas, penanggung jawab, & anggota yang ada di database server carkom : </h6>
                  <div id="big_stats" class="cf">
                    <?php
                    include "../include/koneksi.php";
                    $sql = mysql_query("SELECT * FROM tbl_komunitas");
					$sql2 = mysql_query("SELECT * FROM tbl_anggota WHERE status_jabatan = 'Penanggung Jawab'");
                    $sql3 = mysql_query("SELECT * FROM tbl_anggota WHERE status_jabatan = 'Anggota Biasa'");
                    $num = mysql_num_rows($sql);
                    $num2 = mysql_num_rows($sql2);
                    $num3 = mysql_num_rows($sql3);
                    ?>
                    <div class="stat"> <i class="icon-group"></i> <span class="value"><?php echo $num; ?></span> </div>
                    <!-- .stat -->

                    <div class="stat"> <i class="icon-user-md"></i> <span class="value"><?php echo $num2; ?></span> </div>
                    <!-- .stat -->

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
    header("location:login.php");
}
?>
