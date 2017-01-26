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
              <i class="icon-cog"></i>
              <h3>Backup/Restore Database</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tabbable">
						<ul class="nav nav-tabs">
						  <li>
						    <a href="#formcontrols" data-toggle="tab"><font color="#3e4fc7">Backup</font></a>
						  </li>
						  <li  class="active"><a href="#jscontrols" data-toggle="tab"><font color="#3e4fc7">Restore</font></a></li>
						</ul>

						<br>
							<div class="tab-content">
								<div class="tab-pane" id="formcontrols">
								<form name="backup" action="proses/p_backuprestore.php?download=backup" method="POST" id="edit-profile" class="form-horizontal" target="_blank">
									<fieldset>

										<div class="alert alert-success">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              Tekan tombol dibawah untuk membackup database <strong>"carkom"</strong>
                                            </div>
											<input type="submit" name="backup" class="btn btn-primary" value="Backup !">
									</fieldset>
								</form>
								</div>

								<div class="tab-pane active" id="jscontrols">
									<form enctype="multipart/form-data" method="POST" id="edit-profile2" class="form-vertical">
										<fieldset>

											<div class="alert alert-success">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              Restore semua data dari data <strong>.sql</strong>
                                            </div>
											
										<input type="file" name="datafile" size="30" />
										<br/>
										<button type="submit" name="restore" class="btn btn-primary">Restore !</button></a>
										
											
										</fieldset>
									</form>
									<?php
											if(isset($_POST['restore'])){
												include "../include/koneksi.php";
												$nama_file=$_FILES['datafile']['name'];
												$ukuran=$_FILES['datafile']['size'];
												if ($nama_file==""){
													echo "Fatal Error";
												}else{
												//definisikan variabel file dan alamat file
												$ekstensi_diperbolehkan = array('sql');
												$x 						= explode('.',$nama_file);
												$ekstensi 				= strtolower(end($x));
													$uploaddir='../restore/';
													$alamatfile=$uploaddir.$nama_file;
													if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
														if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile)){
															$filename = '../restore/'.$nama_file.'';									
															$templine = '';
															$lines = file($filename);
																foreach ($lines as $line){
																	if (substr($line, 0, 2) == '--' || $line == '')
																	continue;
																	$templine .= $line;
																	if (substr(trim($line), -1, 1) == ';'){
																		mysql_query($templine) or print("Error performing query ".$templine." : ".mysql_error());
																		$templine = '';
																	}
																}
															echo "<script language='javascript'>alert('Restore database berhasil !');</script>";
															echo '<meta http-equiv="refresh" content="0; url=v_backuprestore.php">';
														}
														else{
															echo "Restore Database Gagal, kode error = " . $_FILES['location']['error'];
														}	
													}else{
														echo "<script language='javascript'>alert('Error : Ekstensi file bukan SQL !');</script>";
														echo '<meta http-equiv="refresh" content="0; url=v_backuprestore.php">';
													}
												}
											}
											else{
												unset($_POST['restore']);
											}
										?>
								</div>

							</div>


						</div>
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
