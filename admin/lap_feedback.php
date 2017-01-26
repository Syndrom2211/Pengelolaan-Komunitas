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
        <div class="widget ">

            <div class="widget-header">
              <i class="icon-copy"></i>
              <h3>Feedback</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

<!-- LIHAT FEEDBACK -->
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a> 
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="lap_feedback.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="lap_feedback.php?by=nama&method=asc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="lap_feedback.php?by=tanggal&method=asc"><i class="i"></i> Tanggal </a></li>
												<li><a href="lap_feedback.php?by=catatan&method=asc"><i class="i"></i> Feedback </a></li>
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
                                                <li><a href="lap_feedback.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="lap_feedback.php?by=nama&method=desc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="lap_feedback.php?by=tanggal&method=desc"><i class="i"></i> Tanggal </a></li>
												<li><a href="lap_feedback.php?by=catatan&method=desc"><i class="i"></i> Feedback </a></li>
                                              </ul>
                                            </div>
                                              </div>
											  </div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nama Lengkap </th>
                    <th> Nama Komunitas </th>
                    <th> Tanggal </th>
					<th> Link Facebook </th>
                    <th> Feedback </th>
                  </tr>
                </thead>
                <?php
				include "../include/koneksi.php";
				error_reporting(0);
				$i = 1;
				$status = "DESC";
				
				// Ascending
				if($_GET['by']=="nama_lengkap" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="nama" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="tanggal" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_feedback.tanggal";
				}else if($_GET['by']=="catatan" && $_GET['method']=="asc"){
					$statusbaru = $status;
					$orderBy = "tbl_feedback.catatan";
				}
				
				// Descending
				else if($_GET['by']=="nama_lengkap" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_anggota.nama_lengkap";
				}else if($_GET['by']=="nama" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_komunitas.nama";
				}else if($_GET['by']=="tanggal" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_feedback.tanggal";
				}else if($_GET['by']=="catatan" && $_GET['method']=="desc"){
					$statusbaru = "DESC";
					$orderBy = "tbl_feedback.catatan";
				}else{
					$statusbaru = $status;
					$orderBy = "tbl_feedback.tanggal";
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
				
				$sql = mysql_query("SELECT * FROM tbl_feedback INNER JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_feedback.no_ktp INNER JOIN tbl_komunitas ON tbl_komunitas.id_komunitas = tbl_feedback.id_komunitas ORDER BY $orderBy $statusbaru LIMIT $posisi,5");
                while($hasil = mysql_fetch_array($sql)){
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $i; ?></td>
					<td><?php echo $hasil['nama_lengkap']; ?></td>
					<td><?php echo $hasil['nama']; ?></td>
					<td><?php echo $hasil['tanggal']; ?></td>
					<td><?php echo $hasil['link_facebook']; ?></td>
					<td><?php echo $hasil['catatan']; ?></td>
                  </tr>
                </tbody>
                <?php
                $i++;
                }
                ?>
              </table>
			  <ul class="pagination">
				<?php
				$res    = mysql_query("SELECT * FROM tbl_feedback INNER JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_feedback.no_ktp INNER JOIN tbl_komunitas ON tbl_komunitas.id_komunitas = tbl_feedback.id_komunitas ORDER BY $orderBy $statusbaru");
				$hitung = mysql_num_rows($res);
				$jum    = $hitung/5;
				$jumlah = ceil($jum);
				for($i=1; $i<=$jumlah; $i++){
					echo "<li><a href='lap_feedback.php?halaman=$i'>".$i."</a></li>";
				}
				?>
			  </ul>
			
        </div></div>
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
