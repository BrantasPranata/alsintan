<?php

  session_start();

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }
  
  $user = $_SESSION['username'];
  include "config.php";
  $query = "SELECT * FROM tb_user WHERE username = '$user' ";
  $data = mysqli_query($con,$query);
  $row = mysqli_fetch_array($data);
  
  include 'alert.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profile - Aplikasi SIPA </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
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
          <h1>My Profile</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<div class="row">
            <div class="col-xs-12">
              <div class="box box-success">
				<!-- form start -->
				
                <form role="form" method="post">
					<?php
					if(isset($_GET['error'])){
						$error = $_GET['error'];
							if($error == 0)
								writeMsg('update.sukses');
              else if($error == 1)
                writeMsg('update.gagal');
					}
					?>
				
				  <div class="box-body">
				  <br/>
				  <dl class="dl-horizontal">
				  <dt>Username</dt>
				   <dd><?php echo $row['username'];?></dd>
				   <br/>
				  <dt>Email</dt>
				   <dd><?php echo $row['email'];?></dd>
				   <br/>
				  <dt>Nama</dt>
				   <dd><?php echo $row['nama'];?></dd>
				   <br/>
				  <dt>Tanggal Lahir</dt>
				   <dd><?php echo $row['tgl_lahir'];?></dd>
				   <br/>
				  <dt>Phone</dt>
				   <dd><?php echo $row['no_tlep'];?></dd>
				   <br/>
				  <dt>Alamat</dt>
				   <dd><?php echo $row['alamat'];?></dd>
				   <br/>
				  <dt>Password</dt>
				   <dd><?php echo $row['password'];?></dd>
				   <br/>
				  <dt>latitude</dt>
				   <dd><?php echo $row['lat'];?></dd>
				   <br/>
				  <dt>longitude</dt>
				   <dd><?php echo $row['lng'];?></dd>
				   <br/>
				   
                  </div><!-- /.box-body -->        
				
				</form>
				
				<div class="box-footer">
				  <div class="col-xs-12">
                    <button type="submit" class="btn btn-success" name="submit" data-toggle="modal" data-target="#editpro">Edit Profile</button>
				  </div>
                  </div>
				
              </div><!-- /.box -->
            </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <div class="modal fade" id="editpro" tabindex="-1" role="dialog" aria-labelledby="editlabel" aria-hidden="true">
    	<div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="apbdlabel">Edit My Profil</h4>
                </div>
                <div class="modal-body">
                	<form role="form" action="updateprofile.php" method="post">
<!--                    	<b>Username</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-at"></i></span>
							  <input name="username" type="text" class="form-control" value="<?php echo $row['username'];?>" >
							</div>
						<br/>-->
						<b>Email</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							  <input name="email" type="text" class="form-control" value="<?php echo $row['email'];?>" >
							</div>
						<br/>
						<b>Nama</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-user"></i></span>
							  <input name="nama" type="text" class="form-control" value="<?php echo $row['nama'];?>" >
							</div>
						<br/>
						<b>Phone</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
							  <input name="no_tlep" type="text" class="form-control" value="<?php echo $row['no_tlep'];?>" >
							</div>
							<br/>
						<b>Alamat</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
							  <input name="alamat" type="text" class="form-control" value="<?php echo $row['alamat'];?>" >
							</div>
						<br/>
						<b>Password</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
							  <input name="password" type="text" class="form-control" value="<?php echo $row['password'];?>" >
							</div>
						<br/>
						<b>Latitude</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
							  <input name="password" type="text" class="form-control" value="<?php echo $row['lat'];?>" >
							</div>
						<br/>
						<b>Longitude</b>
							<div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
							  <input name="password" type="text" class="form-control" value="<?php echo $row['lng'];?>" >
							</div>
						<br/>
                </div>
                <div class="modal-footer">
                		<button type="submit" class="btn btn-success">Update</button>
                    </form>
                	<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
	  
	  
	  
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

  </body>
</html>
