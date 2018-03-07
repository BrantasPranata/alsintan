<?php
  session_start();
  include 'config.php';
?>
<option value="">-- Pilih Kecamatan --</option>
<?php
	$qStr = "SELECT * FROM tblm_kec WHERE SUBSTRING(kd_kec, 1, 4) = '" . $_POST['kd_kab'] . "' ORDER BY kd_kec";
	$qExec = mysqli_query($con,$qStr);
	while($result = mysqli_fetch_array($qExec)){
		echo "<option value='".$result['kd_kec']."'>".$result['nm_kec']."</option>";
	}
?>
