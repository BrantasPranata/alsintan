<?php
  session_start();
  include 'config.php';
  include 'alert.php';
   
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }

?>
<script language="javascript" src="jquery.js"></script>
<script>
$(document).ready(function() {
	$('#provinsi').change(function() { // Jika Select Box id provinsi dipilih
		var provinsi = $(this).val(); // Ciptakan variabel provinsi
		$.ajax({
			type: 'POST', // Metode pengiriman data menggunakan POST
			url: 'kabu.php', // File yang akan memproses data
			data: 'namprov=' + provinsi, // Data yang akan dikirim ke file pemroses
			success: function(response) { // Jika berhasil
				$('#kabu').html(response); // Berikan hasil ke id kota
			}
		});
    });
	});
		  
 </script> 

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SiPIPA - Kementerian Pertanian</title>
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
            <li>Laporan</li>
            <li class="active">Kabupaten Bulanan</li>
          </ol>
        </section>


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Laporan Pendataan Penggilingan Padi Kabupaten Bulanan</h3>
                </div>
          <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

               <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Provinsi</label>
					<div class="col-sm-3">
						<select name="provinsi" id="provinsi" class="form-control" >
							<option value="">-- Pilih Provinsi --</option>
							<?php
								$qStr = "SELECT * FROM tblm_prov ORDER BY nm_prov";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									echo "<option value='".$result['kd_prov']."'>".$result['nm_prov']."</option>";
								}
							?>
						</select>
					</div>
					
                  <label class="control-label col-md-1">Kabupaten</label>
                  <div class="col-sm-3">
						<select name="kabu" id="kabu" class="form-control">
							<option value="">-- Pilih Kabupaten --</option>

						</select>
					</div>
				</div>
              </div>			
			
               <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>
					
				  <label class="control-label col-md-1">Komoditi</label>
				  <div class="col-md-3">				  
				  	<select class="form-control" name="komoditi" id="komoditi">
						<option value="">-- Pilih Komoditi --</option>
						<?php
							$qStr = "SELECT * FROM tblm_komo ORDER BY kd_komo";
							$qExec = mysqli_query($con,$qStr);
							while($result = mysqli_fetch_array($qExec)){
								if ($result['nm_komo']==$_POST['komoditi']) {
								echo "<option value='".$result['nm_komo']."' selected>".$result['nm_komo']."</option>";
								}
								else {
								echo "<option value='".$result['nm_komo']."'>".$result['nm_komo']."</option>";
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
                  <label class="control-label col-md-1">Bulan</label>
					<div class="col-sm-3">
						<select class="form-control" name="bulan" id="bulan">
							<option value="">-- Pilih Bulan --</option>
							<?php
								$qStr = "SELECT * FROM tblm_bulan";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['kd_bulan']==$_POST['bulan']) {
									echo "<option value='".$result['kd_bulan']."' selected>".$result['nm_bulan']."</option>";
									}
									else {
									echo "<option value='".$result['kd_bulan']."'>".$result['nm_bulan']."</option>";
									}
								}
							?>
						</select>
					</div>
					
				  <label class="control-label col-md-1">Tahun</label>
				  <div class="col-md-3">				  
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
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="view">Tampilkan</button>
                  </div>
                </div>
              </div>
           </form></div></div>

            <?php
			    if(isset($_POST['view'])){
					
			?>		

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
                    <thead>                     
                      <tr style="background-color: yellow;">
                        <th><p style="text-align:left">No.</p></th>
                        <th><p style="text-align:left">Nama Kecamatan</p></th>
                        <th><p style="text-align:left">Luas Panen (Ha)</p></th>
                        <th><p style="text-align:left">Produktivitas (Ku/Ha)</p></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT nm_kec, 
						SUM(luas) AS SUMPanen,
						AVG(provitas) AS AVGPanen
						FROM  tbld_rpanen 
						WHERE kd_kab =  '".$_POST['kabu']."'
						AND DATE_FORMAT( waktu,  '%Y' ) =  '".$_POST['tahun']."'
						AND DATE_FORMAT( waktu,  '%m' ) =  '".$_POST['bulan']."'
						GROUP BY nm_kec ORDER BY nm_kec";
					  
                      $data = mysqli_query($con,$query);
					  $no = 1;
					  $nobar  = 0;
					  $isiavg = 0;
					  $totsum = 0;
					  $totavg = 0;
                      while($hasil = mysqli_fetch_array($data)){
						$date = $hasil['waktu'];
						$date = date('d-m-Y', strtotime($date));
						$nobar = $nobar + 1;
						$totsum = $totsum + $hasil['SUMPanen'];  
						$totavg = $totavg + $hasil['AVGPanen'];
						if ($hasil['AVGPanen']>0) {
							$isiavg = $isiavg + 1;
						}	    
                        ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $hasil['nm_kec']; ?></td>
                        <td><?php echo $hasil['SUMPanen']; ?></td>
                        <td><?php echo number_format($hasil['AVGPanen'],1); ?></td>					
                      </tr>
                      <?php
                        }
						$nasavg = 0;
						if ($isiavg > 0) {							
							$nasavg = $totavg/$isiavg;
						}
                      ?>
					  <tr style="background-color: yellow;">
                        <th><p style="text-align:left"> </p></th>
                        <th><p style="text-align:left">Kabupaten</p></th>
                        <th><p style="text-align:left"><?php echo $totsum; ?></p></th>
                        <th><p style="text-align:left"><?php echo number_format($nasavg,1); ?></p></th>					
                      </tr>
                    </tbody>                    
                  </table>
                </div>
			<?php				
				echo ' Simpan format: <a href="lapkabbul_xls.php?kabu='.$_POST['kabu'].'&prov='.$_POST['prov'].'&tahun='.$_POST['tahun'].'&bulan='.$_POST['bulan'].'&komoditi='.$_POST['komoditi'].'">XLS</a> | ';
				echo '<a href="lapkabbul_pdf.php?kabu='.$_POST['kabu'].'&prov='.$_POST['prov'].'&tahun='.$_POST['tahun'].'&bulan='.$_POST['bulan'].'&komoditi='.$_POST['komoditi'].'" target="_blank">PDF</a>';					
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
    <!-- page script -->


  </div>
  </body>
</html>