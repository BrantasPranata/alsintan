<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PUSDATIN Basis Data Harga Komoditas Pertanian</title>
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
  <body class="skin-green sidebar-mini">
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
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="home.html">
                <i class="fa fa-home"></i> <span>Home</span>
              </a>
            </li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-inbox"></i> <span>Transfer Data</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
          <ul class="treeview-menu">
          <li><a href="pages/transferdata/transferhkp.php"><i class="fa fa-upload"></i> HKP - Format1</a></li>
          <li><a href="pages/transferdata/transferhgb.php"><i class="fa fa-upload"></i> HGB - Format2</a></li>
          <li><a href="pages/transferdata/transferhpd.php"><i class="fa fa-upload"></i> HPD - Format3</a></li>
          <li><a href="pages/transferdata/transferhkd.php"><i class="fa fa-upload"></i> HKD - Format4</a></li>
        </ul>
      </li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i> <span>Preview Data</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
          <ul class="treeview-menu">
          <li><a href="pages/previewdata/hargagabah.php"><i class="fa fa-circle-o"></i> Harga Gabah</a></li>
          <li><a href="pages/previewdata/hargakonsumenprovinsi.php"><i class="fa fa-circle-o"></i> Harga Konsumen Provinsi</a></li>
          <li><a href="pages/previewdata/hargakonsumenpedesaan.php"><i class="fa fa-circle-o"></i> Harga Konsumen Pedesaan</a></li>
          <li><a href="pages/previewdata/hargaprodusenpedesaan.php"><i class="fa fa-circle-o"></i> Harga Produsen Pedesaan</a></li>
              </ul>
      </li>
            
            <!-- LAPORAN -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Gabah <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="pages/laporan/laporanhg1.php"><i class="fa fa-table"></i> Tingkat Petani </a></li>
          <li><a href="pages/laporan/laporanhg2.php"><i class="fa fa-table"></i> Tingkat Penggilingan </a></li>
          <li><a href="#"><i class="fa fa-table"></i> Info3 </a></li>
          <li><a href="#"><i class="fa fa-table"></i> Info4 </a></li>
          <li><a href="#"><i class="fa fa-table"></i> Info5 </a></li>
                  </ul>
                </li>
        
        <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Konsumen Provinsi <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="pages/laporan/hkp_mingguan.php"><i class="fa fa-table"></i> Rata-rata Mingguan </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Rata-rata Bulanan <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="pages/laporan/hkp_bulanan.php"><i class="fa fa-table"></i> Tabel </a></li>
                        <li><a href="pages/laporan/hkp_grafikbulanan.php"><i class="fa fa-bar-chart"></i> Grafik </a></li>
                      </ul>
                    </li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Rata-rata Tahunan <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="pages/laporan/hkp_tahunan.php"><i class="fa fa-table"></i> Tabel </a></li>
                        <li><a href="pages/laporan/hkp_grafiktahunan.php"><i class="fa fa-bar-chart"></i> Grafik </a></li>
                      </ul>
                    </li>
          <li><a href="pages/laporan/hkp_nasional.php"><i class="fa fa-table"></i> Rata-rata Tingkat Nasional </a></li>
                  </ul>
                </li>
        
        <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Konsumen Pedesaan <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Rata-rata Bulanan <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="pages/laporan/hkd_bulanan.php"><i class="fa fa-table"></i> Tabel </a></li>
                        <li><a href="pages/laporan/hkd_grafikbulanan.php"><i class="fa fa-bar-chart"></i> Grafik </a></li>
                      </ul>
                    </li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Rata-rata Tahunan <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="pages/laporan/hkd_tahunan.php"><i class="fa fa-table"></i> Tabel </a></li>
                        <li><a href="pages/laporan/hkd_grafiktahunan.php"><i class="fa fa-bar-chart"></i> Grafik </a></li>
                      </ul>
                    </li>
          <li><a href="pages/laporan/hkd_nasional.php"><i class="fa fa-table"></i> Rata-rata Tingkat Nasional </a></li>
                  </ul>
                </li>
        
        <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Produsen Pedesaan <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Rata-rata Bulanan <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="pages/laporan/hpd_bulanan.php"><i class="fa fa-table"></i> Tabel </a></li>
                        <li><a href="pages/laporan/hpd_grafikbulanan.php"><i class="fa fa-bar-chart"></i> Grafik </a></li>
                      </ul>
                    </li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Rata-rata Tahunan <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="pages/laporan/hpd_tahunan.php"><i class="fa fa-table"></i> Tabel </a></li>
                        <li><a href="pages/laporan/hpd_grafiktahunan.php"><i class="fa fa-bar-chart"></i> Grafik </a></li>
                      </ul>
                    </li>
          <li><a href="pages/laporan/hpd_nasional.php"><i class="fa fa-table"></i> Rata-rata Tingkat Nasional </a></li>
                  </ul>
                </li>
              </ul>
            </li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file"></i> <span>Manajemen Data</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
          <ul class="treeview-menu">
          <li><a href="#"><li><i class="fa fa-table"></i> Tabel1</a></li>
          <li><a href="#"><li><i class="fa fa-edit"></i> Edit1</a></li>
          <li><a href="#"><li><i class="fa fa-edit"></i> Edit2</a></li>
          <li><a href="#"><li><i class="fa fa-edit"></i> Edit3</a></li>
          <li><a href="#"><li><i class="fa fa-edit"></i> Input dan Edit4</a></li>

              </ul>
      </li>
      
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
    </body>
  </html>