<?php
  session_start();
  include 'config.php';
  include 'alert.php';
  $link_upload= "http://".$_SERVER['SERVER_NAME']."/epanen/upl/";
  //$link_upload="http://localhost:82/epanen/upl/";

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

function readGPSinfoEXIF($image_full_name)
{
   $exif=exif_read_data($image_full_name, 0, true);
     if(!$exif || $exif['GPS']['GPSLatitude'] == '') {
       return false;
    } else {
    $lat_ref = $exif['GPS']['GPSLatitudeRef'];
    $lat = $exif['GPS']['GPSLatitude'];
    list($num, $dec) = explode('/', $lat[0]);
    $lat_s = $num / $dec;
    list($num, $dec) = explode('/', $lat[1]);
    $lat_m = $num / $dec;
    list($num, $dec) = explode('/', $lat[2]);
    $lat_v = $num / $dec;

    $lon_ref = $exif['GPS']['GPSLongitudeRef'];
    $lon = $exif['GPS']['GPSLongitude'];
    list($num, $dec) = explode('/', $lon[0]);
    $lon_s = $num / $dec;
    list($num, $dec) = explode('/', $lon[1]);
    $lon_m = $num / $dec;
    list($num, $dec) = explode('/', $lon[2]);
    $lon_v = $num / $dec;

    $gps_int = array($lat_s + $lat_m / 60.0 + $lat_v / 3600.0, $lon_s
            + $lon_m / 60.0 + $lon_v / 3600.0);
    return $gps_int;
    }
}  
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ePANEN - Kementerian Pertanian</title>
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
          <h1>Aplikasi Pendataan Rencana Panen</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Input Data</li>
            <li class="active">Rencana Panen</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Input Data Rencana Panen</h3>
                </div>
          <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php

                if(isset($_POST['save'])){
					
					$sql = "SELECT * FROM tblm_desa WHERE kd_desa = '".$_POST['desa']."'";
					$result = $con->query($sql);
					$nm_desa= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_desa= $row['nm_desa'];
						}						
					} 
					
					$sql = "SELECT * FROM tblm_kec WHERE kd_kec = '".$_POST['keca']."'";
					$result = $con->query($sql);
					$nm_keca= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_keca= $row['nm_kec'];
						}						
					}
					
					$sql = "SELECT * FROM tblm_kab WHERE kd_kab = '".$_POST['kabu']."'";
					$result = $con->query($sql);
					$nm_kabu= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_kabu= $row['nm_kab'];
						}						
					} 
					
					$sql = "SELECT * FROM tblm_prov WHERE kd_prov = '".$_POST['prov']."'";
					$result = $con->query($sql);
					$nm_prov= "";					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$nm_prov= $row['nm_prov'];
						}						
					} 
					
			
					$qry1="INSERT INTO tbld_rpanen (
					nama,
					instansi,
					nohp,
					kd_prov,
					nm_prov,
					kd_kab,
					nm_kab,
					kd_kec,
					nm_kec,
					kd_desa,
					nm_desa,
					komoditi,
					varietas,
					waktu,
					luas,
					provitas,
					hargagkp,
					peta_lat,
					peta_long)
					VALUES 
					('".$_POST['nama']."',
					'".$_POST['instansi']."',
					'".$_POST['nohp']."',
					'".$_POST['prov']."',
					'".$nm_prov."',					
					'".$_POST['kabu']."',
					'".$nm_kabu."',					
					'".$_POST['keca']."',
					'".$nm_keca."',
					'".$_POST['desa']."',
					'".$nm_desa."',					
					'".$_POST['komoditi']."',
					'".$_POST['varietas']."',
					'".date('Y-m-d', strtotime($_POST['waktu']))."',
					".$_POST['luas'].",
					".$_POST['provitas'].",
					".$_POST['hargagkp'].",					
					".$_POST['lat'].",					
					".$_POST['long'].")";
					

					$sql = "SELECT * FROM tbld_rpanen WHERE 
					kd_prov = '".$_POST['prov']."' AND
					kd_kab = '".$_POST['kabu']."' AND
					kd_kec = '".$_POST['keca']."' AND
					kd_desa = '".$_POST['desa']."' AND
					komoditi = '".$_POST['komoditi']."' AND
					varietas = '".$_POST['varietas']."' AND
					waktu = '".date('Y-m-d', strtotime($_POST['waktu']))."' AND
					nohp = '".$_POST['nohp']."'";
					$result = $con->query($sql);
					$idrec= 0;					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						$idrec= $row['idx'];
						//ECHO "no. record= ".$idrec;
						}
						$qry2= "UPDATE tbld_rpanen SET 
						nama='".$_POST['nama']."',
						instansi='".$_POST['instansi']."',
						luas=".$_POST['luas'].",
						provitas=".$_POST['provitas'].",
						hargagkp=".$_POST['hargagkp'].",						
						peta_lat=".$_POST['lat'].",	
						peta_long=".$_POST['long']."
						WHERE idx='".$idrec."'";						
						mysqli_query($con,$qry2);
						//ECHO $qry2;						
					}
					else {
						mysqli_query($con,$qry1);
						$idrec = mysqli_insert_id($con);						
					}	
					
					$uploads_dir = './upl';
					if ($error == UPLOAD_ERR_OK) {						
						$tmp_name = $_FILES["filefoto"]["tmp_name"];
						$filename = basename($_FILES["filefoto"]["name"]);
						$ext = end(explode('.',$filename));
						$name = "foto".$idrec.".".$ext;
						try{
							move_uploaded_file($tmp_name, "$uploads_dir/$name");							
							$link= $link_upload.$name;
						} catch(Exception $e){
							var_dump($e);
						}
						
						if ($ext != NULL) {
							mysqli_query($con,"UPDATE tbld_rpanen SET foto='".$link."' WHERE idx='".$idrec."'");
							$results = readGPSinfoEXIF($link);
							$latitude = $results[0];
							if ($lat_ref = "S")
							{    
								$latitude= $latitude*-1;
							}
							$longitude = $results[1];
							
							if ($latitude != NULL)
							{    
								mysqli_query($con,"UPDATE tbld_rpanen SET peta_lat=".$latitude.",peta_long=".$longitude."  WHERE idx='".$idrec."'");
							}
						}			
					}		
					//echo $qry1 ;
               }
              ?>
			  <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Nama Penginput<sup>*</sup></label>
					<div class="col-md-3">
                    <input type="text" class="form-control" name="nama" placeholder="Nama">
                  </div>	  
				  
                  <label class="control-label col-md-1">Instansi<sup>*</sup></label>
                  <div class="col-md-3">
				  <input type="text" class="form-control" name="instansi" placeholder="Instansi">
                  </div>
                </div>
              </div>


             <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Nomor HP<sup>*</sup></label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="nohp" placeholder="Nomor HP">
                  </div>
				  
                </div>
              </div>
			  
               <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Provinsi<sup>*</sup></label>
					<div class="col-sm-3">
						<select class="form-control" name="prov" id="prov" onchange="provChange($(this).val());">
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
					
                  <label class="control-label col-md-1">Kabupaten<sup>*</sup></label>
                  <div class="col-sm-3">
						<select class="form-control" name="kabu" id="kabu" onchange="kabuChange($(this).val());">
							<option value="">-- Pilih Kabupaten --</option>
							<?php
								$qStr = "SELECT * FROM tblm_kab ORDER BY kd_kab";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if (substr($result['kd_kab'],2,2)==$_POST['kabu']) {
									echo "<option value='".$result['kd_kab']."' selected>".$result['nm_kab']."</option>";
									}
									else {
									echo "<option value='".$result['kd_kab']."'>".$result['nm_kab']."</option>";
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
                  <label class="control-label col-md-1">Kecamatan<sup>*</sup></label>
                  <div class="col-sm-3">
						<select class="form-control" name="keca" id="keca" onchange="kecaChange($(this).val());">
							<option value="">-- Pilih Kecamatan --</option>
							<?php
								$qStr = "SELECT * FROM tblm_kec ORDER BY kd_kec";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if (substr($result['kd_kec'],4,3)==$_POST['keca']) {
									echo "<option value='".$result['kd_kec']."' selected>".$result['nm_kec']."</option>";
									}
									else {
									echo "<option value='".$result['kd_kec']."'>".$result['nm_kec']."</option>";
									}
								}
							?>
						</select>
					</div>
					
                  <label class="control-label col-md-1">Desa<sup>*</sup></label>
                  <div class="col-sm-3">
						<select class="form-control" name="desa" id="desa">
							<option value="">-- Pilih Desa --</option>
							<?php
								$qStr = "SELECT * FROM tblm_desa ORDER BY kd_desa";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if (substr($result['kd_desa'],4,3)==$_POST['desa']) {
									echo "<option value='".$result['kd_desa']."' selected>".$result['nm_desa']."</option>";
									}
									else {
									echo "<option value='".$result['kd_desa']."'>".$result['nm_desa']."</option>";
									}
								}
							?>
						</select>
					</div
                </div>
              </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
				  <label class="control-label col-md-1">Komoditi<sup>*</sup></label>
				  <div class="col-md-3">
                    <select class="form-control" name="komoditi">
                      <option selected="selected" disabled="disabled">--Pilih Komoditi--</option>
                      <option value="Padi" selected>Padi</option>
                      <option value="Jagung">Jagung</option>
                      <option value="Kedelai">Kedelai</option>
                    </select>				  
                  </div>

                  <label class="control-label col-md-1">Varietas<sup>*</sup></label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="varietas" placeholder="Varietas">
                  </div>			  
                </div>
              </div>

			  <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Perkiraan Waktu Panen<sup>*</sup></label>
					<div class="col-md-3">
						<div class="input-group date" data-date="" data-date-format="dd-mm-yyyy">
							<input class="form-control" type="text" name="waktu" value="<?php echo date("d-m-Y") ?>">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>	  
                  <label class="control-label col-md-1">Luas Panen (Ha)<sup>*</sup></label>
                  <div class="col-md-3">
				  <input type="text" class="form-control" name="luas" placeholder="Luas (Ha)" value=0>
                  </div>
                </div>
              </div>


             <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Perkiraan Produktivitas (Ku/Ha)<sup>*</sup></label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="provitas" placeholder="Produktivitas (Ku/Ha)" value=0>
                  </div>
				  
                  <label class="control-label col-md-1">Perkiraan Harga GKP (Rp/Kg)<sup>*</sup></label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="hargagkp" placeholder="Perkiraan Harga GKP (Rp/Kg)" value=0>
                  </div>				  
				  
                </div>
              </div>

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-2"></div>
				  <label class="control-label col-md-1">Koordinat Latitude</label>
                  <div class="col-md-3">
				  <input type="text" class="form-control" name="lat" placeholder="Latitude" value=0>
                  </div>
				  
                  <label class="control-label col-md-1">Koordinat Longitude</label>
                  <div class="col-md-3">
				  <input type="text" class="form-control" name="long" placeholder="Longitude" value=0>
                  </div>	
                </div>
              </div>
            
              <div class="form-group">  
                 <div class="row">
					<div class="col-md-2"></div>
					<label class="control-label col-md-1">Upload Foto</label>
                  <div class="col-md-3">
                    <input type="file" class="form-control" name="filefoto" id="filefoto">
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
              <div class="box-header"><h3>Tabel Rencana Panen</h3></div>
              <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">ID</p></th>
                        <th><p style="text-align:center">Nama Provinsi</p></th>
                        <th><p style="text-align:center">Nama Kabupaten</p></th>
                        <th><p style="text-align:center">Nama Kecamatan</p></th>
                        <th><p style="text-align:center">Nama Desa</p></th>
                        <th><p style="text-align:center">Komoditas</p></th>
                        <th><p style="text-align:center">Varietas </p></th>
                        <th><p style="text-align:center">Waktu Panen </p></th>						
                        <th><p style="text-align:center">Luas Panen (Ha) </p></th>
                        <th><p style="text-align:center">Produktivitas (Ku/ha) </p></th>
                        <th><p style="text-align:center">Harga GKP (Rp/Kg)  </p></th>
                        <th><p style="text-align:center">Koordinat Lat</p></th>
						<th><p style="text-align:center">Koordinat Long</p></th>
                        <th><p style="text-align:center">Foto</p></th>
                        <th><p style="text-align:center">Nama</p></th>
                        <th><p style="text-align:center">Instansi</p></th>
						<th><p style="text-align:center">Nomor HP</p></th>
						<th><p style="text-align:center">Waktu Entri</p></th>							
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT  * FROM tbld_rpanen WHERE idx='".$idrec."' ORDER BY idx ";
                      $data = mysqli_query($con,$query);
					  
					  if ($data->num_rows > 0) {
						  writeMsg('save.sukses');
					  } 
					  
                      while($hasil = mysqli_fetch_array($data)){
						$date = $hasil['waktu'];
						$date = date('d-m-Y', strtotime($date));  
                        ?>
                      <tr>
						<td><?php echo $hasil['idx']; ?></td>
                        <td><?php echo $hasil['nm_prov']; ?></td>
                        <td><?php echo $hasil['nm_kab']; ?></td>
                        <td><?php echo $hasil['nm_kec']; ?></td>
                        <td><?php echo $hasil['nm_desa']; ?></td>
                        <td><?php echo $hasil['komoditi']; ?></td>
                        <td><?php echo $hasil['varietas']; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $hasil['luas']; ?></td>
                        <td><?php echo $hasil['provitas']; ?></td>
                        <td><?php echo $hasil['hargagkp']; ?></td>
                        <td><?php echo number_format($hasil['peta_lat'],6); ?></td>
                        <td><?php echo number_format($hasil['peta_long'],6); ?></td>
						<?php
						if ($hasil['foto'] != "") {
							echo "<td><a href='".$hasil['foto']."' target='_blank'> foto</></td>";							
						}
						else {
							echo "<td>-</td>";
						}						
						?>
                        <td><?php echo $hasil['nama']; ?></td>
                        <td><?php echo $hasil['instansi']; ?></td>
                        <td><?php echo $hasil['nohp']; ?></td>
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