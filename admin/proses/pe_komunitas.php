<?php
//File Koneksi
include "../../include/koneksi.php";
$id_komunitas		= $_POST['id_komunitas'];
$jenjang			= $_POST['jenjang'];
$kategori			= $_POST['kategori'];
$nama_komunitas	    = $_POST['nama'];
$logo_lama			= $_POST['logo_lama'];
$tentang		    = $_POST['tentang'];
$visi		    	= $_POST['visi'];
$misi				= $_POST['misi'];
$profit			    = $_POST['profit'];
$jenisbiayalama		= $_POST['jenisbiayalama'];
$jenisbiayabaru		= $_POST['jenisbiayabaru'];
$biayarutinan		= $_POST['biayarutinan'];
$alamat			    = $_POST['alamat'];
$provinsi	    	= $_POST['provinsi'];
$kota		    	= $_POST['kota'];
$kabupaten	    	= $_POST['kabupaten'];
$kecamatan	    	= $_POST['kecamatan'];
$rt	    			= $_POST['rt'];
$rw	    			= $_POST['rw'];
$no_rumah	    	= $_POST['no_rumah'];

// Untuk ke data rutinan jenisbiayalama
if($_POST["jenisbiayalama"]==0){
	$jenisbiayalamanya = "Tidak Ada";
}else if($_POST["jenisbiayalama"]==1){
	$jenisbiayalamanya = "Harian";
}else if($_POST["jenisbiayalama"]==2){
	$jenisbiayalamanya = "Mingguan";
}else if($_POST["jenisbiayalama"]==3){
	$jenisbiayalamanya = "Bulanan";
}else if($_POST["jenisbiayalama"]==4){
	$jenisbiayalamanya = "Tahunan";
}

// Untuk ke data rutinan jenisbiayabaru
if($_POST["jenisbiayabaru"]=="NULL"){
	$jenisbiayabarunya = "Tidak Ada";
}else if($_POST["jenisbiayabaru"]==1){
	$jenisbiayabarunya = "Harian";
}else if($_POST["jenisbiayabaru"]==2){
	$jenisbiayabarunya = "Mingguan";
}else if($_POST["jenisbiayabaru"]==3){
	$jenisbiayabarunya = "Bulanan";
}else if($_POST["jenisbiayabaru"]==4){
	$jenisbiayabarunya = "Tahunan";
}

// Untuk Foto
define("WIDTH", "626");
define("HEIGHT", "626");
$ekstensi_diperbolehkan = array('png','jpg');
$nama 					= $_POST['nama']."-".$_FILES['file']['name'];
$x 						= explode('.',$nama);
$ekstensi 				= strtolower(end($x));
$ukuran					= $_FILES['file']['size'];
$file_tmp				= $_FILES['file']['tmp_name'];

