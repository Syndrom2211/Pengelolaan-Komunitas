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
				<?php
					if (!file_exists('include/koneksi.php')){
					echo "<br/><br/><br/>";
					echo "<div id=\"warning\" align=\"center\"></h5>WARNING ! <br/>File : koneksi.php tidak ditemukan, silahkan lakukan instalasi terlebih dahulu</h5><br/><img src=\"images/progress.gif\"><br/>

					<span id=\"timer\"> Loading... </span></div>";
					echo "<meta http-equiv=\"refresh\" content=\"3;install/\">";
					} else {
						include "include/koneksi.php";
					
					
				  if(isset($_GET['komunitas']) != ""){
					  $id_komunitas   = $_GET['komunitas'];
					  $sql     		  = mysql_query("SELECT * FROM tbl_komunitas, tbl_kategori_komunitas, tbl_jenjang WHERE tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k AND tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND id_komunitas=".$id_komunitas."");
					  $hasil	      = mysql_fetch_array($sql);
					  $sql2			  = mysql_query("SELECT * FROM tbl_komunitas, tbl_detail_anggota, tbl_anggota WHERE tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas AND tbl_detail_anggota.no_ktp = tbl_anggota.no_ktp AND tbl_komunitas.id_komunitas=".$id_komunitas." AND tbl_anggota.status_jabatan = 'Anggota Biasa'");
					  $hasil2		  = mysql_num_rows($sql2);
					  $sql3			  = mysql_query("SELECT * FROM tbl_komunitas, tbl_detail_anggota, tbl_anggota WHERE tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas AND tbl_detail_anggota.no_ktp = tbl_anggota.no_ktp AND tbl_komunitas.id_komunitas=".$id_komunitas." AND tbl_anggota.status_jabatan = 'Penanggung Jawab'");
					  $hasil3		  = mysql_fetch_array($sql3);
				?>
				<div class="span8">
                  <div class="media">
                      <div class="media-body">
                      <div class="w3-content w3-section" style="max-width:700px">
                        <img class="mySlides w3-animate-fading" src="images/banner/1.jpg">
                        <img class="mySlides w3-animate-fading" src="images/banner/2.jpg">
                        <img class="mySlides w3-animate-fading" src="images/banner/3.jpg">
                        <img class="mySlides w3-animate-fading" src="images/banner/4.jpg">
                      </div>
                          <div class="page-header"></div>        
						  <style type="text/css">
						  table,tr,td{
							padding:5px;  
							margin:10px;
					      }
						  </style>
                          <div class="span3" style="font-size:13px;width:100%;margin-bottom:40px;">
						  <h3 class="media-heading"><?php echo $hasil['nama']; ?></h3>
                          <table width="500px" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>
                                  <img style="margin-bottom:10px;" src="images/logo_komunitas/<?php echo $hasil['logo']; ?>" class="img-rounded" />
								  <a class="btn btn-success" style="width:100%;" href="relog.php?komunitas=<?php echo $hasil['id_komunitas']; ?>">Daftar !!</a>
                              </td>
                            </tr>
                            <tr>
                              <td><b>Kategori</td>
                              <td>:</b></td>
                              <td><?php echo $hasil['jenis_kategori']; ?></td>
                            </tr>
                            <tr>
                              <td><b>Jenjang</td>
                              <td>:</b></td>
                              <td><?php echo $hasil['jenjang']; ?></td>
                            </tr>
                            <tr>
                              <td><b>Alamat</td>
                              <td>:</b></td>
                              <td>
							  <p align="justify">
                              <?php echo
                                 $hasil['alamat'].",
                                 No.".$hasil['no_rumah'].",
                                 RT.".$hasil['rt'].",
                                 RW.".$hasil['rw'].",
                                 Kecamatan ".$hasil['kecamatan'].",
                                 Kabupaten ".$hasil['kabupaten'].",
                                 ".$hasil['kota'].",
                                 ".$hasil['provinsi'];
                               ?>
							   </p>
                              </td>
                            </tr>
							<tr>
                              <td><b>Penanggung Jawab</td>
                              <td>:</b></td>
                              <td><?php echo $hasil3["nama_lengkap"]; ?>
                            </tr>
                            <tr>
                              <td><b>Jumlah Anggota</td>
                              <td>:</b></td>
                              <td><?php echo $hasil2; ?>
                            </tr>
                            <tr>
                              <td><b>Profit</td>
                              <td>:</b></td>
                              <td>
								<font color="green">
								<?php
								if($hasil['profit'] == 0){
								  echo "Gratis";
								}else{
								  echo "Rp.".$hasil['profit'];	
								}
								?>
								</font></td>
                            </tr>
							<tr>
                              <td><b>Bayar Bulanan</td>
                              <td>:</b></td>
                              <td>
								<font color="green">
								<?php
								if($hasil['profit'] == 0){
								  echo "Gratis";
								}else{
								  echo "Rp.".$hasil['profit'];	
								}
								?>
								</font></td>
                            </tr>
							<tr>
                              <td><b>Tentang Komunitas</td>
                              <td>:</b></td>
                              <td><p align="justify"><?php echo $hasil['tentang']; ?></p></td>
                            </tr>
							<tr>
                              <td><b>Visi</td>
                              <td>:</b></td>
                              <td><p align="justify"><?php echo $hasil['visi']; ?></p></td>
                            </tr>
							<tr>
                              <td><b>Misi</td>
                              <td>:</b></td>
                              <td><p align="justify"><?php echo $hasil['misi']; ?></p></td>
                            </tr>
                          </table>
                          </div>
                      </div>
                      <div class="page-header"></div>
                  </div>

                </div>
				<?php
				}else{
				?>
                <div class="span8">
                  <!--
                  Untuk Pencarian
                  <div class="well">
                  <div class="input-append">
                    <input class="span9" placeholder="Cari kata kunci komunitas..." id="appendedInputButton" size="16" type="text">
                    <button class="btn" type="button">Cari</button>
                  </div>
                </div>
              -->

                  <div class="media">
                      <div class="media-body">
                        <!-- Untuk Kategori
                          <div class="well">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Kategori Komunitas</a></li>
                            <li><a href="#profile" data-toggle="tab">Lokasi Komunitas</a></li>
                            <li><a href="#settings" data-toggle="tab">Jenjang Komunitas</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <p><ul>
                                    <li><a href="#">Test Link</a></li>
                                </ul></p>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <p><ul>
                                  <li><a href="#">Test Link</a></li>
                                </ul></p>
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <p><ul>
                                  <li><a href="#">Test Link</a></li>
                                </ul></p>
                            </div>
                        </div></div>
                      -->
                      <div class="w3-content w3-section" style="max-width:700px">
                        <img class="mySlides w3-animate-fading" src="images/banner/1.jpg">
                        <img class="mySlides w3-animate-fading" src="images/banner/2.jpg">
                        <img class="mySlides w3-animate-fading" src="images/banner/3.jpg">
                        <img class="mySlides w3-animate-fading" src="images/banner/4.jpg">
                      </div>
                          <div class="page-header"></div>
                          <h3 class="media-heading">Komunitas Terbaru</h3>
						  <?php
                          $i = 3;
						  
							// Pagination
							$halaman = @$_GET['halaman'];
							if(empty($halaman)){
								$posisi  = 0;
								$halaman = 1;
							}else{
								$posisi = ($halaman-1) * 5;
							}
							$i = $posisi + 1;
				
                          $sql = mysql_query("SELECT * FROM tbl_komunitas, tbl_kategori_komunitas, tbl_jenjang, tbl_biaya_rutinan_komunitas WHERE tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k AND tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan ORDER BY id_tbl_komunitas DESC LIMIT $posisi,5");
                          //$sql2 = mysql_query("SELECT * FROM tbl_anggota");
                          //$num = mysql_num_rows($sql2);
                          while($hasil = mysql_fetch_array($sql)){
                          ?>                          
						  <style type="text/css">
						  table,tr,td{
							padding:5px;  
							margin:10px;
					      }
						  </style>
                          <div class="span3" style="font-size:13px;width:48%;margin-bottom:40px;">
						  <h4 style="margin:10px;" class="media-heading"><?php echo $hasil['nama']; ?></h4>
                          <table width="500px" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>
                                  <img style="margin-bottom:10px;" src="images/logo_komunitas/<?php echo $hasil['logo']; ?>" class="img-rounded" />
								  <a class="btn btn-secondary" style="width:100%;" href="index.php?komunitas=<?php echo $hasil['id_komunitas']; ?>">Info Detail</a><br/>
								  <a class="btn btn-success" style="width:100%;" href="relog.php?komunitas=<?php echo $hasil['id_komunitas']; ?>">Daftar !!</a>
                              </td>
                            </tr>
                            <tr>
                              <td><b>Kategori</td>
                              <td>:</b></td>
                              <td><?php echo $hasil['jenis_kategori']; ?></td>
                            </tr>
                            <tr>
                              <td><b>Jenjang</td>
                              <td>:</b></td>
                              <td><?php echo $hasil['jenjang']; ?></td>
                            </tr>
                            <tr>
                              <td><b>Alamat</td>
                              <td>:</b></td>
                              <td>
							  <p align="justify">
                              <?php echo
                                 $hasil['alamat'].",
                                 No.".$hasil['no_rumah'].",
                                 RT.".$hasil['rt'].",
                                 RW.".$hasil['rw'].",
                                 Kecamatan ".$hasil['kecamatan'].",
                                 Kabupaten ".$hasil['kabupaten'].",
                                 ".$hasil['kota'].",
                                 ".$hasil['provinsi'];
                               ?>
							   </p>
                              </td>
                            </tr>
                            <tr>
                              <td><b>Profit</td>
                              <td>:</b></td>
                              <td>
								<?php
								if($hasil['profit'] == 0){
								  echo "Non-Profit";
								}else{
								  echo "Profit";	
								}
								?></td>
                            </tr>
							<tr>
                              <td><b>Harga Pendaftaran</td>
                              <td>:</b></td>
                              <td><font color="green">
								<?php
								if($hasil['profit'] == 0){
								  echo "Rp.0";
								}else{
								  echo "Rp.".$hasil['profit'];
								}
								?></font></td>
                            </tr>
							<tr>
                              <td><b>Biaya Internal</td>
                              <td>:</b></td>
                              <td><?php echo "Rp.".$hasil['bayar_rutinan']; ?></td>
                            </tr>
							<tr>
                              <td><b>Jangka Pembayaran</td>
                              <td>:</b></td>
                              <td><?php echo $hasil['jenis_biaya']; ?></td>
                            </tr>
                          </table>     
						 </div>						  
                          <?php
                          $i++;
                          }
                          ?>
						  <div class="pagination" style="font-size:13px;width:48%;margin-bottom:40px;">
							  <ul>
								<?php
								$res    = mysql_query("SELECT * FROM tbl_komunitas, tbl_kategori_komunitas, tbl_jenjang, tbl_biaya_rutinan_komunitas WHERE tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k AND tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan ORDER BY id_tbl_komunitas DESC");
								$hitung = mysql_num_rows($res);
								$jum    = $hitung/5;
								$jumlah = ceil($jum);
								for($i=1; $i<=$jumlah; $i++){
									echo "<li><a href='index.php?halaman=$i'>".$i."</a></li>";
								}
								?>
							  </ul>
						  </div>
                      </div>
                      <div class="page-header"></div>
                  </div>

                </div>
				<?php
				}
				?>
				<!--/End Sidebar Content -->
                <div class="span4"><!--
                  <h3>Kategori Artikel</h3>
                  <p>
                  <ul>
                  <?php
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
                </p> -->
				<h3><i class="icon-envelope-alt"></i> Feedback Anggota Terbaru</h3>
                <div class="page-header" style="padding-bottom:30px"></div>
					<div class="media">
					<?php
						$sql = mysql_query("SELECT * FROM tbl_anggota INNER JOIN tbl_feedback ON tbl_feedback.no_ktp = tbl_anggota.no_ktp INNER JOIN tbl_komunitas ON tbl_feedback.id_komunitas = tbl_komunitas.id_komunitas ORDER BY tbl_feedback.tanggal DESC LIMIT 10");
						while($hasil = mysql_fetch_array($sql)){
						?>
                    <a class="pull-left" href="#">
                       <img src="images/foto_anggota/<?php echo $hasil["foto"]; ?>" class="img-rounded" />
                    </a>
                    <div class="media-body">
						<font size="2px"><?php echo $hasil["tanggal"]; ?></font>
                        <h4 class="media-heading"><?php echo $hasil["nama_lengkap"]; ?><br/><font size="2px">(<?php echo $hasil["status_jabatan"]?>)</font></h4>
                        <h5 class="media-heading">Komunitas <?php echo $hasil["nama"]; ?></h5>
						<a target="_blank" href="<?php echo $hasil["link_facebook"]; ?>">Link Facebook</h6></a>
						<h6 class="media-heading"><i><font size="5px">"<?php echo $hasil["catatan"]; ?>"</font></i></h6>
                    </div>
					<div class="page-header"></div>
					<?php
					}
					?>
                </div>
                </div>
            </div>

        <div id="footerInnerSeparator"></div>
    </div>

</div>

<div id="footerOuterSeparator"></div>

<?php include "include/footer.php"; } ?>
</body>
</html>
