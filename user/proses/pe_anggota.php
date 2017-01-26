<?php
//File Koneksi
include "../../include/koneksi.php";
$no_ktp			    = $_POST['no_ktp'];
$username			= $_POST['username'];
$password			= $_POST['password'];
$password_lama     	= $_POST['password_lama'];
$foto_lama			= $_POST['foto_lama'];

// Untuk Foto
define("WIDTH", "113");
define("HEIGHT", "170");
$ekstensi_diperbolehkan = array('png','jpg');
$nama 					= $_POST["nama_lengkap"]."-".$_FILES['file']['name'];
$x 						= explode('.',$nama);
$ekstensi 				= strtolower(end($x));
$ukuran					= $_FILES['file']['size'];
$file_tmp				= $_FILES['file']['tmp_name'];

if(empty($username)){
	echo "<script language='javascript'>alert('Data username jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else if($_POST["konfirmasi_password"] != $password){
	echo "<script language='javascript'>alert('Password tidak cocok !');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else if(empty($_POST["password"]) && empty($_FILES['file']['name'])){
	$sql	= "UPDATE tbl_anggota SET username='$username', password='$password_lama', foto='$foto_lama' WHERE tbl_anggota.no_ktp = $no_ktp";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else if(empty($_FILES['file']['name'])){
	$sql	= "UPDATE tbl_anggota SET username='$username', password='".md5($password)."', foto='$foto_lama' WHERE tbl_anggota.no_ktp = $no_ktp";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else if(empty($_POST["password"]) && (in_array($ekstensi, $ekstensi_diperbolehkan) == true)){
	list($file_width, $file_height) = getimagesize($file_tmp);
	if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/foto_anggota/'.$nama);
			$sql	= "UPDATE tbl_anggota SET username='$username', password='$password_lama', foto='$nama' WHERE tbl_anggota.no_ktp = $no_ktp";
			$num 	= mysql_query($sql);
			echo "<script language='javascript'>alert('Data berhasil diubah');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
		}
}else if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
	list($file_width, $file_height) = getimagesize($file_tmp);
	if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/foto_anggota/'.$nama);
			$sql	= "UPDATE tbl_anggota SET username='$username', password='".md5($password)."', foto='$nama' WHERE tbl_anggota.no_ktp = $no_ktp";
			$num 	= mysql_query($sql);
			echo "<script language='javascript'>alert('Data berhasil diubah');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
		}
}else{
		echo "<script language='javascript'>alert('Data gagal di edit!');</script>";
		echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}
?>
