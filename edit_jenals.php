<?php
  session_start();
  include 'config.php';
  include 'alert.php';

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

  $query = "SELECT * FROM tblm_jenals ORDER BY kd_jenals";
  $data = mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MONEV ALSINTAN - Kementerian Pertanian</title>
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
            Monitoring & Evaluasi Alat dan Mesin Pertanian
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Manajemen Data</li>
            <li class="active">Tabel Jenis Alsintan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Form Input Data Tabel Jenis Alsintan</h3>
                </div>
                <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php
                if(isset($_POST['input'])){
                  mysqli_query($con,"INSERT INTO tblm_jenals (kd_jenals,nm_jenals) VALUES ('".$_POST['kode']."','".$_POST['nama']."')");
                  writeMsg('save.sukses');
                }
              ?>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-2">Kode Jenis Alsintan</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="kode" placeholder="Input Kode Jenis Alsintan">
                  </div>
                </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-2">Nama Jenis Alsintan</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="nama" placeholder="Input Nama Jenis Alsintan">
                  </div>
                </div>
              </div>

             
                 <div class="form-group">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="input">Input</button>
                      <button type="reset" class="btn btn-primary" name="clear">Clear</button>
                  </div>
                 </div>
               </div>
            </form></div></div>

            <div class="box box-success">
              <div class="box-header"><h3>Tabel Jenis Alsintan</h3></div>
              <div class="box-body table-responsive text-center">
            <table id="example1" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">Kode Jenis Alsintan</p></th>
                        <th><p style="text-align:center">Nama Jenis Alsintan</p></th>
                        <th><p style="text-align:center">Aksi</p></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT * FROM tblm_jenals ORDER BY kd_jenals";
                      $data = mysqli_query($con,$query);
                      while($hasil = mysqli_fetch_array($data)){
                        ?>
                      <tr>
                        <td><?php echo $hasil['kd_jenals']; ?></td>
                        <td><?php echo $hasil['nm_jenals']; ?></td>
                        <td><p style="text-align:center"><a href="update_jenals.php?id=<?php echo $hasil['kd_jenals']; ?>" class="btn btn-primary">Update</a>&nbsp;&nbsp;<a href="delete_jenals.php?id=<?php echo $hasil['kd_jenals']; ?>" onclick="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;" class="btn btn-danger">Delete</a></p></td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>                    
                  </table>
                </div>
              </div>

      </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php
        include "footer.php";
      ?>

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
          "bAutoWidth": false,
        });
      });
    </script>
  </div>
  </body>
</html>