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
              <h3>Biaya Rutinan Komunitas</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_rutinan   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_biaya_rutinan_komunitas WHERE id_rutinan=".$id_rutinan."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_biaya_rutinan.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Jenis Biaya</td>
                      <td>:</td>
                      <td>
                          <input type="hidden" class="form-control" name="id_rutinan" value="<?php echo $id_rutinan; ?>" />
                          <input type="text" class="form-control" name="jenis_biaya" value="<?php echo $num['jenis_biaya']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td><input class="btn btn-info" type="submit" value="Ubah" /></td>
                  </tr>
                  </table>
              </form>
              <?php
              }else{
              $sql = mysql_query("SELECT * FROM tbl_biaya_rutinan_komunitas");
              ?>
              <a href="vt_biaya_rutinan.php"><button style="margin-bottom:5px;" class="btn btn-info">Tambah</button></a>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Jenis Biaya </th>
                    <th class="td-actions"> Aksi </th>
                  </tr>
                </thead>
                <?php
                $i = 1;
                while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['jenis_biaya']; ?></td>
                    <td class="td-actions">
						<a href="v_biaya_rutinan.php?edit=<?php echo $hasil['id_rutinan']; ?>"><button class="btn btn-success">Edit</button></a>&nbsp;
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusBiayaRutinan('".$hasil["id_rutinan"]."','".$hasil["jenis_biaya"]."');\" value='Hapus'><button class='btn btn-danger'>Hapus</button></a>"; ?>
					</td>
                  </tr>
				<?php
                  $i++;
                  }
                  if(isset($_GET['id_rutinan']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_biaya_rutinan_komunitas WHERE id_rutinan=".$_GET['id_rutinan']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_biaya_rutinan.php">';
                      }
                  }
                  ?>
                </tbody>
              </table>
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
