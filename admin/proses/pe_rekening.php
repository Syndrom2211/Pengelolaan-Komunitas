<?php
//File Koneksi
include "../../include/koneksi.php";
$id_rekening			    = $_POST['id_rekening'];
$nama_cabang				= $_POST['nama_cabang'];
$no_rekening				= $_POST['no_rekening'];
$atas_nama					= $_POST['atas_nama'];

if(empty($nama_cabang) || empty($atas_nama)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_rekening.php">';
}else{
	$sql	= "UPDATE tbl_data_rekening SET nama_cabang='$nama_cabang', no_rekening='$no_rekening', atas_nama='$atas_nama' WHERE tbl_data_rekening.id_rekening = $id_rekening";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_rekening.php">';
}
?>