<?php
//File Koneksi
include "../../include/koneksi.php";
$id_info			    = $_POST['id_info'];
$no_hp					= $_POST['no_hp'];
$email					= $_POST['email'];
$alamat					= $_POST['alamat'];
$maps					= $_POST['maps'];
$link_facebook			= $_POST['link_facebook'];
$link_twitter			= $_POST['link_twitter'];
$tentang				= $_POST['tentang'];


if(empty($no_hp) || empty($email) || empty($alamat) || empty($maps) || empty($link_facebook) || empty($link_twitter) || empty($tentang)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_info.php">';
}else{
	$sql	= "UPDATE tbl_info SET no_hp='$no_hp', email='$email', alamat='$alamat', maps='$maps', facebook='$link_facebook', twitter='$link_twitter', tentang='$tentang' WHERE tbl_info.id_info = $id_info";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_info.php">';
}
?>