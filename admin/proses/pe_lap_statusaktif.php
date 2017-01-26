<?php
//File Koneksi
include "../../include/koneksi.php";
$no_ktp		    		= $_POST['no_ktp'];
$status_anggota			= $_POST['status_anggota'];

if(empty($status_anggota)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../lap_statusaktif.php">';
}else{
	$sql	= "UPDATE tbl_detail_anggota SET status_anggota='$status_anggota' WHERE tbl_detail_anggota.no_ktp = $no_ktp";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../lap_statusaktif.php">';
}
?>