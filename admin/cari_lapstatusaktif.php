<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['id_admin'])){
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
<form style="margin:0px;" method="POST" action="cari_lapstatusaktif.php">
				<div class="widget-header">
				  <i class="icon-file"></i>
				  <h3></a> Laporan Status Keaktifan</h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama">Nama Komunitas</option>
						<option value="nama_lengkap">Nama Anggota</option>
						<option value="tgl_daftar">Tanggal Daftar</option>
						<option value="status_jabatan">Status Jabatan</option>
					</select>
					<input type="submit" style="margin:6px 15px 6px 0px;" class="btn btn-primary" value="Cari Data">
				  </div>
				  
				  
				</div> <!-- /widget-header -->
			</form>

            <div class="widget-content">
			<?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $no_ktp   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_detail_anggota WHERE no_ktp=".$no_ktp."");
                  $num     = mysql_fetch_array($sql);
            ?>
			<style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_lap_statusaktif.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
				  <tr>
                      <td>Status Anggota</td>
                      <td>:</td>
                      <td>
						<select name="status_anggota">
							<option value="Aktif">Aktif</option>
							<option value="Tidak Aktif">Tidak Aktif</option>
						</select>
                          <input type="hidden" class="form-control" name="no_ktp" value="<?php echo $no_ktp; ?>" />								  
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
			  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Catatan :</strong>
				  <br/>Jika ada penambahan anggota/penanggung jawab yang telah didaftarkan maka akan menghasilkan laporan untuk anggota/penanggung jawab tersebut.
				  <br/>Status bisa diaktifkan setelah membayar transaksi pendaftaran
			  </div>
			  <form action="report_statusaktif.php" method="POST" target="_blank">
				<?php
				$simpankey = $_POST["datacari"];
				?>
				<input type="hidden" value="<?php echo $simpankey; ?>" name="lempar" />
				<button style="float:left;" class="btn btn-primary" style="margin:6px 15px 6px 0px;" type="submit">Print Data</button>
			  </form>
			  <!-- Ascending -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="lap_statusaktif.php?by=nama&method=asc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="lap_statusaktif.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Anggota </a></li>
												<li><a href="lap_statusaktif.php?by=tgl_daftar&method=asc"><i class="i"></i> Tanggal Daftar </a></li>
												<li><a href="lap_statusaktif.php?by=status_jabatan&method=asc"><i class="i"></i> Status Jabatan </a></li>
												<li><a href="lap_statusaktif.php?by=status_anggota&method=asc"><i class="i"></i> Status Anggota </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
											  <!-- Descending -->
											  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-down
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="lap_statusaktif.php?by=nama&method=desc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="lap_statusaktif.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Anggota </a></li>
												<li><a href="lap_statusaktif.php?by=tgl_daftar&method=desc"><i class="i"></i> Tanggal Daftar </a></li>
												<li><a href="lap_statusaktif.php?by=status_jabatan&method=desc"><i class="i"></i> Status Jabatan </a></li>
												<li><a href="lap_statusaktif.php?by=status_anggota&method=desc"><i class="i"></i> Status Anggota </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nama Komunitas </th>
                    <th> Nama Anggota</th>
					<th> Tgl Daftar</th>
					<th> Status Jabatan </th>
                    <th> Status Anggota </th>
                    <th class="td-actions"> Aksi </th>
                  </tr>
                </thead>
                <?php
                $i = 1;
				$status = "ASC";
				$data = $_POST["datacari"];
				
				// Ascending
				if($_GET['by']=="nama" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="nama_lengkap" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="tgl_daftar" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_detail_anggota.tgl_daftar";
				}else if($_GET['by']=="status_jabatan" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_anggota.status_jabatan";
				}else if($_GET['by']=="status_anggota" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_detail_anggota.status_anggota";
				}
				
				//Descending
				if($_GET['by']=="nama" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="tgl_daftar" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_detail_anggota.tgl_daftar";
				}else if($_GET['by']=="status_jabatan" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.status_jabatan";
				}else if($_GET['by']=="status_anggota" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_detail_anggota.status_anggota";
				}else{
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
				}
				
				if($_POST['tipecari'] == "nama"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp LEFT JOIN tbl_transaksi_pembayaran ON tbl_detail_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp WHERE tbl_komunitas.nama LIKE '%$data%' GROUP BY tbl_detail_anggota.no_ktp ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "nama_lengkap"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp LEFT JOIN tbl_transaksi_pembayaran ON tbl_detail_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp WHERE tbl_anggota.nama_lengkap LIKE '%$data%' GROUP BY tbl_detail_anggota.no_ktp ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "tgl_daftar"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp LEFT JOIN tbl_transaksi_pembayaran ON tbl_detail_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp WHERE tbl_detail_anggota.tgl_daftar LIKE '%$data%' GROUP BY tbl_detail_anggota.no_ktp ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "status_jabatan"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp LEFT JOIN tbl_transaksi_pembayaran ON tbl_detail_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp WHERE tbl_anggota.status_jabatan LIKE '%$data%' GROUP BY tbl_detail_anggota.no_ktp ORDER BY $orderBy $statusbaru");
				}
				
				while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['nama']; ?></td>
					<td><?php echo $hasil['nama_lengkap']; ?></td>
					<td><?php echo $hasil['tgl_daftar']; ?></td>
					<td><?php echo $hasil['status_jabatan']; ?></td>
					<td>
						<?php 
						if($hasil['status_anggota'] == 'Tidak Aktif'){
							echo "<font color='red'>".$hasil['status_anggota']."</font>"; 
						}else if($hasil['status_anggota'] == 'Aktif'){
							echo "<font color='lime'>".$hasil['status_anggota']."</font>"; 
						}else{
							echo "Bugs !";
						}?>
					</td>
                    <td class="td-actions">
						<?php
						if($hasil["status_bayar"]=="Belum Bayar"){
								// NULL
						}else{
						?>
						<a href="lap_statusaktif.php?edit=<?php echo $hasil['no_ktp']; ?>"><button class="btn btn-success"><i class="icon-large icon-pencil
"></i> Edit</button></a>
						<?php
						}
						?>
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusStatus('".$hasil["no_ktp"]."','".$hasil["nama_lengkap"]."');\" value='Hapus'><button class='btn btn-danger'><i class='icon-large icon-trash
'></i> Hapus</button></a>"; ?>
					</td>
                  </tr>
                </tbody>
                <?php
				$i++;
				}
				if(isset($_GET['no_ktp']) != ""){
						  $hapus = mysql_query("DELETE FROM tbl_detail_anggota WHERE no_ktp=".$_GET['no_ktp']."");
						  if($hapus){
							  echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
							  echo '<meta http-equiv="refresh" content="0; url=lap_statusaktif.php">';
						  }
				}
                ?>
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
