<?php
  session_start();
//include_once './func/konfigurasi.php';
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
    <title>ALSINTAN - Kementerian Pertanian</title>
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
	<style>
      #map-canvas {
        width: 100%;
        height: 500px;
		padding : 10px;
		margin : 0;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2zNkS5ev4MDQLRiTGxXOWJwVtFpwPEbI&callback=initMap"></script>
	
  </head>
  <body class="skin-blue  sidebar-mini">
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
                    <h3 align="center">Sebaran Alat dan Mesin Pertanian Provinsi</h3>
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
								$query = mysqli_query($con, "SELECT * FROM tblm_prov ORDER BY kd_prov");
									while ($data = mysqli_fetch_array($query)) {
									if ($data['kd_prov']==$_POST['prov']) {
									echo "<option value='".$data['kd_prov']."' selected>".$data['nm_prov']."</option>";
									}
									else {
									echo "<option value='".$data['kd_prov']."'>".$data['nm_prov']."</option>";
									}
								}
							?>
						</select>
					</div>
					
				  <label class="control-label col-md-1">Jenis Alsintan</label>
				  <div class="col-md-3">
				  
				  	<select class="form-control" name="jenis" id="jenis">
						<option value="">-- Pilih Alsintan --</option>
						<?php
								$query = mysqli_query("SELECT * FROM tblm_jenals ORDER BY kd_jenals");
									while ($data = mysqli_fetch_array($query)) {
									if ($data['kd_jenals']==$_POST['jenals']) {
									echo "<option value='".$data['kd_jenals']."' selected>".$data['nm_jenals']."</option>";
									}
									else {
									echo "<option value='".$data['kd_jenals']."'>".$data['nm_jenals']."</option>";
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

    <script>
    var marker;
      function initialize() {
		  
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
			center: new google.maps.LatLng(-5.039440,112.132323),
                zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }     
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var infoWindow = new google.maps.InfoWindow;      
        var bounds = new google.maps.LatLngBounds();
 
 
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
          function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
			var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'; 
            var marker = new google.maps.Marker({
                map: map,
                position: pt,
				icon: image
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
 
          <?php
		  // menampilkan marker dari database
			$wil= $_POST['prov'];
			$wilayah= substr($wil,0,2);
            $query = mysqli_query($con,"SELECT user_name,kode_wil,lat,lng,sum(vol_g)as vol_g,sum(h_jual)as h_jual,sum(kapasitas)as kapasitas FROM `tr_giling` where kode_wil like '$wilayah%' and jenis_g like'".$_POST['komoditi']."%' group by user_name,jenis_g");
          while ($data = mysqli_fetch_array($query)) {
            $lat = $data['lat'];
            $lon = $data['lng'];
            $nama = $data['user_name'];
			$kapa = $data['kapasitas'];
			$volum = $data['vol_g'];
			$hjual = $data['h_jual'];
            $query1 = mysqli_query($con,"SELECT nama from tb_user where username='$nama'");
          while ($data1 = mysqli_fetch_array($query1)) {
			  $unama = $data1['nama'];
			}
			//echo ("SELECT user_name,kode_wil,lat,lng,sum(vol_g)as vol_g,sum(h_jual)as h_jual,sum(kapasitas)as kapasitas FROM `tr_giling` where kode_wil like '$wilayah%' and jenis_g like'".$_POST['komoditi']."%' group by user_name");
            echo ("addMarker($lat, $lon, '<b>$unama</b><br>kapasitas = $kapa<br> Volume Giling =$volum<br> Harga jual = $hjual');\n");                        
          }
          ?>
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

            <div class="box box-success">
            <div class="box-body table-responsive">
						<div id="map-canvas"></div>
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