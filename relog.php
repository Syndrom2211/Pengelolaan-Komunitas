<?php
session_start();
if(isset($_SESSION['username'])){
    header('location:user/');
}else{
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php include "include/header.php"; ?>
</head>
<body id="pageBody">

<?php include "include/navigation.php"; ?>

<div id="contentOuterSeparator"></div>

<div class="container">

    <div class="divPanel page-content">

        <div class="row-fluid">
                  <!--
                  Untuk Pencarian
                  <div class="well">
                  <div class="input-append">
                    <input class="span9" placeholder="Cari kata kunci komunitas..." id="appendedInputButton" size="16" type="text">
                    <button class="btn" type="button">Cari</button>
                  </div>
                </div>
              -->
				  <?php
				  if (!file_exists('include/koneksi.php')){
					echo "<br/><br/><br/>";
					echo "<div id=\"warning\" align=\"center\"></h5>WARNING ! <br/>File : koneksi.php tidak ditemukan, silahkan lakukan instalasi terlebih dahulu</h5><br/><img src=\"images/progress.gif\"><br/>

					<span id=\"timer\"> Loading... </span></div>";
					echo "<meta http-equiv=\"refresh\" content=\"3;install/\">";
					} else {
						include "include/koneksi.php";
				  ?>
                  <div class="media">
                      <div class="media-body">
                          <div class="well">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Registrasi</a></li>
                            <li><a href="#profile" data-toggle="tab">Login</a></li>
                        </ul>
                        <div class="tab-content">
							<?php
							  if(isset($_GET['komunitas']) != ""){
								  $id_komunitas   = $_GET['komunitas'];
								  $sql     		  = mysql_query("SELECT id_komunitas, nama, profit FROM tbl_komunitas WHERE id_komunitas=".$id_komunitas."");
								  $sql2			  = mysql_query("SELECT id_komunitas, nama, profit, jenis_biaya, bayar_rutinan FROM tbl_komunitas INNER JOIN tbl_biaya_rutinan_komunitas ON tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan WHERE id_komunitas=".$id_komunitas."");
								  $hasil2		  = mysql_fetch_array($sql2);
							?>
                            <div class="tab-pane fade in active" id="home">
                                <style type="text/css">
                                table, tr, td{
                                    padding:5px;
                                    margin:5px;
                                }
                                </style>
                                <p>Untuk melakukan pendaftaran, baca <a href="bare.php">bantuan pendaftaran</a> terlebih dahulu.</p>
                                <h3>Biodata Diri</h3>
                                <form name="form1" action="proses/p_anggota.php" method="POST" enctype="multipart/form-data">
                                <table cellpadding="0" cellspacing="0">
								  <tr>
                                    <td>No KTP</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="no_ktp" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Nama Langkap</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="nama_lengkap" class="input-large" type="text" /></td>
                                  </tr>
								  <tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td>
									<select name="jenis_kelamin">
										<option value="-">-</option>
										<option value="L">Laki - Laki</option>
										<option value="P">Perempuan</option>
									</select>
									</td>
								  </tr>
                                  <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><textarea name="alamat"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="username" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="password" class="input-large" type="password" /></td>
                                  </tr>
								  <tr>
                                    <td>Konfirmasi Password</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="konfirmasi_password" class="input-large" type="password" /></td>
                                  </tr>
                                  <tr>
                                    <td>No Handphone</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="no_hp" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="email" class="input-large" type="email" /></td>
                                  </tr>
                                  <tr>
                                    <td>Link Facebook</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="link_facebook" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Motivasi</td>
                                    <td>:</td>
                                    <td><textarea name="motivasi"></textarea></td>
                                  </tr>
                                </table>
                                <br/><br/>
                                <h3>Transaksi Pembayaran Komunitas</h3>
                                <table cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td>Nama Komunitas</td>
                                    <td>:</td>
                                    <td>
										<select name="nama_komunitas">
									<?php
									while($hasil = mysql_fetch_array($sql)){
									?>
                                        <option value="<?php echo $hasil['id_komunitas']; ?>"><?php echo $hasil['nama']; ?></option>
									<?php
									}
									?>
										</select>
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
                                    <td>Atas Nama</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="atas_nama" class="input-large" type="text" /></td>
                                  </tr>
								  <tr>
								  <td>Biaya Internal</td>
									<td>:</td>
									<td><input style="width:250px;padding:10px;height:30px;" id="biaya_internal" name="biaya_internal" class="input-large" type="text" value="<?php echo $hasil2["bayar_rutinan"]; ?>" readonly /></td>
								  </tr>
								  <tr>
								  <td>Jangka Pembayaran</td>
									<td>:</td>
									<td><input style="width:250px;padding:10px;height:30px;" id="jenis_biaya" name="jenis_biaya" class="input-large" type="text" value="<?php echo $hasil2["jenis_biaya"]; ?>" readonly /></td>
								  </tr>
                                  <tr>
                                    <td>Jumlah Bayar</td>
                                    <td>:</td>
                                    <td>
										<input style="width:250px;padding:10px;height:30px;" name="jumlah_bayar" class="input-large" type="text" value="<?php echo $hasil2['profit']; ?>" readonly />
										<input type="hidden" class="form-control" name="tgl_daftar" value="<?php $tgl = date('Y-m-d'); echo $tgl; ?>" />
										<input type="hidden" class="form-control" name="tujuan_daftar" value="Mengikuti Komunitas" />
										<input type="hidden" class="form-control" name="status_bayar" value="Belum Bayar" />
										<input type="hidden" class="form-control" name="status_anggota" value="Tidak Aktif" />
										<input type="hidden" class="form-control" name="status_jabatan" value="Anggota Biasa" />
										<input type="hidden" class="form-control" name="waktu_daftar" />
										<div id="clockbox"></div>
									</td>
                                  </tr>
                                  <tr>
                                    <td>
										<input type="submit" class="btn" name="submit" value="Register" />
									</td>
                                  </tr>
                                </table>
                              </form>
                            </div>
							<?php
							}else{
							?>
							<div class="tab-pane fade in active" id="home">
                                <style type="text/css">
                                table, tr, td{
                                    padding:5px;
                                    margin:5px;
                                }
                                </style>
                                <p>Untuk melakukan pendaftaran, baca <a href="bare.php">bantuan pendaftaran</a> terlebih dahulu.</p>
                                <h3>Biodata Diri</h3>
                                <form name="form1" action="proses/p_anggota.php" method="POST" enctype="multipart/form-data">
                                <table cellpadding="0" cellspacing="0">
								  <tr>
                                    <td>No KTP</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="no_ktp" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Nama Langkap</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="nama_lengkap" class="input-large" type="text" /></td>
                                  </tr>
								  <tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td>
									<select name="jenis_kelamin">
										<option value="-">-</option>
										<option value="L">Laki - Laki</option>
										<option value="P">Perempuan</option>
									</select>
									</td>
								  </tr>
                                  <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><textarea name="alamat"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="username" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="password" class="input-large" type="password" /></td>
                                  </tr>
								  <tr>
                                    <td>Konfirmasi Password</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="konfirmasi_password" class="input-large" type="password" /></td>
                                  </tr>
                                  <tr>
                                    <td>No Handphone</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="no_hp" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="email" class="input-large" type="email" /></td>
                                  </tr>
                                  <tr>
                                    <td>Link Facebook</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="link_facebook" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Motivasi</td>
                                    <td>:</td>
                                    <td><textarea name="motivasi"></textarea></td>
                                  </tr>
                                </table>
                                <br/><br/>
                                <h3>Transaksi Pembayaran Komunitas</h3>
                                <table cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td>Nama Komunitas</td>
                                    <td>:</td>
                                    <td>
									<?php
									$sql = mysql_query("SELECT * FROM tbl_komunitas INNER JOIN tbl_biaya_rutinan_komunitas ON tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan ORDER BY nama ASC");
									$jsArray = "var nppName = new Array();";
									$jsArrayDua = "var nppNameDua = new Array();";
									$jsArrayTiga = "var nppNameTiga = new Array();";
									echo '<select name="nama_komunitas" id="nama_komunitas" onchange="document.getElementById(\'jumlah_bayar\').value = nppName[this.value];document.getElementById(\'jenis_biaya\').value = nppNameDua[this.value];document.getElementById(\'biaya_internal\').value = nppNameTiga[this.value];">';  
									echo "<option value='-' selected>-</option>";
									while($hasil=mysql_fetch_array($sql)){
										echo "<option value='".$hasil[id_komunitas]."'>".$hasil[nama]."</option>";
										 $jsArray .= "nppName['".$hasil[id_komunitas]."'] = '".addslashes($hasil[profit])."';";
										 $jsArrayDua .= "nppNameDua['".$hasil[id_komunitas]."'] = '".addslashes($hasil[jenis_biaya])."';";
										 $jsArrayTiga .= "nppNameTiga['".$hasil[id_komunitas]."'] = '".addslashes($hasil[bayar_rutinan])."';";
									}
									?>
									</select>
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
                                    <td>Atas Nama</td>
                                    <td>:</td>
                                    <td><input style="width:250px;padding:10px;height:30px;" name="atas_nama" class="input-large" type="text" /></td>
                                  </tr>
                                  <tr>
                                    <td>Jumlah Bayar</td>
                                    <td>:</td>
                                    <td>
										<input style="width:250px;padding:10px;height:30px;" id="jumlah_bayar" name="jumlah_bayar" class="input-large" type="text" readonly />
										<script type="text/javascript">  
											<?php echo $jsArray; ?>  
										</script>
										<input type="hidden" class="form-control" name="tgl_daftar" value="<?php $tgl = date('Y-m-d'); echo $tgl; ?>" />
										<input type="hidden" class="form-control" name="tujuan_daftar" value="Mengikuti Komunitas" />
										<input type="hidden" class="form-control" name="status_bayar" value="Belum Bayar" />
										<input type="hidden" class="form-control" name="status_anggota" value="Tidak Aktif" />
										<input type="hidden" class="form-control" name="status_jabatan" value="Anggota Biasa" />
										<input type="hidden" class="form-control" name="waktu_daftar" />
									</td>									
                                  </tr>
								  <tr>
								  <td>Biaya Internal</td>
									<td>:</td>
									<td><input style="width:250px;padding:10px;height:30px;" id="biaya_internal" name="biaya_internal" class="input-large" type="text" readonly /><script type="text/javascript">  
											<?php echo $jsArrayTiga; ?>  
										</script></td>
								  </tr>
								  <tr>
								  <td>Jangka Pembayaran</td>
									<td>:</td>
									<td><input style="width:250px;padding:10px;height:30px;" id="jenis_biaya" name="jenis_biaya" class="input-large" type="text" readonly />
									<script type="text/javascript">  
											<?php echo $jsArrayDua; ?>  
										</script></td>
								  </tr>
                                  <tr>
                                    <td><input type="submit" class="btn" name="submit" value="Register" /></td>
                                  </tr>
                                </table>
                              </form>
                            </div>
							<?php
							}
							?>
                            <div class="tab-pane fade" id="profile">
                            <form action="p_login.php" method="POST">
                              <table cellpadding="0" cellspacing="0">
                                <tr>
                                  <td>Username</td>
                                  <td>:</td>
                                  <td><input style="width:250px;padding:10px;height:30px;" name="usernamez" class="input-large" type="text" /></td>
                                </tr>
                                <tr>
                                  <td>Password</td>
                                  <td>:</td>
                                  <td><input style="width:250px;padding:10px;height:30px;" name="passwordz" class="input-large" type="password" /></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td><input type="submit" name="submit" class="btn" value="Login" /></td>
                                </tr>
                              </table>
                            </form>
                            </div>
                        </div></div>
                      </div>
                      <div class="page-header"></div>
                  </div>

				<!--/End Sidebar Content -->
                <div class="span4">
				<!--
                  <h3>Kategori Artikel</h3>
                  <p>
                  <ul>
                  <?php
                  //include "include/koneksi.php";
                  //$sql = mysql_query("SELECT * FROM tbl_kategori_artikel");
                  //while($hasil = mysql_fetch_array($sql)){
                  ?>
                      <li>
                        <a href="#"><?php //echo $hasil['nama_kategori']; ?></a>
                      </li>
                  <?php
                  //}
                  ?>
                  </ul>
                </p>
                <div class="page-header"></div>
                    <h3>Artikel Terbaru</h3>
                    <?php
                    //$sql = mysql_query("SELECT * FROM tbl_artikel");
                    //while($hasil = mysql_fetch_array($sql)){
                    ?>
                    <a class="pull-left" href="#">
                      <img style="margin:10px 10px 0px 10px;" src="<?php //echo $hasil['gambar']; ?>" class="img-rounded" />
                    </a>
	                  <a href="#"><?php //echo $hasil['judul']; ?></a>
                    <p align="justify">
                        <?php //echo $hasil['isi']; ?>
                    </p>
                    <?php
                    //}
                    ?>
					-->
                </div>
            </div>

        <div id="footerInnerSeparator"></div>
    </div>

</div>

<div id="footerOuterSeparator"></div>

<?php include "include/footer.php"; } ?>
</body>
</html>
<?php
}
?>