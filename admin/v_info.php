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
              <h3>Pengaturan Informasi Website</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_info   = $_GET['edit'];
                  $sql       = mysql_query("SELECT * FROM tbl_info WHERE id_info=".$id_info."");
                  $numtwo    = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form id="edit-profile" class="form-horizontal" method="POST" action="proses/pe_info.php">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="no_hp">No Handphone</label>
                    <div class="controls">
					  <input type="hidden" class="span6" name="id_info" value="<?php echo $numtwo['id_info']; ?>" >
                      <input type="text" class="span6" name="no_hp" value="<?php echo $numtwo['no_hp']; ?>" >
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                      <input type="text" class="span6" name="email" value="<?php echo $numtwo['email']; ?>" >
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <div class="controls">
                      <textarea name="alamat" cols="5" rows="5"><?php echo $numtwo['alamat']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="alamat">Maps</label>
                    <div class="controls">
                      <textarea name="maps" cols="5" rows="5"><?php echo $numtwo['maps']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="link_facebook">Link Facebook</label>
                    <div class="controls">
                      <input type="text" class="span6" name="link_facebook" value="<?php echo $numtwo['facebook']; ?>">
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="link_twitter">Link Twitter</label>
                    <div class="controls">
                      <input type="text" class="span6" name="link_twitter" value="<?php echo $numtwo['twitter']; ?>">
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="alamat">Tentang</label>
                    <div class="controls">
                      <textarea name="tentang" cols="5" rows="5"><?php echo $numtwo['tentang']; ?></textarea>
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
              $sql = mysql_query("SELECT * FROM tbl_info");
              $num = mysql_fetch_array($sql);
              ?>
                <fieldset class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label" for="no_hp">No Handphone</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" id="no_hp" value="<?php echo $num['no_hp']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" id="email" value="<?php echo $num['email']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <div class="controls">
                      <textarea cols="5" rows="5" disabled><?php echo $num['alamat']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="alamat">Maps</label>
                    <div class="controls">
                      <textarea cols="5" rows="5" disabled><?php echo $num['maps']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="link_facebook">Link Facebook</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" id="link_facebook" value="<?php echo $num['facebook']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="link_twitter">Link Twitter</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" id="link_twitter" value="<?php echo $num['twitter']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="alamat">Tentang</label>
                    <div class="controls">
                      <textarea cols="5" rows="5" disabled><?php echo $num['tentang']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
					<div class="form-actions">
						<a href="v_info.php?edit=<?php echo $num['id_info']; ?>"><button type="submit" class="btn btn-success">Edit</button></a>
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
