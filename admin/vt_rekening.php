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
              <i class="icon-asterisk"></i>
              <h3>Tambah Rekening</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
                <?php
                include "../include/koneksi.php";
                $sql = mysql_query("SELECT * FROM tbl_data_rekening");
                $num = mysql_fetch_array($sql);
                ?>
              <form id="edit-profile" class="form-horizontal" method="POST" action="proses/p_rekening.php">
                <br/>
                <fieldset>
				
				  <div class="control-group">
                    <label class="control-label" for="jenjang">Nama Cabang</label>
                    <div class="controls">
                      <input type="text" name="nama_cabang" class="span6" id="nama_cabang" placeholder="Masukan nama cabang...">
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="jenjang">No Rekening</label>
                    <div class="controls">
                      <input type="text" name="no_rekening" class="span6" id="no_rekening" placeholder="Masukan no rekening...">
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
				  
				  <div class="control-group">
                    <label class="control-label" for="jenjang">Atas Nama</label>
                    <div class="controls">
                      <input type="text" name="atas_nama" class="span6" id="atas_nama" placeholder="Atas Nama...">
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
                </fieldset>
                <br/>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Tambah</button>

                </div> <!-- /form-actions -->
              </form>
            </div>
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
