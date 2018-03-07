<?php
include 'config.php';
 
$querylikeprov="SELECT * FROM tblm_kab WHERE kd_kab LIKE '$_POST[namprov]%'"; 
$tampil=mysqli_query($con,$querylikeprov);
$jml=mysqli_num_rows($tampil);
if($jml > 0){
	echo"
	<option value=\"\" selected>-- Pilih Kabupaten --</option>";
	while($r=mysqli_fetch_array($tampil)){
	echo "<option value=$r[kd_kab]>$r[nm_kab]</option>";
	}
}else{
    echo "<option selected>- Data Wilayah Tidak Ada, Pilih Yang Lain -</option>";
}
?>