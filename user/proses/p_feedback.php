<?php
//File Koneksi
include "../../include/koneksi.php";
$no_ktp			= $_POST['no_ktp'];
$id_komunitas	= $_POST['id_komunitas'];
$waktu			= $_POST['waktu_daftars'];
$tanggal     	= $_POST['tgl_daftars'];
$catatan     	= $_POST['catatan'];

// UNTUK INSERT ATAU UPDATE
$sql = mysql_query("SELECT * FROM tbl_feedback WHERE no_ktp = '$no_ktp'");
$hasil = mysql_fetch_array($sql);

if(empty($catatan)){
	echo "<script language='javascript'>alert('Feedback tidak boleh di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_feedback.php">';
}else{
	$sql	= "INSERT INTO tbl_feedback VALUES('$no_ktp','$id_komunitas','$waktu','$tanggal','$catatan')";
	$num 	= mysql_query($sql);
	echo "<script language='javascript'>alert('Feedback berhasil di isi!');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_feedback.php">';
}
?>
