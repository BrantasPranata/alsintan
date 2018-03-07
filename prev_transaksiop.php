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
	 <style>
	
	</style>
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
 jQuery(function($){ // wait until the DOM is ready
            $("#datepickersm").datepicker({ dateFormat: 'yy-mm-dd' });
        });
 jQuery(function($){ // wait until the DOM is ready
            $("#datepickersm2").datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link href="css/select2-bootstrap.min.css" rel="stylesheet" />
	<link href="css/select2-bootstrap.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script>
	jQuery(function($){
    $('.js-example-basic-single').select2({
		theme: "bootstrap"
	});
	
	});
	</script>

  
  
    <meta charset="UTF-8">
    <title>MONEV Alsintan - Kementrian Pertanian</title>
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
          <h1>MONEV Alsintan</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Input</li>
            <li class="active">Hasil dan Pelayanan</li>
          </ol>
        </section>


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Preview Data Hasil dan Pelayanan Harian </h3>
                </div>
          <div class="box-body">

           

			<div class="form-group">
			<div class="bs-example"><div class="row">
    <!-- Button HTML (to Trigger Modal) -->
				<div class="col-md-4"></div>
                <div class="col-md-3">
				<a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">Tambahkan Data Hasil / Pelayanan Harian</a>
				</div>
				</div>
				<!-- Modal HTML -->
				<div id="myModal" class="modal fade">
				
				
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Input Data Hasil dan Pelayanan Harian</h4>
							</div>
				<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
								
							
							<div class="modal-body">
							<div class="form-group">
							<div class="row">
							<div class="col-md-1"></div>
							<div class="form-group">
							<label class="control-label col-md-1">ID Master</label>
							<div class="col-md-1"></div>
								<div class="col-sm-3">
								<select class="form-control-block-level js-example-basic-single"  name="kodemaster" id="kodemaster">
									<option value="">-- Pilih ID Master --</option>
									<?php
										$qStr = "SELECT m_alsintan.* , tblm_jenals.nm_jenals , tblm_tahunal.nm_tahun , tblm_pengelolaan.nm_pengelolaan FROM m_alsintan
										JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
										JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
										JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
										WHERE created_by_userid='".$_SESSION['id_user']."' AND sts=1 AND kd_kondisi=1 AND kd_status=2
										ORDER BY id_al";
										$qExec = mysqli_query($con,$qStr);
										while($result = mysqli_fetch_array($qExec)){
											
											echo "<option value='".$result['id_al']."'>".$result['id_al']."/".$result['nm_jenals']."/".$result['merek']."/".$result['poktangapoktan']."/".$result['nm_tahun']."/".$result['nm_pengelolaan']."/".$result['jumlah']."Unit</option>";
											}
										
									?>
								</select>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-1"></div>
							<div class="form-group">
							<label class="control-label col-md-1">Tanggal  </label>
							<div class="col-md-1"></div>
								<div class="col-sm-3">
								<div class='input-group date'>
									<input type='text' class="form-control" id="datepickersm" name="datepickersm" placeholder="Enter OT Date">
									
								 </div>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-1"></div>
							<div class="form-group">

							<label class="control-label col-md-1">Hasil </label>
							<div class="col-md-1"></div>
							  <div class="col-md-2">
								<input type="text" class="form-control" name="hasil" placeholder="Ton/Hari">
							  </div>			  
						   </div>
						   </div>
						   <div class="row">
							<div class="col-md-1"></div>
						   <div class="form-group">
						   
							<label class="control-label col-md-1">Pelayanan </label>
							<div class="col-md-1"></div>
							  <div class="col-md-2">
								<input type="text" class="form-control" name="pelayanan" placeholder="Ha/Hari">
							  </div>			  
						   </div>
						   </div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="submit" name="submit1" class="btn btn-primary" value="Input">
							</div>
							</div>
							</form>
							
						   
							
							
						</div>
					</div>
				</div>
			</div>
			</div>
			
			
			 <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<div class="box-header">
                    <h4 align="center">Filter </h4>
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
                    <div class="col-md-2"></div>
					<label class="control-label col-md-1">Tampilkan</label>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="view">Filter</button>
                  </div>
				  
				  <div class="col-md-1">
                      <button type="submit" class="btn btn-success" name="viewall">Terinput</button>
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
					    <th><p style="text-align:center">ID Master</p></th>
						<th><p style="text-align:center">Tanggal</p></th>
						<th><p style="text-align:center">Hasil</p></th>
						<th><p style="text-align:center">Pelayanan</p></th>
						<th><p style="text-align:center">Nama Lembaga</p></th>
						<th><p style="text-align:center">Komoditi</p></th>
						<th><p style="text-align:center">Jenis Alsintan</p></th>
						<th><p style="text-align:center">Merk Alsintan</p></th>
						<th><p style="text-align:center">Jumlah (Unit)</p></th>
						<th><p style="text-align:center">Tahun Pengadaan</p></th>
						<th><p style="text-align:center">Sumber Dana</p></th>
						<th><p style="text-align:center">Pola Pengelolaan</p></th>

						<th><p style="text-align:center">Action</p></th>						
                      </tr>						
                      						
                      
                    </thead>
                    <tbody>
                    <?php
					$querys = "SELECT m_alsintan.id_al as a,
					m_alsintan.poktangapoktan as b,
					tblm_komod.nm_komod as c,
					tblm_jenals.nm_jenals as d,
					m_alsintan.merek as e,
					m_alsintan.jumlah as f,
					tblm_tahunal.nm_tahun as g,
					tblm_sumberdana.nm_sumberdana as h,
					tblm_pengelolaan.nm_pengelolaan as pola,
					tr_alsintan.tanggal as i,
					tr_alsintan.hasil as j,
					tr_alsintan.pelayanan as k,
					tr_alsintan.id_tr as l
					FROM m_alsintan
					JOIN tr_alsintan ON tr_alsintan.id_m = m_alsintan.id_al
					JOIN tb_user ON tb_user.id_user = m_alsintan.created_by_userid
					JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
					JOIN tblm_sumberdana ON tblm_sumberdana.kd_sumberdana = m_alsintan.id_sumberdana
					JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
					JOIN tblm_komod ON tblm_komod.kd_komod = m_alsintan.id_komod
					JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
					WHERE 
					(tr_alsintan.tanggal BETWEEN '".$_POST['datepicker']."'
					AND '".$_POST['datepicker2']."')
					  AND tr_alsintan.sts=1
					  AND m_alsintan.kd_kondisi = 1
					  AND m_alsintan.kd_status = 2
					  AND id_user='".$_SESSION['id_user']."'
					  
					ORDER BY tr_alsintan.tanggal DESC";
					  $datas = mysqli_query($con,$querys);
                      while($hasils = mysqli_fetch_array($datas)){
                        ?>
                      <tr>
					  	<td><?php echo $hasils['a']; ?></td>
						<td><?php echo $hasils['i']; ?></td>
						<td><?php echo $hasils['j']; ?></td>
						<td><?php echo $hasils['k']; ?></td>
						<td><?php echo $hasils['b']; ?></td>
						<td><?php echo $hasils['c']; ?></td>
                        <td><?php echo $hasils['d']; ?></td>
						<td><?php echo $hasils['e']; ?></td>
						<td><?php echo $hasils['f']; ?></td>
                        <td><?php echo $hasils['g']; ?></td>
						<td><?php echo $hasils['h']; ?></td>
						<td><?php echo $hasils['pola']; ?></td>

						<td><a onclick="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;" href="hapustr.php?id=<?php echo $hasil['l']; ?>" class="btn btn-danger">HAPUS</a></td>				
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
	  
	   <?php
			    if(isset($_POST['viewall'])){
					
			?>		


            <div class="box box-success">
            <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
					    <th><p style="text-align:center">Tanggal</p></th>
						<th><p style="text-align:center">Hasil</p></th>
						<th><p style="text-align:center">Pelayanan</p></th>
						<th><p style="text-align:center">ID Master</p></th>
						<th><p style="text-align:center">Komoditi</p></th>
						<th><p style="text-align:center">Jenis Alsintan</p></th>
						<th><p style="text-align:center">Merk Alsintan</p></th>
						<th><p style="text-align:center">Jumlah (Unit)</p></th>
						<th><p style="text-align:center">Tahun Pengadaan</p></th>
						<th><p style="text-align:center">Sumber Dana</p></th>
						<th><p style="text-align:center">Pola Pengelolaan</p></th>
						<th><p style="text-align:center">Nama Lembaga</p></th>
						<th><p style="text-align:center">Action</p></th>						
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					$query = "SELECT m_alsintan.id_al as a,
					tr_alsintan.tanggal as i,
					tr_alsintan.hasil as j,
					tr_alsintan.pelayanan as k,
					m_alsintan.poktangapoktan as b,
					tblm_komod.nm_komod as c,
					tblm_jenals.nm_jenals as d,
					m_alsintan.merek as e,
					m_alsintan.jumlah as f,
					tblm_tahunal.nm_tahun as g,
					tblm_sumberdana.nm_sumberdana as h,
					tblm_pengelolaan.nm_pengelolaan as pola,

					tr_alsintan.id_tr as l
					FROM m_alsintan
					LEFT OUTER JOIN tr_alsintan ON tr_alsintan.id_m = m_alsintan.id_al
					JOIN tb_user ON tb_user.id_user = m_alsintan.created_by_userid
					JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
					JOIN tblm_sumberdana ON tblm_sumberdana.kd_sumberdana = m_alsintan.id_sumberdana
					JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
					JOIN tblm_komod ON tblm_komod.kd_komod = m_alsintan.id_komod
					JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
					WHERE id_user='".$_SESSION['id_user']."' AND m_alsintan.kd_kondisi = 1 AND m_alsintan.kd_status = 2 AND tr_alsintan.sts=1
					ORDER BY tr_alsintan.tanggal DESC";
					$data = mysqli_query($con,$query);
                      while($hasil = mysqli_fetch_array($data)){
  
					  ?>
                      <tr>
						<td><?php echo $hasil['i']; ?></td>
						<td><?php echo $hasil['j']; ?></td>
						<td><?php echo $hasil['k']; ?></td>
						<td><?php echo $hasil['a']; ?></td>	
						<td><?php echo $hasil['c']; ?></td>
                        <td><?php echo $hasil['d']; ?></td>
						<td><?php echo $hasil['e']; ?></td>
						<td><?php echo $hasil['f']; ?></td>
                        <td><?php echo $hasil['g']; ?></td>
						<td><?php echo $hasil['h']; ?></td>
						<td><?php echo $hasil['pola']; ?></td>
						<td><?php echo $hasil['b']; ?></td>

						<td><a onclick="if (!confirm('Apakah Anda yakin akan menghapus data ini?')) return false;" href="hapustr.php?id=<?php echo $hasil['l']; ?>" class="btn btn-danger">HAPUS</a></td>				
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