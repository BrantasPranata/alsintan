<?php
  session_start();
  include 'config.php';
  include 'alert.php';

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

  $query = "SELECT * FROM tb_user ORDER BY id_user";
  $data = mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manajemen Data User - Biaya Pemasaran dan Supply-Demand</title>
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
          <h2 align="center"></h2>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Manajemen Data</li>
            <li class="active">Manajemen User </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Tabel Manajemen Data User</h3>
                </div>
          <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php
                if(isset($_POST['input'])){
                  mysqli_query($con,"INSERT INTO tb_user (username,password,hak_akses,kd_jabatan,nama,alamat,email,no_tlep,tgl_lahir,instansi) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['hak_akses']."','".$_POST['kd_jabatan']."','".$_POST['nama']."','".$_POST['alamat']."','".$_POST['email']."','".$_POST['no_tlep']."','".$_POST['tgl_lahir']."','".$_POST['instansi']."')");
                  writeMsg('save.sukses');
                }
              ?>
              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Username</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                   <label class="control-label col-md-1">Hak Akses</label>
                  <div class="col-md-3">
                    <select class="form-control" name="hak_akses">
                      <option disabled="disabled">--Pilih Hak Akses--</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                  </div>
                </div>
              </div>

               <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Password</label>
                  <div class="col-md-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                   <label class="control-label col-md-1">Jabatan</label>
                  <div class="col-md-3">
                    <select class="form-control" name="kd_jabatan">
                      <option selected="selected" disabled="disabled">--Pilih Jabatan--</option>
                      <option value="manaj">Manajer</option>
                      <option value="karya">Karyawan</option>
                      <option value="direk">Direktur</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Nama</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="nama" placeholder="Nama">
                  </div>
                   <label class="control-label col-md-1">Alamat</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                  </div>
                </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Email</label>
                  <div class="col-md-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                  </div>
                   <label class="control-label col-md-1">No Telp</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="no_tlep" placeholder="No Telp">
                  </div>
                </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Tgl Lahir</label>
                  <div class="col-md-3">
                    <input type="date" class="form-control" name="tgl_lahir" placeholder="Tgl Lahir">
                  </div>
                   <label class="control-label col-md-1">Instansi</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="instansi" placeholder="Instansi">
                  </div>
                </div>
              </div>

              
              <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="input">Input</button>
                      <button type="reset" class="btn btn-primary" name="clear">Clear</button>
                  </div>
                </div>
              </div>
            
            </form></div></div>

            <div class="box box-success">
              <div class="box-header"><h3>Tabel User</h3></div>
              <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">Username</p></th>
                        <th><p style="text-align:center">Password</p></th>
                        <th><p style="text-align:center">Hak Akses</p></th>
                        <th><p style="text-align:center">Kode Jabatan</p></th>
                        <th><p style="text-align:center">Nama</p></th>
                        <th><p style="text-align:center">Alamat</p></th>
                        <th><p style="text-align:center">Email</p></th>
                        <th><p style="text-align:center">No Telepon</p></th>
                        <th><p style="text-align:center">Tangal Lahir</p></th>
                        <th><p style="text-align:center">Instansi</p></th>
                        <th><p style="text-align:center">Action</p></th>
                        <th><p style="text-align:center">Action</p></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT * FROM tb_user";
                      $data = mysqli_query($con,$query);
                      while($hasil = mysqli_fetch_array($data)){
                        ?>
                      <tr>
                        <td><?php echo $hasil['username']; ?></td>
                        <td><?php echo $hasil['password']; ?></td>
                        <td><?php echo $hasil['hak_akses']; ?></td>
                        <td><?php echo $hasil['kd_jabatan']; ?></td>
                        <td><?php echo $hasil['nama']; ?></td>
                        <td><?php echo $hasil['alamat']; ?></td>
                        <td><?php echo $hasil['email']; ?></td>
                        <td><?php echo $hasil['no_tlep']; ?></td>
                        <td><?php echo $hasil['tgl_lahir']; ?></td>
                        <td><?php echo $hasil['instansi']; ?></td>
                        <td><p style="text-align:center"><a href="update_user.php?id=<?php echo $hasil['id_user']; ?>" class="btn btn-primary">Update</a></p></td>
                        <td><p style="text-align:center"><a href="delete_user.php?id=<?php echo $hasil['id_user']; ?>" onclick="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;" class="btn btn-danger">Delete</a></p></td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tfoot>                    
                  </table>

                </div>
                </div>
              
          </div></div>     
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