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
<body class="skin-blue sidebar-mini">

<?php
  $hak = $_SESSION['hak_akses'];
  if($hak==4){
?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <p style="color:white">M. Rachmatarramadhan</p>
            </div>
          </div> -->
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
           </form>
          <!-- /.search form -->
      
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="header"> </li>
            <li class="treeview"><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
            
		
            <!-- Input Data -->            
            <li class="treeview"><a href="#"><i class="fa fa-inbox"></i> <span>Input Data</span><i class="fa fa-angle-left pull-right"></i></a>
			<ul class="treeview-menu">
                <li><a href="entri_alsintan.php"><i class="fa fa-inbox"></i> Master Alsintan</a></li>
                <li><a href="prev_transaksi.php"><i class="fa fa-inbox"></i> Hasil & Pelayanan</a></li>
              </ul>
            </li>
			
			<!-- Preview Data -->
            <li class="treeview"><a href="prev_all.php"><i class="fa fa-book"></i> <span>Preview Data</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="prev_all.php"><i class="fa fa-book"></i> Master Alsintan</a></li>
                <li><a href="prev_alltr.php"><i class="fa fa-book"></i> Hasil & Pelayanan</a></li>
				<li><a href="prev_bastpall.php"><i class="fa fa-book"></i> BAST Pembayaran</a></li>
				<li><a href="prev_basthall.php"><i class="fa fa-book"></i> BAST Hibah</a></li>
            </ul>
			</li>
      <!-- Preview Map -->
            <li class="treeview"><a href="#"><i class="fa fa-globe"></i> <span>Preview Map</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="map_nasional.php"><i class="fa fa-globe"></i> Sebaran Nasional</a></li>
                <li><a href="map_provinsi.php"><i class="fa fa-globe"></i> Sebaran Provinsi</a></li>
              </ul>
            </li>
              
			<!-- LAPORAN -->
			<li class="treeview"><a href="#"><i class="fa fa-file"></i> <span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="prev_haspelperprov.php"><i class="fa fa-file"></i>Hasil & Pelayanan Nasional</a></li>
				<li><a href="prev_detilunitperprov.php"><i class="fa fa-file"></i>Unit Alsintan Nasional</a></li>
 			  </ul>
            </li>	  
				  
            <!-- Manajemen Data -->
            <li class="treeview"><a href="#"><i class="fa fa-folder"></i> <span>Manajemen Data</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="edit_prov.php"><li><i class="fa fa-folder"></i> Tabel Provinsi</a></li>
                <li><a href="edit_kabu.php"><li><i class="fa fa-folder"></i> Tabel Kabupaten</a></li>
				<li><a href="edit_keca.php"><li><i class="fa fa-folder"></i> Tabel Kecamatan</a></li>
				<li><a href="edit_desa.php"><li><i class="fa fa-folder"></i> Tabel Desa</a></li>
				<li><a href="edit_jenals.php"><li><i class="fa fa-folder"></i> Tabel Jenis Alsintan</a></li>
				<li><a href="edit_komod.php"><li><i class="fa fa-folder"></i> Tabel Komoditas</a></li>
				<li><a href="edit_status.php"><li><i class="fa fa-folder"></i> Tabel Status</a></li>
				<li><a href="edit_kondisi.php"><li><i class="fa fa-folder"></i> Tabel Kondisi</a></li>
				<li><a href="edit_pengelolaan.php"><li><i class="fa fa-folder"></i> Tabel Pengelolaan</a></li>
				<li><a href="edit_sumberdana.php"><li><i class="fa fa-folder"></i> Tabel Sumber Dana</a></li>
				<li><a href="edit_tahunal.php"><li><i class="fa fa-folder"></i> Tabel Tahun</a></li>
                <li><a href="edit_user.php"><li><i class="fa fa-folder"></i> Tabel User</a></li>
              </ul>
            </li>
			
      </ul>
    </section>
      <!-- /.sidebar -->
  </aside>

    <?php
      }
    ?>
	<?php
	if($hak==3){
	
	?>
	<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <p style="color:white">M. Rachmatarramadhan</p>
            </div>
          </div> -->
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
           </form>
          <!-- /.search form -->
      
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="header"> </li>
            <li class="treeview"><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
            
		
            <!-- Input Data -->            
            <li class="treeview"><a href="#"><i class="fa fa-inbox"></i> <span>Input Data</span><i class="fa fa-angle-left pull-right"></i></a>
			<ul class="treeview-menu">
                <li><a href="entri_alsintan.php"><i class="fa fa-inbox"></i> Master Alsintan</a></li>
                <li><a href="prev_transaksi.php"><i class="fa fa-inbox"></i> Hasil & Pelayanan</a></li>
              </ul>
            </li>
			
			<!-- Preview Data -->
            <li class="treeview"><a href="prev_all.php"><i class="fa fa-book"></i> <span>Preview Data</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="prev_all.php"><i class="fa fa-book"></i> Master Alsintan</a></li>
                <li><a href="prev_alltr.php"><i class="fa fa-book"></i> Hasil & Pelayanan</a></li>
				<li><a href="prev_bastpall.php"><i class="fa fa-book"></i> BAST Pembayaran</a></li>
				<li><a href="prev_basthall.php"><i class="fa fa-book"></i> BAST Hibah</a></li>
            </ul>
			</li>
			
			<!-- Upload BAST -->
			<li class="treeview"><a href="#"><i class="fa fa-upload"></i> <span>Upload BAST</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="upload_bastp-old.php"><i class="fa fa-upload"></i> BAST Pembayaran</a></li>
                <li><a href="upload_basth-old.php"><i class="fa fa-upload"></i> BAST Hibah</a></li>
 			  </ul>
            </li>
			              
			<!-- LAPORAN -->
			<li class="treeview"><a href="#"><i class="fa fa-file"></i> <span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="prev_haspelperprov.php"><i class="fa fa-file"></i>Hasil & Pelayanan Nasional</a></li>
				<li><a href="prev_detilunitperprov.php"><i class="fa fa-file"></i>Unit Alsintan Nasional</a></li>
 			  </ul>
            </li>	  
				  

			
      </ul>
    </section>
      <!-- /.sidebar -->
  </aside>
	<?php
      }
    ?>
	
	
    <?php
      if($hak==2){

    ?>

  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <p style="color:white">M. Rachmatarramadhan</p>
            </div>
          </div> -->

      
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview"><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
            
            <!-- Input Data -->            
            <li class="treeview"><a href="#"><i class="fa fa-inbox"></i> <span>Input Data</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="entri_alsintanop.php"><i class="fa fa-inbox"></i> Master Alsintan</a></li>
                <li><a href="prev_transaksiop.php"><i class="fa fa-inbox"></i> Hasil & Pelayanan</a></li>
              </ul>
            </li>
			<li class="treeview"><a href="#"><i class="fa fa-upload"></i> <span>Upload BAST</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="upload_bastp.php"><i class="fa fa-upload"></i> BAST Pembayaran</a></li>
                <li><a href="upload_basth.php"><i class="fa fa-upload"></i> BAST Hibah</a></li>
 			  </ul>
            </li>
		    <li class="treeview"><a href="prev_all.php"><i class="fa fa-book"></i> <span>Preview Data</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
				<li><a href="prev_bastpop.php"><i class="fa fa-book"></i> BAST Pembayaran</a></li>
				<li><a href="prev_basthop.php"><i class="fa fa-book"></i> BAST Hibah</a></li>
            </ul>
			</li>
            
            <!-- LAPORAN            -->
 
 		
      </ul>
    </section>
      <!-- /.sidebar -->
  </aside>

    <?php
      }
    ?>


    <?php
      if($hak==1){

    ?>

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <p style="color:white">M. Rachmatarramadhan</p>
            </div>
          </div> -->

      
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview"><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
             <li class="treeview"><a href="#"><i class="fa fa-file"></i> <span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="prev_haspelperprov.php"><i class="fa fa-file"></i>Hasil & Pelayanan Nasional</a></li>
				<li><a href="prev_detilunitperprov.php"><i class="fa fa-file"></i>Unit Alsintan Nasional</a></li>
 			  </ul>
            </li>	
            
            <!-- LAPORAN -->            
  
          
      
      </ul>
    </section>
      <!-- /.sidebar -->
  </aside>

    <?php
      }
    ?>
  </body>
</html>