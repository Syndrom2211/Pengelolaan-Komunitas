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
              <h3>Pengaturan Admin</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_admin   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_admin WHERE id_admin=".$id_admin."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_admin.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td>
                        <input type="hidden" class="form-control" name="id_admin" value="<?php echo $id_admin; ?>" />
                        <input type="text" class="form-control" name="username" value="<?php echo $num['username']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td>Password</td>
                      <td>:</td>
                      <td>
                        <input type="hidden" class="form-control" name="password_lama" value="<?php echo $num['password']; ?>" />
                        <input type="text" class="form-control" name="password" placeholder="Masukan password baru..." />
                      </td>
                  </tr>
                  <tr>
                      <td><input class="btn btn-info" type="submit" value="Ubah" /></td>
                  </tr>
                  </table>
              </form>
              <?php
              }else{
              ?>
              <div class="tab-pane" id="formcontrols">
                <?php
                $sql = mysql_query("SELECT * FROM tbl_admin");
                $num = mysql_fetch_array($sql);
                ?>
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" id="username" value="<?php echo $num['username']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="password">Password</label>
                    <div class="controls">
                      <input class="span6 disabled" id="password" type="password" value="<?php echo $num['password']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
                </fieldset>
                </form>
                <div class="form-actions">
                  <a href="v_setting.php?edit=<?php echo $num['id_admin']; ?>"><button class="btn btn-primary">Edit</button></a>&nbsp;
                </div> <!-- /form-actions -->

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
