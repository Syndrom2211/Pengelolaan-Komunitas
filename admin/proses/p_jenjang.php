<?php
include "../../include/koneksi.php";

$jenjang	= $_POST["jenjang"];

if(empty($_POST["jenjang"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_jenjang.php">';
}else{
	$sql = "INSERT INTO tbl_jenjang (id_jenjang, jenjang)
			VALUES (NULL, '$jenjang')";
	$kueri = mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_jenjang.php">';
}
?>
