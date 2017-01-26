<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['no_ktp'])){
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
              <i class="icon-copy"></i>
              <h3>Feedback</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
			<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Catatan :</strong><br/>Harap di isi dengan jujur karena tidak bisa diubah lagi feedback nya, dan jika ingin ada perubahan harap menghubungi pihak pusat nya.
              </div>
              <div class="tab-pane" id="formcontrols">
			  <form action="proses/p_feedback.php" method="POST">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="username">Nama Lengkap</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" name="nama_lengkap" id="nama_lengkap" value="<?php echo $_SESSION['nama_lengkap']; ?>" readonly>
					  <input type="hidden" class="span6 disabled" name="no_ktp" id="nama_lengkap" value="<?php echo $_SESSION['no_ktp']; ?>">
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="password">Komunitas</label>
                    <div class="controls">
                      <input class="span6 disabled" name="nama_komunitas" id="password" value="<?php echo $_SESSION['nama']; ?>" type="text" readonly>
					  <input class="span6 disabled" name="id_komunitas" id="password" value="<?php echo $_SESSION['id_komunitas']; ?>" type="hidden">
					  <input type="hidden" class="form-control" name="tgl_daftars" value="<?php $tgls = date('Y-m-d'); echo $tgls; ?>" />
					  <input type="hidden" class="form-control" name="waktu_daftars" />
						<div id="clockbox"></div>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
				  
				  <div class="control-group">
                    <label class="control-label" for="password">Isi Feedback</label>
                    <div class="controls">
					  <?php
					  include "../include/koneksi.php";
					  $sesi = $_SESSION['no_ktp'];
					  $sql = mysql_query("SELECT * FROM tbl_feedback WHERE no_ktp = $sesi");
					  $hasil = mysql_fetch_array($sql);
					  ?>
						<textarea name="catatan" maxlength="120"><?php echo $hasil['catatan']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
                </fieldset>
                
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Isi Feedback</button></a>&nbsp;
                </div> <!-- /form-actions -->
				</form>
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
    header("location:../relog.php");
}
?>
