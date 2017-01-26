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
        <div class="span6">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-group"></i>
                                <h3>Komunitas</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
							<style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
			  <div class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">&times;</button>
				 <strong>Catatan :</strong>
				 <br/>*Harap diperhatikan untuk <b>transaksi pembayaran</b> dan <b>status keaktifan</b> apakah sudah terverifikasi atau belum sebelum menambahkan komunitas.
				 <br/>*<b>Biaya Rutinan Komunitas</b> di isi jika komunitas nya memiliki biaya untuk para anggota dalam komunitasnya
				</div>
			  <form action="proses/p_komunitas.php" method="POST" enctype="multipart/form-data">
                <table cellpadding="0" cellspacing="0">
				  <tr>
                      <td>Penanggung Jawab</td>
                      <td>:</td>
                      <td>
                        <select name="penanggung_jawab">
							<option value="-">-</option>
							<?php
							include "../include/koneksi.php";
							$sql = mysql_query("SELECT * FROM tbl_detail_anggota, tbl_anggota, tbl_transaksi_pembayaran WHERE tbl_detail_anggota.no_ktp = tbl_anggota.no_ktp AND tbl_transaksi_pembayaran.no_ktp = tbl_anggota.no_ktp");
							while($hasil = mysql_fetch_array($sql)){
								// Jika belum ada komunitas untuk status yang jabatannya penangung jawab serta status anggota nya aktif dan status bayar nya sudah bayar
								if(($hasil['id_komunitas']==NULL) && ($hasil['status_jabatan']=='Penanggung Jawab') && ($hasil['status_anggota']=='Aktif') && ($hasil['status_bayar']=='Sudah Bayar')){
									?>
									<option value="<?php echo $hasil['no_ktp']; ?>"><?php echo $hasil['nama_lengkap']; ?></option>
									<?php
								}
							}
							?>
						</select>
                      </td>
                  </tr>
				  <tr>
                      <td>Kategori Komunitas</td>
                      <td>:</td>
                      <td>
                        <select name="kategori_komunitas">
							<option value="-">-</option>
							<?php
							include "../include/koneksi.php";
							$sql = mysql_query("SELECT * FROM tbl_kategori_komunitas");
							while($hasil = mysql_fetch_array($sql)){
							?>
								<option value="<?php echo $hasil['id_kategori_k']; ?>"><?php echo $hasil['jenis_kategori']; ?></option>
							<?php
							}
							?>
						</select>
                      </td>
                  </tr>
                  <tr>
                      <td>Jenjang Komunitas</td>
                      <td>:</td>
                      <td>
                          <select name="jenjang_komunitas">
							<option value="-">-</option>
							<?php
							include "../include/koneksi.php";
							$sql = mysql_query("SELECT * FROM tbl_jenjang");
							while($hasil = mysql_fetch_array($sql)){
							?>
								<option value="<?php echo $hasil['id_jenjang']; ?>"><?php echo $hasil['jenjang']; ?></option>
							<?php
							}
							?>
						</select>
                      </td>
                  </tr>
				  <tr>
                      <td>Nama Komunitas</td>
                      <td>:</td>
                      <td>
						<input type="text" class="form-control" name="nama_komunitas" />
					  </td>
                  </tr>
                  <tr>
                      <td>Logo Komunitas</td>
                      <td>:</td>
                      <td>
						<input type="file" name="file" id="file" />
						<br/>
						<i>Ukuran Besar Logo 626x626 pixel</i>
						<br/>
						<i>Ukuran Size Kurang dari 1 MB</i>
					  </td>
                  </tr>
				  <tr>
                      <td>Tentang</td>
                      <td>:</td>
                      <td><textarea cols="5" rows="5" name="tentang"></textarea></td>
                  </tr>
                  <tr>
                      <td>Visi</td>
                      <td>:</td>
                      <td><textarea cols="5" rows="5" name="visi"></textarea></td>
                  </tr>
                  <tr>
                      <td>Misi</td>
                      <td>:</td>
                      <td>
                        <textarea cols="5" rows="5" name="misi"></textarea>
                      </td>
                  </tr>
                  <tr>
                      <td>Profit Komunitas<br/><i>Ket : Isi 0 jika tidak memiliki profit</i></td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="profit" /></td>
                  </tr>
				  <tr>
                      <td>Jenis Biaya Rutinan</td>
                      <td>:</td>
                      <td>
					  <select name="jenisbiaya">
							<option value="-">-</option>
							<?php
							include "../include/koneksi.php";
							$sql = mysql_query("SELECT * FROM tbl_biaya_rutinan_komunitas ORDER BY id_rutinan DESC");
							while($hasil = mysql_fetch_array($sql)){
							?>
								<option value="<?php echo $hasil['id_rutinan']; ?>"><?php echo $hasil['jenis_biaya']; ?></option>
							<?php
							}
							?>
						</select>
					  </td>
                  </tr>
				  <tr>
					<td>Biaya Rutinan<br/><i>Ket : Isi 0 jika tidak ada biaya rutinan</i></td>
					<td>:</td>
					<td><input type="text" class="form-control" id="biayarutinan" name="biayarutinan" /></td>
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
                                <i class="icon-inbox"></i>
                                <h3>Alamat Komunitas</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td>
						<textarea cols="5" rows="5" name="alamat"></textarea>
                      </td>
                  </tr>
				  <tr>
                      <td>Provinsi</td>
                      <td>:</td>
                      <td>
						<input type="text" class="form-control" name="provinsi" />
                      </td>
                  </tr>
				  <tr>
					<td>Kota</td>
					<td>:</td>
					<td>
						<input type="text" class="form-control" name="kota" />
					</td>
				  </tr>
				  <tr>
					<td>Kabupaten</td>
					<td>:</td>
					<td>
						<input type="text" class="form-control" name="kabupaten" />
					</td>
				  </tr>
				  <tr>
					<td>Kecamatan</td>
					<td>:</td>
					<td>
						<input type="text" class="form-control" name="kecamatan" />
					</td>
				  </tr>
                  <tr>
                      <td>RT</td>
                      <td>:</td>
                      <td>
						<input type="text" class="form-control" name="rt" />
					  </td>
                  </tr>
                  <tr>
                      <td>RW</td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="rw" /></td>
                  </tr>
				  <tr>
                      <td>No Rumah</td>
                      <td>:</td>
                      <td><input type="text" class="form-control" name="no_rumah" /></td>
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
