<?php
include "../../include/koneksi.php";

// Bagian ke Tabel Komunitas
$kategori_komunitas		= $_POST["kategori_komunitas"];
$jenjang_komunitas		= $_POST["jenjang_komunitas"];
$jenisbiaya				= $_POST["jenisbiaya"];
$nama_komunitas			= $_POST["nama_komunitas"];
$tentang				= $_POST["tentang"];
$visi					= $_POST["visi"];
$misi					= $_POST["misi"];
$profit					= $_POST["profit"];
$biayarutinan			= $_POST["biayarutinan"];
$alamat					= $_POST["alamat"];
$provinsi				= $_POST["provinsi"];
$kota					= $_POST["kota"];
$kabupaten				= $_POST["kabupaten"];
$kecamatan				= $_POST["kecamatan"];
$rt						= $_POST["rt"];
$rw						= $_POST["rw"];
$no_rumah				= $_POST["no_rumah"];
$tgl_bayar	   			= "0000-00-00";
$status_bayar  			= "Sudah Bayar";
	
// Untuk ke Teks rutinan bukan ID
if($_POST["jenisbiaya"]=="0"){
	$jenisbiayanya = "Tidak Ada";
}else if($_POST["jenisbiaya"]=="1"){
	$jenisbiayanya = "Harian";
}else if($_POST["jenisbiaya"]=="2"){
	$jenisbiayanya = "Mingguan";
}else if($_POST["jenisbiaya"]=="3"){
	$jenisbiayanya = "Bulanan";
}else if($_POST["jenisbiaya"]=="4"){
	$jenisbiayanya = "Tahunan";
}

// Untuk Foto
define("WIDTH", "626");
define("HEIGHT", "626");
$ekstensi_diperbolehkan = array('png','jpg');
$nama 					= $_POST["nama_komunitas"]."-".$_FILES['file']['name'];
$x 						= explode('.',$nama);
$ekstensi 				= strtolower(end($x));
$ukuran					= $_FILES['file']['size'];
$file_tmp				= $_FILES['file']['tmp_name'];

// Bagian update status keaktifan dan penanggung jawab
$id_komunitas			= rand(1000,100000);
$penanggung_jawab		= $_POST["penanggung_jawab"];

if(empty($_POST["kategori_komunitas"]) || empty($_POST["jenjang_komunitas"]) || empty($_POST["nama_komunitas"]) || empty($_POST["tentang"]) || empty($_POST["visi"]) || empty($_POST["misi"]) || empty($_POST["alamat"]) || empty($_POST["provinsi"]) || empty($_POST["kota"]) || empty($_POST["kabupaten"]) || empty($_POST["kecamatan"]) || empty($_POST["rt"]) || empty($_POST["rw"]) || empty($_POST["no_rumah"])){
	echo "<script language='javascript'>alert('Data Komunitas jangan ada yang di kosongkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
}else if($_POST["kategori_komunitas"]=="-"){
	echo "<script language='javascript'>alert('Kategori komunitas harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
}else if($_POST["jenjang_komunitas"]=="-"){
	echo "<script language='javascript'>alert('Jenjang komunitas harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
}else if($_POST["jenisbiaya"]=="-"){
	echo "<script language='javascript'>alert('Jenis Biaya harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
}else if($_POST["penanggung_jawab"]=="-"){
	echo "<script language='javascript'>alert('Penanggung Jawab harus di isi');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
}else if(empty($_FILES['file']['name'])){
	echo "<script language='javascript'>alert('Harap memilih foto untuk di upload');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
}else if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
		list($file_width, $file_height) = getimagesize($file_tmp);
		if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/logo_komunitas/'.$nama);
			$query = mysql_query("INSERT INTO tbl_komunitas VALUES (NULL,'$id_komunitas','$kategori_komunitas','$jenjang_komunitas','$jenisbiaya','$nama_komunitas','$nama','$tentang','$visi','$misi','$profit','$biayarutinan','$alamat','$provinsi','$kota','$kabupaten','$kecamatan','$rt','$rw','$no_rumah')");
			if($_POST["jenisbiaya"]=="0"){
				$query2 = mysql_query("UPDATE tbl_detail_anggota SET id_komunitas = '$id_komunitas', jenis_rutinan = '$jenisbiayanya', jumlah_bayar = '$biayarutinan', pembayaran_selanjutnya = '$tgl_bayar', status_bayar = '$status_bayar' WHERE no_ktp = '$penanggung_jawab'");
			}else{
				$query2 = mysql_query("UPDATE tbl_detail_anggota SET id_komunitas = '$id_komunitas', jenis_rutinan = '$jenisbiayanya', jumlah_bayar = '$biayarutinan' WHERE no_ktp = '$penanggung_jawab'");
			}
			$query3 = mysql_query("UPDATE tbl_penanggung_jawab SET id_komunitas = '$id_komunitas' WHERE no_ktp = '$penanggung_jawab'");
			echo "<script language='javascript'>alert('Data berhasil ditambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
		}
	}else{
		echo "<script language='javascript'>alert('Error : Ekstensi gambar tidak sesuai dengan yang ditentukan, harus JPG atau PNG');</script>";
		echo '<meta http-equiv="refresh" content="0; url=../vt_komunitas.php">';
	}
?>