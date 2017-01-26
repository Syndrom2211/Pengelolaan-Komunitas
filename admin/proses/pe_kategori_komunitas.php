<?php
//File Koneksi
include "../../include/koneksi.php";
$id_kategori_k		    = $_POST['id_kategori_k'];
$jenis_kategori			= $_POST['jenis_kategori'];


if(empty($jenis_kategori)){
	echo "<script language='javascript'>alert('Data jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_k_artikel.php">';
}else{
	$sql	= "UPDATE tbl_kategori_komunitas SET jenis_kategori='$jenis_kategori' WHERE tbl_kategori_komunitas.id_kategori_k = $id_kategori_k";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_k_komunitas.php">';
}
?>