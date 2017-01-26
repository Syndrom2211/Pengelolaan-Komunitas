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
              <h3>List Jenjang Komunitas</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_jenjang   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_jenjang WHERE id_jenjang=".$id_jenjang."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_jenjang.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Jenjang Komunitas</td>
                      <td>:</td>
                      <td>
                          <input type="hidden" class="form-control" name="id_jenjang" value="<?php echo $id_jenjang; ?>" />
                          <input type="text" class="form-control" name="jenjang" value="<?php echo $num['jenjang']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td><input class="btn btn-info" type="submit" value="Ubah" /></td>
                  </tr>
                  </table>
              </form>
              <?php
              }else{
              $sql = mysql_query("SELECT * FROM tbl_jenjang");
              ?>
              <a href="vt_jenjang.php"><button style="margin-bottom:5px;" class="btn btn-info">Tambah</button></a>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Jenjang Komunitas </th>
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
                    <td><?php echo $hasil['jenjang']; ?></td>
                    <td class="td-actions">
						<a href="v_jenjang.php?edit=<?php echo $hasil['id_jenjang']; ?>"><button class="btn btn-success">Edit</button></a>&nbsp;
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusJenjang('".$hasil["id_jenjang"]."','".$hasil["jenjang"]."');\" value='Hapus'><button class='btn btn-danger'>Hapus</button></a>"; ?>
					</td>
                  </tr>
				<?php
                  $i++;
                  }
                  if(isset($_GET['id_jenjang']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_jenjang WHERE id_jenjang=".$_GET['id_jenjang']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_jenjang.php">';
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
