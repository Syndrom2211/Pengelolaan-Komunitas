<?php
error_reporting(0);
session_start();
if(isset($_SESSION['username'])){
?>
<link rel="stylesheet" type="text/css" media="print" href="../styles/mystyle.css" />
<body onload="print()">
<?php include "../include/koneksi.php"; ?>
	<hr size="4" color="000" />
		<center><h2>LAPORAN PENGGANTIAN JABATAN</h2>
		<?php
		$nerima = $_POST["lempar"];
		
		if($_POST["lempar"] == ""){
			$sql = "SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin";
		}else{
			$sql = "SELECT * FROM tbl_anggota, tbl_admin, tbl_history_status WHERE tbl_anggota.no_ktp = tbl_history_status.no_ktp AND tbl_admin.id_admin = tbl_history_status.id_admin AND nama_lengkap LIKE '%$nerima%' OR tbl_admin.username LIKE '%$nerima%' OR tanggal LIKE '%$nerima%' OR status_akhir LIKE '%$nerima%' OR periode_awal LIKE '%$nerima%' OR periode_akhir LIKE '%$nerima%' OR keterangan LIKE '%$nerima%'";
		}		
		
		$query = mysql_query($sql);
		?></center>
		<center>
		<table>
			<tr>
                    <th> No </th>
                    <th> Nama Anggota </th>
					<th> Username Admin </th>
                    <th> Waktu </th>
                    <th> Tanggal </th>
                    <th> Status Akhir </th>
					<th> Periode Awal </th>
					<th> Periode Akhir </th>
					<th> Keterangan </th>
                    <!--<th class="td-actions"> Aksi </th>-->
			</tr>
			<?php
			$i = 1;
			while($data = mysql_fetch_array($query)){
				echo "<tr bgcolor='white'>
					<td align='center'>$i</td>
                    <td align='center'>$data[nama_lengkap]</td>
					<td align='center'>$data[username]</td>
					<td align='center'>$data[waktu]</td>
					<td align='center'>$data[tanggal]</td>
					<td align='center'>$data[status_akhir]</td>
					<td align='center'>$data[periode_awal]</td>
					<td align='center'>$data[periode_akhir]</td>
					<td align='center'>$data[keterangan]</td>
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
