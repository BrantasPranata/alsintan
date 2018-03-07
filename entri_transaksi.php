<?php
  session_start();
  include "config.php";
  
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ALSINTAN - Kementerian Pertanian</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
            include "header.php";
            include "nav.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Monitoring dan Evaluasi ALSINTAN</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Preview Data</li>
            <li class="active">Laporan Bulanan</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tabel Alsintan</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th><p style="text-align:center">Nomer</p></th>
						<th><p style="text-align:center">Dibuat Oleh</p></th>
						<th><p style="text-align:center">Komoditi</p></th>
						<th><p style="text-align:center">Jenis Alsintan</p></th>
						<th><p style="text-align:center">Merk Alsintan</p></th>
                        <th><p style="text-align:center">Provinsi</p></th>
						<th><p style="text-align:center">Kabupaten</p></th>
						<th><p style="text-align:center">Kecamatan</p></th>
						<th><p style="text-align:center">Desa</p></th>
						<th><p style="text-align:center">Lembaga</p></th>
                        <th><p style="text-align:center">Nama Lembaga</p></th>
						<th><p style="text-align:center">Koordinat Lat</p></th>
						<th><p style="text-align:center">Koordinat Lang</p></th>
                        <th><p style="text-align:center">Sumber Dana</p></th>
						<th><p style="text-align:center">Tahun Pengadaan</p></th>
						<th><p style="text-align:center">Status</p></th>
						<th><p style="text-align:center">Pola Pengelolaan</p></th>
						<th><p style="text-align:center">Jumlah (Unit)</p></th>
						<th><p style="text-align:center">Action</p></th>
                        <th><p style="text-align:center">Action </p></th>						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT m_alsintan.id_al as a,
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
					  WHERE sts=1
					  ORDER BY id_al
							
							";
                      $data = mysqli_query($con,$query);
					  $nomer=1;
                      while($hasil = mysqli_fetch_array($data)){
                        ?>
                      <tr>
					  <td><?php echo $nomer++; ?></td>
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
						<td><a class="btn btn-success">INPUT HASIL/PELAYANAN</a></td>
						<td><a onclick="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;" href="hapus.php?id=<?php echo $hasil['a']; ?>" class="btn btn-danger">HAPUS</a></td>
					  </tr>
                    <?php
                      }
                    ?>
                    </tbody>                    
                  </table>
                </div>			
			<?php				
				echo '<br> Simpan format: <a href="prevall_xls.php">XLS</a>';			
                				
            ?>		   
          </div></div>     
      </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php
        include "footer.php";
      ?>

      <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

    </div>
  </body>
</html>