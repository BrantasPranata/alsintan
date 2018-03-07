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
    <title>SIPIPA - Kementerian Pertanian</title>
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
  <body class="skin-green sidebar-mini">
    <div class="wrapper">
        <?php
            include "header.php";
            include "nav.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Sistem Informasi Penggilingan Padi</h1>
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
                  <h3 class="box-title">Tabel Volume & Harga Bulanan</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><p style="text-align:center">Nama User</p></th>
                        <th><p style="text-align:center">Kode BPS</p></th>
                        <th><p style="text-align:center">Nama Desa</p></th>
                        <th><p style="text-align:center">Bulan</p></th>
                        <th><p style="text-align:center">Periode</p></th>
                        <th><p style="text-align:center">Jenis Gilingan</p></th>					
                        <th><p style="text-align:center">Kapasitas</p></th>
                        <th><p style="text-align:center">Volume Gilingan</p></th>
                        <th><p style="text-align:center">Harga Jual (Rp/Kg)  </p></th>
                        <th><p style="text-align:center">Koordinat Lat</p></th>
						<th><p style="text-align:center">Koordinat Long</p></th>
						<th><p style="text-align:center">Waktu Entri</p></th>						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT * FROM tr_giling where user_name='".$_SESSION['username']."' order by jenis_g,periode ";
                      $data = mysqli_query($con,$query);
                      while($hasil = mysqli_fetch_array($data)){
                        ?>
                      <tr>
                        <td><?php echo $hasil['user_name']; ?></td>
                        <td><?php echo $hasil['kode_wil']; ?></td>
                        <td><?php 
                      $query1 = "SELECT * FROM tblm_desa where kd_desa='".$hasil['kode_wil']."'";
                      $data1 = mysqli_query($con,$query1);
                      while($hasil1 = mysqli_fetch_array($data1)){						
						echo $hasil1['nm_desa']; }?></td>
                        <td><?php                       
						$query2 = "SELECT * FROM tblm_bulan where kd_bulan ='".$hasil['bulan']."'";
                      $data2 = mysqli_query($con,$query2);
                      while($hasil2 = mysqli_fetch_array($data2)){						
						echo $hasil2['nm_bulan']; }?></td>
                        <td><?php echo $hasil['periode']; ?></td>
                        <td><?php 
                      $query3 = "SELECT * FROM tblm_komo where kd_komo='".$hasil['jenis_g']."'";
                      $data3 = mysqli_query($con,$query3);
                      while($hasil3 = mysqli_fetch_array($data3)){						
						echo $hasil3['nm_komo']; }?></td>
                        <td><?php echo $hasil['kapasitas']; ?></td>
                        <td><?php echo $hasil['vol_g']; ?></td>
                        <td><?php echo $hasil['h_jual']; ?></td>
                        <td><?php echo number_format($hasil['lat'],6); ?></td>
                        <td><?php echo number_format($hasil['lng'],6); ?></td>
                        <td><?php echo $hasil['created_date']; ?></td>
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