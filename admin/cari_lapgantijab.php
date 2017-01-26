<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username'])){
	error_reporting(0);
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
			<form style="margin:0px;" method="POST" action="cari_lapgantijab.php">
				<div class="widget-header">
				  <i class="icon-file"></i>
				  <h3></a> Laporan Penggantian Jabatan</h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama_lengkap">Nama Anggota</option>
						<option value="username">Username</option>
						<option value="tanggal">Tanggal</option>
						<option value="status_akhir">Status Akhir</option>
						<option value="periode_awal">Periode Awal</option>
						<option value="periode_akhir">Periode Akhir</option>
						<option value="keterangan">Keterangan</option>
					</select>
					<input type="submit" style="margin:6px 15px 6px 0px;" class="btn btn-primary" value="Cari Data">
				  </div>
				  
				  
				</div> <!-- /widget-header -->
			</form>

            <div class="widget-content">
			  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Catatan :</strong><br/>Ketika masa aktif untuk penanggung jawab dalam komunitas habis maka akan menghasilkan suatu laporan penggantian jabatan.
              </div>
			  <form action="report_gantijab.php" method="POST" target="_blank">
				<?php
				$simpankey = $_POST["datacari"];
				?>
				<input type="hidden" value="<?php echo $simpankey; ?>" name="lempar" />
				<button style="float:left;" class="btn btn-primary" style="margin:6px 15px 6px 0px;" type="submit">Print Data</button>
			  </form>
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="lap_gantijab.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Anggota </a></li>
												<li><a href="lap_gantijab.php?by=username&method=asc"><i class="i"></i> Username Admin </a></li>
												<li><a href="lap_gantijab.php?by=tanggal&method=asc"><i class="i"></i> Waktu </a></li>
												<li><a href="lap_gantijab.php?by=tanggal&method=asc"><i class="i"></i> Tanggal </a></li>
												<li><a href="lap_gantijab.php?by=periode_awal&method=asc"><i class="i"></i> Periode Awal </a></li>
												<li><a href="lap_gantijab.php?by=perode_akhir&method=asc"><i class="i"></i> Periode Akhir </a></li>
												<li><a href="lap_gantijab.php?by=keterangan&method=asc"><i class="i"></i> Keterangan </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
											  <!-- DESCENDING -->
											  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-down
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="lap_gantijab.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Anggota </a></li>
												<li><a href="lap_gantijab.php?by=username&method=desc"><i class="i"></i> Username Admin </a></li>
												<li><a href="lap_gantijab.php?by=username&method=desc"><i class="i"></i> Waktu </a></li>
												<li><a href="lap_gantijab.php?by=tanggal&method=desc"><i class="i"></i> Tanggal </a></li>
												<li><a href="lap_gantijab.php?by=periode_awal&method=desc"><i class="i"></i> Periode Awal </a></li>
												<li><a href="lap_gantijab.php?by=perode_akhir&method=desc"><i class="i"></i> Periode Akhir </a></li>
												<li><a href="lap_gantijab.php?by=keterangan&method=desc"><i class="i"></i> Keterangan </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nama Anggota </th>
					<th> Username Admin </th>
                    <th> Waktu </th>
                    <th> Tanggal </th>
                    <th> Status Akhir </th>
					<th> Periode Awal </th>
					<th> Periode Akhir </th>
					<th> Keterangan </th>
                    <!--<th class="td-actions"> Aksi </th>-->
                  </tr>
                </thead>
                <?php
				include "../include/koneksi.php";
                $i = 1;
                $status = "ASC";
				$data = $_POST["datacari"];
				
				// Ascending
				if($_GET['by']=="nama_lengkap" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "nama_lengkap";
				}else if($_GET['by']=="username" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_admin.username";
				}else if($_GET['by']=="waktu" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "waktu";
				}else if($_GET['by']=="tanggal" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tanggal";
				}else if($_GET['by']=="periode_awal" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_history_status.periode_awal";
				}else if($_GET['by']=="periode_akhir" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_history_status.periode_akhir";
				}else if($_GET['by']=="keterangan" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "keterangan";
				}
				
				// Descending
				if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "nama_lengkap";
				}else if($_GET['by']=="username" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_admin.username";
				}else if($_GET['by']=="waktu" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "waktu";
				}else if($_GET['by']=="tanggal" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tanggal";
				}else if($_GET['by']=="periode_awal" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_history_status.periode_awal";
				}else if($_GET['by']=="periode_akhir" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_history_status.periode_akhir";
				}else if($_GET['by']=="keterangan" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "keterangan";
				}else{
					$statusbaru = $status;
					$orderBy = "nama_lengkap";
				}
				
				if($_POST['tipecari'] == "nama_lengkap"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND nama_lengkap LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "username"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND tbl_admin.username LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "tanggal"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND tanggal LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "status_akhir"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND status_akhir LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "periode_awal"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND periode_awal LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "periode_akhir"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND periode_akhir LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "keterangan"){
					$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND keterangan LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}
				
				while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['nama_lengkap']; ?></td>
					<td><?php echo $hasil['username']; ?></td>
					<td><?php echo $hasil['waktu']; ?></td>
					<td><?php echo $hasil['tanggal']; ?></td>
					<td><?php echo $hasil['status_akhir']; ?></td>
					<td><?php echo $hasil['periode_awal']; ?></td>
					<td><?php echo $hasil['periode_akhir']; ?></td>
					<td><?php echo $hasil['keterangan']; ?></td>
                    <!--<td class="td-actions"><a href="lap_gantijab.php?hapus=<?php echo $hasil['waktu']; ?>"><button class="btn btn-danger">Hapus</button></a></td> -->
                  </tr>
                </tbody>
                <?php
                $i++;
                }
				/*
				if(isset($_GET['hapus']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_history_status WHERE waktu=".$_GET['hapus']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=lap_gantijab.php">';
                      }
                }
				*/
                ?>
              </table>
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
