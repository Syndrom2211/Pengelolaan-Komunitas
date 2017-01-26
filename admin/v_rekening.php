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
              <h3>Rekening Bank</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">
              <?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_rekening   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_data_rekening WHERE id_rekening=".$id_rekening."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_rekening.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
				  <tr>
                      <td>Nama Cabang</td>
                      <td>:</td>
                      <td>
                          <input type="hidden" class="form-control" name="id_rekening" value="<?php echo $id_rekening; ?>" />
                          <input type="text" class="form-control" name="nama_cabang" value="<?php echo $num['nama_cabang']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td>No Rekening</td>
                      <td>:</td>
                      <td>
                          <input type="text" class="form-control" name="no_rekening" value="<?php echo $num['no_rekening']; ?>" />
                      </td>
                  </tr>
				  <tr>
                      <td>Atas Nama</td>
                      <td>:</td>
                      <td>
                          <input type="text" class="form-control" name="atas_nama" value="<?php echo $num['atas_nama']; ?>" />
                      </td>
                  </tr>
                  <tr>
                      <td><input class="btn btn-info" type="submit" value="Ubah" /></td>
                  </tr>
                  </table>
              </form>
              <?php
              }else{
              $sql = mysql_query("SELECT * FROM tbl_data_rekening");
              ?>
              <a href="vt_rekening.php"><button style="margin-bottom:5px;" class="btn btn-info">Tambah</button></a>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
					<th> Nama Cabang </th>
                    <th> No Rekening </th>
					<th> Atas Nama </th>
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
					<td><?php echo $hasil['nama_cabang']; ?></td>
                    <td><?php echo $hasil['no_rekening']; ?></td>
					<td><?php echo $hasil['atas_nama']; ?></td>
                    <td class="td-actions">
						<a href="v_rekening.php?edit=<?php echo $hasil['id_rekening']; ?>"><button class="btn btn-success">Edit</button></a>&nbsp;
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusRekening('".$hasil["id_rekening"]."','".$hasil["atas_nama"]."');\" value='Hapus'><button class='btn btn-danger'>Hapus</button></a>"; ?>
					</td>
                  </tr>
				<?php
                  $i++;
                  }
                  if(isset($_GET['id_rekening']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_data_rekening WHERE id_rekening=".$_GET['id_rekening']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_rekening.php">';
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
