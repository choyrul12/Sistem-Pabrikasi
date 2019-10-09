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
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/config.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/styles.js"></script> -->
    <style>
         .dataTable > thead > tr > th{background-color: #00a65a; color: #FFF;}
    </style>
    <style>
      .gambar:hover{
        cursor : pointer;
      }
    </style>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
      <a href="#" class="logo">
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
              <a href="#" data-toggle="modal" data-target="#modalTrash" onclick="modalTrashSpk()">
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
    <div class="modal fade" id="modalTrash" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalTrash">&times;</button>
            <h3 class="modal-title text-primary">Tempat Sampah</h3>
          </div>
          <div class="modal-body" style="height:550px; overflow-y:scroll;">
            <div class="row">
              <div class="col-md-12">
                <div class="box box-info collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Gudang Roll</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashGudangRoll">
                        <thead>
                          <th>Kode</th>
                          <th>Ukuran</th>
                          <th>Merek</th>
                          <th>Jenis</th>
                          <th>Warna</th>
                          <th>Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-warning collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Trasaksi / History Gudang Hasil</h3>
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
                          <th>Berat</th>
                          <th>Payung</th>
                          <th>Bobin</th>
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

    <div class="modal fade" id="modalDetailDeletedSpk" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailDeletedSpk">&times;</button>
            <h4 class="modal-title text-primary">Detail SPK</h4>
          </div>
          <div class="modal-body">
            <table class="table table-responsive table-bordered">
              <tr>
                <td width="20%">Kode PPIC</td>
                <td width="1%">:</td>
                <td id="tdKodePpic"></td>
              </tr>
              <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td id="tdNamaCustomer"></td>
              </tr>
              <tr>
                <td>Tanggal Rencana</td>
                <td>:</td>
                <td id="tdTglRencana"></td>
              </tr>
              <tr>
                <td>Bagian</td>
                <td>:</td>
                <td id="tdBagian"></td>
              </tr>
              <tr>
                <td>Jenis Permintaan</td>
                <td>:</td>
                <td id="tdJnsPermintaan"></td>
              </tr>
              <tr>
                <td>Merek</td>
                <td>:</td>
                <td id="tdMerek"></td>
              </tr>
              <tr>
                <td>Ukuran</td>
                <td>:</td>
                <td id="tdUkuran"></td>
              </tr>
              <tr>
                <td>Warna Plastik</td>
                <td>:</td>
                <td id="tdWarnaPlastik"></td>
              </tr>
              <tr>
                <td>Tebal</td>
                <td>:</td>
                <td id="tdTebal"></td>
              </tr>
              <tr>
                <td>Berat</td>
                <td>:</td>
                <td id="tdBerat"></td>
              </tr>
              <tr>
                <td>Jumlah Permintaan</td>
                <td>:</td>
                <td id="tdJumlahPermintaan"></td>
              </tr>
              <tr>
                <td>Strip</td>
                <td>:</td>
                <td id="tdStrip"></td>
              </tr>
              <tr>
                <td>Status Pengerjaan</td>
                <td>:</td>
                <td id="tdStatusPengerjaan"></td>
              </tr>
              <tr>
                <td>Prioritas</td>
                <td>:</td>
                <td id="tdPrioritas"></td>
              </tr>
              <tr>
                <td></td>
                <td>:</td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td>:</td>
                <td></td>
              </tr>
            </table>
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
