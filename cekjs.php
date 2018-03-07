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
    <title>PUSDATIN Basis Data Harga Komoditas Pertanian</title>
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
          <h1>
            Harga Gabah
            <small>Laporan Harga Gabah (BPS)</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Preview Data</li>
            <li class="active">Harga Gabah</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tabel Data Harga Gabah</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Tahun</th>
                        <th>Kode</th>
                        <th>Kualitas</th>
                        <th>HPP</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>Mei</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Agu</th>
                        <th>Sep</th>
                        <th>Okt</th>
                        <th>Nov</th>
                        <th>Des</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = mysql_query("SELECT * FROM tbldatahgb order by tahun");
                      while($hasil = mysql_fetch_array($query)){
                        ?>
                      <tr>
                        <th><?php echo $hasil['tahun']; ?></th>
                        <th><?php echo $hasil['kode']; ?></th>
                        <th><?php echo $hasil['kualitas']; ?></th>
                        <th><?php echo $hasil['hpp']; ?></th>
                        <th><?php echo $hasil['bln1']; ?></th>
                        <th><?php echo $hasil['bln2']; ?></th>
                        <th><?php echo $hasil['bln3']; ?></th>
                        <th><?php echo $hasil['bln4']; ?></th>
                        <th><?php echo $hasil['bln5']; ?></th>
                        <th><?php echo $hasil['bln6']; ?></th>
                        <th><?php echo $hasil['bln7']; ?></th>
                        <th><?php echo $hasil['bln8']; ?></th>
                        <th><?php echo $hasil['bln9']; ?></th>
                        <th><?php echo $hasil['bln10']; ?></th>
                        <th><?php echo $hasil['bln11']; ?></th>
                        <th><?php echo $hasil['bln12']; ?></th>
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>                    
                  </table>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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