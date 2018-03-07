<?php
  session_start();
  include "config.php";
  
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }
?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <script>
		 jQuery(function($){ // wait until the DOM is ready
					$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
				});
		 jQuery(function($){ // wait until the DOM is ready
					$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
				});
    </script>
    <meta charset="UTF-8">
    <title>MONEV ALSINTAN - Kementrian Pertanian</title>
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
          <h1>Monitoring & Evaluasi ALSINTAN</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Laporan</li>
            <li class="active">Laporan Nasional Per Provinsi</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
		
				<div class="box box-success">
				<div class="box-header">
		
                  <h3 class="box-title">Tabel Hasil & Pelayanan Nasional Per Provinsi</h3>
                </div>
		 <div class="row">
            <div class="col-xs-12">
		<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<div class="box-header">
                    <h4 align="center">Filter</h4>
            </div>
			<div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-2"></div>
                  <label class="control-label col-md-1">Komoditas</label>
					<div class="col-sm-3">
						<select class="form-control" name="komoditas" id="komoditas">
							<option value="*">-- Pilih Komoditas --</option>
							<?php
								$qStr = "SELECT * FROM tblm_komod ORDER BY kd_komod";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['kd_komod']==$_POST['komoditas']) {
									echo "<option value='".$result['kd_komod']."' selected>".$result['nm_komod']."</option>";
									}
									else {
									echo "<option value='".$result['kd_komod']."'>".$result['nm_komod']."</option>";
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
                  <label class="control-label col-md-1">Tanggal Mulai</label>
					<div class="col-sm-3">
					    <div class='input-group date'>
							<input type='text' class="form-control" id="datepicker" name="datepicker" placeholder="Enter OT Date">
							<span class="input-group-addon"> 
							   <span class="glyphicon glyphicon-calendar"></span> 
							</span>
						 </div>
				  
						</div>
						
					<label class="control-label col-md-1">Tanggal Sampai</label>
					<div class="col-sm-3">
					    <div class='input-group date'>
							<input type='text' class="form-control" id="datepicker2" name="datepicker2" placeholder="Enter OT Date">
							<span class="input-group-addon"> 
							   <span class="glyphicon glyphicon-calendar"></span> 
							</span>
						 </div>
				  
						</div>
              </div>
			  </div>
          
              <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="view">Tampilkan Hasil</button>
                  </div>
                </div>
              </div>
           
			

			</form>
		
          <?php
			    if(isset($_POST['view'])){
					
			?>
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Tabel Pelayanan Per Provinsi</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><p style="text-align:center">Provinsi</p></th>
                        <th><p style="text-align:center">Hasil (Ton)</p></th>
                        <th><p style="text-align:center">Pelayanan (Ha)</p></th>
                        <th><p style="text-align:center">Total Unit (Baik-Dimanfaatkan)</p></th>
						<th><p style="text-align:center">Rata-rata Hasil (Ton)/Unit</p></th>
						<th><p style="text-align:center">Rata-rata Pelayanan (Ha)/Unit</p></th>
						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = " SELECT
					tblm_prov.nm_prov as provinsi,
					SUM(tr_alsintan.hasil) as totalhasil,                    
                    SUM(tr_alsintan.pelayanan) as totalpelayanan,
                    TRUNCATE(SUM(CASE WHEN m_alsintan.kd_kondisi=1 AND m_alsintan.kd_status=2 THEN m_alsintan.jumlah END)*count(DISTINCT m_alsintan.id_al)/count(*),0)  as totalunitbaikmanfaat,					
					TRUNCATE((SUM(tr_alsintan.hasil))/(SUM(CASE WHEN m_alsintan.kd_kondisi=1 AND m_alsintan.kd_status=2 THEN m_alsintan.jumlah END)*count(DISTINCT m_alsintan.id_al)/count(*)),2) as ratahasil,
					TRUNCATE((SUM(tr_alsintan.pelayanan))/(SUM(CASE WHEN m_alsintan.kd_kondisi=1 AND m_alsintan.kd_status=2 THEN m_alsintan.jumlah END)*count(DISTINCT m_alsintan.id_al)/count(*)),2) as ratapelayanan
					FROM m_alsintan
                    JOIN tblm_prov ON tblm_prov.kd_prov = m_alsintan.provinsi
                    LEFT JOIN tr_alsintan ON tr_alsintan.id_m = m_alsintan.id_al
					WHERE 
					(tr_alsintan.tanggal BETWEEN '".$_POST['datepicker']."'
					AND '".$_POST['datepicker2']."') AND id_komod='".$_POST['komoditas']."'
					";
					
                      $data = mysqli_query($con,$query);
                      while($hasil = mysqli_fetch_array($data)){
                        ?>
                      <tr>
                        <td><p style="text-align:center"><?php echo $hasil['provinsi']; ?></p></td>
                        <td><p style="text-align:center"><?php echo $hasil['totalhasil']; ?></p></td>
						<td><p style="text-align:center"><?php echo $hasil['totalpelayanan']; ?></p></td>
                        <td><p style="text-align:center"><?php echo $hasil['totalunitbaikmanfaat']; ?></p></td>
						<td><p style="text-align:center"><?php echo $hasil['ratahasil']; ?></p></td>
						<td><p style="text-align:center"><?php echo $hasil['ratapelayanan']; ?></p></td>
                      </tr>
                    <?php
                      }
                    ?>
                    </tbody>                    
                  </table>
                </div>			
			<?php				
				echo '<br> Simpan format: <a href="prevalltr_xls.php">XLS</a>';			
                				
            ?>		   
          </div>
		  <?php
                        }
                      ?>
		  </div>     
      </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
</div>
</div>
      <?php
        include "footer.php";
      ?>

      <!-- jQuery 2.1.4 -->
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
          "bAutoWidth": false
        });
      });
    </script>

    </div>
	</div>
  </body>
</html>