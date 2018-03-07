<?php
  session_start();
  include "config.php";
  
  if(!isset($_SESSION['username'])){
    header('location:index.php');
  }
?>
<script language="javascript" src="../jquery.js"></script>
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
	
$(document).ready(function() {
	$('#kabu').change(function() { // Jika select box id kota dipilih
		var kabu = $(this).val(); // Ciptakan variabel kota
		$.ajax({
			type: 'POST', // Metode pengiriman data menggunakan POST
			url: 'keca.php', // File pemroses data
			data: 'namkab=' + kabu, // Data yang akan dikirim ke file pemroses
			success: function(response) { // Jika berhasil
				$('#keca').html(response); // Berikan hasilnya ke id kurir
			}
		});
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

    <link href="bootstrap/css/datepicker.css" rel="stylesheet">
	<title>Update Data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
            include "header.php";
            include "nav.php";
        ?>
	<div class="judul">		
		<h1>Update Record</h1>
	</div>
	
	<br/>
	
	<a href="../prev_all.php">Lihat Semua Data</a>
 
	<br/>
	<h3>Edit data</h3>
 
	<?php 
	$id = $_GET['id'];
	$query_mysql = mysql_query("SELECT * FROM tr_alsintan WHERE id_al='$id'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
	<form action="update.php" method="post">		
		<table>
			<tr>
				<td>Kode Wilayah</td>
				<td>
					<input type="hidden" name="id" value="<?php echo $data['id_al'] ?>">
					<input type="text" name="kode_wildis" value="<?php echo $data['kode_wil'] ?>" disabled>
				</td>					
			</tr>	
			<tr>
				<td>Poktan / Gapoktant</td>
				<td><input type="text" name="poktangapoktan" value="<?php echo $data['poktangapoktan'] ?>"></td>					
			</tr>	
			<tr>
				<td>Nomor Alsintan / Kode Aset</td>
				<td><input type="text" name="no_alsintan" <?php echo $data['no_alsintan_new'] ?></td>					
			</tr>
			<tr>
				<td>Jenis Alsintan</td>
				<td> <select class="form-control" name="jenals">
                    <option value="<?php echo $data['jenis_als'] ?>">-- Pilih Jenis Alsintan --</option>
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
                    </select></td>					
			</tr>
			<tr>
				<td>Provinsi</td>
				<td> <select name="provinsi" id="provinsi" class="form-control" >
							<option value="">-- Pilih Provinsi --</option>
							<?php
								$qStrpro = "SELECT * FROM tblm_prov ORDER BY nm_prov";
								$qExeckab = mysqli_query($con,$qStrpro);
								while($resultkab = mysqli_fetch_array($qExeckab)){
									echo "<option value='".$resultkab['kd_prov']."'>".$resultkab['nm_prov']."</option>";
								}
							?>
						</select></td>					
			</tr>
			<tr>
				<td>Kabupaten</td>
				<td> 	<select name="kabu" id="kabu" class="form-control">
							<option value="">-- Pilih Kabupaten --</option>

						</select></td>					
			</tr>
			<tr>
				<td>Kecamatan</td>
				<td> 							<select name="keca" id="keca" class="form-control">
							<option value="">-- Pilih Kecamatan --</option>

						</select></td>					
			</tr>			
			<tr>
				<td></td>
				<td><input type="submit" value="Simpan"></td>					
			</tr>				
		</table>
	</form>
	<?php } ?>
</body>
</html>