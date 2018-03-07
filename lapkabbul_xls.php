<?php

 include 'config.php';
 header("Content-Type: application/force-download");
 header("Cache-Control: no-cache, must-revalidate");
 header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
 header("content-disposition: attachment;filename=laporan_provinsi_".date('dmY').".xls");
 
 //mysql_connect("localhost","root","") or die("Gagal melakukan Koneksi!");
 //mysql_select_db("raport") or die("Gagal memilih Database!");
 
 $sql = "SELECT * FROM tblm_prov WHERE kd_prov = '".$_GET['prov']."'";
					$result = $con->query($sql);
					$nm_prov= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_prov= $row['nm_prov'];
						}						
					} 

$sql = "SELECT * FROM tblm_kab WHERE kd_kab = '".$_GET['kabu']."'";
$result = $con->query($sql);
$nm_kabu= "";					
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$nm_kabu= $row['nm_kab'];
	}						
} 
						
 $sql = "SELECT * FROM tblm_bulan WHERE kd_bulan = '".$_GET['bulan']."'";
					$result = $con->query($sql);
					$nm_bulan= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_bulan= $row['nm_bulan'];
						}						
					}					
 
 $query = mysqli_query($con,"SELECT nm_kec, 
						SUM(luas) AS SUMPanen,
						AVG(provitas) AS AVGPanen
						FROM  tbld_rpanen 
						WHERE kd_kab =  '".$_GET['kabu']."'
						AND DATE_FORMAT( waktu,  '%Y' ) =  '".$_GET['tahun']."'
						AND DATE_FORMAT( waktu,  '%m' ) =  '".$_GET['bulan']."'
						GROUP BY nm_kec ORDER BY nm_kec");
 echo '';
 ?>
 <h3>Laporan Rencana Panen Kabupaten Bulanan</h3>
  <table align="center" border="0">
 <tbody>
 	<tr>
	  <td style="background: #EEE; font-weight: bold;">Provinsi</td>
	  <td style="background: #EEE; font-weight: bold;">: <?php echo $nm_prov;?></td>
	</tr>
	<tr>
	  <td style="background: #EEE; font-weight: bold;">Kabupaten</td>
	  <td style="background: #EEE; font-weight: bold;">: <?php echo $nm_kabu;?></td>
	</tr>
	<tr>
	  <td style="background: #EEE; font-weight: bold;">Komoditi</td>
	  <td style="background: #EEE; font-weight: bold;">: <?php echo $_GET['komoditi'];?></td>
	</tr>
	<tr>
	  <td style="background: #EEE; font-weight: bold;">Bulan</td>
	  <td style="background: #EEE; font-weight: bold;">: <?php echo $nm_bulan;?></td>
	</tr>
	<tr>
	  <td style="background: #EEE; font-weight: bold;">Tahun</td>
	  <td style="background: #EEE; font-weight: bold;">: <?php echo $_GET['tahun'];?></td>
	</tr>
 </tbody></table>
 <br>	
 <table align="center" border="1">
 <tbody>
<tr>
  <td style="background: yellow; font-weight: bold;">No.</td>
  <td style="background: yellow; font-weight: bold;">Nama Kecamatan</td>
  <td style="background: yellow; font-weight: bold;">Luas Panen (Ha)</td>
  <td style="background: yellow; font-weight: bold;">Produktivitas (Ku/Ha)</td>
 </tr>
 <?php
 $no = 1;
	$nobar  = 0;
	$isiavg = 0;
	$totsum = 0;
	$totavg = 0;
 while($data=mysqli_fetch_array($query)){
	$nobar = $nobar + 1;
	$totsum = $totsum + $data['SUMPanen'];  
	$totavg = $totavg + $data['AVGPanen'];
	if ($data['AVGPanen']>0) {
		$isiavg = $isiavg + 1;
	}		 
  echo ' <tr>
    <td>' . $no++ . '.</td>
    <td>' . $data['nm_kec'] . '</td>
    <td>' . $data['SUMPanen'] . '</td>
    <td>' . number_format($data['AVGPanen'],1). '</td>
   </tr> ';
 }
	$nasavg = 0;
	if ($isiavg > 0) {							
		$nasavg = $totavg/$isiavg;
	} 
  echo ' <tr>
    <td style="background: yellow; font-weight: bold;"> </td>
    <td style="background: yellow; font-weight: bold;">Kabupaten</td>
    <td style="background: yellow; font-weight: bold;">' . $totsum . '</td>
    <td style="background: yellow; font-weight: bold;">' . number_format($nasavg,1). '</td>
   </tr> '; 
?>
</tbody></table>