<?php
session_start();
include "include/koneksi.php";

if(isset($_POST['submit'])){
	$username = $_POST['usernamez'];
	$password = $_POST['passwordz'];
	$sql = mysql_query("SELECT tbl_anggota.no_ktp, tbl_anggota.nama_lengkap, tbl_anggota.username, tbl_anggota.password, tbl_detail_anggota.id_komunitas, tbl_komunitas.nama, tbl_detail_anggota.status_anggota FROM tbl_detail_anggota INNER JOIN tbl_anggota ON tbl_detail_anggota.no_ktp = tbl_anggota.no_ktp INNER JOIN TBL_KOMUNITAS ON  tbl_komunitas.id_komunitas = tbl_detail_anggota.id_komunitas WHERE username='$username' && password='".md5($password)."' LIMIT 1");
	
	// Untuk validasi status keaktifan dan transaksi pembayaran
	//$sqldua = mysql_query("SELECT tbl_detail_anggota.status_anggota FROM tbl_detail_anggota INNER JOIN tbl_anggota ON tbl_detail_anggota.no_ktp = tbl_anggota.no_ktp WHERE tbl_anggota.username = '$username'");
	
	$hasil = mysql_fetch_array($sql);
	//$hasildua = mysql_fetch_array($sqldua);
	
	$num = mysql_num_rows($sql);
	if($num==1){
		if($hasil['status_anggota'] == "Aktif"){
			$_SESSION['nama_lengkap'] = $hasil['nama_lengkap'];
			$_SESSION['no_ktp'] = $hasil['no_ktp'];
			$_SESSION['id_komunitas'] = $hasil['id_komunitas'];
			$_SESSION['nama'] = $hasil['nama'];
			$_SESSION['username'] = $username;
			echo "<script language='javascript'>alert('Login Berhasil')</script>";
			echo '<meta http-equiv="refresh" content="0; url=user/">';
		}else if($hasil['status_anggota'] == "Tidak Aktif"){
			echo "<script language='javascript'>alert('User anda belum aktif, harap bayar transaksi dulu !')</script>";
			echo '<meta http-equiv="refresh" content="0; url=user/">';
		}
	}else{
		echo "<script language='javascript'>alert('Login Gagal')</script>";
		echo '<meta http-equiv="refresh" content="0; url=relog.php">';	
	}
}
?>
