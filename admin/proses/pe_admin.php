<?php
//File Koneksi
include "../../include/koneksi.php";
$id_admin		    = $_POST['id_admin'];
$username			= $_POST['username'];
$password			= $_POST['password'];
$password_lama     	= $_POST['password_lama'];


if(empty($username)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else if(empty($_POST["password"])){
	$sql	= "UPDATE tbl_admin SET username='$username', password='$password_lama' WHERE tbl_admin.id_admin = $id_admin";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else if(!empty($_POST["password"])){
	$sql	= "UPDATE tbl_admin SET username='$username', password='".md5($password)."' WHERE tbl_admin.id_admin = $id_admin";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}else{
		echo "<script language='javascript'>alert('Data gagal di edit!');</script>";
		echo '<meta http-equiv="refresh" content="0; url=../v_setting.php">';
}
?>
