<!DOCTYPE html>
<?php
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
        <div class="widget ">

            <div class="widget-header">
              <i class="icon-cog"></i>
              <h3>History Penanggung Jawab</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              $sql = mysql_query("SELECT * FROM tbl_history_pj");

              ?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> PJ Sebelumnya </th>
                    <th> Periode PJ Sebelumnya </th>
                    <th> PJ Setelahnya </th>
                    <th> Periode PJ Setelahnya </th>
                    <th> Keterangan </th>
                  </tr>
                </thead>
                <?php
                $i = 1;
                while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['pj_lama']; ?></td>
                    <td><?php echo $hasil['pj_baru']; ?></td>
                    <td><?php echo $hasil['periode_kelola_lama']; ?></td>
                    <td><?php echo $hasil['periode_kelola_baru']; ?></td>
                    <td><?php echo $hasil['keterangan']; ?></td>
                  </tr>
                </tbody>
                <?php
                $i++;
                }
                ?>
              </table>
            </div>
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
<!-- /main -->
<?php include "include/footer.php"; ?>
</body>
</html>
<?php
}else{
    header("location:login.php");
}
?>
