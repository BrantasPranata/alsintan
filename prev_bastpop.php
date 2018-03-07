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
          
               <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Monitoring dan Evaluasi ALSINTAN</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Preview Data</li>
            <li class="active">BAST Pembayaran</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tabel BAST Pembayaran</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th><p style="text-align:center">No</p></th>
						<th><p style="text-align:center">Tahun</p></th>
						<th><p style="text-align:center">Nama Prov</p></th>
						<th><p style="text-align:center">File</p></th>
						<th><p style="text-align:center">Tanggal Entri</p></th>						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT *
					FROM tbld_bastp
					WHERE kd_prov='".$_SESSION['wilayah']."'
					";
                      $data = mysqli_query($con,$query);
					  $nomer=1;
                      while($hasil = mysqli_fetch_array($data)){
                        ?>
                      <tr>
					    <td><?php echo $nomer++; ?></td>
						<td><?php echo $hasil['tahun']; ?></td>
                        <td><?php echo $hasil['nm_prov']; ?></td>
                        <td><a href="<?php echo $hasil['upload']; ?>" target='_blank'> File BAST</a></td>
						<td><?php echo $hasil['tglentri']; ?></td>
					  </tr>
                    <?php
                      }
                    ?>
                    </tbody>                    
                  </table>
                </div>			
				   
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