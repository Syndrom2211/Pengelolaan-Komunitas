<?php
include "../../include/koneksi.php";

// Bagian ke Tabel Anggota
$no_ktp				= $_POST["no_ktp"];
$nama_lengkap		= $_POST["nama_lengkap"];
$jenis_kelamin		= $_POST["jenis_kelamin"];
$alamat				= $_POST["alamat"];
// Untuk Foto
define("WIDTH", "113");
define("HEIGHT", "170");
$ekstensi_diperbolehkan = array('png','jpg');
$nama 					= $_POST["nama_lengkap"]."-".$_FILES['file']['name'];
$x 						= explode('.',$nama);
$ekstensi 				= strtolower(end($x));
$ukuran					= $_FILES['file']['size'];
$file_tmp				= $_FILES['file']['tmp_name'];
$username				= $_POST["username"];
$password				= $_POST["password"];
$password_konfirmasi	= $_POST["password_konfirmasi"];
$no_hp					= $_POST["no_hp"];
$email					= $_POST["email"];
$link_facebook			= $_POST["link_facebook"];
$motivasi				= $_POST["motivasi"];
$jenisbiaya 			= $_POST["jenisbiaya"];
$biayarutinan 			= $_POST["biayarutinan"];
$status_bayars			= "Belum Bayar"; 

$status_bayar		= $_POST["status_bayar"]; 
$tgl_daftars		= $_POST["tgl_daftars"];
// Bagian ke Tabel Transaksi Pembayaran
$tgl_daftar			= $_POST["tgl_daftar"];
$waktu_daftar		= $_POST["waktu_daftar"];
$metode_pembayaran	= $_POST["metode_pembayaran"];
$atas_nama			= $_POST["atas_nama"];
$jumlah_bayar		= $_POST["jumlah_bayar"];
$tujuan_daftar		= $_POST["tujuan_daftar"];

// Bagian ke tabel history status
$id_admin			= $_POST["id_admin"];

// Kondisi tujuan pendaftaran
if($tujuan_daftar == 'ikut'){
	$tujuan_daftars = 'Mengikuti Komunitas';
}else if($tujuan_daftar == 'daftar'){
	$tujuan_daftars = 'Mendaftarkan Komunitas';
}else{
	$tujuan_daftars = 'Bugs !';
}

// Bagian ke Tabel Detail Anggota
$komunitas_pilihan	= $_POST["komunitas_pilihan"];
$status_jabatan		= $_POST["status_jabatan"];
$status_anggota		= $_POST["status_anggota"];
$periode_mulai		= $_POST["periode_mulai"];
$periode_akhir		= $_POST["periode_akhir"];

if(empty($_POST["nama_lengkap"]) || empty($_POST["jenis_kelamin"]) || empty($_POST["alamat"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["no_hp"]) || empty($_POST["email"]) || empty($_POST["link_facebook"]) || empty($_POST["motivasi"]) || empty($_POST["atas_nama"])){
	echo "<script language='javascript'>alert('Data Biodata jangan di kosongkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
}else if($_POST["password"] != $_POST["password_konfirmasi"]){
	echo "<script language='javascript'>alert('Password tidak cocok !');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
}else if($_POST["tujuan_daftar"]=="-"){
	echo "<script language='javascript'>alert('Tujuan pendaftaran harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
}else if($_POST["status_jabatan"]=="-"){
	echo "<script language='javascript'>alert('Sebagai harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
}else if($_POST["metode_pembayaran"]=="-"){
	echo "<script language='javascript'>alert('Metode pembayaran harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
}else if(empty($_FILES['file']['name'])){
	echo "<script language='javascript'>alert('Harap memilih foto untuk di upload');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
}else if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
		list($file_width, $file_height) = getimagesize($file_tmp);
		if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/foto_anggota/'.$nama);
			// INSERT ke tabel anggota
			$query = mysql_query("INSERT INTO tbl_anggota VALUES ('$no_ktp','$nama_lengkap','$jenis_kelamin','$alamat','$nama','$username','".md5($password)."','$no_hp','$email','$link_facebook','$motivasi','$status_jabatan')");
			//INSERT ke tabel transaksi pembayaran
			$querydua = mysql_query("INSERT INTO tbl_transaksi_pembayaran VALUES (NULL,'$no_ktp','$tgl_daftar','$waktu_daftar','$metode_pembayaran','$atas_nama','$jumlah_bayar','$tujuan_daftars','$status_bayar')");
			//INSERT ke tabel detail anggota
			if($_POST["komunitas_pilihan"] == "-"){
				// Jika kosong untuk jenis dan biaya rutinan nya
				$querytiga = mysql_query("INSERT INTO tbl_detail_anggota VALUES (NULL,'$no_ktp','$tgl_daftar','$status_anggota','$jenisbiaya','$biayarutinan','$tgl_daftars','$status_bayars')");
				//INSERT ke tabel history status 
				$querylima = mysql_query("INSERT INTO tbl_history_status VALUES ('$no_ktp','$id_admin','$waktu_daftar','$tgl_daftar','Anggota Biasa','$periode_mulai','$periode_akhir','Menjadi Penanggung Jawab')");
			}else{
				// Harus ada list komunitas dulu
				//if($jenisbiaya == "Tidak ada" && $biayarutinan == "0"){
				//	$querytiga = mysql_query("INSERT INTO tbl_detail_anggota VALUES ('$komunitas_pilihan','$no_ktp','$tgl_daftar','$status_anggota','$jenisbiaya','$biayarutinan','0000-00-00','Sudah Bayar')");
				//}else{
					$querytiga = mysql_query("INSERT INTO tbl_detail_anggota VALUES ('$komunitas_pilihan','$no_ktp','$tgl_daftar','$status_anggota','$jenisbiaya','$biayarutinan','$tgl_daftars','$status_bayars')");
				//}
			}
			
			//INSERT ke tabel penanggung jawab
			if($tujuan_daftar == 'daftar'){
				$queryempat = mysql_query("INSERT INTO tbl_penanggung_jawab VALUES (NULL,'$no_ktp','$periode_mulai','$periode_akhir')");
			}else{
				// Tidak ada proses karna menjadi anggota
			}
			echo "<script language='javascript'>alert('Data berhasil ditambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_anggota.php">';
		}
	}else{
		echo "<script language='javascript'>alert('Error : Ekstensi gambar tidak sesuai dengan yang ditentukan, harus JPG atau PNG');</script>";
		echo '<meta http-equiv="refresh" content="0; url=../vt_anggota.php">';
	}
?>