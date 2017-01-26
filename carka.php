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
                <div class="span8">
                  <div class="well">
                  <div class="input-append">
					<div class="btn-group">
					<div class="form-group">
					  <select name="datacari" style="width:120px" class="form-control" id="sel1">
						<option value="-">Cari Apa ?</option>
						<option value="nama">Nama Komunitas</option>
						<option value="jenis_kategori">Kategori</option>
						<option value="jenjang">Jenjang</option>
						<option value="alamat">Alamat</option>
						<option value="profit">Profit</option>
						<option value="harga">Harga Pendaftaran</option>
						<option value="bayar_rutinan">Biaya Internal</option>
						<option value="jenis_biaya">Jangka Pembayaran</option>
					  </select>
					</div>
					</div>
                    <input class="span9" placeholder="Masukan kata kuncinya..." id="appendedInputButton" size="16" type="text">
                    <button class="btn" type="button">Cari</button>
					
                  </div>
                </div> -->
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
                            <li class="active"><a href="#home" data-toggle="tab">Kategori Komunitas</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <p><ul>
								<?php 
								$sql = mysql_query("SELECT * FROM tbl_kategori_komunitas");
								while($hasil = mysql_fetch_array($sql)){
								?>
                                    <li><a href="carka.php?kategori=<?php echo $hasil["jenis_kategori"]; ?>"><?php echo $hasil["jenis_kategori"]; ?></a></li>
								<?php
								}
								?>
                                </ul></p>
                            </div>
                        </div></div>
						<h3 class="media-heading">Hasil pencarian komunitas berdasarkan kategori</h3>
						<div class="page-header"></div>	
							<?php
							if(isset($_GET["kategori"]) != ""){
								$kategori = $_GET['kategori'];
								$sql = mysql_query("SELECT * FROM tbl_komunitas, tbl_kategori_komunitas, tbl_jenjang, tbl_biaya_rutinan_komunitas WHERE tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k AND tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan AND tbl_kategori_komunitas.jenis_kategori = '$kategori' ORDER BY id_tbl_komunitas DESC");
							  
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
							 }
						}else{
							
						}
						?>
                      </div>
                      <div class="page-header"></div>
                  </div>

                </div>
				
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
                </p>
                <div class="page-header"></div>
                    <h3>Artikel Terbaru</h3>
                    <?php
                   // $sql = mysql_query("SELECT * FROM tbl_artikel");
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
            </div></div></div>

        <div id="footerInnerSeparator"></div>
    </div>

</div>

<div id="footerOuterSeparator"></div>

<?php include "include/footer.php"; }?>
</body>
</html>
