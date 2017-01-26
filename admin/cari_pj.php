<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']) && (isset($_SESSION['id_admin']))){
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
			<form style="margin:0px;" method="POST" action="cari_pj.php">
				<div class="widget-header">
				  <i class="icon-user-md"></i>
				  <h3></a> List Penanggung Jawab</h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama_komunitas">Nama Komunitas</option>
						<option value="pj">Penanggung Jawab</option>
						<option value="periode_mulai">Periode Mulai</option>
						<option value="periode_akhir">Periode Akhir</option>
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
                  $sql     = mysql_query("SELECT * FROM tbl_penanggung_jawab INNER JOIN tbl_komunitas ON tbl_penanggung_jawab.id_komunitas = tbl_komunitas.id_komunitas INNER JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_penanggung_jawab.no_ktp AND tbl_penanggung_jawab.no_ktp=".$no_ktp."");
                  $num     = mysql_fetch_array($sql);
              ?>
              <style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
			  <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Catatan :</strong>
				  <br/>
				  Penanggung Jawab Sekarang : <b>Nama Penanggung Jawab, Periode Awal, Periode Akhir</b>
				  <br/>
				  Penanggung Jawab Baru		: <b>Nama Penanggung Jawab, Periode Awal, Periode Akhir</b>
				  <br/><br/>
				  Sebelum Mengubah, pastikan :
				  <br/>
				  *Status Jabatan = <b>Anggota</b><br/>
				  *Status Keaktifan = <b>Aktif</b><br/>
				  *Status Transaksi = <b>Sudah Bayar</b><br/>
              </div>
              <form action="proses/pe_pj.php" method="POST">
                  <table cellpadding="0" cellspacing="0">
                  <tr>
                      <td>Penanggung Jawab Sekarang</td>
                      <td>:</td>
                      <td>
                          <input type="hidden" class="form-control" name="no_ktp" value="<?php echo $no_ktp; ?>" />
						  <input type="hidden" class="form-control" name="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" />
						  <input type="hidden" class="form-control" name="id_komunitas" value="<?php echo $num['id_komunitas']; ?>" />
						  <input type="hidden" class="form-control" name="status_akhir" value="<?php echo $num['status_jabatan']; ?>" />
						  <input type="hidden" class="form-control" name="keterangan" value="Pensiun dan Menjadi Anggota Biasa" />
                          <input type="text" class="form-control" name="pj_sekarang" value="<?php echo $num['nama_lengkap']; ?>" readonly />
						  <input type="text" class="form-control" name="periode_awal_sekarang" value="<?php echo $num['periode_mulai']; ?>" readonly />
						  <input type="text" class="form-control" name="periode_akhir_sekarang" value="<?php echo $num['periode_akhir']; ?>" readonly />
                      </td>
                  </tr>
                  <tr>
                      <td>Penanggung Jawab Baru</td>
                      <td>:</td>
                      <td>
						<select name="pj_baru">
							<option value="-">-</option>
							<?php
							$sql = mysql_query("SELECT * FROM tbl_anggota, tbl_detail_anggota WHERE tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp");
							while($hasil = mysql_fetch_array($sql)){
								if(($hasil['status_anggota']=="Aktif") && ($hasil['status_bayar']=="Sudah Bayar") && ($hasil['status_jabatan']=="Anggota Biasa") && ($hasil['id_komunitas']==$num['id_komunitas'])){
									?>
										<option value="<?php echo $hasil['no_ktp']; ?>"><?php echo "(".$hasil['no_ktp'].") ".$hasil['nama_lengkap']; ?></option>
									<?php
								}
							}
							?>
						</select>
						<input type="text" class="form-control" name="periode_awal_selanjutnya" value="<?php echo $num['periode_akhir']; ?>" readonly />
						<input type="text" class="form-control" name="periode_akhir_selanjutnya" id="periode_akhir" />
						<input type="hidden" class="form-control" name="tgl_sekarang" value="<?php $tgl = date('Y-m-d'); echo $tgl; ?>" />
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
                  <strong>Catatan :</strong><br/>Data penanggung jawab dengan periodenya dari masing - masing komunitas.
              </div>
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a>
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="v_pj.php?by=nama&method=asc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="v_pj.php?by=nama_lengkap&method=asc"><i class="i"></i> Penanggung Jawab </a></li>
												<li><a href="v_pj.php?by=periode_mulai&method=asc"><i class="i"></i> Periode Mulai </a></li>
												<li><a href="v_pj.php?by=periode_akhir&method=asc"><i class="i"></i> Periode Akhir </a></li>
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
                                                <li><a href="v_pj.php?by=nama&method=desc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="v_pj.php?by=nama_lengkap&method=desc"><i class="i"></i> Penanggung Jawab </a></li>
												<li><a href="v_pj.php?by=periode_mulai&method=desc"><i class="i"></i> Periode Mulai </a></li>
												<li><a href="v_pj.php?by=periode_akhir&method=desc"><i class="i"></i> Periode Akhir </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nama Komunitas </th>
                    <th> Foto Penanggung Jawab </th>
					<th> Penanggung Jawab </th>
                    <th> Periode Mulai </th>
                    <th> Periode Akhir </th>
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
				}else if($_GET['by']=="periode_mulai" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_penanggung_jawab.periode_mulai";
				}else if($_GET['by']=="periode_akhir" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_penanggung_jawab.periode_akhir";
				
				
				// DESCENDING
				}else if($_GET['by']=="nama" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="periode_mulai" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_penanggung_jawab.periode_mulai";
				}else if($_GET['by']=="periode_akhir" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_penanggung_jawab.periode_akhir";
				}else{
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
				}
				
				if($_POST['tipecari'] == "nama_komunitas"){
					$sql = mysql_query("SELECT * FROM tbl_penanggung_jawab LEFT JOIN tbl_komunitas ON tbl_penanggung_jawab.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_penanggung_jawab.no_ktp WHERE nama LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "pj"){
					$sql = mysql_query("SELECT * FROM tbl_penanggung_jawab LEFT JOIN tbl_komunitas ON tbl_penanggung_jawab.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_penanggung_jawab.no_ktp WHERE nama_lengkap LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "periode_mulai"){
					$sql = mysql_query("SELECT * FROM tbl_penanggung_jawab LEFT JOIN tbl_komunitas ON tbl_penanggung_jawab.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_penanggung_jawab.no_ktp WHERE periode_mulai LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}else if($_POST['tipecari'] == "periode_akhir"){
					$sql = mysql_query("SELECT * FROM tbl_penanggung_jawab LEFT JOIN tbl_komunitas ON tbl_penanggung_jawab.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_penanggung_jawab.no_ktp WHERE periode_akhir LIKE '%$data%' ORDER BY $orderBy $statusbaru");
				}
				
                while($hasil=mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $hasil['nama']; ?></td>
					<td><center><a target="_blank" href="../images/foto_anggota/<?php echo $hasil['foto']; ?>"><img src="../images/foto_anggota/<?php echo $hasil['foto']; ?>" width="50px" /></a></center></td>
                    <td><?php echo $hasil['nama_lengkap']; ?></td>
                    <td><?php echo $hasil['periode_mulai']; ?></td>
					<td><?php echo $hasil['periode_akhir']; ?></td>
                    <td class="td-actions">
                        <a href="v_pj.php?edit=<?php echo $hasil['no_ktp']; ?>"><button class="btn btn-success"><i class="icon-large icon-pencil
"></i> Edit</button></a>&nbsp;
                        &nbsp;<?php echo "<a href='#' onClick=\"return konfirmasiHapusPenanggungJawab('".$hasil["no_ktp"]."','".$hasil["nama_lengkap"]."');\" value='Hapus'><button class='btn btn-danger'><i class='icon-large icon-trash
'></i> Hapus</button></a>"; ?>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  }
                  if(isset($_GET['no_ktp']) != ""){
                      $hapus = mysql_query("DELETE FROM tbl_penanggung_jawab WHERE no_ktp=".$_GET['no_ktp']."");
                      if($hapus){
                          echo "<script language='javascript'>alert('Data berhasil di hapus');</script>";
                          echo '<meta http-equiv="refresh" content="0; url=v_pj.php">';
                      }
                  }
                  ?>
                </tbody>
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
