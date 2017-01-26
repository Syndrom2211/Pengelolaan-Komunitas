<?php
include "../include/koneksi.php";

// Bagian ke Tabel Anggota
$no_ktp					= $_POST["no_ktp"];
$nama_lengkap			= $_POST["nama_lengkap"];
$jenis_kelamin			= $_POST["jenis_kelamin"];
$alamat					= $_POST["alamat"];
$username				= $_POST["username"];
$password				= $_POST["password"];
$no_hp					= $_POST["no_hp"];
$email					= $_POST["email"];
$link_facebook			= $_POST["link_facebook"];
$motivasi				= $_POST["motivasi"];
$nama_komunitas 		= $_POST["nama_komunitas"];
$tgl_daftar				= $_POST["tgl_daftar"];
$waktu_daftar			= $_POST["waktu_daftar"];
$metode_pembayaran		= $_POST["metode_pembayaran"];
$atas_nama				= $_POST["atas_nama"];
$jumlah_bayar			= $_POST["jumlah_bayar"];
$status_bayar			= $_POST["status_bayar"];
$tujuan_daftar			= $_POST["tujuan_daftar"];
$status_anggota			= $_POST["status_anggota"];
$status_jabatan			= $_POST["status_jabatan"];
$jenisbiaya				= $_POST["jenis_biaya"];
$biayarutinan			= $_POST["biaya_internal"];

if(empty($_POST["no_ktp"]) || empty($_POST["nama_lengkap"]) || empty($_POST["jenis_kelamin"]) || empty($_POST["alamat"]) || empty($_POST["username"]) ||
 empty($_POST["password"]) || empty($_POST["no_hp"]) || empty($_POST["email"]) || empty($_POST["link_facebook"]) ||
 empty($_POST["motivasi"]) || empty($_POST["atas_nama"])){
	echo "<script language='javascript'>alert('Data Biodata jangan di kosongkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../relog.php">';
}else if($_POST["jenis_kelamin"]=="-"){
	echo "<script language='javascript'>alert('Jenis kelamin harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../relog.php">';
}else if($_POST["metode_pembayaran"]=="-"){
	echo "<script language='javascript'>alert('Metode pembayaran harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../relog.php">';
}else if($_POST["nama_komunitas"]=="-"){
	echo "<script language='javascript'>alert('Nama komunitas harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../relog.php">';
}else if($_POST["konfirmasi_password"]!=$_POST["password"]){
	echo "<script language='javascript'>alert('Password tidak cocok !');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../relog.php">';
}else{
			// INSERT ke tabel anggota
			$query = mysql_query("INSERT INTO tbl_anggota VALUES ('$no_ktp','$nama_lengkap','$jenis_kelamin','$alamat',NULL,'$username','".md5($password)."','$no_hp','$email','$link_facebook','$motivasi','$status_jabatan')");
			//INSERT ke tabel transaksi pembayaran
			$querydua = mysql_query("INSERT INTO tbl_transaksi_pembayaran VALUES (NULL,'$no_ktp','$tgl_daftar','$waktu_daftar','$metode_pembayaran','$atas_nama','$jumlah_bayar','$tujuan_daftar','$status_bayar')");
			// INSERT ke tabel detail anggota
			$querytiga = mysql_query("INSERT INTO tbl_detail_anggota VALUES ('$nama_komunitas','$no_ktp','$tgl_daftar','$status_anggota','$jenisbiaya','$biayarutinan','$tgl_daftar','$status_bayar')");			
			echo "<script language='javascript'>alert('Pendaftaran Berhasil, silahkan isi formulir yang sudah di download kemudian serahkan ke cabang terdekat untuk konfirmasi akun serta pembayarannya');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../index.php">';
}
?>