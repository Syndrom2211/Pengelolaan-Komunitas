<?php
//File Koneksi
include "../../include/koneksi.php";
$id_transaksi		    = $_POST['id_transaksi'];
$no_ktp				    = $_POST['no_ktp'];
$metode_pembayaran		= $_POST['metode_pembayaran'];
$atas_nama				= $_POST['atas_nama'];
$jumlah_bayar			= $_POST['jumlah_bayar'];
$tujuan_pendaftaran		= $_POST['tujuan_pendaftaran'];
$status_bayar			= $_POST['status_bayar'];

if(empty($metode_pembayaran) || empty($atas_nama) || empty($tujuan_pendaftaran) || empty($status_bayar)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../lap_transaksi.php">';
}else{
	$sql	= "UPDATE tbl_transaksi_pembayaran SET metode_pembayaran='$metode_pembayaran', atas_nama='$atas_nama', jumlah_bayar='$jumlah_bayar', tujuan_pendaftaran='$tujuan_pendaftaran', status_bayar='$status_bayar' WHERE tbl_transaksi_pembayaran.id_transaksi = $id_transaksi";
		$num 	= mysql_query($sql);
		
	if($_POST['status_bayar'] == "Sudah Bayar"){
		$sqldua	= "UPDATE tbl_detail_anggota SET status_anggota='Aktif' WHERE tbl_detail_anggota.no_ktp = $no_ktp";
		$numdua	= mysql_query($sqldua);
	}else if($_POST['status_bayar'] == "Belum Bayar"){
		$sqldua	= "UPDATE tbl_detail_anggota SET status_anggota='Tidak Aktif' WHERE tbl_detail_anggota.no_ktp = $no_ktp";
		$numdua	= mysql_query($sqldua);
	}
	
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../lap_transaksi.php">';
}
?>