<?php
//File Koneksi
include "../../include/koneksi.php";
$id_rutinan			    = $_POST['id_rutinan'];
$jenis_biaya			= $_POST['jenis_biaya'];

if(empty($jenis_biaya)){
	echo "<script language='javascript'>alert('Data jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_biaya_rutinan.php">';
}else{
	$sql	= "UPDATE tbl_biaya_rutinan_komunitas SET jenis_biaya='$jenis_biaya' WHERE tbl_biaya_rutinan_komunitas.id_rutinan = $id_rutinan";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_biaya_rutinan.php">';
}
?>