<?php
include 'config.php';
 
$querylikekabu="SELECT * FROM tblm_kec WHERE kd_kec LIKE '$_POST[namkab]%'"; 
$tampil=mysqli_query($con,$querylikekabu);
$jml=mysqli_num_rows($tampil);
if($jml > 0){
	echo"
	<option value=\"\" selected>-- Pilih Kecamatan --</option>";
	while($r=mysqli_fetch_array($tampil)){
	echo "<option value=$r[kd_kec]>$r[nm_kec]</option>";
	}
}else{
    echo "<option selected>- Data Wilayah Tidak Ada, Pilih Yang Lain -</option>";
}
?>