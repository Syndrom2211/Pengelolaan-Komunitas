<?php
	error_reporting(0);
	include "../../include/koneksi.php";
	$file=date("Ymd").'_backup_database_carkom_'.time().'.sql';
	backup_tables($server,$user,$password,$database,$file);
?>
<script type="text/javascript">
function load(){
		window.location.href = "p_download_backup_data.php?nama_file=<?php echo $file;?>";
		window.onclick = setTimeout(window.close, 100);
}
</script>
<body onload="load()">
<?php
	function backup_tables($server,$user,$password,$database,$nama_file,$tables ='*')	{
	if($tables == '*'){
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result)){
			$tables[] = $row[0];
		}
	}
	else{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	foreach($tables as $table){
		$foreign = 'SET FOREIGN_KEY_CHECKS = 0;';
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		$return.= $foreign."\n\n";
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysql_fetch_row($result)){
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) {
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}							
		$nama_file;
		$handle = fopen('../../backup/'.$nama_file,'w+');
		fwrite($handle,$return);
			fclose($handle);
	}
?>