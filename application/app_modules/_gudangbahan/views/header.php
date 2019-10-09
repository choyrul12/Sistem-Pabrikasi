<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Produksi Terintegrasi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
		<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-theme.min.css">-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/fixedheader/css/fixedHeader.bootstrap.min.css">
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/config.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/styles.js"></script>
    <style>
         .dataTable > thead > tr > th{background-color: #00a65a; color: #FFF;}
    </style>
    <style>
      .gambar:hover{
        cursor : pointer;
      }

      @media print {
        body * {
          visibility: hidden;
        }
        #section-to-print, #section-to-print * {
          visibility: visible;
        }
      }
    </style>
  </head>

  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url().'_gudangbahan/main'; ?>" class="logo">
        <span class="logo-mini"><img class="user-image" src="<?php echo base_url(); ?>assets/images/logo_plastik_white.png" width="45px" height="45px"></span>
        <span class="logo-lg"><b><?php echo strtoupper($this->session->userdata("fabricationGroup")); ?></b> LTE</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="notifications-menu">
              <a href="#" data-toggle="modal" data-target="#modalTrashGudangBahan" onclick="modalTrashGudangBahan()">
                <i class="fa fa-trash"></i>
                <div class="label label-warning" id="count-trash"></div>
              </a>
            </li>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar_2x.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $this->session->userdata("fabricationUsername"); ?></span>&nbsp;
                <span class="ion-arrow-down-b"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar_2x.png" class="img-circle" alt="User Image">
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
              <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div><!-- /.row -->
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url() ?>_main/main/logout" class="btn btn-danger btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
        </div>
      </nav>
    </header>
    <div class="modal fade" id="modalTrashGudangBahan" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalTrashBahanBaku">&times;</button>
            <h4 class="modal-title text-primary">Tempat Sampah</h4>
          </div>
          <div class="modal-body" style="height:550px; overflow-y:scroll;">
            <div class="row">
              <div class="col-md-12">
                <div class="box box-info collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Gudang Bahan</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashGudangBahan">
                        <thead>
                          <th>Id</th>
                          <th>Nama Bahan Baku</th>
                          <th>Stok</th>
                          <th>Warna</th>
                          <th>Jenis</th>
                          <th>Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-danger collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Spare Part</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashSparePart">
                        <thead>
                          <th>Id</th>
                          <th>Nama Spare Part</th>
                          <th>Ukuran</th>
                          <th>Stok(Stok Aktual)</th>
                          <th>Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-primary collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Transaksi / History Gudang Bahan</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashTransaksi">
                        <thead>
                          <th>Tanggal</th>
                          <th>Nama Barang</th>
                          <th>Jumlah</th>
                          <th>Keterangan History</th>
                          <th>Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-success collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Transaksi / History Gudang Apal</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashTransaksiGudangApal">
                        <thead>
                          <th>Tanggal</th>
                          <th>Nama</th>
                          <th>Jenis(Sub Jenis)</th>
                          <th>Jumlah</th>
                          <th>Keterangan History</th>
                          <th>Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-warning collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Transaksi / History Gudang Spare Part</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashTransaksiGudangSparePart">
                        <thead>
                          <th>Tanggal</th>
                          <th>Nama Barang</th>
                          <th>Jumlah</th>
                          <th>Keterangan History</th>
                          <th>Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-notif" role="dialog" style="z-index:9999;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <div id="modalNotifContent">

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalShowImage" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-toggle="modal" data-target="#modalShowImage">&times;</button>
          </div>
          <div class="modal-body" style="height:500px; overflow-x:scroll; overflow-y:scroll;">
            <img src="" id="imageShow" width="100%" height="500px">
          </div>
        </div>
      </div>
    </div>

    <div id="modalPermintaanBahanSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1050px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Permintaan <span id="title_jenis"></span> Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
            <div class="content">
              <table class="table table-responsive table-striped" id="tableDataPermintaanBahanSablon">
                <thead>
                  <th style="width: 15px;">No.</th>
                  <th>Tanggal</th>
                  <th>Nama Bahan</th>
                  <th>Jenis</th>
                  <th>Warna</th>
                  <th>Jumlah</th>
                  <th>Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>
              <div style="text-align: center; bottom: 0px;">

              </div>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;">
              <button class="btn btn-flat bg-navy margin" id="btn_approvePermintaanBahanSablon" style="margin: auto; width:30%; position: relative;">APPROVE</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalBonPermintaan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalBonPermintaan">&times;</button>
            </div>
            <div class="modal-body" style="height:80%;" id="section-to-print">
              <h4 class="modal-title text-blue">BON PERMINTAAN <span id="jenis"></span></h4>
              <table class="table table-responsive table-striped" id="tableListBonPermintaan" width="100%">
                <thead>
                  <th align="left">No</th>
                  <th align="left">Tanggal</th>
                  <th align="left">Customer</th>
                  <th align="left">Nama Bahan</th>
                  <th align="left">Warna</th>
                  <th align="left">Jenis</th>
                  <th align="left">Jumlah</th>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-md btn-flat btn-success" id="print_bon_permintaan"><span class="fa fa-print"></span> Print</button>
            </div>
          </div>
        </div>
      </div>


    <section>
      <div id="modal_cariBonPermintaan" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="text-align: center;">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Bon Permintaan</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_cari1" id="tgl_cari1" placeholder="Tanggal Awal">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_cari2" id="tgl_cari2" placeholder="Tanggal Akhir">
                </div>
              </div>
            <div class="form-group">
              <button type="submit" id="btn_cariBonPermintaan" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
