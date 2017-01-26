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
<form style="margin:0px;" method="POST" action="cari_lapbiayarutinan.php">
				<div class="widget-header">
				  <i class="icon-file"></i>
				  <h3></a> Laporan Biaya Rutinan</h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama">Nama Komunitas</option>
						<option value="nama_lengkap">Nama Anggota</option>
						<option value="jenis_rutinan">Jenis Rutinan</option>
						<option value="pembayaran_selanjutnya">Pembayaran Selanjutnya</option>
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
                  $sql     = mysql_query("SELECT * FROM tbl_detail_anggota INNER JOIN tbl_anggota ON tbl_detail_anggota.no_ktp = tbl_anggota.no_ktp WHERE tbl_detail_anggota.no_ktp=".$no_ktp."");
                  $num     = mysql_fetch_array($sql);
            ?>
			<style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_lap_statusrutinan.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
				  <tr>
                      <td>Status Bayar</td>
                      <td>:</td>
                      <td>
						<select name="status_bayar">
							<option value="Sudah Bayar">Sudah Bayar</option>
							<option value="Belum Bayar">Belum Bayar</option>
						</select>
                          <input type="hidden" class="form-control" name="no_ktp" value="<?php echo $no_ktp; ?>" />	
						  <input type="hidden" class="form-control" name="jenisbiaya" value="<?php echo $num["jenis_rutinan"]; ?>" />						  
                      </td>
                  </tr>
				  <tr>
					<td>Metode Pembayaran</td>
					<td>:</td>
					<td><select name="metode_pembayaran">
                                <option value="-">-</option>
						    	<?php
								$sql = mysql_query("SELECT * FROM tbl_data_rekening");
								while($hasil = mysql_fetch_array($sql)){
								?>
                                <option value="<?php echo $hasil["nama_cabang"]; ?>"><?php echo $hasil["nama_cabang"]; ?> - <?php echo $hasil["no_rekening"]; ?> - <?php echo $hasil["atas_nama"]; ?></option>
								<?php
								}
								?>
								</select></td>
				  </tr>
				  <tr>
					<td>Atas Nama</td>
					<td>:</td>
					<td>
						<input type="text" class="form-control" name="atas_nama" value="<?php echo $num["nama_lengkap"]; ?>" />
						<input type="hidden" class="form-control" name="jumlah_bayar" value="<?php echo $num["jumlah_bayar"]; ?>" />
						<input type="hidden" class="form-control" name="pembayaran_selanjutnya" value="<?php echo $num["pembayaran_selanjutnya"]; ?>" />
						<input type="hidden" class="form-control" name="pembayaran_selanjutnya_lagi" value="<?php echo $num["pembayaran_selanjutnya"]; ?>" />
						<input type="hidden" class="form-control" name="waktu_daftar" />
						<div id="clockbox"></div>
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
				  <br/>Penghapusan untuk Biaya Rutinan Anggota bisa dilakukan ketika status Anggota nya sudah tidak aktif.
				  <br/>Pembayaran Selanjutnya terisi jika suatu komunitas memang memerlukan biaya Mingguan/Bulanan/Tahunan dalam komunitas nya
				  <br/>Status bayar sudah bisa di update jika penanggung jawab sudah membuat komunitasnya
				  <!--<br/>Pembayaran Selanjutnya terisi jika suatu komunitas memang memerlukan biaya Mingguan/Bulanan/Tahunan dalam komunitas nya -->
              </div>
			  <form action="report_biayarutinan.php" method="POST" target="_blank">
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
                                                <li><a href="lap_biayarutinan.php?by=nama&method=asc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="lap_biayarutinan.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Anggota </a></li>
												<li><a href="lap_biayarutinan.php?by=jenis_rutinan&method=asc"><i class="i"></i> Jenis Rutinan </a></li>
												<li><a href="lap_biayarutinan.php?by=pembayaran_selanjutnya&method=asc"><i class="i"></i> Pembayaran Berikutnya </a></li>
												<li><a href="lap_biayarutinan.php?by=status_bayar&method=asc"><i class="i"></i> Status Bayar </a></li>
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
                                                <li><a href="lap_biayarutinan.php?by=nama&method=desc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="lap_biayarutinan.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Anggota </a></li>
												<li><a href="lap_biayarutinan.php?by=jenis_rutinan&method=desc"><i class="i"></i> Jenis Rutinan </a></li>
												<li><a href="lap_biayarutinan.php?by=pembayaran_selanjutnya&method=desc"><i class="i"></i> Pembayaran Berikutnya </a></li>
												<li><a href="lap_biayarutinan.php?by=status_bayar&method=desc"><i class="i"></i> Status Bayar </a></li>
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
					<th> Jenis Rutinan</th>
					<th> Jumlah Bayar </th>
                    <th> Pembayaran Berikutnya </th>
					<th> Status Bayar </th>
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
				}else if($_GET['by']=="jenis_rutinan" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_detail_anggota.jenis_rutinan";
				}else if($_GET['by']=="pembayaran_selanjutnya" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_detail_anggota.pembayaran_selanjutnya";
				}else if($_GET['by']=="status_bayar" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_detail_anggota.status_bayar";
				}
				
				// Descending
				else if($_GET['by']=="nama" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="jenis_rutinan" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_detail_anggota.jenis_rutinan";
				}else if($_GET['by']=="pembayaran_selanjutnya" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_detail_anggota.pembayaran_selanjutnya";
				}else if($_GET['by']=="status_bayar" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_detail_anggota.status_bayar";
				}else{
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
				}
				
				if($_POST['tipecari'] == "nama"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp WHERE tbl_komunitas.nama LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "nama_lengkap"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp WHERE tbl_anggota.nama_lengkap LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "jenis_rutinan"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp WHERE tbl_detail_anggota.jenis_rutinan LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "pembayaran_selanjutnya"){
					$sql = mysql_query("SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp WHERE tbl_detail_anggota.pembayaran_selanjutnya LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}
				
				while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['nama']; ?></td>
					<td><?php echo $hasil['nama_lengkap']; ?></td>
					<td><?php echo $hasil['jenis_rutinan']; ?></td>
					<td><?php echo $hasil['jumlah_bayar']; ?></td>
					<td><?php echo $hasil['pembayaran_selanjutnya']; ?></td>
					<td>
						<?php 
						if($hasil['status_bayar'] == 'Belum Bayar'){
							echo "<font color='red'>".$hasil['status_bayar']."</font>"; 
						}else if($hasil['status_bayar'] == 'Sudah Bayar'){
							echo "<font color='lime'>".$hasil['status_bayar']."</font>"; 
						}else{
							echo "Bugs !";
						}?>
					</td>
                    <td class="td-actions">
						<?php
						if($hasil['jenis_rutinan']==""){
							//NULL
						}else{
							if($hasil['status_bayar']=="Sudah Bayar"){
								echo "[NonAktif]";
							}else{
								?><a href="lap_biayarutinan.php?edit=<?php echo $hasil['no_ktp']; ?>"><button class="btn btn-success"><i class="icon-large icon-pencil
"></i> Edit</button></a><?php
							}
						}
						?>
						&nbsp;
						<?php
						if($hasil['pembayaran_selanjutnya'] == "0000-00-00"){
								// NULL
						}else{
							if($hasil['status_anggota'] == 'Tidak Aktif'){
								echo "<a href='#' onClick=\"return konfirmasiHapusRutinanAnggota('".$hasil["no_ktp"]."','".$hasil["nama_lengkap"]."');\" value='Hapus'><button class='btn btn-danger'><i class='icon-large icon-trash
'></i> Hapus</button></a>";
							}else if($hasil['status_anggota'] == 'Aktif'){
								// NULL
							}
						}
						?>
						
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
