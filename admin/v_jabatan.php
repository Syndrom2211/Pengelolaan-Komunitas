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
              <h3>Jabatan Anggota</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_jabatan   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_jabatan WHERE id_jabatan=".$id_jabatan."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_jabatan.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Jabatan</td>
                      <td>:</td>
                      <td>
                          <input type="hidden" class="form-control" name="id_jabatan" value="<?php echo $id_jabatan; ?>" />
                          <input type="text" class="form-control" name="jabatan" value="<?php echo $num['jabatan']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td><input class="btn btn-info" type="submit" value="Ubah" /></td>
                  </tr>
                  </table>
              </form>
              <?php
              }else{
              $sql = mysql_query("SELECT * FROM tbl_jabatan");
              ?>
              <a href="vt_jabatan.php"><button style="margin-bottom:5px;" class="btn btn-info">Tambah</button></a>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Jabatan </th>
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
                    <td><?php echo $hasil['jabatan']; ?></td>
                    <td class="td-actions">
						<a href="v_jabatan.php?edit=<?php echo $hasil['id_jabatan']; ?>"><button class="btn btn-success">Edit</button></a>&nbsp;
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusJabatan('".$hasil["id_jabatan"]."','".$hasil["jabatan"]."');\" value='Hapus'><button class='btn btn-danger'>Hapus</button></a>"; ?>
					</td>
                  </tr>
				<?php
                  $i++;
                  }
                  if(isset($_GET['id_jabatan']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_jabatan WHERE id_jabatan=".$_GET['id_jabatan']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_jabatan.php">';
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
