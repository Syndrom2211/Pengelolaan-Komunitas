<?php
include "../../include/koneksi.php";

$jabatan	= $_POST["jabatan"];

if(empty($_POST["jabatan"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_jabatan.php">';
}else{
	$sql = "INSERT INTO tbl_jabatan (id_jabatan, jabatan)
			VALUES (NULL, '$jabatan')";
	$kueri = mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_jabatan.php">';
}
?>
