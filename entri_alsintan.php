<?php
  session_start();
  include 'config.php';
  include 'alert.php';
  //$link_upload= "http://".$_SERVER['SERVER_NAME']."/sipipa/upl/";
  $link_upload="http://localhost/sipipa/upl/";

  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }
  $hak = $_SESSION['hak_akses'];
  if($hak<3){header('location:entri_alsintanop.php');}

  
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
				$('#keca').html('<option value="" selected>-- Pilih Kecamatan --</option>');
				$('#desa').html('<option value="" selected>-- Pilih Desa --</option>');
			}
		});
    });
	});
	
$(document).ready(function() {
	$('#kabu').change(function() { // Jika select box id kota dipilih
		var kabu = $(this).val(); // Ciptakan variabel kota
		$.ajax({
			type: 'POST', // Metode pengiriman data menggunakan POST
			url: 'keca.php', // File pemroses data
			data: 'namkab=' + kabu, // Data yang akan dikirim ke file pemroses
			success: function(response) { // Jika berhasil
				$('#keca').html(response); // Berikan hasilnya ke id kurir
				$('#desa').html('<option value="" selected>-- Pilih Desa --</option>');
			}
		});
    });
	});
$(document).ready(function() {
	$('#keca').change(function() { // Jika select box id kota dipilih
		var keca = $(this).val(); // Ciptakan variabel kota
		$.ajax({
			type: 'POST', // Metode pengiriman data menggunakan POST
			url: 'desa.php', // File pemroses data
			data: 'namkec=' + keca, // Data yang akan dikirim ke file pemroses
			success: function(response) { // Jika berhasil
				$('#desa').html(response); // Berikan hasilnya ke id kurir
			}
		});
    });
	});
	
	
