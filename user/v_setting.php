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
              <i class="icon-cog"></i>
              <h3>Pengaturan Anggota</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $no_ktp   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_anggota WHERE no_ktp=".$no_ktp."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form enctype="multipart/form-data" action="proses/pe_anggota.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
				  <tr>
                      <td>Foto</td>
                      <td>:</td>
                      <td>
                        <input type="hidden" name="foto_lama" value="<?php echo $num['foto']; ?>"/>
                        <a href="<?php echo "../images/foto_anggota/".$num['foto']; ?>" target="_blank"><img src="<?php echo "../images/foto_anggota/".$num['foto']; ?>" width="120px" height="120px" /></a>
                      </td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td><i>(klik gambar untuk memperbesar)</i></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td>Ganti Foto :</td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td>
					  <input type="file" name="file" id="file" />
					  <br/>
						<i>Ukuran Besar Foto 113x170 pixel</i>
						<br/>
						<i>Ukuran Size Kurang dari 1 MB</i></td>
                  </tr>
                  <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td>
					    <input type="hidden" class="form-control" name="nama_lengkap" value="<?php echo $_SESSION['nama_lengkap']; ?>" />
                        <input type="hidden" class="form-control" name="no_ktp" value="<?php echo $no_ktp; ?>" />
                        <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>" readonly />
                      </td>
                  </tr>
                  <tr>
                      <td>Password</td>
                      <td>:</td>
                      <td>
                        <input type="hidden" class="form-control" name="password_lama" value="<?php echo $num['password']; ?>" />
                        <input type="password" class="form-control" name="password" placeholder="Masukan password baru..." />
                      </td>
                  </tr>
				  <tr>
                      <td>Konfimasi Password</td>
                      <td>:</td>
                      <td>
                        <input type="password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi password baru..." />
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
				$session = $_SESSION['no_ktp'];
                $sql = mysql_query("SELECT * FROM tbl_anggota WHERE no_ktp = $session");
                $num = mysql_fetch_array($sql);
                ?>
                <fieldset>
				 <div class="control-group">
                    <label class="control-label" for="username">Foto</label>
                    <div class="controls">
                       <a href="<?php echo "../images/foto_anggota/".$num['foto']; ?>" target="_blank"><img src="<?php echo "../images/foto_anggota/".$num['foto']; ?>" width="120px" height="120px" /></a>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
				  
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
                  <a href="v_setting.php?edit=<?php echo $num['no_ktp']; ?>"><button class="btn btn-primary">Edit</button></a>&nbsp;
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
    header("location:../relog.php");
}
?>
