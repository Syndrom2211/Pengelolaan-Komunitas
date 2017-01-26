<?php
include "../../include/koneksi.php";

$namakategori	= $_POST["namakategori"];

if(empty($_POST["namakategori"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_k_artikel.php">';
}else{
	$sql = "INSERT INTO tbl_kategori_artikel (id_kategori_a, nama_kategori)
			VALUES (NULL, '$namakategori')";
	$kueri = mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_k_artikel.php">';
}
?>
