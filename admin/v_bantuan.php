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
              <h3>Pengaturan Bantuan Registrasi</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_bantuan   = $_GET['edit'];
                  $sql       	= mysql_query("SELECT * FROM tbl_bantuan_registrasi WHERE id_bantuan=".$id_bantuan."");
                  $numtwo    	= mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form id="edit-profile" class="form-horizontal" method="POST" action="proses/pe_bantuan.php">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="penjelasan">Penjelasan</label>
                    <div class="controls">
					  <input type="hidden" name="id_bantuan" value="<?php echo $numtwo['id_bantuan']; ?>" />
                      <textarea name="penjelasan" cols="5" rows="5"><?php echo $numtwo['penjelasan']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
                </fieldset>
				<div class="form-actions">
                  <input type="submit" class="btn btn-info" value="Ubah" />
                </div> <!-- /form-actions -->
				</form>
              <?php
              }else{
              $sql = mysql_query("SELECT * FROM tbl_bantuan_registrasi");
              $num = mysql_fetch_array($sql);
              ?>
                <fieldset class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label" for="penjelasan">Penjelasan</label>
                    <div class="controls">
                      <textarea cols="5" rows="5" disabled><?php echo $num['penjelasan']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
				  <div class="form-actions">
					<a href="v_bantuan.php?edit=<?php echo $num['id_bantuan']; ?>"><button type="submit" class="btn btn-success">Edit</button></a>
				  </div> <!-- /form-actions -->
                </fieldset>                
            </div>
			<?php
            }
            ?>
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
