<?php
  session_start();
  include 'config.php';
  include 'alert.php';

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

  $query = mysqli_query($con,"SELECT * FROM tblm_status WHERE kd_status='".$_GET['id']."'");
  $hasil = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MONEV ALSINTAN - Kementrian Pertanian</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />

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
            Monitoring & Evaluasi Alsintan
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Manajemen Data</li>
            <li class="active">Edit Tabel Status</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Form Input Data Tabel Status</h3>
                </div>
                <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php
                if(isset($_POST['update'])){
                  mysqli_query($con,"UPDATE tblm_status SET nm_status='".$_POST['nama']."' WHERE kd_status='".$_GET['id']."'");
                  writeMsg('update.sukses');

                  $query = mysqli_query($con,"SELECT * FROM tblm_status WHERE kd_status='".$_GET['id']."'");
                  $hasil = mysqli_fetch_array($query);
                }
              ?>
              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-2">Kode Status</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="kode" value="<?php echo $hasil['kd_status']; ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-2">Nama Status</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="nama" value="<?php echo $hasil['nm_status']; ?>">
                  </div>
                </div>
              </div>
             
                 <div class="form-group">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="update">Update</button>
                      <a href="edit_status.php" class="btn btn-primary">Kembali</a>
                  </div>
                 </div>
            </form><br/>

              </div><!-- /.box-body -->
            </div><!-- /.box -->
      </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php
        include "footer.php";
      ?>

      <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- Bootstrap 3.3.2 JS -->
      <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- FastClick -->
      <script src='plugins/fastclick/fastclick.min.js'></script>
      <!-- AdminLTE App -->
      <script src="dist/js/app.min.js" type="text/javascript"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="dist/js/demo.js" type="text/javascript"></script>
  </div>
  </body>
</html>