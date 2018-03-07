<?php
  session_start();
  
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

 include 'config.php';
 header("Content-Type: application/force-download");
 header("Cache-Control: no-cache, must-revalidate");
 header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
 header("content-disposition: attachment;filename=laporan_hasil_pelayanan_alsintan_".date('dmY').".xls");
 
 //mysql_connect("localhost","root","") or die("Gagal melakukan Koneksi!");
 //mysql_select_db("raport") or die("Gagal memilih Database!");
 

 $query = mysqli_query($con,"SELECT tr_alsintan.id_tr as a,
					tr_alsintan.tanggal as b,
					tblm_komod.nm_komod as c,
					tblm_jenals.nm_jenals as d,
					m_alsintan.merek as e,
					tr_alsintan.hasil as f,
					tr_alsintan.pelayanan as g,
					tblm_sumberdana.nm_sumberdana h,
					tblm_tahunal.nm_tahun as i,
					tblm_pengelolaan.nm_pengelolaan as j,
					m_alsintan.jumlah as k,
					m_alsintan.id_al as l,
					tb_user.username as m
					FROM tr_alsintan
					JOIN m_alsintan ON m_alsintan.id_al = tr_alsintan.id_m
					JOIN  tb_user ON tb_user.id_user = m_alsintan.created_by_userid
					JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
					JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
					JOIN tblm_komod ON tblm_komod.kd_komod = m_alsintan.id_komod
					JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
					JOIN tblm_sumberdana ON tblm_sumberdana.kd_sumberdana = m_alsintan.id_sumberdana
					WHERE tr_alsintan.sts=1 ORDER BY id_tr
							
							");
 echo '';
 ?>
 <h3>Tabel Master Alsintan </h3>
 <table align="center" border="1">
 <tbody>
<tr>
						<td style="background: yellow; font-weight: bold;">No</td>
						<td style="background: yellow; font-weight: bold;">ID Harian</td>
						<td style="background: yellow; font-weight: bold;">Tanggal</td>
						<td style="background: yellow; font-weight: bold;">Komoditi</td>
						<td style="background: yellow; font-weight: bold;">Jenis Alsintan</td>
						<td style="background: yellow; font-weight: bold;">Merk Alsintan</td>
						<td style="background: yellow; font-weight: bold;">Hasil (Ton/Hari)</td>
						<td style="background: yellow; font-weight: bold;">Pelayanan (Ha/Hari)</td>
                        <td style="background: yellow; font-weight: bold;">Sumber Dana</td>
						<td style="background: yellow; font-weight: bold;">Tahun Pengadaan</td>
						<td style="background: yellow; font-weight: bold;">Pola Pengelolaan</td>
						<td style="background: yellow; font-weight: bold;">Jumlah (Unit)</td>
						<td style="background: yellow; font-weight: bold;">ID Master</td>
						<td style="background: yellow; font-weight: bold;">User</td>
						
 </tr>

 <?php
 $nomer = 1;
 while($hasil=mysqli_fetch_array($query)){
 ?>
				<tr>
					  <td><?php echo $nomer++; ?></td>
						<td><?php echo $hasil['a']; ?></td>
                        <td><?php echo $hasil['b']; ?></td>
                        <td><?php echo $hasil['c']; ?></td>
						<td><?php echo $hasil['d']; ?></td>
						<td><?php echo $hasil['e']; ?></td>
                        <td><?php echo $hasil['f']; ?></td>
                        <td><?php echo $hasil['g']; ?></td>
						<td><?php echo $hasil['h']; ?></td>
                        <td><?php echo $hasil['i']; ?></td>
                        <td><?php echo $hasil['j']; ?></td>
                        <td><?php echo $hasil['k']; ?></td>
                        <td><?php echo $hasil['l']; ?></td>
						<td><?php echo $hasil['m']; ?></td>
                      </tr>
<?php
 }
?>
</tbody></table>