<?php
include "../../include/koneksi.php";

$jenis_biaya	= $_POST["jenis_biaya"];

if(empty($_POST["jenis_biaya"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_biaya_rutinan.php">';
}else{
	$sql = "INSERT INTO tbl_biaya_rutinan_komunitas (id_rutinan, jenis_biaya)
			VALUES (NULL, '$jenis_biaya')";
	$kueri = mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_biaya_rutinan.php">';
}
?>
