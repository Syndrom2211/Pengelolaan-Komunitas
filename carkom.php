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
				?>
				<div class="media">
                      <div class="media-body">
							<form action="carkom.php" method="GET">
							  <div class="well">
							  <div class="input-append">
								<div class="btn-group">
								</div>
								<input name="datacari" class="span9" style="width:90%" placeholder="Masukan nama komunitas..." id="appendedInputButton" type="text">
								<input class="btn" type="submit" value="Cari" />
								
							  </div>
							</div>
							</form>
							<h3 class="media-heading">Hasil pencarian komunitas berdasarkan nama komunitas</h3>
						<div class="page-header"></div>	
						  <?php
						  if(isset($_GET['datacari'])){
							  
							  $datacari = $_GET['datacari'];
							  
							  $sql = mysql_query("SELECT * FROM tbl_komunitas, tbl_kategori_komunitas, tbl_jenjang, tbl_biaya_rutinan_komunitas WHERE tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k AND tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan AND tbl_komunitas.nama LIKE '%$datacari%' ORDER BY id_tbl_komunitas DESC");

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
							}
							  ?>
                      </div>
                      <div class="page-header"></div>
                  </div>

                </div>
            </div></div></div>

        <div id="footerInnerSeparator"></div>
    </div>

</div>

<div id="footerOuterSeparator"></div>

<?php include "include/footer.php"; } ?>
</body>
</html>
