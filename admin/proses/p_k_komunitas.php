<?php
include "../../include/koneksi.php";

$jeniskategori	= $_POST["jeniskategori"];

if(empty($_POST["jeniskategori"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_k_komunitas.php">';
}else{
	$sql = "INSERT INTO tbl_kategori_komunitas (id_kategori_k, jenis_kategori)
			VALUES (NULL, '$jeniskategori')";
	$kueri = mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_k_komunitas.php">';
}
?>
