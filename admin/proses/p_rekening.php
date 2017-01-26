<?php
include "../../include/koneksi.php";

$nama_cabang	= $_POST["nama_cabang"];
$no_rekening	= $_POST["no_rekening"];
$atas_nama		= $_POST["atas_nama"];

if(empty($_POST["nama_cabang"]) || empty($_POST["atas_nama"])){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_rekening.php">';
}else{
	$sql = "INSERT INTO tbl_data_rekening (id_rekening, nama_cabang, no_rekening, atas_nama)
			VALUES (NULL, '$nama_cabang', '$no_rekening', '$atas_nama')";
	$kueri = mysql_query($sql);
	echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_rekening.php">';
}
?>
