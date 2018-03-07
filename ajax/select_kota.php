<?php
if (!empty($_GET['q'])){
	if (ctype_digit($_GET['q'])) {
		include '../koneksi.php';
		$query = mysql_query("SELECT * FROM tblm_kab where left(kd_kab,2)=$_GET[q] order by kd_kab");
		echo"<option selected value=''>=== Pilih Kabupaten ===</option>";
		while($d = mysql_fetch_array($query)){
			echo "<option value='$d[kd_kab]'>$d[nm_kab]</option>";
		}


	}
}


?>
