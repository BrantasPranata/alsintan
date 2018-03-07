<?php
  session_start();
  include 'config.php';
  include 'alert.php';
  $link_upload= "http://".$_SERVER['SERVER_NAME']."/alsintantp/upl/";
  //$link_upload="http://localhost:82/alsintantp/upl/";

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ALSINTANTP - Kementerian Pertanian</title>
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

	<!-- Bootstrap --> 
    <link href="bootstrap/css/datepicker.css" rel="stylesheet">

	</head>
  <body class="skin-green  sidebar-mini">
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
            <li>Upload BAST</li>
            <li class="active">BAST Hibah</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Upload BAST Hibah</h3>
                </div>
          <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php

                if(isset($_POST['save'])){
	
					$sql = "SELECT * FROM tblm_prov WHERE kd_prov = '".$_POST['prov']."'";
					$result = $con->query($sql);
					$nm_prov= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_prov= $row['nm_prov'];
						}						
					} 
			
					$qry1="INSERT INTO tbld_basth (
					tahun,
					kd_prov,
					nm_prov,
					uploadby_user_id)
					VALUES 
					('".$_POST['tahun']."',
					'".$_POST['prov']."',
					'".$nm_prov."',
					'".$_SESSION['id_user']."')";
					
					//ECHO $qry1;
					$sql = "SELECT * FROM tbld_basth WHERE 
					tahun = '".$_POST['tahun']."' AND
					kd_prov = '".$_POST['prov']."'";
					
					$result = $con->query($sql);
					$idrec= 0;					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$idrec= $row['idx'];
						//ECHO "no. record= ".$idrec;
						}
					}
					else {
						if ($_POST['prov'] != NULL) {
						mysqli_query($con,$qry1);
						$idrec = mysqli_insert_id($con);
						}
					}
					
					$uploads_dir = './upl';
					if ($error == UPLOAD_ERR_OK) {						
						$tmp_name = $_FILES["filebast"]["tmp_name"];
						$filename = basename($_FILES["filebast"]["name"]);
						$ext = end(explode('.',$filename));
						$name = "basth_".$_POST['tahun'].$_POST['prov']."_".$idrec.".".$ext;
						try{
							move_uploaded_file($tmp_name, "$uploads_dir/$name");							
							$link= $link_upload.$name;
						} catch(Exception $e){
							var_dump($e);
						}
						
						if ($ext != NULL) {
							mysqli_query($con,"UPDATE tbld_basth SET upload='".$link."' WHERE idx='".$idrec."'");
						}			
					}		
					//echo $qry1 ;
               }
              ?>
			  
               <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Provinsi</label>
					<div class="col-sm-3">
						<select class="form-control" name="prov" id="prov">
							<option value="">-- Pilih Provinsi --</option>
							<?php
								$qStr = "SELECT * FROM tblm_prov ORDER BY kd_prov";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['kd_prov']==$_POST['prov']) {
									echo "<option value='".$result['kd_prov']."' selected>".$result['nm_prov']."</option>";
									}
									else {
									echo "<option value='".$result['kd_prov']."'>".$result['nm_prov']."</option>";
									}
								}
							?>
						</select>
					</div>
				</div>
              </div>					
					

               <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>					
					<label class="control-label col-md-1">Tahun</label>
					<div class="col-sm-3">
						<select class="form-control" name="tahun" id="tahun">
							<option value="">-- Pilih Tahun --</option>
							<?php
								$qStr = "SELECT * FROM tblm_tahun ORDER BY tahun";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['tahun']==$_POST['tahun']) {
									echo "<option value='".$result['tahun']."' selected>".$result['tahun']."</option>";
									}
									else {
									echo "<option value='".$result['tahun']."'>".$result['tahun']."</option>";
									}
								}
							?>
						</select>
					</div>	
				</div>
              </div>

             <div class="form-group">  
                 <div class="row">
					<div class="col-md-2"></div>
					<label class="control-label col-md-1">Upload BAST</label>
                  <div class="col-md-3">
                    <input type="file" class="form-control" name="filebast" id="filebast">
                  </div>
                </div>
              </div>			
			
              <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="save">Save</button>
                      <button type="reset" class="btn btn-primary" name="clear">Clear</button>
                  </div>
                </div>
              </div>
            
            </form></div></div>

			<?php
			if(isset($_POST['save'])){	

			?>				
			
            <div class="box box-success">
              <div class="box-header"><h3>Detail Data BAST Hibah</h3></div>
              <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">ID</p></th>
                        <th><p style="text-align:center">Tahun</p></th>
                        <th><p style="text-align:center">Nama Provinsi</p></th>
						<th><p style="text-align:center">File BAST</p></th>
						<th><p style="text-align:center">Waktu Entri</p></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT  * FROM tbld_basth WHERE idx='".$idrec."' ORDER BY idx ";
                      $data = mysqli_query($con,$query);
					  
					  if ($data->num_rows > 0) {
						  writeMsg('save.sukses');
					      } 
					  else {
						  writeMsg('save.gagal');
					  }  
					  					  
                      while($hasil = mysqli_fetch_array($data)){
 
                        ?>
                      <tr>
						<td><?php echo $hasil['idx']; ?></td>
                        <td><?php echo $hasil['tahun']; ?></td>
                        <td><?php echo $hasil['nm_prov']; ?></td>
						<?php
						if ($hasil['upload'] != "") {
							echo "<td><a href='".$hasil['upload']."' target='_blank'> File BAST</></td>";							
						}
						else {
							echo "<td>-</td>";
						}						
						?>
                        <td><?php echo $hasil['tglentri']; ?></td>						
                      </tr>
                      <?php
                        }
                      ?>
                    </tfoot>                    
                  </table>

                </div>
                </div>
              
			<?php
			}		
			?>
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
	
	<script src="js/bootstrap-datepicker.js"></script>
    <script>
    $(".input-group.date").datepicker({
		startDate: 'd',
        endDate: '+12m',
		autoclose: true, 
		todayHighlight: true
		});
    </script>		
	
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
	  
	  function provChange(p_id) {
		  $.ajax({
			 type: "POST",
			 url: "/epanen/ajax_kab_kota.php",
			 data: {kd_prov: p_id},
			 success: function(data) {
				 $('#kabu').html(data);
			 }
		  });
		  $('#keca').html('<option value="">-- Pilih Kecamatan --</option>');
		  $('#desa').html('<option value="">-- Pilih Desa --</option>');		  
	  }
	  
	  function kabuChange(k_id) {
		  $.ajax({
			 type: "POST",
			 url: "/epanen/ajax_kec.php",
			 data: {kd_kab: k_id},
			 success: function(data) {
				 $('#keca').html(data);
			 }
		  });
	  }
	  
	  function kecaChange(k_id) {
		  $.ajax({
			 type: "POST",
			 url: "/epanen/ajax_desa.php",
			 data: {kd_kec: k_id},
			 success: function(data) {
				 $('#desa').html(data);
			 }
		  });
	  }
	  
    </script>

  </div>
  </body>
</html>