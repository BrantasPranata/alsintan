<?php
  session_start();
  include 'config.php';
  include 'alert.php';
   
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
          <h1>Sistem Informasi Penggilingan Padi</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Laporan</li>
            <li class="active">Preview Provinsi</li>
          </ol>
        </section>


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Laporan Volume dan Harga Gabah/Beras Provinsi </h3>
                </div>
          <div class="box-body">

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">


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
					
				  <label class="control-label col-md-1">Jenis </label>
				  <div class="col-md-3">
				  
				  	<select class="form-control" name="komoditi" id="komoditi">
						<option value="">-- Jenis Yang Digiling --</option>
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


            <div class="box box-success">
            <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
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
                      $query = "SELECT * FROM tbld_rpanen WHERE kd_prov='".$_POST['prov']."' 
					  and komoditi='".$_POST['komoditi']."' ORDER BY kd_kab ";
                      $data = mysqli_query($con,$query);
                      while($hasil = mysqli_fetch_array($data)){
						$date = $hasil['waktu'];
						$date = date('d-m-Y', strtotime($date));  
                        ?>
                      <tr>
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
							$foto= $hasil['foto'];
							//$foto="./upl/foto36.jpg";
							echo "<td><a href='viewpicmap.php?foto=".$foto."&lat=".$hasil['peta_lat'].
							"&long=".$hasil['peta_long']."' target='_blank'> foto</></td>";						
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
			<?php				
				echo '<br> Simpan format: <a href="prevprov_xls.php?prov='.$_POST['prov'].'&tahun='.$_POST['tahun'].'&bulan='.$_POST['bulan'].'&komoditi='.$_POST['komoditi'].'">XLS</a>';			
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