<?php
  session_start();
  include 'config.php';
?>
<option value="">-- Pilih Kabupaten --</option>
<?php
	$qStr = "SELECT * FROM tblm_kab WHERE SUBSTRING(kd_kab, 1, 2) = '" . $_POST['kd_prov'] . "' ORDER BY kd_kab";
	$qExec = mysqli_query($con,$qStr);
	while($result = mysqli_fetch_array($qExec)){
		echo "<option value='".$result['kd_kab']."'>".$result['nm_kab']."</option>";
	}
?>
