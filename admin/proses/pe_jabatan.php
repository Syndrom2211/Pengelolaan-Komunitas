<?php
//File Koneksi
include "../../include/koneksi.php";
$id_jabatan			    = $_POST['id_jabatan'];
$jabatan				= $_POST['jabatan'];

if(empty($jabatan)){
	echo "<script language='javascript'>alert('Data jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_jabatan.php">';
}else{
	$sql	= "UPDATE tbl_jabatan SET jabatan='$jabatan' WHERE tbl_jabatan.id_jabatan = $id_jabatan";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_jabatan.php">';
}
?>