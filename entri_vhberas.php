<?php
  session_start();
  include 'config.php';
  include 'alert.php';
  //$link_upload= "http://".$_SERVER['SERVER_NAME']."/sipipa/upl/";
  $link_upload="http://localhost/sipipa/upl/";

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
          <h1>Sistem Informasi Pendataan Penggilingan Padi</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Input Data</li>
            <li class="active">Data Volume & Harga Beras</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Input Data Volume dan Harga Beras</h3>
                </div>
          <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php

                if(isset($_POST['save'])){
										
					$qry1="INSERT INTO tr_giling (
					user_name,
					kode_wil,
					bulan,
					periode,
					jenis_g,
					kapasitas,
					vol_g,
					h_jual,
          lat,
          lng,
          sts
					)
					VALUES 
					('".$_SESSION['username']."',
					'".$_SESSION['wilayah']."',
					'".$_POST['prov']."',
					'".$_POST['kabu']."',
					'".$_POST['komoditi']."',
					".$_POST['varietas'].",
					".$_POST['provitas'].",
					".$_POST['hargagkp'].",					
					'".$_SESSION['lat']."',					
					'".$_SESSION['lng']."','1')";
					

					$sql = "SELECT * FROM tr_giling WHERE 
          user_name = '".$_SESSION['username']."' and
					kode_wil = '".$_SESSION['wilayah']."' and bulan ='".$_POST['prov']."' and periode = '".$_POST['kabu']."' and jenis_g = '".$_POST['komoditi']."'";
					$result = $con->query($sql);
					$idrec= 0;					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$idrec= $row['idx'];
						//ECHO "no. record= ".$idrec;
						}
						$qry2= "UPDATE tr_giling SET 
						lat=".$_SESSION['lat'].",	
						lng=".$_SESSION['lng']."
						WHERE idx='".$idrec."'";						
						mysqli_query($con,$qry2);
						//ECHO $qry2;						
					}
					else {
						mysqli_query($con,$qry1);
						$idrec = mysqli_insert_id($con);						
					}	
					
					//echo $qry1 ;
               }
              ?>
			  <div class="form-group">  
			  
               <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Bulan<sup>*</sup></label>
					<div class="col-sm-3">
						<select class="form-control" name="prov" id="prov" onchange="provChange($(this).val());">
							<option value="">-- Pilih Bulan --</option>
							<?php
								$qStr = "SELECT * FROM tblm_bulan";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['kd_bulan']==$_POST['prov']) {
									echo "<option value='".$result['kd_bulan']."' selected>".$result['nm_bulan']."</option>";
									}
									else {
									echo "<option value='".$result['kd_bulan']."'>".$result['nm_bulan']."</option>";
									}
								}
							?>

						</select>
					</div>
					
                  <label class="control-label col-md-1">Periode<sup>*</sup></label>
                  <div class="col-sm-3">
						<select class="form-control" name="kabu" id="kabu" onchange="kabuChange($(this).val());">
							<option value="">-- Pilih Periode --</option>
		                    <option value="I">I</option>
		                    <option value="II">II</option>
		                    <option value="III">III</option>
		                    <option value="IV">IV</option>
						</select>
					</div>
				</div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
				  <label class="control-label col-md-1">Jenis<sup>*</sup></label>
				  <div class="col-md-3">
                    <select class="form-control" name="komoditi">
                    <option value="">-- Pilih Jenis Giling --</option>
							<?php
								$qStr = "SELECT * FROM tblm_komo";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['kd_komo']==$_POST['prov']) {
									echo "<option value='".$result['kd_komo']."' selected>".$result['nm_komo']."</option>";
									}
									else {
									echo "<option value='".$result['kd_komo']."'>".$result['nm_komo']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>

                  <label class="control-label col-md-1">Kapasitas (Ton/Jam)</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="varietas" placeholder="Kapasitas Giling">
                  </div>			  
                </div>
              </div>


             <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Vol yang Digiling (Kg)</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="provitas" placeholder="Produktivitas (Ku/Ha)" value=0>
                  </div>
				  
                  <label class="control-label col-md-1">Harga Jual Beras (Rp/Kg)<sup>*</sup></label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="hargagkp" placeholder="Perkiraan Harga GKP (Rp/Kg)" value=0>
                  </div>				  
				  
                </div>
              </div>

			
              <div class="form-group">
                <div class="row">
                    <div class="col-md-5"></div>
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
              <div class="box-header"><h3>Tabel Data Volume & Harga Beras</h3></div>
              <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">ID</p></th>
                        <th><p style="text-align:center">Nama Penggilingan</p></th>
                        <th><p style="text-align:center">Kode Wilayah (BPS)</p></th>
                        <th><p style="text-align:center">Bulan</p></th>
                        <th><p style="text-align:center">Periode</p></th>
                        <th><p style="text-align:center">Jenis Gilingan</p></th>
                        <th><p style="text-align:center">Kapasitas</p></th>
                        <th><p style="text-align:center">Volume Yang Digiling</p></th>						
                        <th><p style="text-align:center">Harga Jual</p></th>
						<th><p style="text-align:center">Waktu Entri</p></th>							
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT  * FROM tr_giling WHERE user_name='".$_SESSION['username']."' ORDER BY idx ";
                      $data = mysqli_query($con,$query);
					  
					  if ($data->num_rows > 0) {
						  writeMsg('save.sukses');
					  } 
					  
                      while($hasil = mysqli_fetch_array($data)){
						$date = $hasil['created_date'];
						$date = date('d-m-Y', strtotime($date));  
                        ?>
                      <tr>
						            <td><?php echo $hasil['idx']; ?></td>
                        <td><?php echo $hasil['user_name']; ?></td>
                        <td><?php echo $hasil['kode_wil']; ?></td>
                        <td><?php echo $hasil['bulan']; ?></td>
                        <td><?php echo $hasil['periode']; ?></td>
                        <td><?php echo $hasil['jenis_g']; ?></td>
                        <td><?php echo $hasil['kapasitas']; ?></td>
                        <td><?php echo $hasil['vol_g']; ?></td>
                        <td><?php echo $hasil['h_jual']; ?></td>
                        <td><?php echo $hasil['created_date']; ?></td>
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
    $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
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