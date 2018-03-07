<?php
include 'config.php';
 
$querylikekeca="SELECT * FROM tblm_desa WHERE kd_desa LIKE '$_POST[namkec]%'"; 
$tampil=mysqli_query($con,$querylikekeca);
$jml=mysqli_num_rows($tampil);
if($jml > 0){
	echo"
	<option value=\"\" selected>-- Pilih Desa --</option>";
	while($r=mysqli_fetch_array($tampil)){
	echo "<option value=$r[kd_desa]>$r[nm_desa]</option>";
	}
}else{
    echo "<option selected>- Data Wilayah Tidak Ada, Pilih Yang Lain -</option>";
}
?>