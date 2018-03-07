<?php
  session_start();
  include 'config.php';
?>
<option value="">-- Pilih Desa --</option>
<?php
	$qStr = "SELECT * FROM tblm_desa WHERE SUBSTRING(kd_desa, 1, 7) = '" . $_POST['kd_kec'] . "' ORDER BY kd_desa";
	$qExec = mysqli_query($con,$qStr);
	while($result = mysqli_fetch_array($qExec)){
		echo "<option value='".$result['kd_desa']."'>".$result['nm_desa']."</option>";
	}
?>
