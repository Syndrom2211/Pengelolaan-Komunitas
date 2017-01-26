<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['no_ktp'])){
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
			<form style="margin:0px;" method="POST" action="cari_anggota.php">
				<div class="widget-header">
				  <i class="icon-user"></i>
				  <h3></a> List Anggota <?php echo $_SESSION['nama']; ?></h3>
				  
				  
				  <div style="float:right;">
				  	<input name="datacari" style="width:250px;margin:6px 0px 6px 0px;" type="text" class="span6" id="lastname" placeholder="Masukan kata pencarian..." >
				    <select name="tipecari" style="width:150px;margin:6px 0px 6px 0px;">
						<option value="nama_lengkap">Nama Lengkap</option>
						<option value="username">Username</option>
						<option value="email">Email</option>
						<option value="status_jabatan">Status Jabatan</option>
					</select>
					<input type="submit" style="margin:6px 15px 6px 0px;" class="btn btn-primary" value="Cari Data">
				  </div>
				  
				  
				</div> <!-- /widget-header -->
			</form>

            <div class="widget-content">
			<?php
              include "../include/koneksi.php";
              if(isset($_GET['lihat']) != ""){
                  $no_ktp   = $_GET['lihat'];
                  $sql     = mysql_query("SELECT * FROM tbl_anggota WHERE no_ktp=".$no_ktp."");
                  $num     = mysql_fetch_array($sql);
            ?>
			<style type="text/css">
              table,tr,td{
                  margin:5px;
                  padding:5px;
              }
              </style>
                  <table cellpadding="0" cellspacing="0">
				  <tr>
					<td>No KTP</td>
                      <td>:</td>
                      <td>
						<?php echo $num["no_ktp"]; ?>
					  </td>
				  </tr>
				  <tr>
					<td>Nama Lengkap</td>
                      <td>:</td>
                      <td>
						<?php echo $num["nama_lengkap"]; ?>
					  </td>
				  </tr>
				  <tr>
                      <td>Jenis Kelamin</td>
                      <td>:</td>
                      <td>
						<?php echo $num["jenis_kelamin"]; ?>			  
                      </td>
                  </tr>
				  <tr>
					<td>Alamat</td>
                      <td>:</td>
                      <td>
						<?php echo $num["alamat"]; ?>
					  </td>
				  </tr>
				  <tr>
                      <td>Foto</td>
                      <td>:</td>
                      <td>
                        <a href="<?php echo "../images/foto_anggota/".$num['foto']; ?>" target="_blank"><img src="<?php echo "../images/foto_anggota/".$num['foto']; ?>" width="120px" height="120px" /></a>
                      </td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td><i>(klik gambar untuk memperbesar)</i></td>
                  </tr>
				  <tr>
					<td>Username</td>
                      <td>:</td>
                      <td>
						<?php echo $num["username"]; ?>
					  </td>
				  </tr>
				  <tr>
					<td>No Handphone</td>
                      <td>:</td>
                      <td>
						<?php echo $num["no_hp"]; ?>
					  </td>
				  </tr>
				  <tr>
					<td>Email</td>
                      <td>:</td>
                      <td>
						<?php echo $num["email"]; ?>
					  </td>
				  </tr>
				  <tr>
					<td>Link Facebook</td>
                      <td>:</td>
                      <td>
						<?php echo $num["link_facebook"]; ?>
					  </td>
				  </tr>
				  <tr>
					<td>Motivasi</td>
                      <td>:</td>
                      <td>
						<?php echo $num["motivasi"]; ?>
					  </td>
				  </tr>
				  <tr>
                      <td>Status Jabatan</td>
                      <td>:</td>
                      <td>
						<?php echo $num["status_jabatan"]; ?>
                      </td>
                  </tr>		  
                  </table>
			  <?php
			  }else{
				  $id_komun = $_SESSION['id_komunitas'];
				  $no_ktp = $_SESSION['no_ktp'];
				  $totalkueri = mysql_query("SELECT * FROM tbl_detail_anggota WHERE no_ktp = '$no_ktp' AND id_komunitas = '$id_komun'");
				  $total = mysql_num_rows($totalkueri);
			  ?>
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a> 
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="v_anggota.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="v_anggota.php?by=username&method=asc"><i class="i"></i> Username </a></li>
												<li><a href="v_anggota.php?by=status_jabatan&method=asc"><i class="i"></i> Status Jabatan </a></li>
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
                                                <li><a href="v_anggota.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="v_anggota.php?by=username&method=desc"><i class="i"></i> Username </a></li>
												<li><a href="v_anggota.php?by=status_jabatan&method=desc"><i class="i"></i> Status Jabatan </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
					<th> Foto </th>
                    <th> Nama Lengkap </th>
                    <th> Username </th>
                    <th> Email </th>
                    <th> Status Jabatan </th>
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
				}else if($_GET['by']=="username" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_anggota.username";
				}else if($_GET['by']=="status_jabatan" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_anggota.status_jabatan";
				}
				
				// Descending
				else if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="username" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.username";
				}else if($_GET['by']=="status_jabatan" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.status_jabatan";
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
				
				$sql = mysql_query("SELECT * FROM tbl_anggota INNER JOIN tbl_detail_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp WHERE tbl_detail_anggota.id_komunitas = '$id_komun' ORDER BY $orderBy $statusbaru LIMIT $posisi,5");
                while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><center><a target="_blank" href="../images/foto_anggota/<?php echo $hasil['foto']; ?>"><img src="../images/foto_anggota/<?php echo $hasil['foto']; ?>" width="50px" /></a></center></td>
					<td><?php echo $hasil['nama_lengkap']; ?></td>
					<td><?php echo $hasil['username']; ?></td>
					<td><?php echo $hasil['email']; ?></td>
					<td><?php echo $hasil['status_jabatan']; ?></td>
                    <td class="td-actions">
						<a href="v_anggota.php?lihat=<?php echo $hasil['no_ktp']; ?>"><button class="btn btn-success"><i class="icon-large icon-search
"></i> Lihat Detail</button></a>
					</td>
                  </tr>
                </tbody>
                <?php
                $i++;
                }
                ?>
              </table>
			  <ul class="pagination">
				<?php
				$res    = mysql_query("SELECT * FROM tbl_anggota ORDER BY $orderBy $statusbaru");
				$hitung = mysql_num_rows($res);
				$jum    = $hitung/5;
				$jumlah = ceil($jum);
				for($i=1; $i<=$jumlah; $i++){
					echo "<li><a href='v_anggota.php?halaman=$i'>".$i."</a></li>";
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
    header("location:../relog.php");
}
?>
