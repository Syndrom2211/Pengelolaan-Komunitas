<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['id_admin'])){
    header('location:index.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header.php"; ?>

			<div class="nav-collapse">
				<ul class="nav pull-right">

					<li class="">

					</li>
				</ul>

			</div><!--/.nav-collapse -->

		</div> <!-- /container -->

	</div> <!-- /navbar-inner -->

</div> <!-- /navbar -->

<div class="account-container">

	<div class="content clearfix">
	<table border="0">
		<tr>
		<?php 
		//membuat koneksi ke mysql
		$connect=mysql_connect($_POST['host'],$_POST['user'],$_POST['pass'])or die ("<td><b>Error : </b> <font color='red'>Gagal membuat koneksi database !</font></td>");
		echo "<td><b>Status : </b><font color='green'>Berhasil terkoneksi ke server mysql !</font></td>";
		?>
		</tr>
		<tr>
		<?php
		//membuat database
		$buat_db=mysql_query("create database ".$_POST['db']."") or die ("<td><b>Error : </b> <font color='red'>Gagal membuat database !</font></td>");
		echo "<td><b>Status : </b><font color='green'>Berhasil membuat database !</font></td>";
		?>
		</tr>
		<tr>
		<?php
		//membuka database yang telah dibuat
		$db=mysql_select_db($_POST['db'])or die ("<td><b>Error : </b> <font color='red'>Database tidak ditemukan !</font></td>");
		echo "<td><b>Status : </b><font color='green'>Database berhasil ditemukan !</font></td>";
		?>
		</tr>
		<tr>
		<?php
		//membuat file koneksi.php
		$file_config = fopen('../include/koneksi.php', 'w+');
		fwrite($file_config, "<?php \r\n");
		fwrite($file_config, "\$server='".$_POST['host']."'; \r\n");
		fwrite($file_config, "\$user='".$_POST['user']."'; \r\n");
		fwrite($file_config, "\$password='".$_POST['pass']."'; \r\n");
		fwrite($file_config, "\$database='".$_POST['db']."'; \r\n");
		fwrite($file_config, "\n");
		fwrite($file_config, "\n");
		fwrite($file_config, "mysql_connect(\$server, \$user, \$password); \n");
		fwrite($file_config, "mysql_select_db(\$database); \n");
		fwrite($file_config, "?>");
		fclose($file_config);
		?>
		</tr>
		<tr>
		<?php
											if(isset($_POST['submit'])){
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
															echo "<td><b>Status : </b><font color='green'>Upload data SQL berhasil !</font></td>";
														}
														else{
															echo "<td><b>Error : </b> <font color='red'>Upload data SQL gagal !</font></td> kode error = " . $_FILES['location']['error'];
														}	
													}else{
														echo "<td><b>Error : </b> <font color='red'>Ekstensi File bukan SQL !</font></td>";
													}
												}
											}
											else{
												unset($_POST['submit']);
											}
										?>
		</tr>
		<tr>
		<?php
		//memindahkan ke index.php
		echo "<td>Berhasil membuat file <b>koneksi.php</b>, silahkan RESTORE file .sql nya di halaman admin <b>(Pengaturan Lainnya->Backup/Restore)</b>";
		echo "&nbsp;<a href='../admin/'>Klik disini untuk login ke halaman admin</a></td>";
		?>
		</tr>
	</table>
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
<?php
}
?>
