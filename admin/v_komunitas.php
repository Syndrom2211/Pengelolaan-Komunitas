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
			<form style="margin:0px;" method="POST" action="cari_komunitas.php">
				<div class="widget-header">
				  <i class="icon-group"></i>
				  <h3></a> List Komunitas</h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama_komunitas">Nama Komunitas</option>
						<option value="jenjang">Jenjang</option>
						<option value="kategori">Kategori</option>
					</select>
					<input type="submit" style="margin:6px 15px 6px 0px;" class="btn btn-primary" value="Cari Data">
				  </div>
				  
				  
				</div> <!-- /widget-header -->
			</form>
            <div class="widget-content">
			<?php
              include "../include/koneksi.php";
              if(isset($_GET['edit']) != ""){
                  $id_tbl_komunitas   = $_GET['edit'];
                  $sql     = mysql_query("SELECT * FROM tbl_komunitas, tbl_jenjang, tbl_kategori_komunitas, tbl_biaya_rutinan_komunitas WHERE tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k AND tbl_komunitas.id_rutinan = tbl_biaya_rutinan_komunitas.id_rutinan AND id_tbl_komunitas=".$id_tbl_komunitas."");
                  $num     = mysql_fetch_array($sql);
            ?>
			<style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
              <form action="proses/pe_komunitas.php" method="POST" enctype="multipart/form-data">
                  <table cellpadding="0" cellspacing="0">
				  <tr>
					<td>ID Komunitas</td>
                      <td>:</td>
                      <td>
						<input type="text" name="id_komunitas" value="<?php echo $num["id_komunitas"]; ?>" readonly />
					  </td>
				  </tr>
				  <tr>
                      <td>Jenjang</td>
                      <td>:</td>
                      <td>
						<select name="jenjang">
							<option value="<?php echo $num["id_jenjang"]; ?>"><?php echo $num["jenjang"]; ?></option>
							<?php
							$sql = mysql_query("SELECT * FROM tbl_jenjang");
							while($hasil = mysql_fetch_array($sql)){
							?>
							<option value="<?php echo $hasil["id_jenjang"]; ?>"><?php echo $hasil["jenjang"]; ?></option>
							<?php
							}
							?>
						</select>					  
                      </td>
                  </tr>
				  <tr>
					<td>Kategori</td>
                      <td>:</td>
                      <td>
						<select name="kategori">
							<option value="<?php echo $num["id_kategori_k"]; ?>"><?php echo $num["jenis_kategori"]; ?></option>
							<?php
							$sql = mysql_query("SELECT * FROM tbl_kategori_komunitas");
							while($hasil = mysql_fetch_array($sql)){
							?>
							<option value="<?php echo $hasil["id_kategori_k"]; ?>"><?php echo $hasil["jenis_kategori"]; ?></option>
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
						<input type="text" name="nama" value="<?php echo $num["nama"]; ?>" />
					  </td>
				  </tr>
				  <tr>
                      <td>Logo</td>
                      <td>:</td>
                      <td>
                        <input type="hidden" name="logo_lama" value="<?php echo $num['logo']; ?>"/>
                        <a href="<?php echo "../images/logo_komunitas/".$num['logo']; ?>" target="_blank"><img src="<?php echo "../images/logo_komunitas/".$num['logo']; ?>" width="120px" height="120px" /></a>
                      </td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td><i>(klik gambar untuk memperbesar)</i></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td>Ganti Foto :</td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td>
					  <input type="file" name="file" id="file" />
					  <br/>
						<i>Ukuran Besar Logo 626x626 pixel </i>
						<br/>
						<i>Ukuran Size Kurang dari 1 MB</i></td>
                  </tr>
				  <tr>
					<td>Tentang</td>
                      <td>:</td>
                      <td>
						<textarea name="tentang"><?php echo $num["tentang"]; ?></textarea>
					  </td>
				  </tr>
				  <tr>
					<td>Visi</td>
                      <td>:</td>
                      <td>
						<textarea name="visi"><?php echo $num["visi"]; ?></textarea>
					  </td>
				  </tr>
				  <tr>
					<td>Misi</td>
                      <td>:</td>
                      <td>
						<textarea name="misi"><?php echo $num["misi"]; ?></textarea>
					  </td>
				  </tr>
				  <tr>
					<td>Profit</td>
                      <td>:</td>
                      <td>
						Rp.<input style="width:120px" type="text" name="profit" value="<?php echo $num["profit"]; ?>" />
					  </td>
				  </tr>
				  <tr>
                      <td>Jenis Biaya Rutinan</td>
                      <td>:</td>
                      <td>
					  <select name="jenisbiayalama">
							<option value="<?php echo $hasil['id_rutinan']; ?>"><?php echo $num['jenis_biaya']; ?></option>
						</select>
					  </td>
                  </tr>
				  <tr>
                      <td>Ganti Jenis Biaya Rutinan<br><i>Ket : Jika tidak diganti maka biarkan strip</i></td>
                      <td>:</td>
                      <td>
					  <select name="jenisbiayabaru">
							<option value="NULL">-</option>
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
					<td>Biaya Rutinan</td>
					<td>:</td>
					<td>Rp.<input style="width:120px" type="text" name="biayarutinan" value="<?php echo $num["bayar_rutinan"]; ?>" /></td>
				  </tr>
				  <tr>
					<td>Alamat</td>
                      <td>:</td>
                      <td>
						<textarea name="alamat"><?php echo $num["alamat"]; ?></textarea>
					  </td>
				  </tr>
				  <tr>
					<td>Provinsi</td>
                      <td>:</td>
                      <td>
						<input type="text" name="provinsi" value="<?php echo $num["provinsi"]; ?>" />
					  </td>
				  </tr>
				  <tr>
					<td>Kota</td>
                      <td>:</td>
                      <td>
						<input type="text" name="kota" value="<?php echo $num["kota"]; ?>" />
					  </td>
				  </tr>
				  <tr>
					<td>Kabupaten</td>
                      <td>:</td>
                      <td>
						<input type="text" name="kabupaten" value="<?php echo $num["kabupaten"]; ?>" />
					  </td>
				  </tr>
				  <tr>
					<td>Kecamatan</td>
                      <td>:</td>
                      <td>
						<input type="text" name="kecamatan" value="<?php echo $num["kecamatan"]; ?>" />
					  </td>
				  </tr>
				  <tr>
					<td>RT</td>
                      <td>:</td>
                      <td>
						<input type="text" name="rt" value="<?php echo $num["rt"]; ?>" />
					  </td>
				  </tr>
				  <tr>
					<td>RW</td>
                      <td>:</td>
                      <td>
						<input type="text" name="rw" value="<?php echo $num["rw"]; ?>" />
					  </td>
				  </tr>
				  <tr>
					<td>No Rumah</td>
                      <td>:</td>
                      <td>
						<input type="text" name="no_rumah" value="<?php echo $num["no_rumah"]; ?>" />
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
			  <a href="vt_komunitas.php"><button style="float:left;" class="btn btn-primary" style="margin:6px 15px 6px 0px;">Tambah Data</button></a>
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
												<li><a href="v_komunitas.php?by=nama&method=asc"><i class="i"></i> Nama Komunitas</a></li>
												<li><a href="v_komunitas.php?by=jenjang&method=asc"><i class="i"></i> Jenjang </a></li>
												<li><a href="v_komunitas.php?by=jenis_kategori&method=asc"><i class="i"></i> Kategori </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
											  <!-- DESCENDING -->
                                              <div class="control-group" style="float:right">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-down
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
												<li><a href="v_komunitas.php?by=nama&method=desc"><i class="i"></i> Nama Komunitas</a></li>
												<li><a href="v_komunitas.php?by=jenjang&method=desc"><i class="i"></i> Jenjang </a></li>
												<li><a href="v_komunitas.php?by=jenis_kategori&method=desc"><i class="i"></i> Kategori </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Logo </th>
                    <th> Nama Komunitas </th>
                    <th> Jenjang </th>
                    <th> Kategori</th>
                    <th class="td-actions"> Aksi </th>
                  </tr>
                </thead>
                <?php
                $i = 1;
				$status = "ASC";
				
				// Ascending
				if($_GET['by']=="nama" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="jenjang" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_jenjang.jenjang";
				}else if($_GET['by']=="jenis_kategori" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_kategori_komunitas.jenis_kategori";
					
				// Descending
				}else if($_GET['by']=="nama" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="jenjang" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_jenjang.jenjang";
				}else if($_GET['by']=="jenis_kategori" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_kategori_komunitas.jenis_kategori";
				}else{
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
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
				
				$sql = mysql_query("SELECT * FROM tbl_komunitas, tbl_jenjang, tbl_kategori_komunitas WHERE tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k ORDER BY $orderBy $statusbaru LIMIT $posisi,5");
                while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><center><a href="../images/logo_komunitas/<?php echo $hasil['logo']; ?>" target="_blank"><img src="../images/logo_komunitas/<?php echo $hasil['logo']; ?>" width="50px" /></a></center></td>
                    <td><?php echo $hasil['nama']; ?></td>
                    <td><?php echo $hasil['jenjang']; ?></td>
                    <td><?php echo $hasil['jenis_kategori']; ?></td>
                    <td class="td-actions"><a href="v_komunitas.php?edit=<?php echo $hasil['id_tbl_komunitas']; ?>"><button class="btn btn-success"><i class="icon-large icon-pencil
"></i> Edit</button></a>
						&nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusKomunitas('".$hasil["id_komunitas"]."','".$hasil["nama"]."');\" value='Hapus'><button class='btn btn-danger'><i class='icon-large icon-trash
'></i> Hapus</button></a>"; ?>
					</td>
                  </tr>
                </tbody>
                <?php
                $i++;
                }
				if(isset($_GET['id_komunitas']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_komunitas WHERE id_komunitas=".$_GET['id_komunitas']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_komunitas.php">';
                      }
                  }
                ?>
              </table>
			  <ul class="pagination">
				<?php
				$res    = mysql_query("SELECT * FROM tbl_komunitas, tbl_jenjang, tbl_kategori_komunitas WHERE tbl_komunitas.id_jenjang = tbl_jenjang.id_jenjang AND tbl_komunitas.id_kategori_k = tbl_kategori_komunitas.id_kategori_k ORDER BY $orderBy $statusbaru");
				$hitung = mysql_num_rows($res);
				$jum    = $hitung/5;
				$jumlah = ceil($jum);
				for($i=1; $i<=$jumlah; $i++){
					echo "<li><a href='v_komunitas.php?halaman=$i'>".$i."</a></li>";
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
