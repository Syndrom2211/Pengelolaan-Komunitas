<?php
//File Koneksi
include "../../include/koneksi.php";
$id_jenjang		    = $_POST['id_jenjang'];
$jenjang			= $_POST['jenjang'];


if(empty($jenjang)){
	echo "<script language='javascript'>alert('Data jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_jenjang.php">';
}else{
	$sql	= "UPDATE tbl_jenjang SET jenjang='$jenjang' WHERE tbl_jenjang.id_jenjang = $id_jenjang";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_jenjang.php">';
}
?>