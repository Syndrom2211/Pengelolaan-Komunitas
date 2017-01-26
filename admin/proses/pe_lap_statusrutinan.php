<?php
//File Koneksi
include "../../include/koneksi.php";
$no_ktp		    		= $_POST['no_ktp'];
$status_bayar			= $_POST['status_bayar'];
$jenisbiaya				= $_POST['jenisbiaya'];
$metode_pembayaran		= $_POST['metode_pembayaran'];
$atas_nama				= $_POST['atas_nama'];
$jumlah_bayar			= $_POST['jumlah_bayar'];
$waktu_daftar			= $_POST['waktu_daftar'];
$tujuan_pembayaran		= "Biaya Rutinan ".$jenisbiaya;
$status_bayar			= "Sudah Bayar";
$pembayaran_selanjutnya	= $_POST['pembayaran_selanjutnya'];
$pembayaran_selanjutnya_lagi	= $_POST['pembayaran_selanjutnya_lagi'];

// Rutinan Berikutnya
//ini dipake ketika di edit terus status udah bayar
if($_POST["jenisbiaya"] == "Harian"){
	$teuing = strtotime('+1 day' , strtotime ($pembayaran_selanjutnya));
	$teuing = date ('Y-m-d' , $teuing);
}else if($_POST["jenisbiaya"] == "Mingguan"){
	$teuing = strtotime('+1 week' , strtotime ($pembayaran_selanjutnya));
	$teuing = date ('Y-m-d' , $teuing);
}else if($_POST["jenisbiaya"] == "Bulanan"){
	$teuing = strtotime('+1 month' , strtotime ($pembayaran_selanjutnya));
	$teuing = date ('Y-m-d' , $teuing);
}else if($_POST["jenisbiaya"] == "Tahunan"){
	$teuing = strtotime('+1 year' , strtotime ($pembayaran_selanjutnya));
	$teuing = date ('Y-m-d' , $teuing);
}else if($_POST["jenisbiaya"] == "Tidak ada"){
	$teuing = strtotime('+1 month' , strtotime ($pembayaran_selanjutnya));
	$teuing = date ('Y-m-d' , $teuing);
}

if(empty($atas_nama) || $metode_pembayaran == "-"){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan/biarkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../lap_biayarutinan.php">';
}else{
	$sql	= "UPDATE tbl_detail_anggota SET status_bayar='$status_bayar', pembayaran_selanjutnya='$teuing' WHERE tbl_detail_anggota.no_ktp = $no_ktp";
	$sqldua = "INSERT INTO tbl_transaksi_pembayaran VALUES (NULL,'$no_ktp','$pembayaran_selanjutnya_lagi','$waktu_daftar','$metode_pembayaran','$atas_nama','$jumlah_bayar','$tujuan_pembayaran','$status_bayar')";
	$num 	= mysql_query($sql);
	$numdua = mysql_query($sqldua);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../lap_biayarutinan.php">';
}
?>