<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']) && (isset($_SESSION['id_admin']))){
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
        <div class="span6">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>
                                    Biodata Diri</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
							<style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
			  <form action="proses/p_anggota.php" method="POST" enctype="multipart/form-data">
                <table cellpadding="0" cellspacing="0">
				  <tr>
                      <td>No KTP</td>
                      <td>:</td>
                      <td>
                          <input type="text" class="form-control" name="no_ktp" />
                      </td>
                  </tr>
                  <tr>
                      <td>Nama Lengkap</td>
                      <td>:</td>
                      <td>
                          <input type="text" class="form-control" name="nama_lengkap" />
                      </td>
                  </tr>
				  <tr>
                      <td>Jenis Kelamin</td>
                      <td>:</td>
                      <td>
						<select name="jenis_kelamin">
							<option value="-">-</option>
							<option value="L">Laki-Laki</option>
							<option vale="P">Perempuan</option>
						</select>
					  </td>
                  </tr>
                  <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><textarea cols="5" rows="5" name="alamat"></textarea></td>
                  </tr>
				  <tr>
                      <td>Pas Foto</td>
                      <td>:</td>
                      <td>
						<input type="file" name="file" id="file" />
						<br/>
						<i>Ukuran Besar Foto 113x170 pixel</i>
						<br/>
						<i>Ukuran Size Kurang dari 1 MB</i>
						</td>
                  </tr>
				  <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td><input type="email" class="form-control" name="email" /></td>
                  </tr>
                  <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="username" /></td>
                  </tr>
                  <tr>
                      <td>Password</td>
                      <td>:</td>
                      <td>
                        <input type="password" class="form-control" name="password" />
                      </td>
                  </tr>
				  <tr>
                      <td>Konfirmasi Password</td>
                      <td>:</td>
                      <td>
                        <input type="password" class="form-control" name="password_konfirmasi" />
                      </td>
                  </tr>
                  <tr>
                      <td>No Handphone</td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="no_hp" /></td>
                  </tr>
				  <tr>
                      <td>Link Facebook</td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="link_facebook" /></td>
                  </tr>
				  <tr>
                      <td>Motivasi</td>
                      <td>:</td>
                      <td><textarea cols="5" rows="5" name="motivasi"></textarea></td>
                  </tr>
                </table>
                                <!-- /bar-chart -->
                            </div>
                            <!-- /widget-content -->
                        </div>
                        <!-- /widget -->
                    </div>
                    <!-- /span6 -->
                    <div class="span6">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-money"></i>
                                <h3>
                                    Transaksi Pembayaran</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Tujuan Pendaftaran</td>
                      <td>:</td>
                      <td>
						<div class="button dropdown"> 
                        <select name="tujuan_daftar" id="tujuandaftar">
							<option value="-">-</option>
							<option value="ikut">Mengikuti Komunitas</option>
							<option value="daftar">Mendaftarkan Komunitas</option>
						</select>
						</div>
                      </td>
                  </tr>
				  <tr>
                      <td>Sebagai</td>
                      <td>:</td>
                      <td>
						<select name="status_jabatan">
								<option value="-">-</option>
								<?php
								include "../include/koneksi.php";
								$i = 1;
								$sql = mysql_query("SELECT * FROM tbl_jabatan");
								while($num = mysql_fetch_array($sql)){
								?>
									<option value="<?php echo $num['jabatan']; ?>"><?php echo $num['jabatan']; ?></option>
								<?php
								$i++;
								}
								?>
								</select>
                      </td>
                  </tr>
				  <tr>
					<td>Nama Komunitas<br/><i>Ket : Jika tujuan mengikuti komunitas</i></td>
					<td>:</td>
					<td>
						<div class="terpilih">
							<div id="ikut" class="pilihan ikut">
									<?php
									$i = 1;
									$sql = mysql_query("SELECT * FROM tbl_komunitas, tbl_biaya_rutinan_komunitas WHERE tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan");
									$jsArray = "var nppName = new Array();";
									$jsArrayDua = "var nppNameDua = new Array();";
									echo '<select name="komunitas_pilihan" id="komunitas_pilihan" onchange="document.getElementById(\'biayarutinan\').value = nppName[this.value];document.getElementById(\'jenisbiaya\').value = nppNameDua[this.value];">';  
									echo "<option value='-' selected>-</option>";
									while($hasil=mysql_fetch_array($sql)){
										echo "<option value='".$hasil[id_komunitas]."'>".$hasil[nama]."</option>";
										 $jsArray .= "nppName['".$hasil[id_komunitas]."'] = '".addslashes($hasil[bayar_rutinan])."';";
										 $jsArrayDua .= "nppNameDua['".$hasil[id_komunitas]."'] = '".addslashes($hasil[jenis_biaya])."';";
									}
									?>
								</select>
							</div>
						</div>
					</td>
				  </tr>
				  <tr>
					<td>Periode Jabatan<br/><i>Ket : Periode Penanggung Jawab Menjabat</i></td>
					<td>:</td>
					<td>
						<div class="terpilih">
							<div id="daftar" class="pilihan daftar">
								<input style="width:95px;" type="text" class="form-control" id="periode_mulai" name="periode_mulai" /> - <input style="width:95px;"type="text" class="form-control" id="periode_akhir" name="periode_akhir" /> 
							</div>
						</div>
					</td>
				  </tr>
				  <tr>
					<td>Profit<br/><i>Default : Harga Pendaftaran Komunitas</i></td>
					<td>:</td>
					<td>
						<input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="20000" readonly />
					</td>
				  </tr>
                  <tr>
                      <td>Metode Pembayaran</td>
                      <td>:</td>
                      <td>
						<select name="metode_pembayaran">
                                <option value="">-</option>
						    	<?php
								$sql = mysql_query("SELECT * FROM tbl_data_rekening");
								while($hasil = mysql_fetch_array($sql)){
								?>
                                <option value="<?php echo $hasil["nama_cabang"]; ?>"><?php echo $hasil["nama_cabang"]; ?> - <?php echo $hasil["no_rekening"]; ?> - <?php echo $hasil["atas_nama"]; ?></option>
								<?php
								}
								?>
								</select>
					  </td>
                  </tr>
                  <tr>
                      <td>Atas Nama (Rek Pendaftar)</td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="atas_nama" /></td>
                  </tr>
				  <tr>
                      <td>Jenis Biaya Rutinan Komunitas</td>
                      <td>:</td>
                      <td>
						<input type="text" class="form-control" id="jenisbiaya" name="jenisbiaya" readonly />
						<script type="text/javascript">  
							<?php echo $jsArrayDua; ?>  
						</script>
					</td>
                  </tr>
				  <tr>
                      <td>Biaya Rutinan Komunitas</td>
                      <td>:</td>
                      <td>
						<input type="text" class="form-control" id="biayarutinan" name="biayarutinan" readonly />
						<script type="text/javascript">  
							<?php echo $jsArray; ?>  
						</script>
					  </td>
                  </tr>
				  <tr>
                      <td></td>
                      <td></td>
                      <td>
						<input type="hidden" class="form-control" name="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" />
						<input type="hidden" class="form-control" name="status_bayar" value="Belum Bayar" />
						<input type="hidden" class="form-control" name="status_anggota" value="Tidak Aktif" />
						<input type="hidden" class="form-control" name="tgl_daftar" value="<?php $tgl = date('Y-m-d'); echo $tgl; ?>" />
						<input type="hidden" class="form-control" name="tgl_daftars" value="<?php $tgls = date('Y-m-d'); echo $tgls; ?>" />
						<input type="hidden" class="form-control" name="waktu_daftar" />
						<div id="clockbox"></div>
					  </td>
                  </tr>
                </table>
                                <!-- /bar-chart -->
                            </div>
                            <!-- /widget-content -->
                        </div>
                        <!-- /widget -->
                    </div>
                    <!-- /span6 -->
        <!-- /span6 -->
      </div>
	  <div class="form-actions">
		<button type="submit" class="btn btn-primary">Tambah</button> 
	  </div>
	  </form>
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
