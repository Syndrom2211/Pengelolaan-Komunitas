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
              <h3>Tambah Kategori</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
                <?php
                include "../include/koneksi.php";
                $sql = mysql_query("SELECT * FROM tbl_kategori_komunitas");
                $num = mysql_fetch_array($sql);
                ?>
              <form id="edit-profile" class="form-horizontal" method="POST" action="proses/p_k_komunitas.php">
                <br/>
                <fieldset>

                  <div class="control-group">
                    <label class="control-label" for="jeniskategori">Jenis Kategori</label>
                    <div class="controls">
                      <input type="text" name="jeniskategori" class="span6" id="jeniskategori" placeholder="Masukan jenis kategori...">
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