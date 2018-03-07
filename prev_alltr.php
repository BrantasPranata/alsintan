<?php
  session_start();
  include "config.php";
  
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }
  
  $hak = $_SESSION['hak_akses'];
  if($hak<3){header('location:prev_transaksiop.php');}
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
          
               <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Monitoring dan Evaluasi ALSINTAN</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Preview Data</li>
            <li class="active">Master Alsintan</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tabel Master Alsintan</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th><p style="text-align:center">No</p></th>
						<th><p style="text-align:center">ID Harian</p></th>
						<th><p style="text-align:center">Tanggal</p></th>
						<th><p style="text-align:center">Komoditi</p></th>
						<th><p style="text-align:center">Jenis Alsintan</p></th>
						<th><p style="text-align:center">Merk Alsintan</p></th>
						<th><p style="text-align:center">Hasil (Ton/Hari)</p></th>
						<th><p style="text-align:center">Pelayanan (Ha/Hari)</p></th>
                        <th><p style="text-align:center">Sumber Dana</p></th>
						<th><p style="text-align:center">Tahun Pengadaan</p></th>
						<th><p style="text-align:center">Pola Pengelolaan</p></th>
						<th><p style="text-align:center">Jumlah (Unit)</p></th>
						<th><p style="text-align:center">ID Master</p></th>
						<th><p style="text-align:center">User</p></th>
                        <th><p style="text-align:center">Action </p></th>						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT tr_alsintan.id_tr as a,
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
					WHERE tr_alsintan.sts=1 ORDER BY id_tr";
                      $data = mysqli_query($con,$query);
					  $nomer=1;
                      while($hasil = mysqli_fetch_array($data)){
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
						<td><a onclick="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;" href="hapustr.php?id=<?php echo $hasil['a']; ?>" class="btn btn-danger">HAPUS</a></td>
					  </tr>
                    <?php
                      }
                    ?>
                    </tbody>                    
                  </table>
                </div>			
			<?php				
				echo '<br> Simpan format: <a href="prevalltr_xls.php">XLS</a>';			
                				
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

    
  </body>
</html>