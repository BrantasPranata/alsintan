<?php

 include 'config.php';
 header("Content-Type: application/force-download");
 header("Cache-Control: no-cache, must-revalidate");
 header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
 header("content-disposition: attachment;filename=rencana_panen_prov_".date('dmY').".xls");
 
 //mysql_connect("localhost","root","") or die("Gagal melakukan Koneksi!");
 //mysql_select_db("raport") or die("Gagal memilih Database!");

 $qry = "SELECT * FROM tbld_rpanen WHERE kd_prov='".$_GET['prov']."' 
		  and komoditi='".$_GET['komoditi']."' ORDER BY kd_kab "; 
 $query = mysqli_query($con,$qry);
 echo '';
 ?>
 <h3>Tabel Rencana Panen Provinsi </h3>
 <table align="center" border="1">
 <tbody>
<tr>
  <td style="background: yellow; font-weight: bold;">Id</td>
  <td style="background: yellow; font-weight: bold;">Kode Provinsi</td>
  <td style="background: yellow; font-weight: bold;">Nama Provinsi</td>
  <td style="background: yellow; font-weight: bold;">Kode Kabupaten</td>
  <td style="background: yellow; font-weight: bold;">Nama Kabupaten</td>
  <td style="background: yellow; font-weight: bold;">Kode Kecamatan</td>
  <td style="background: yellow; font-weight: bold;">Nama Kecamatan</td>
  <td style="background: yellow; font-weight: bold;">Kode Desa</td>
  <td style="background: yellow; font-weight: bold;">Nama Desa</td>
  <td style="background: yellow; font-weight: bold;">Komoditas</td>
  <td style="background: yellow; font-weight: bold;">Varietas</td>
  <td style="background: yellow; font-weight: bold;">Waktu Panen</td>
  <td style="background: yellow; font-weight: bold;">Luas Panen (Ha)</td>
  <td style="background: yellow; font-weight: bold;">Produktivitas (Ku/Ha)</td>
  <td style="background: yellow; font-weight: bold;">Harga GKP (Rp/Kg)</td>
  <td style="background: yellow; font-weight: bold;">Koordinat Lat</td>
  <td style="background: yellow; font-weight: bold;">Koordinat Long</td>
  <td style="background: yellow; font-weight: bold;">Foto</td>
  <td style="background: yellow; font-weight: bold;">Nama</td>
  <td style="background: yellow; font-weight: bold;">Instansi</td>
  <td style="background: yellow; font-weight: bold;">Nomor HP</td>
  <td style="background: yellow; font-weight: bold;">Waktu Entri</td>
 </tr>

 <?php
 $no = 1;
 while($hasil=mysqli_fetch_array($query)){
 ?>
	  <tr>
		<td><?php echo $hasil['idx']; ?></td>
		<td><?php echo $hasil['kd_prov']; ?></td>
		<td><?php echo $hasil['nm_prov']; ?></td>
		<td><?php echo $hasil['kd_kab']; ?></td>
		<td><?php echo $hasil['nm_kab']; ?></td>
		<td><?php echo $hasil['kd_kec']; ?></td>
		<td><?php echo $hasil['nm_kec']; ?></td>
		<td><?php echo $hasil['kd_desa']; ?></td>
		<td><?php echo $hasil['nm_desa']; ?></td>
		<td><?php echo $hasil['komoditi']; ?></td>
		<td><?php echo $hasil['varietas']; ?></td>
		<td><?php echo $hasil['waktu']; ?></td>
		<td><?php echo $hasil['luas']; ?></td>
		<td><?php echo $hasil['provitas']; ?></td>
		<td><?php echo $hasil['hargagkp']; ?></td>
		<td><?php echo number_format($hasil['peta_lat'],6); ?></td>
		<td><?php echo number_format($hasil['peta_long'],6); ?></td>
	    <td><?php echo $hasil['foto']; ?></td>
	    <td><?php echo $hasil['nama']; ?></td>
		<td><?php echo $hasil['instansi']; ?></td>
		<td><?php echo "&nbsp;".$hasil['nohp']; ?></td>
		<td><?php echo $hasil['tglentri']; ?></td>						
	  </tr>
<?php
 }
?>
</tbody></table>