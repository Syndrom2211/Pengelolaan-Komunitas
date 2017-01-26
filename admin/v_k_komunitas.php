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
              <h3>List Kategori Komunitas</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_kategori_k   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_kategori_komunitas WHERE id_kategori_k=".$id_kategori_k."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_kategori_komunitas.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Kategori Komunitas</td>
                      <td>:</td>
                      <td>
                          <input type="hidden" class="form-control" name="id_kategori_k" value="<?php echo $id_kategori_k; ?>" />
                          <input type="text" class="form-control" name="jenis_kategori" value="<?php echo $num['jenis_kategori']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td><input class="btn btn-info" type="submit" value="Ubah" /></td>
                  </tr>
                  </table>
              </form>
              <?php
              }else{
              $sql = mysql_query("SELECT * FROM tbl_kategori_komunitas");
              ?>
              <a href="vt_k_komunitas.php"><button style="margin-bottom:5px;" class="btn btn-info">Tambah</button></a>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Jenis Kategori </th>
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
                    <td><?php echo $hasil['jenis_kategori']; ?></td>
                    <td class="td-actions">
						<a href="v_k_komunitas.php?edit=<?php echo $hasil['id_kategori_k']; ?>"><button class="btn btn-success">Edit</button></a>&nbsp;
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusKategoriKomunitas('".$hasil["id_kategori_k"]."','".$hasil["jenis_kategori"]."');\" value='Hapus'><button class='btn btn-danger'>Hapus</button></a>"; ?>
					</td>
                  </tr>
				<?php
                  $i++;
                  }
                  if(isset($_GET['id_kategori_k']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_kategori_komunitas WHERE id_kategori_k=".$_GET['id_kategori_k']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_k_komunitas.php">';
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
