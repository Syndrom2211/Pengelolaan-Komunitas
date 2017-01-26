<?php
//File Koneksi
include "../../include/koneksi.php";
$no_ktp		        = $_POST['no_ktp'];
$nama_lengkap		= $_POST['nama_lengkap'];
$jenis_kelamin		= $_POST['jenis_kelamin'];
$alamat			    = $_POST['alamat'];
$foto_lama			= $_POST['foto_lama'];
$username		    = $_POST['username'];
$password		    = $_POST['password'];
$password_baru		= $_POST['password_baru'];
$no_hp			    = $_POST['no_handphone'];
$email			    = $_POST['email'];
$link_facebook	    = $_POST['link_facebook'];
$motivasi		    = $_POST['motivasi'];
$status_jabatan	    = $_POST['status_jabatan'];

// Untuk Foto
define("WIDTH", "113");
define("HEIGHT", "170");
$ekstensi_diperbolehkan = array('png','jpg');
$nama 					= $_POST["nama_lengkap"]."-".$_FILES['file']['name'];
$x 						= explode('.',$nama);
$ekstensi 				= strtolower(end($x));
$ukuran					= $_FILES['file']['size'];
$file_tmp				= $_FILES['file']['tmp_name'];

// Upload File
if(empty($no_ktp) || empty($nama_lengkap) || empty($jenis_kelamin) || empty($alamat) || empty($username) || empty($no_hp) || empty($email)
	|| empty($link_facebook) || empty($motivasi) || empty($status_jabatan)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
}else if(empty($_POST["password_baru"]) && empty($_FILES['file']['name'])){
	$sql	= "UPDATE tbl_anggota SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin',
				 alamat='$alamat', foto='$foto_lama',
				 username='$username', password='$password', no_hp='$no_hp', email='$email', link_facebook='$link_facebook', motivasi='$motivasi', status_jabatan='$status_jabatan' WHERE tbl_anggota.no_ktp = $no_ktp";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
}else if(empty($_FILES['file']['name'])){
	$sql	= "UPDATE tbl_anggota SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin',
				 alamat='$alamat', foto='$foto_lama',
				 username='$username', password='".md5($password_baru)."', no_hp='$no_hp', email='$email', link_facebook='$link_facebook', motivasi='$motivasi', status_jabatan='$status_jabatan' WHERE tbl_anggota.no_ktp = $no_ktp";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
}else if(empty($_POST["password_baru"]) && (in_array($ekstensi, $ekstensi_diperbolehkan) == true)){
	list($file_width, $file_height) = getimagesize($file_tmp);
	if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/foto_anggota/'.$nama);
			$sql	= "UPDATE tbl_anggota SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin',
				 alamat='$alamat', foto='$nama',
				 username='$username', password='$password', no_hp='$no_hp', email='$email', link_facebook='$link_facebook', motivasi='$motivasi', status_jabatan='$status_jabatan' WHERE tbl_anggota.no_ktp = $no_ktp";
			$num 	= mysql_query($sql);
			echo "<script language='javascript'>alert('Data berhasil diubah');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}
}else if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
	list($file_width, $file_height) = getimagesize($file_tmp);
	if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/foto_anggota/'.$nama);
			$sql = "UPDATE tbl_anggota SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin',
				 alamat='$alamat', foto='$nama',
				 username='$username', password='".md5($password_baru)."', no_hp='$no_hp', email='$email', link_facebook='$link_facebook', motivasi='$motivasi', status_jabatan='$status_jabatan' WHERE tbl_anggota.no_ktp = $no_ktp";
			$num 	= mysql_query($sql);
			echo "<script language='javascript'>alert('Data berhasil diubah');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}
}else{
	echo "<script language='javascript'>alert('Error : Ekstensi gambar tidak sesuai dengan yang ditentukan, harus JPG atau PNG');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
}
?>
