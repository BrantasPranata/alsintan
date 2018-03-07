<?php
  session_start();
  
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

 include 'config.php';
 header("Content-Type: application/force-download");
 header("Cache-Control: no-cache, must-revalidate");
 header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
 header("content-disposition: attachment;filename=laporan_master_alsintan_".date('dmY').".xls");
 
 //mysql_connect("localhost","root","") or die("Gagal melakukan Koneksi!");
 //mysql_select_db("raport") or die("Gagal memilih Database!");
 

 $query = mysqli_query($con,"SELECT m_alsintan.id_al as a,
					  tb_user.username as b,
					  tblm_komod.nm_komod as z,
					  tblm_jenals.nm_jenals as c,
					  m_alsintan.merek as d,
                      tblm_prov.nm_prov as e1,
                      tblm_kab.nm_kab as e2,
                      tblm_kec.nm_kec as e3,
                      tblm_desa.nm_desa as e4,
					  tblm_lembaga.nm_lembaga as f,
					  m_alsintan.poktangapoktan as g,
					  m_alsintan.lat as lat,
					  m_alsintan.lat as lang,
					  tblm_sumberdana.nm_sumberdana as h,
					  tblm_tahunal.nm_tahun as i,
					  tblm_status.nm_status as j,
					  tblm_pengelolaan.nm_pengelolaan as k,
					  m_alsintan.jumlah as l,
					  tblm_kondisi.nm_kondisi as kond,
					  m_alsintan.created_date,
					  m_alsintan.sts
					  FROM m_alsintan
					  JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
					  JOIN tb_user ON tb_user.id_user = m_alsintan.created_by_userid
                      LEFT JOIN tblm_prov ON tblm_prov.kd_prov = m_alsintan.provinsi
                      LEFT JOIN tblm_kab ON tblm_kab.kd_kab = m_alsintan.kabupaten
					  LEFT JOIN tblm_kec ON tblm_kec.kd_kec = m_alsintan.kecamatan
                      LEFT JOIN tblm_desa ON tblm_desa.kd_desa = m_alsintan.desa
					  JOIN tblm_sumberdana ON tblm_sumberdana.kd_sumberdana = m_alsintan.id_sumberdana
					  JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
					  JOIN tblm_komod ON tblm_komod.kd_komod = m_alsintan.id_komod
					  JOIN tblm_status ON tblm_status.kd_status = m_alsintan.kd_status
					  JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
					  JOIN tblm_lembaga ON tblm_lembaga.id_lembaga = m_alsintan.id_lembaga
                      JOIN tblm_kondisi ON tblm_kondisi.kd_kondisi = m_alsintan.kd_kondisi
					  WHERE sts=1
					  ORDER BY id_al
							
							");
 echo '';
 ?>
 <h3>Tabel Master Alsintan </h3>
 <table align="center" border="1">
 <tbody>
<tr>
						<td style="background: yellow; font-weight: bold;">Nomor</td>
						<td style="background: yellow; font-weight: bold;">ID Master</td>
						<td style="background: yellow; font-weight: bold;">Dibuat Oleh</td>
						<td style="background: yellow; font-weight: bold;">Komoditi</td>
						<td style="background: yellow; font-weight: bold;">Jenis Alsintan</td>
						<td style="background: yellow; font-weight: bold;">Merk Alsintan</td>
                        <td style="background: yellow; font-weight: bold;">Provinsi</td>
						<td style="background: yellow; font-weight: bold;">Kabupaten</td>
						<td style="background: yellow; font-weight: bold;">Kecamatan</td>
						<td style="background: yellow; font-weight: bold;">Desa</td>
						<td style="background: yellow; font-weight: bold;">Lembaga</td>
                        <td style="background: yellow; font-weight: bold;">Nama Lembaga</td>
						<td style="background: yellow; font-weight: bold;">Koordinat Lat</td>
						<td style="background: yellow; font-weight: bold;">Koordinat Lang</td>
                        <td style="background: yellow; font-weight: bold;">Sumber Dana</td>
						<td style="background: yellow; font-weight: bold;">Tahun Pengadaan</td>
						<td style="background: yellow; font-weight: bold;">Status</td>
						<td style="background: yellow; font-weight: bold;">Pola Pengelolaan</td>
						<td style="background: yellow; font-weight: bold;">Jumlah (Unit)</td>
						<td style="background: yellow; font-weight: bold;">Kondisi</td>
 </tr>

 <?php
 $nomer = 1;
 while($hasil=mysqli_fetch_array($query)){
 ?>
				<tr>
					  <td><?php echo $nomer++; ?></td>
						<td><?php echo $hasil['a']; ?></td>
                        <td><?php echo $hasil['b']; ?></td>
						<td><?php echo $hasil['z']; ?></td>
                        <td><?php echo $hasil['c']; ?></td>
						<td><?php echo $hasil['d']; ?></td>
                        <td><?php echo $hasil['e1']; ?></td>
						<td><?php echo $hasil['e2']; ?></td>
						<td><?php echo $hasil['e3']; ?></td>
						<td><?php echo $hasil['e4']; ?></td>
                        <td><?php echo $hasil['f']; ?></td>
                        <td><?php echo $hasil['g']; ?></td>
						<td><?php echo $hasil['lat']; ?></td>
						<td><?php echo $hasil['lang']; ?></td>
						<td><?php echo $hasil['h']; ?></td>
                        <td><?php echo $hasil['i']; ?></td>
                        <td><?php echo $hasil['j']; ?></td>
                        <td><?php echo $hasil['k']; ?></td>
                        <td><?php echo $hasil['l']; ?></td>
						<td><?php echo $hasil['kond']; ?></td>
                      </tr>
<?php
 }
?>
</tbody></table>