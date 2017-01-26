<?php
//File Koneksi
include "../../include/koneksi.php";
//Untuk tbl_history_status
$no_ktp		    			= $_POST['no_ktp'];
$id_admin					= $_POST['id_admin'];
$id_komunitas				= $_POST['id_komunitas'];
$waktu						= $_POST['waktu_daftar'];
$tanggal					= $_POST['tgl_sekarang'];
$status_akhir				= $_POST['status_akhir'];
$periode_awal_sekarang		= $_POST['periode_awal_sekarang'];
$periode_akhir_sekarang		= $_POST['periode_akhir_sekarang'];
$periode_awal_selanjutnya	= $_POST['periode_awal_selanjutnya'];
$periode_akhir_selanjutnya	= $_POST['periode_akhir_selanjutnya'];
$keterangan					= $_POST['keterangan'];
$pj_baru					= $_POST['pj_baru'];

if(empty($periode_awal_selanjutnya) || empty($periode_akhir_selanjutnya)){
	echo "<script language='javascript'>alert('Periode selanjutnya jangan ada yg dikosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_pj.php">';
}else if($_POST['pj_baru']=="-"){
	echo "<script language='javascript'>alert('Penanggung Jawab Baru harus di isi')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_pj.php">';
}else{
	// INSERT ke tbl_history_status
	$sql		= mysql_query("INSERT INTO tbl_history_status VALUES ('$no_ktp','$id_admin','$waktu','$tanggal','$status_akhir','$periode_awal_sekarang','$periode_akhir_sekarang','$keterangan')"); // PJ ke AnggotaBiasa
	$sqldua		= mysql_query("INSERT INTO tbl_history_status VALUES ('$pj_baru','$id_admin','$waktu','$tanggal','Anggota Biasa','$periode_awal_selanjutnya','$periode_akhir_selanjutnya','Menjadi Penanggung Jawab')"); // AnggotaBiasa ke PJ
	// UPDATE tbl_anggota
	$sqltiga	= mysql_query("UPDATE tbl_anggota SET status_jabatan='Anggota Biasa' WHERE tbl_anggota.no_ktp = $no_ktp"); // 1
	$sqlempat	= mysql_query("UPDATE tbl_anggota SET status_jabatan='Penanggung Jawab' WHERE tbl_anggota.no_ktp = $pj_baru"); // 2
	// UPDATE tbl_penanggung_jawab
	$sqllima	= mysql_query("UPDATE tbl_penanggung_jawab SET no_ktp='$pj_baru', periode_mulai='$periode_awal_selanjutnya', periode_akhir='$periode_akhir_selanjutnya' WHERE tbl_penanggung_jawab.id_komunitas = $id_komunitas"); // 2
	
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_pj.php">';
}
?>