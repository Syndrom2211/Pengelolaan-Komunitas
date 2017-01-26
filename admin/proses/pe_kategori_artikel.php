<?php
//File Koneksi
include "../../include/koneksi.php";
$id_kategori_a		    = $_POST['id_kategori_a'];
$nama_kategori			= $_POST['nama_kategori'];


if(empty($nama_kategori)){
	echo "<script language='javascript'>alert('Data jangan di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_k_artikel.php">';
}else{
	$sql	= "UPDATE tbl_kategori_artikel SET nama_kategori='$nama_kategori' WHERE tbl_kategori_artikel.id_kategori_a = $id_kategori_a";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_k_artikel.php">';
}
?>