// Upload File
if(empty($nama_komunitas) || empty($tentang) || empty($visi) || empty($misi) || empty($alamat) || empty($provinsi)
	|| empty($kota) || empty($kabupaten) || empty($kecamatan) || empty($rt) || empty($rw) || empty($no_rumah)){
	echo "<script language='javascript'>alert('Data jangan ada yang di kosongkan')</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
}else if(empty($_FILES['file']['name'])){
	// Pebandingan Jenis Biaya Rutinan
	if(isset($_POST['jenisbiayabaru']) == "NULL"){
	$sql	= "UPDATE tbl_komunitas SET id_kategori_k='$kategori', id_jenjang='$jenjang', id_rutinan='$jenisbiayalama', 
		nama='$nama_komunitas', logo='$logo_lama',
		tentang='$tentang', visi='$visi', misi='$misi', profit='$profit', bayar_rutinan='$biayarutinan', alamat='$alamat', provinsi='$provinsi', kota='$kota', kabupaten='$kabupaten', kecamatan='$kecamatan', rt='$rt', rw='$rw', no_rumah='$no_rumah' WHERE tbl_komunitas.id_komunitas = $id_komunitas";
	$sqldua = "UPDATE tbl_detail_anggota SET jenis_rutinan = '$jenisbiayalamanya', jumlah_bayar = '$biayarutinan' WHERE id_komunitas = '$id_komunitas'";
	}else if(isset($_POST['jenisbiayabaru']) != "NULL"){
	$sql	= "UPDATE tbl_komunitas SET id_kategori_k='$kategori', id_jenjang='$jenjang', id_rutinan='$jenisbiayabaru', 
		nama='$nama_komunitas', logo='$logo_lama',
		tentang='$tentang', visi='$visi', misi='$misi', profit='$profit', bayar_rutinan='$biayarutinan', alamat='$alamat', provinsi='$provinsi', kota='$kota', kabupaten='$kabupaten', kecamatan='$kecamatan', rt='$rt', rw='$rw', no_rumah='$no_rumah' WHERE tbl_komunitas.id_komunitas = $id_komunitas";	
	$sqldua = "UPDATE tbl_detail_anggota SET jenis_rutinan = '$jenisbiayabarunya', jumlah_bayar = '$biayarutinan' WHERE id_komunitas = '$id_komunitas'";
	}
	$num 	= mysql_query($sql);
	$numdua = mysql_query($sqldua);
	echo "<script language='javascript'>alert('Berhasil di edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
}else if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
	list($file_width, $file_height) = getimagesize($file_tmp);
	if($ukuran > 1044070){
			echo "<script language='javascript'>alert('Error : Ukuran file terlalu besar');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
		}else if(($file_width > WIDTH) || ($file_height > HEIGHT)){
			echo "<script language='javascript'>alert('Error : Ukuran gambar melebihi yang ditentukan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
		}else{
			move_uploaded_file($file_tmp, '../../images/logo_komunitas/'.$nama);
			if(isset($_POST['jenisbiayabaru']) == "NULL"){
				$sql = "UPDATE tbl_komunitas SET id_kategori_k='$kategori', id_jenjang='$jenjang', id_rutinan='$jenisbiayalama', 
				 nama='$nama_komunitas', logo='$nama',
				 tentang='$tentang', visi='$visi', misi='$misi', profit='$profit', bayar_rutinan='$biayarutinan', alamat='$alamat', provinsi='$provinsi', kota='$kota', kabupaten='$kabupaten', kecamatan='$kecamatan', rt='$rt', rw='$rw', no_rumah='$no_rumah' WHERE tbl_komunitas.id_komunitas = $id_komunitas";
				 $sqldua = "UPDATE tbl_detail_anggota SET jenis_rutinan = '$jenisbiayalamanya', jumlah_bayar = '$biayarutinan' WHERE id_komunitas = '$id_komunitas'";
			}else if(isset($_POST['jenisbiayabaru']) != "NULL"){
				$sql = "UPDATE tbl_komunitas SET id_kategori_k='$kategori', id_jenjang='$jenjang', id_rutinan='$jenisbiayabaru', 
				 nama='$nama_komunitas', logo='$nama',
				 tentang='$tentang', visi='$visi', misi='$misi', profit='$profit', bayar_rutinan='$biayarutinan', alamat='$alamat', provinsi='$provinsi', kota='$kota', kabupaten='$kabupaten', kecamatan='$kecamatan', rt='$rt', rw='$rw', no_rumah='$no_rumah' WHERE tbl_komunitas.id_komunitas = $id_komunitas";
				$sqldua = "UPDATE tbl_detail_anggota SET jenis_rutinan = '$jenisbiayabarunya', jumlah_bayar = '$biayarutinan' WHERE id_komunitas = '$id_komunitas'";
			}
			$num 	= mysql_query($sql);
			$numdua	= mysql_query($sqldua);
			echo "<script language='javascript'>alert('Data berhasil diubah');</script>";
			echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
		}
}else{
	echo "<script language='javascript'>alert('Error : Ekstensi gambar tidak sesuai dengan yang ditentukan, harus JPG atau PNG');</script>";
	echo '<meta http-equiv="refresh" content="0; url=../v_komunitas.php">';
}
?>
