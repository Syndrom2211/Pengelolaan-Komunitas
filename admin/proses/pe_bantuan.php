<?php
//File Koneksi
include "../../include/koneksi.php";
$id_bantuan		    = $_POST['id_bantuan'];
$penjelasan			= $_POST['penjelasan'];

if(empty($penjelasan)){
	echo "<script language='javascript'>alert('Data jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_bantuan.php">';
}else{
	$sql	= "UPDATE tbl_bantuan_registrasi SET penjelasan='$penjelasan' WHERE tbl_bantuan_registrasi.id_bantuan = $id_bantuan";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_bantuan.php">';
}
?>