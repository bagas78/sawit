<!DOCTYPE html>
<html> 
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title><?=strtoupper(@$title)?> | SISTEM MONITORING KEBUN SAWIT</title>
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/gambar/icon.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/font-awesome/css/font-awesome.min.css"> 
  <!-- Ionicons --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/Ionicons/css/ionicons.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/skins/_all-skins.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Data Table -->
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/responsive.dataTables.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/css/select2.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

  <!--sweetalert-->
  <script src="<?php echo base_url('assets/') ?>sweetalert/sweet-alert.js"></script>

  <!-- number format -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/number_format.js') ?>"></script>


<style type="text/css">

#loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 140px;
    height: 45px;
    font-size: 18px;
    opacity: 40%;
}

.clock {
    font-size: 18px;
    color: white;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 37.5vw;
    transform: translateY(-50%);
    background-color: #008749;
    padding: 5px 30px 5px 30px;
    border-radius: 50px;
 }

 @media (max-width: 767px) {
    .clock {
    left: 37vw;
    }
  }

</style>

</head>
<body class="hold-transition skin-green-light sidebar-mini">

<div class="wrapper"> 

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><i class="fa fa-pie-chart"></i></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img style="width: 15%;" src="<?=base_url('assets/gambar/icon.png')?>" aria-hidden="true"></i> <b>KEBUN SAWIT</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="font-size: 14px;">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <span class="clock" id="clock"></span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         <li>
            <a href="#" onclick="refresh()"><i style="padding-top: 5px;" class="fa fa-refresh"></i></a>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i style="padding-top: 5px;" class="fa fa-gears"></i></a>
          </li>
          
        </ul>
      </div>

      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <img src="<?=@$this->server->online()?>assets/gambar/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image"  style="height: 45px;">

          <!-- <img src="<?php echo base_url() ?>assets/gambar/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image"  style="height: 45px;"> -->
          
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name'); ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

          <li class="dashboard">
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-pie-chart"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="notif" hidden>
            <a href="<?php echo base_url() ?>wa">
              <i class="fa fa-whatsapp"></i> <span>Notif Whatsapp</span>
            </a>
          </li>

          <li class="treeview kontak" hidden>
            <a href="#">
              <i class="fa fa-users"></i> <span>Kontak</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('kontak/index/s')?>"><i class="fa fa-circle-o"></i> Supplier</a></li>
              <li><a href="<?=base_url('kontak/index/p')?>"><i class="fa fa-circle-o"></i> Pelanggan</a></li>
            </ul>
          </li>

          <li class="treeview gudang" hidden>
            <a href="#">
              <i class="fa fa-dropbox"></i> <span>Persedian Gudang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('satuan')?>"><i class="fa fa-circle-o"></i> Satuan</a></li>
              <li><a href="<?=base_url('barang/sawit')?>"><i class="fa fa-circle-o"></i> Sawit</a></li>
              <li><a href="<?=base_url('barang/pupuk')?>"><i class="fa fa-circle-o"></i> Pupuk</a></li>
              <li><a href="<?=base_url('barang/pestisida')?>"><i class="fa fa-circle-o"></i> Pestisida</a></li>
            </ul>
          </li>

          <li class="treeview reminder" hidden>
            <a href="#">
              <i class="fa fa-bell"></i> <span>Reminder</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small style="display: none;" class="label pull-right bg-red reminder_notif">New</small>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('reminder/kategori')?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
              <li><a href="<?=base_url('reminder/jadwal')?>"><i class="fa fa-circle-o"></i> Jadwal</a></li>
              <li>
                <a href="<?=base_url('reminder/notif')?>"><i class="fa fa-circle-o"></i> Notifikasi
                  <small style="display: none;" class="label pull-right bg-primary reminder_notif"></small>
                </a>
              </li>
            </ul>
          </li>

          <li class="treeview kebun" hidden>
            <a href="#">
              <i class="fa fa-th-large"></i> <span>Kode Kebun</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('kebun')?>"><i class="fa fa-circle-o"></i> Kebun</a></li>
              <li><a href="<?=base_url('pekerjaan')?>"><i class="fa fa-circle-o"></i> Pekerjaan</a></li>
              <li><a href="<?=base_url('karyawan')?>"><i class="fa fa-circle-o"></i> Karyawan</a></li>
            </ul>
          </li>

          <li class="treeview pembelian" hidden>
            <a href="#">
              <i class="fa fa-shopping-basket"></i> <span>Pembelian</span>
              <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
                <small style="display: none;" class="label pull-right bg-red pembelian_notif">New</small>
              </span>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('pembelian/transaksi')?>"><i class="fa fa-circle-o"></i> Transaksi</a></li>
              <li>
                <a href="<?=base_url('pembelian/hutang')?>"><i class="fa fa-circle-o"></i> Hutang
                  <small style="display: none;" class="label pull-right bg-primary hutang_notif"></small>
                </a>
              </li>
            </ul>
          </li>

          <li class="treeview pengeluaran" hidden>
            <a href="#">
              <i class="fa fa-arrows-alt"></i> <span>Pengeluaran</span>
              <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('pengeluaran/kategori')?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
              <li><a href="<?=base_url('pengeluaran/transaksi')?>"><i class="fa fa-circle-o"></i> Transaksi</a></li>
            </ul>
          </li>

          <li class="treeview recording" hidden>
            <a href="#">
              <i class="fa fa-paste"></i> <span>Recording</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('recording/harian')?>"><i class="fa fa-circle-o"></i> Harian</a></li>
            </ul>
          </li>

          <li class="treeview monitoring" hidden>
            <a href="#">
              <i class="fa fa-industry"></i> <span>Monitoring</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('monitoring/view/panen')?>"><i class="fa fa-circle-o"></i> Panen</a></li>
              <li><a href="<?=base_url('monitoring/view/pruning')?>"><i class="fa fa-circle-o"></i> Pruning</a></li>
              <li><a href="<?=base_url('monitoring/view/semprot')?>"><i class="fa fa-circle-o"></i> Semprot</a></li>
              <li><a href="<?=base_url('monitoring/view/pupuk')?>"><i class="fa fa-circle-o"></i> Pupuk</a></li>
            </ul>
          </li>


          <li class="treeview penjualan" hidden>
            <a href="#">
              <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small style="display: none;" class="label pull-right bg-red penjualan_notif">New</small>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('penjualan/transaksi')?>"><i class="fa fa-circle-o"></i> Transaksi</a></li>
              <li>
                <a href="<?=base_url('penjualan/piutang')?>"><i class="fa fa-circle-o"></i> Piutang
                  <small style="display: none;" class="label pull-right bg-primary piutang_notif"></small>
                </a>
              </li>
            </ul>
          </li>

          <li class="treeview laporan" hidden>
            <a href="#">
              <i class="fa fa-file-text"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('laporan/pembelian')?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
              <li><a href="<?=base_url('laporan/penjualan')?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
              <li><a href="<?=base_url('laporan/pengeluaran')?>"><i class="fa fa-circle-o"></i> Pengeluaran</a></li>
            </ul>
          </li>

          <li class="treeview absensi" hidden>
            <a href="#">
              <i class="fa fa-check-square-o"></i> <span>Absensi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('absen/harian')?>"><i class="fa fa-circle-o"></i> Harian</a></li>
              <li><a href="<?=base_url('absen/riwayat')?>"><i class="fa fa-circle-o"></i> Riwayat</a></li>
            </ul>
          </li>

          <li class="treeview gaji" hidden>
            <a href="#">
              <i class="fa fa-tasks"></i> <span>Gaji Karyawan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('gaji/bulan')?>"><i class="fa fa-circle-o"></i> Bulan Ini</a></li>
              <li><a href="<?=base_url('gaji/riwayat')?>"><i class="fa fa-circle-o"></i> Riwayat</a></li>
            </ul>
          </li>

          <li class="treeview user" hidden>
            <a href="#">
              <i class="fa fa-user-plus"></i> <span>User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('user/level')?>"><i class="fa fa-circle-o"></i> Level</a></li>
              <li><a href="<?=base_url('user')?>"><i class="fa fa-circle-o"></i> Akun</a></li>
            </ul>
          </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active">
       <ul class="control-sidebar-menu">
          <li>
            <a style="color: #444444;" href="<?php echo base_url() ?>profile">
              <i class="fa fa-user-circle-o"></i><span> &#160;&#160;Profile</span>
            </a>
          </li>

          <li>
            <a style="color: #444444;" href="#" onclick="logout('<?php echo base_url('login/logout') ?>')">
              <i class="fa fa-sign-out"></i><span> &#160;&#160;Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
<button style="display: none;" id="loader" class="btn btn-danger" type="button" disabled>
  <i class="fa fa-spinner fa-spin"></i>
  Loading...
</button>

  