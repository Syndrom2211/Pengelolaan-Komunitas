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
<form style="margin:0px;" method="POST" action="cari_laptransaksi.php">
				<div class="widget-header">
				  <i class="icon-file"></i>
				  <h3></a> Laporan Transaksi Pembayaran</h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama_lengkap">Nama Lengkap</option>
						<option value="tanggal">Tanggal</option>
						<option value="waktu">Waktu</option>
						<option value="metode_pembayaran">Metode Pembayaran</option>
						<option value="atas_nama">Atas Nama</option>
						<option value="jumlah_bayar">Jumlah Bayar</option>
						<option value="status_bayar">Status Bayar</option>
					</select>
					<input type="submit" style="margin:6px 15px 6px 0px;" class="btn btn-primary" value="Cari Data">
				  </div>
				  
				  
				</div> <!-- /widget-header -->
			</form>
            <div class="widget-content">
			<?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_transaksi   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_transaksi_pembayaran WHERE id_transaksi=".$id_transaksi."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_lap_transaksi.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
				  <tr>
					<td>Metode Pembyaran</td>
                      <td>:</td>
					<td><input type="text" class="form-control" name="metode_pembayaran" value="<?php echo $num['metode_pembayaran']; ?>" /><input type="hidden" class="form-control" name="no_ktp" value="<?php echo $num['no_ktp']; ?>" /></td>
				  </tr>
				  <tr>
					<td>Atas Nama</td>
                      <td>:</td>
					<td><input type="text" class="form-control" name="atas_nama" value="<?php echo $num['atas_nama']; ?>" /></td>
				  </tr>
				  <tr>
					<td>Jumlah Bayar</td>
                      <td>:</td>
					<td><input type="text" class="form-control" name="jumlah_bayar" value="<?php echo $num['jumlah_bayar']; ?>" /></td>
				  </tr>
				  <tr>
					<td>Tujuan Pendaftaran</td>
                      <td>:</td>
					<td><input type="text" class="form-control" name="tujuan_pendaftaran" value="<?php echo $num['tujuan_pendaftaran']; ?>" /></td>
				  </tr>
				  <tr>
                      <td>Status Pembayaran</td>
                      <td>:</td>
                      <td>
						<select name="status_bayar">
							<option value="Belum Bayar">Belum Bayar</option>
							<option value="Sudah Bayar">Sudah Bayar</option>
						</select>
                          <input type="hidden" class="form-control" name="id_transaksi" value="<?php echo $id_transaksi; ?>" />						  
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
                  <strong>Catatan :</strong><br/>Dalam penambahan anggota/penanggung jawab baru maka akan menghasilkan suatu laporan transaksi untuk verifikasi kelayakan menjadi anggota/penanggung jawab.
              </div>
			  <a target="_blank" href="report_transaksi.php"><button style="float:left;" class="btn btn-primary" style="margin:6px 15px 6px 0px;">Print Data</button></a>
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="lap_transaksi.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="lap_transaksi.php?by=tgl_daftar&method=asc"><i class="i"></i> Tanggal Daftar/Perpanjang Rutinan </a></li>
												<li><a href="lap_transaksi.php?by=waktu_daftar&method=asc"><i class="i"></i> Waktu Daftar/Perpanjang Rutinan </a></li>
												<li><a href="lap_transaksi.php?by=metode_pembayaran&method=asc"><i class="i"></i> Metode Pembayaran </a></li>
												<li><a href="lap_transaksi.php?by=atas_nama&method=asc"><i class="i"></i> Atas Nama </a></li>
												<li><a href="lap_transaksi.php?by=jumlah_bayar&method=asc"><i class="i"></i> Jumlah Bayar </a></li>
												<li><a href="lap_transaksi.php?by=tujuan_pendaftaran&method=asc"><i class="i"></i> Tujuan Pembayaran </a></li>
												<li><a href="lap_transaksi.php?by=status_bayar&method=asc"><i class="i"></i> Status Pembayaran </a></li>
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
                                                <li><a href="lap_transaksi.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="lap_transaksi.php?by=tgl_daftar&method=desc"><i class="i"></i> Tanggal Daftar/Perpanjang Rutinan </a></li>
												<li><a href="lap_transaksi.php?by=waktu_daftar&method=desc"><i class="i"></i> Waktu Daftar/Perpanjang Rutinan </a></li>
												<li><a href="lap_transaksi.php?by=metode_pembayaran&method=desc"><i class="i"></i> Metode Pembayaran </a></li>
												<li><a href="lap_transaksi.php?by=atas_nama&method=desc"><i class="i"></i> Atas Nama </a></li>
												<li><a href="lap_transaksi.php?by=jumlah_bayar&method=desc"><i class="i"></i> Jumlah Bayar </a></li>
												<li><a href="lap_transaksi.php?by=tujuan_pendaftaran&method=desc"><i class="i"></i> Tujuan Pembayaran </a></li>
												<li><a href="lap_transaksi.php?by=status_bayar&method=desc"><i class="i"></i> Status Pembayaran </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nama Lengkap</th>
                    <th> Tanggal Daftar/Perpanjang Rutinan </th>
					<th> Waktu Daftar/Perpanjang Rutinan </th>
                    <th> Metode Pembayaran </th>
                    <th> Atas Nama </th>
                    <th> Jumlah Bayar</th>
                    <th> Tujuan Pembayaran </th>
                    <th> Status Pembayaran</th>
                    <th class="td-actions"> Aksi </th>
                  </tr>
                </thead>
                <?php
                $i = 1;
				$status = "ASC";
				
				// Ascending
				if($_GET['by']=="nama_lengkap" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="tgl_daftar" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.tgl_daftar";
				}else if($_GET['by']=="waktu_daftar" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.waktu_daftar";
				}else if($_GET['by']=="metode_pembayaran" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.metode_pembayaran";
				}else if($_GET['by']=="atas_nama" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.atas_nama";
				}else if($_GET['by']=="jumlah_bayar" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.jumlah_bayar";
				}else if($_GET['by']=="tujuan_pendaftaran" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.tujuan_pendaftaran";
				}else if($_GET['by']=="status_bayar" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_transaksi_pembayaran.status_bayar";
				}
				
				// Descending
				else if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="tgl_daftar" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.tgl_daftar";
				}else if($_GET['by']=="waktu_daftar" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.waktu_daftar";
				}else if($_GET['by']=="metode_pembayaran" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.metode_pembayaran";
				}else if($_GET['by']=="atas_nama" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.atas_nama";
				}else if($_GET['by']=="jumlah_bayar" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.jumlah_bayar";
				}else if($_GET['by']=="tujuan_pendaftaran" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.tujuan_pendaftaran";
				}else if($_GET['by']=="status_bayar" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_transaksi_pembayaran.status_bayar";
				}else{
					$statusbaru = $status;
					$orderBy = "tbl_anggota.nama_lengkap";
				}
				
				// Pagination
				$halaman = @$_GET['halaman'];
				if(empty($halaman)){
					$posisi  = 0;
					$halaman = 1;
				}else{
					$posisi = ($halaman-1) * 5;
				}
				$i = $posisi + 1;
				
				$sql = mysql_query("SELECT * FROM tbl_transaksi_pembayaran, tbl_anggota WHERE tbl_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp ORDER BY $orderBy $statusbaru LIMIT $posisi,5");
                while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['nama_lengkap']; ?></td>
					<td><?php echo $hasil['tgl_daftar']; ?></td>
					<td><?php echo $hasil['waktu_daftar']; ?></td>
					<td><?php echo $hasil['metode_pembayaran']; ?></td>
					<td><?php echo $hasil['atas_nama']; ?></td>
					<td><?php echo "Rp.".$hasil['jumlah_bayar']; ?></td>
					<td><?php echo $hasil['tujuan_pendaftaran']; ?></td>
					<td>
						<?php
						if($hasil['status_bayar'] == 'Belum Bayar'){
							echo "<font color='red'>".$hasil['status_bayar']."</font>";
						}else{
							echo "<font color='lime'>".$hasil['status_bayar']."</font>";
						}
						?>
					</td>
                    <td class="td-actions"><a href="lap_transaksi.php?edit=<?php echo $hasil['id_transaksi']; ?>"><button class="btn btn-success"><i class="icon-large icon-pencil
"></i> Edit</button></a>
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusTransaksi('".$hasil["id_transaksi"]."','".$hasil["atas_nama"]."');\" value='Hapus'><button class='btn btn-danger'><i class='icon-large icon-trash
'></i> Hapus</button></a>"; ?>
                  </tr>
                </tbody>
                <?php
                $i++;
                }
				if(isset($_GET['id_transaksi']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_transaksi_pembayaran WHERE id_transaksi=".$_GET['id_transaksi']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=lap_transaksi.php">';
                      }
                }
                ?>
              </table>
			  <ul class="pagination">
				<?php
				$res    = mysql_query("SELECT * FROM tbl_transaksi_pembayaran, tbl_anggota WHERE tbl_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp ORDER BY $orderBy $statusbaru");
				$hitung = mysql_num_rows($res);
				$jum    = $hitung/5;
				$jumlah = ceil($jum);
				for($i=1; $i<=$jumlah; $i++){
					echo "<li><a href='lap_transaksi.php?halaman=$i'>".$i."</a></li>";
				}
				?>
			  </ul>
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
