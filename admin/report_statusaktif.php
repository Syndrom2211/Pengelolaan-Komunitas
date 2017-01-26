<?php
error_reporting(0);
session_start();
if(isset($_SESSION['username'])){
?>
<link rel="stylesheet" type="text/css" media="print" href="../styles/mystyle.css" />
<body onload="print()">
<?php include "../include/koneksi.php"; ?>
	<hr size="4" color="000" />
		<center><h2>LAPORAN STATUS KEAKTIFAN</h2>
		<?php		
		$nerima = $_POST["lempar"];
		
		if($_POST["lempar"] == ""){
			$sql = "SELECT * FROM tbl_detail_anggota LEFT JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas LEFT JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp LEFT JOIN tbl_transaksi_pembayaran ON tbl_detail_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp GROUP BY tbl_detail_anggota.no_ktp ORDER BY nama ASC";
		}else{
			$sql = "SELECT * FROM tbl_detail_anggota INNER JOIN tbl_komunitas ON tbl_detail_anggota.id_komunitas = tbl_komunitas.id_komunitas INNER JOIN tbl_anggota ON tbl_anggota.no_ktp = tbl_detail_anggota.no_ktp INNER JOIN tbl_transaksi_pembayaran ON tbl_detail_anggota.no_ktp = tbl_transaksi_pembayaran.no_ktp AND tbl_komunitas.nama LIKE '%$nerima%' OR tbl_anggota.nama_lengkap LIKE '$nerima%' OR tbl_detail_anggota.tgl_daftar LIKE '%$nerima%' OR tbl_anggota.status_jabatan LIKE '%$nerima%' GROUP BY tbl_detail_anggota.no_ktp ORDER BY nama ASC";
		}		
		
		$query = mysql_query($sql);
		?></center>
		<center>
		<table>
			<tr>
			<th> No </th>
                    <th> Nama Komunitas </th>
                    <th> Nama Anggota</th>
					<th> Tgl Daftar</th>
					<th> Status Jabatan </th>
                    <th> Status Anggota </th>
                    <!--<th class="td-actions"> Aksi </th>-->
			</tr>
			<?php
			$i = 1;
			while($data = mysql_fetch_array($query)){
				echo "<tr bgcolor='white'>
					<td align='center'>$i</td>
                    <td align='center'>$data[nama]</td>
					<td align='center'>$data[nama_lengkap]</td>
					<td align='center'>$data[tgl_daftar]</td>
					<td align='center'>$data[status_jabatan]</td>
					<td align='center'>$data[status_anggota]</td>
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