$(document).ready(function() {
    $('#desa').attr('disabled','disabled');
	$('#keca').attr('disabled','disabled');
	$('#kabu').attr('disabled','disabled');	
    $('select[name="lembaga"]').on('change',function(){
    var  others = $(this).val();
        if(others == "1"){
		$('#desa').attr('disabled','disabled'); 
		$('#keca').attr('disabled','disabled');
		$('#kabu').attr('disabled','disabled');		
         }
		 else if(others == "2"){
		$('#desa').attr('disabled','disabled'); 
		$('#keca').attr('disabled','disabled');
		$('#kabu').removeAttr('disabled');	
         }
		 else{
        $('#kabu').removeAttr('disabled'); 
		$('#keca').removeAttr('disabled'); 
		$('#desa').removeAttr('disabled');
        }  

      });
    });

		  
 </script> 

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
    <link href="bootstrap/css/datepicker.css" rel="stylesheet" />

	</head>
  <body class="skin-blue  sidebar-mini">
    <div class="wrapper">
      
  <?php
    include "header.php";
    include "nav.php";
	error_reporting(0);
  

  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Monitoring dan Evaluasi ALSINTAN</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
            <li>Input Data</li>
            <li class="active">Data Alsintan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <!-- general form elements disabled -->
              <div class="box box-success">
                <div class="box-header">
                    <h3 align="center">Input Data Master Alsintan</h3>
                </div>
          <div class="box-body">

            <form id="master-form" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <?php
                if(isset($_POST['save'])){
					if ($_POST['kabu'] === '0') {
						$_POST['kabu'] = 'NULL';
						$_POST['keca'] = 'NULL';
						$_POST['desa'] = 'NULL';
					} else if (($_POST['keca'] === '0')) {
						$_POST['keca'] = 'NULL';
						$_POST['desa'] = 'NULL';
					}	
					
					/*
					$checknoals=if($_POST['no_alsintan']=""){
						$number = $_SESSION['number'];
						
						$number++;
						
						echo "21.91.101.${number}";
						
						$_SESSION['number'] = $number;
					}else { $_POST['no_alsintan'];
					*/
					$qry1="INSERT INTO m_alsintan (
					created_by_userid,
					edited_by_userid,
					provinsi,
					kabupaten,
					kecamatan,
					desa,
					merek,
					jenis_als,
					id_lembaga,
					poktangapoktan,
					id_komod,
					kd_status,
					kd_kondisi,
					kd_pola,
					jumlah,
					id_tahun,
					id_sumberdana,
					keterangan,
					  lat,
					  lng,
					  sts
					)
					VALUES 
					('".$_SESSION['id_user']."',
					'".$_SESSION['id_user']."',
					'".$_POST['provinsi']."',
					'".$_POST['kabu']."',
					'".$_POST['keca']."',
					'".$_POST['desa']."',
					'".$_POST['merek']."',
					'".$_POST['jenals']."',
					'".$_POST['lembaga']."',
					'".$_POST['poktangapoktan']."',
					'".$_POST['komod']."',
					'".$_POST['status']."',
					'".$_POST['kondisi']."',
					'".$_POST['pengelolaan']."',
					'".$_POST['jumlahunit']."',
					'".$_POST['tahun']."',
					'".$_POST['sumberdana']."',
					'".$_POST['keterangan']."',
					'".$_POST['latal']."',					
					'".$_POST['lngal']."',
					'1')";
					
					
					$datainsert=mysqli_query($con,$qry1);
					
				
				}

					/*$sql = "SELECT * FROM tr_giling WHERE 
          user_name = '".$_SESSION['username']."' and
					kode_wil = '".$_SESSION['wilayah']."' and bulan ='".$_POST['prov']."' and periode = '".$_POST['kabu']."' and jenis_g = '".$_POST['jenals']."'";
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
               }*/
              ?>
			  <div class="form-group">  
			  
               

              <div class="form-group">  
                 <div class="row">
                  <div class="col-md-1"></div>
				  
				 <label class="control-label col-md-1">Komoditi</label>
				  <div class="col-md-2">
                    <select class="form-control" name="komod">
                    <option value="">-- Pilih Jenis Komoditi</option>
							<?php
								$qStr2 = "SELECT * FROM tblm_komod";
								$qExec2 = mysqli_query($con,$qStr2);
								while($result = mysqli_fetch_array($qExec2)){
									if ($result['kd_komod']==$_POST['prov']) {
									echo "<option value='".$result['kd_komod']."' selected>".$result['nm_komod']."</option>";
									}
									else {
									echo "<option value='".$result['kd_komod']."'>".$result['nm_komod']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>
				  
				  <label class="control-label col-md-1">Jenis Alsintan</label>
				  <div class="col-md-2">
                    <select class="form-control" name="jenals">
                    <option value="">-- Pilih Jenis Alsintan --</option>
							<?php
								$qStr = "SELECT * FROM tblm_jenals";
								$qExec = mysqli_query($con,$qStr);
								while($result = mysqli_fetch_array($qExec)){
									if ($result['kd_jenals']==$_POST['prov']) {
									echo "<option value='".$result['kd_jenals']."' selected>".$result['nm_jenals']."</option>";
									}
									else {
									echo "<option value='".$result['kd_jenals']."'>".$result['nm_jenals']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>
    
				<label class="control-label col-md-1">Merek</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="merek" placeholder="Merek">
                  </div>			  
               </div>	 		  
				
              </div>

						  <div class="form-group">  
                 <div class="row">
                  <div class="col-md-1"></div>
				  

				  
				  <label class="control-label col-md-1">Jenis Lembaga</label>
				  <div class="col-md-2">
                    <select class="form-control" name="lembaga">
                    <option value="">-- Pilih Jenis Lembaga</option>
							<?php
								$qStr1 = "SELECT * FROM tblm_lembaga";
								$qExec1 = mysqli_query($con,$qStr1);
								while($result = mysqli_fetch_array($qExec1)){
									if ($result['id_lembaga']==$_POST['prov']) {
									echo "<option value='".$result['id_lembaga']."' selected>".$result['nm_lembaga']."</option>";
									}
									else {
									echo "<option value='".$result['id_lembaga']."'>".$result['nm_lembaga']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>

                  <label class="control-label col-md-1">Nama Lembaga</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="poktangapoktan" placeholder="Nama Lembaga">
					
                  </div>
				  <span data-alertid="example"></span>

                	
				  	<label class="control-label col-md-1">Provinsi</label>
					<div class="col-sm-2">
						<select name="provinsi" id="provinsi" class="form-control" >
							<option value="">-- Pilih Provinsi --</option>
							<?php
								$qStrpro = "SELECT * FROM tblm_prov ORDER BY nm_prov";
								$qExeckab = mysqli_query($con,$qStrpro);
								while($resultkab = mysqli_fetch_array($qExeckab)){
									echo "<option value='".$resultkab['kd_prov']."'>".$resultkab['nm_prov']."</option>";
								}
							?>
						</select>
					</div>
				 
                </div>
              </div>


			  <div class="form-group">  
                 <div class="row">				 
                  <div class="col-md-1"></div>
				  
                  <label class="control-label col-md-1">Kabupaten</label>
                  <div class="col-sm-2">
						<select name="kabu" id="kabu" class="form-control">
							<option value="">-- Pilih Kabupaten --</option>

						</select>
					</div>
					
					<label class="control-label col-md-1">Kecamatan</label>
                  <div class="col-sm-2">
						<select name="keca" id="keca" class="form-control">
							<option value="">-- Pilih Kecamatan --</option>

						</select>
					</div>
					
				<label class="control-label col-md-1">Desa</label>
                  <div class="col-sm-2">
						<select name="desa" id="desa" class="form-control">
							<option value="">-- Pilih Desa --</option>

						</select>
					</div>
					
				</div>
              </div>

             <div class="form-group">  
                 <div id="latlang" class="row" style="display:block">
                  <div class="col-md-1"></div>
                  <label class="control-label col-md-1">Latitude</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="latal" placeholder="Produktivitas (Ku/Ha)" value=-6.21462>
                  </div>
				  
                  <label class="control-label col-md-1">Longitude</label>
                  <div class="col-md-2">
                    <input type="text" class="form-control" name="lngal" placeholder="Perkiraan Harga GKP (Rp/Kg)" value=106.84513>
                  </div>
				
                </div>
			</div>	
			<div class="form-group">  
				<div id="latlangpic" class="row" style="display:none">
                  <div class="col-md-3"></div>
				  <button class="btn btn-primary" onclick="toggleShow()" >Hide/Show Upload Pic</button>
                  <label class="control-label col-md-1">Upload Gambar</label>
					<form action="uploadpic.php" method="post" enctype="multipart/form-data">
						Select image to upload:
						<input type="file" name="fileToUpload" id="fileToUpload">
						<input type="submit" value="Upload Image" name="submit">
					</form>		  
				  
                </div>
              </div>
			  
			  			  			  <div class="form-group">  
                 <div class="row">
                  <div class="col-md-1"></div>


                  <label class="control-label col-md-1">Tahun Pengadaan</label>
				   <div class="col-md-2">
                    <select class="form-control" name="tahun">
                    <option value="">-- Pilih Tahun --</option>
							<?php
								$qStr5 = "SELECT * FROM tblm_tahunal";
								$qExec5 = mysqli_query($con,$qStr5);
								while($result = mysqli_fetch_array($qExec5)){
									if ($result['kd_tahun']==$_POST['prov']) {
									echo "<option value='".$result['kd_tahun']."' selected>".$result['nm_tahun']."</option>";
									}
									else {
									echo "<option value='".$result['kd_tahun']."'>".$result['nm_tahun']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>
                		  
                
				
				<label class="control-label col-md-1">Sumber Dana</label>
				  <div class="col-md-2">
                    <select class="form-control" name="sumberdana">
                    <option value="">-- Pilih Sumber Dana --</option>
							<?php
								$qStr6 = "SELECT * FROM tblm_sumberdana";
								$qExec6 = mysqli_query($con,$qStr6);
								while($result = mysqli_fetch_array($qExec6)){
									if ($result['kd_sumberdana']==$_POST['prov']) {
									echo "<option value='".$result['kd_sumberdana']."' selected>".$result['nm_sumberdana']."</option>";
									}
									else {
									echo "<option value='".$result['kd_sumberdana']."'>".$result['nm_sumberdana']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>

				<label class="control-label col-md-1">Kondisi</label>
				  <div class="col-md-2">
                    <select class="form-control" name="kondisi">
                    <option value="">-- Pilih Kondisi --</option>
							<?php
								$qStr7 = "SELECT * FROM tblm_kondisi";
								$qExec7 = mysqli_query($con,$qStr7);
								while($result = mysqli_fetch_array($qExec7)){
									if ($result['kd_kondisi']==$_POST['prov']) {
									echo "<option value='".$result['kd_kondisi']."' selected>".$result['nm_kondisi']."</option>";
									}
									else {
									echo "<option value='".$result['kd_kondisi']."'>".$result['nm_kondisi']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>	
				  
                </div>
              </div>
			  
			  <div class="form-group">  
                 <div class="row">
                  <div class="col-md-1"></div>
				  <label class="control-label col-md-1">Jumlah Unit</label>
				   <div class="col-md-2">
                    <input type="text" class="form-control" name="jumlahunit" placeholder="Total Jumlah Unit">
                  </div>


                  <label class="control-label col-md-1">Status</label>
				   <div class="col-md-2">
                    <select class="form-control" name="status">
                    <option value="">-- Pilih Status --</option>
							<?php
								$qStr3 = "SELECT * FROM tblm_status";
								$qExec3 = mysqli_query($con,$qStr3);
								while($result = mysqli_fetch_array($qExec3)){
									if ($result['kd_status']==$_POST['prov']) {
									echo "<option value='".$result['kd_status']."' selected>".$result['nm_status']."</option>";
									}
									else {
									echo "<option value='".$result['kd_status']."'>".$result['nm_status']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>
                		  
                
				
				<label class="control-label col-md-1">Pola Pengelolaan</label>
				  <div class="col-md-2">
                    <select class="form-control" name="pengelolaan">
                    <option value="">-- Pilih Pola Pengelolaan --</option>
							<?php
								$qStr4 = "SELECT * FROM tblm_pengelolaan";
								$qExec4 = mysqli_query($con,$qStr4);
								while($result = mysqli_fetch_array($qExec4)){
									if ($result['kd_pengelolaan']==$_POST['prov']) {
									echo "<option value='".$result['kd_pengelolaan']."' selected>".$result['nm_pengelolaan']."</option>";
									}
									else {
									echo "<option value='".$result['kd_pengelolaan']."'>".$result['nm_pengelolaan']."</option>";
									}
								}
							?>
                    </select>				  
                  </div>		  
                </div>
              </div>
			  
			  <div class="form-group">  
                 <div class="row">
                  <div class="col-md-1"></div>
				  <label class="control-label col-md-1">Keterangan</label>
				   <div class="col-md-5">
                    <textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan lain *apabila diperlukan">
					</textarea>
                  </div>


                  
                		  
                
				
						  
                </div>
              </div>
			 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success" name="save">Save</button>
                      <button type="reset" class="btn btn-primary" name="clear">Clear</button>
					  <button type="submit1" class="btn btn-success" name="view">Preview</button>
                      
                  </div>
                </div>
              </div>
            
            </form></div></div>
			<?php
			if(isset($_POST['view'])){
				
			?>

			<div class="box box-success">
              <div class="box-header"><h3>Tabel Data Alsintan</h3></div>
              <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">ID Master</p></th>
						<th><p style="text-align:center">Dibuat Oleh</p></th>
						<th><p style="text-align:center">Komoditi</p></th>
						<th><p style="text-align:center">Jenis Alsintan</p></th>
						<th><p style="text-align:center">Merk Alsintan</p></th>
                        <th><p style="text-align:center">Kode Wilayah (BPS)</p></th>
						<th><p style="text-align:center">Lembaga</p></th>
                        <th><p style="text-align:center">Nama Lembaga</p></th>	
                        <th><p style="text-align:center">Sumber Dana</p></th>
						<th><p style="text-align:center">Tahun Pengadaan</p></th>
						<th><p style="text-align:center">Status</p></th>
						<th><p style="text-align:center">Kondisi</p></th>
						<th><p style="text-align:center">Pola Pengelolaan</p></th>
						<th><p style="text-align:center">Jumlah (Unit)</p></th>
						<th><p style="text-align:center">Waktu Entri</p></th>							
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT m_alsintan.id_al as a,
					  tb_user.username as b,
					  tblm_komod.nm_komod as z,
					  tblm_jenals.nm_jenals as c,
					  m_alsintan.merek as d,
						CASE
							WHEN m_alsintan.id_lembaga='1' THEN provinsi
							WHEN m_alsintan.id_lembaga='2' THEN kabupaten
							ELSE desa
						END as e,
					  tblm_lembaga.nm_lembaga as f,
					  m_alsintan.poktangapoktan as g,
					  tblm_sumberdana.nm_sumberdana as h,
					  tblm_tahunal.nm_tahun as i,
					  tblm_status.nm_status as j,
					  tblm_kondisi.nm_kondisi as x,
					  tblm_pengelolaan.nm_pengelolaan as k,
					  m_alsintan.jumlah as l,
					  m_alsintan.created_date,
					  m_alsintan.sts
					  FROM m_alsintan
					  JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
					  JOIN tb_user ON tb_user.id_user = m_alsintan.created_by_userid
					  LEFT JOIN tblm_kec ON tblm_kec.kd_kec = m_alsintan.kecamatan
					  JOIN tblm_sumberdana ON tblm_sumberdana.kd_sumberdana = m_alsintan.id_sumberdana
					  JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
					  JOIN tblm_komod ON tblm_komod.kd_komod = m_alsintan.id_komod
					  JOIN tblm_status ON tblm_status.kd_status = m_alsintan.kd_status
					  JOIN tblm_kondisi ON tblm_kondisi.kd_kondisi = m_alsintan.kd_kondisi
					  JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
					  JOIN tblm_lembaga ON tblm_lembaga.id_lembaga = m_alsintan.id_lembaga
					  WHERE sts=1
					  ORDER BY id_al ";
                      $data = mysqli_query($con,$query);
					  
                      while($hasil = mysqli_fetch_array($data)){
						$date = $hasil['created_date'];
						$date = date('d-m-Y', strtotime($date));  
                        ?>
                      <tr>
						<td><?php echo $hasil['a']; ?></td>
                        <td><?php echo $hasil['b']; ?></td>
						<td><?php echo $hasil['z']; ?></td>
                        <td><?php echo $hasil['c']; ?></td>
						<td><?php echo $hasil['d']; ?></td>
                        <td><?php echo $hasil['e']; ?></td>
                        <td><?php echo $hasil['f']; ?></td>
                        <td><?php echo $hasil['g']; ?></td>
						<td><?php echo $hasil['h']; ?></td>
                        <td><?php echo $hasil['i']; ?></td>
                        <td><?php echo $hasil['j']; ?></td>
						<td><?php echo $hasil['x']; ?></td>
                        <td><?php echo $hasil['k']; ?></td>
                        <td><?php echo $hasil['l']; ?></td>
                        <td><?php echo $date; ?></td>
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
			if(isset($_POST['save'])){
				if ($datainsert) {
				writeMsg('save.sukses');
				} 
				else if (!$datainsert) {
				writeMsg('save.gagal');
				}					
					
					
				if("" == trim($_POST['pengelolaan'])){
				writeMsg('save.gagalpola');
				}
				if("" == trim($_POST['status'])){
				writeMsg('save.gagalstatus');
				}
				if("" == trim($_POST['jumlahunit'])){
				writeMsg('save.gagaljumlah');
				}
				if("" == trim($_POST['kondisi'])){
				writeMsg('save.gagalkondisi');
				}
				if("" == trim($_POST['sumberdana'])){
				writeMsg('save.gagalsumber');
				}
				if("" == trim($_POST['tahun'])){
				writeMsg('save.gagaltahun');
				}
				if("" == trim($_POST['poktangapoktan'])){
				writeMsg('save.gagalpoktan');
				}
				if("" == trim($_POST['lembaga'])){
				writeMsg('save.gagaljenlem');
				}
				if("" == trim($_POST['merek'])){
				writeMsg('save.gagalmerk');
				}
				if("" == trim($_POST['jenals'])){
				writeMsg('save.gagaljenals');
				}
				if("" == trim($_POST['komod'])){
				writeMsg('save.gagalkomod');
				}
																	
			?>				
			            <div class="box box-success">
              <div class="box-header"><h3>Tabel Data Alsintan</h3></div>
              <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-striped">
                    <thead>                     
                      <tr>
                        <th><p style="text-align:center">ID Master</p></th>
						<th><p style="text-align:center">Dibuat Oleh</p></th>
						<th><p style="text-align:center">Komoditi</p></th>
						<th><p style="text-align:center">Jenis Alsintan</p></th>
						<th><p style="text-align:center">Merk Alsintan</p></th>
                        <th><p style="text-align:center">Kode Wilayah (BPS)</p></th>
						<th><p style="text-align:center">Lembaga</p></th>
                        <th><p style="text-align:center">Nama Lembaga</p></th>	
                        <th><p style="text-align:center">Sumber Dana</p></th>
						<th><p style="text-align:center">Tahun Pengadaan</p></th>
						<th><p style="text-align:center">Status</p></th>
						<th><p style="text-align:center">Kondisi</p></th>
						<th><p style="text-align:center">Pola Pengelolaan</p></th>
						<th><p style="text-align:center">Jumlah (Unit)</p></th>
						<th><p style="text-align:center">Waktu Entri</p></th>							
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT m_alsintan.id_al as a,
					  tb_user.username as b,
					  tblm_komod.nm_komod as z,
					  tblm_jenals.nm_jenals as c,
					  m_alsintan.merek as d,
						CASE
							WHEN m_alsintan.id_lembaga='1' THEN provinsi
							WHEN m_alsintan.id_lembaga='2' THEN kabupaten
							ELSE desa
						END as e,
					  tblm_lembaga.nm_lembaga as f,
					  m_alsintan.poktangapoktan as g,
					  tblm_sumberdana.nm_sumberdana as h,
					  tblm_tahunal.nm_tahun as i,
					  tblm_status.nm_status as j,
					  tblm_kondisi.nm_kondisi as x,
					  tblm_pengelolaan.nm_pengelolaan as k,
					  m_alsintan.jumlah as l,
					  m_alsintan.created_date,
					  m_alsintan.sts
					  FROM m_alsintan
					  JOIN tblm_jenals ON tblm_jenals.kd_jenals=m_alsintan.jenis_als
					  JOIN tb_user ON tb_user.id_user = m_alsintan.created_by_userid
					  LEFT JOIN tblm_kec ON tblm_kec.kd_kec = m_alsintan.kecamatan
					  JOIN tblm_sumberdana ON tblm_sumberdana.kd_sumberdana = m_alsintan.id_sumberdana
					  JOIN tblm_tahunal ON tblm_tahunal.kd_tahun = m_alsintan.id_tahun
					  JOIN tblm_komod ON tblm_komod.kd_komod = m_alsintan.id_komod
					  JOIN tblm_status ON tblm_status.kd_status = m_alsintan.kd_status
					  JOIN tblm_kondisi ON tblm_kondisi.kd_kondisi = m_alsintan.kd_kondisi
					  JOIN tblm_pengelolaan ON tblm_pengelolaan.kd_pengelolaan = m_alsintan.kd_pola
					  JOIN tblm_lembaga ON tblm_lembaga.id_lembaga = m_alsintan.id_lembaga
					  WHERE sts=1
					  ORDER BY id_al ";
                      $data = mysqli_query($con,$query);
					  
                      while($hasil = mysqli_fetch_array($data)){
						$date = $hasil['created_date'];
						$date = date('d-m-Y', strtotime($date));  
                        ?>
                      <tr>
						<td><?php echo $hasil['a']; ?></td>
                        <td><?php echo $hasil['b']; ?></td>
						<td><?php echo $hasil['z']; ?></td>
                        <td><?php echo $hasil['c']; ?></td>
						<td><?php echo $hasil['d']; ?></td>
                        <td><?php echo $hasil['e']; ?></td>
                        <td><?php echo $hasil['f']; ?></td>
                        <td><?php echo $hasil['g']; ?></td>
						<td><?php echo $hasil['h']; ?></td>
                        <td><?php echo $hasil['i']; ?></td>
                        <td><?php echo $hasil['j']; ?></td>
						<td><?php echo $hasil['x']; ?></td>
                        <td><?php echo $hasil['k']; ?></td>
                        <td><?php echo $hasil['l']; ?></td>
                        <td><?php echo $date; ?></td>
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
	
	<script src="js/bootstrap-datepicker.js"></script>
    <script>
    $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
    </script>
	<script src="//cdn.rawgit.com/google/code-prettify/master/loader/prettify.js"></script>
	<script src="js/jquery.bsFormAlerts.js"></script>
  <script>
    $(function() {
      $("#master-form").submit(function() {
        var inputVal = $("#poktangapoktan").val();
        $(document).trigger("clear-alert-id.example");
        if (inputVal.length = 0) {
          $(document).trigger("set-alert-id-example", [
            {
              "message": "Please enter at least 3 characters",
              "priority": "error"
            },
            {
              "message": "This is an info alert",
              "priority": "info"
            }
          ]);
        }

        return false;
      });

      prettyPrint();
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