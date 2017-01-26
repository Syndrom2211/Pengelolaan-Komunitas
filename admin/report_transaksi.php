<?php
error_reporting(0);
session_start();
if(isset($_SESSION['username'])){
?>
<link rel="stylesheet" type="text/css" media="print" href="../styles/mystyle.css" />
<body onload="print()">
<?php include "../include/koneksi.php"; ?>
	<hr size="4" color="000" />
		<center><h2>LAPORAN TRANSAKSI PEMBAYARAN</h2>
		<?php
		$nerima = $_POST["lempar"];
		
		if($_POST["lempar"] == ""){
			$sql = "SELECT * FROM tbl_transaksi_pembayaran, tbl_anggota WHERE tbl_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp ";
		}else{
			$sql = "SELECT * FROM tbl_transaksi_pembayaran, tbl_anggota WHERE tbl_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp AND tbl_anggota.nama_lengkap LIKE '%$nerima%' OR tbl_transaksi_pembayaran.tgl_daftar LIKE '$nerima%' OR tbl_transaksi_pembayaran.waktu_daftar LIKE '%$nerima%' OR tbl_transaksi_pembayaran.metode_pembayaran LIKE '%$nerima%' OR tbl_transaksi_pembayaran.atas_nama LIKE '%$nerima%' OR tbl_transaksi_pembayaran.jumlah_bayar LIKE '%$nerima%' OR tbl_transaksi_pembayaran.status_bayar LIKE '%$nerima%' ORDER BY tgl_daftar DESC";
		}
		
		$query = mysql_query($sql);
		?></center>
		<center>
		<table>
			<tr>
			<th> No </th>
                    <th> Nama Lengkap</th>
                    <th> Tanggal Daftar/Perpanjang Rutinan </th>
					<th> Waktu Daftar/Perpanjang Rutinan </th>
                    <th> Metode Pembayaran </th>
                    <th> Atas Nama </th>
                    <th> Jumlah Bayar</th>
                    <th> Tujuan Pembayaran </th>
                    <th> Status Pembayaran</th>
                    <!--<th class="td-actions"> Aksi </th>-->
			</tr>
			<?php
			$i = 1;
			while($data = mysql_fetch_array($query)){
				echo "<tr bgcolor='white'>
					<td align='center'>$i</td>
                    <td align='center'>$data[nama_lengkap]</td>
					<td align='center'>$data[tgl_daftar]</td>
					<td align='center'>$data[waktu_daftar]</td>
					<td align='center'>$data[metode_pembayaran]</td>
					<td align='center'>$data[atas_nama]</td>
					<td align='center'>Rp.$data[jumlah_bayar]</td>
					<td align='center'>$data[tujuan_pendaftaran]</td>
					<td align='center'>$data[status_bayar]</td>
					</tr>";
					$i++;
			}
			?>
		</table></center>
</body>
</html>
<?php
}else{
    header("location:login.php");
}
?>
