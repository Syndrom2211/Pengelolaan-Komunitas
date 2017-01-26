<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['no_ktp'])){
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
			<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Catatan :</strong><br/>Feedback ini di isi sebagai suatu rasa timbal balik setelah kalian mengikuti komunitas yang kalian ikuti.
              </div>
              <div class="tab-pane" id="formcontrols">
                <?php
				include "../include/koneksi.php";
				$no_ktpnya = $_SESSION['no_ktp'];
                $sql = mysql_query("SELECT * FROM tbl_feedback INNER JOIN tbl_anggota ON tbl_feedback.no_ktp = tbl_anggota.no_ktp INNER JOIN tbl_komunitas ON tbl_feedback.id_komunitas = tbl_komunitas.id_komunitas WHERE tbl_anggota.no_ktp = '$no_ktpnya'");
                $num = mysql_fetch_array($sql);
                ?>
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="username">Nama Lengkap</label>
                    <div class="controls">
                      <input type="text" class="span6 disabled" id="nama_lengkap" value="<?php echo $_SESSION['nama_lengkap']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->

                  <div class="control-group">
                    <label class="control-label" for="password">Komunitas</label>
                    <div class="controls">
                      <input class="span6 disabled" id="password" type="text" value="<?php echo $_SESSION['nama']; ?>" disabled>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
				  
				  <div class="control-group">
                    <label class="control-label" for="password">Isi Feedback</label>
                    <div class="controls">
                      <textarea disabled><?php echo $num['catatan']; ?></textarea>
                    </div>
                    <!-- /controls -->
                  </div> <!-- /control-group -->
                </fieldset>
                </form>
                <div class="form-actions">
				  <?php
				  if($num['catatan'] != NULL){
					 //  
				  }else{
				  ?>
					<a href="vt_feedback.php"><button class="btn btn-primary">Isi Feedback</button></a>&nbsp;
				<?php
				 }
				 ?>
				</div> <!-- /form-actions -->

            </div>

<!-- LIHAT FEEDBACK -->
<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Catatan :</strong><br/>List feedback dari keseluruhan anggota
              </div>
			  <!-- ASCENDING -->
			  <div class="control-group" style="float:right;margin-left:5px;">
                                            <div class="controls">
                                              <div class="btn-group">
                                              <a class="btn btn-primary" style="width:100px" href="#"><i class="icon-small icon-chevron-up
"></i> Sorting Data</a> 
                                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                <li><a href="v_feedback.php?by=nama_lengkap&method=asc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="v_feedback.php?by=nama&method=asc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="v_feedback.php?by=tanggal&method=asc"><i class="i"></i> Tanggal </a></li>
												<li><a href="v_feedback.php?by=catatan&method=asc"><i class="i"></i> Feedback </a></li>
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
                                                <li><a href="v_feedback.php?by=nama_lengkap&method=desc"><i class="i"></i> Nama Lengkap </a></li>
												<li><a href="v_feedback.php?by=nama&method=desc"><i class="i"></i> Nama Komunitas </a></li>
												<li><a href="v_feedback.php?by=tanggal&method=desc"><i class="i"></i> Tanggal </a></li>
												<li><a href="v_feedback.php?by=catatan&method=desc"><i class="i"></i> Feedback </a></li>
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
                    <th> Nama Komunitas </th>
                    <th> Tanggal </th>
					<th> Link Facebook </th>
                    <th> Feedback </th>
                  </tr>
                </thead>
                <?php
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
					<td><center><a target="_blank" href="../images/foto_anggota/<?php echo $hasil['foto']; ?>"><img src="../images/foto_anggota/<?php echo $hasil['foto']; ?>" width="50px" /></a></center></td>
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
					echo "<li><a href='v_feedback.php?halaman=$i'>".$i."</a></li>";
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
    header("location:../relog.php");
}
?>
