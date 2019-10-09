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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/fixedheader/css/fixedHeader.bootstrap.min.css">
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/config.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/styles.js"></script>
    <style type="text/css">
      .img-hover:hover{
    	   transform: scale(3);
    	    z-index: 1000;
    	     transition: 1s;
      }
      .img-hover{
    	   transition: 1s;
       }
  </style>
  </head>

  <body class="hold-transition skin-green sidebar-mini sidebar-collapse">
    <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url(); ?>_marketing/main" class="logo">
        <span class="logo-mini"><img class="user-image" src="<?php echo base_url(); ?>assets/images/logo_plastik_white.png" width="45px" height="45px"></span>
        <span class="logo-lg"><b><?php echo strtoupper($this->session->userdata("fabricationGroup")); ?></b> LTE</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->

              <li class="notifications-menu">
                <a href="#" data-toggle="modal" data-target="#modalGetListOrder" data-backdrop="static" onclick="modalShowOrderDeadline();">
                  <i class="fa fa-bell-o"></i>
                  <div class="label label-danger" id="countOrder"></div>
                </a>
              </li>
            <li class="notifications-menu">
              <a href="#" data-toggle="modal" data-target="#modal-trash" data-backdrop="static">
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
                    <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modalChangePassword" data-backdrop="static">
                      <i class="fa fa-cogs"></i> Password
                    </a>
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
    <div class="modal fade" id="modal-trash">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" name="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="text-danger"><b>Tempat Sampah</b></h4>
          </div>
          <div class="modal-body">
            <table class="table table-responsive table-striped" id="table-trash">
              <thead>
                <th>No.Order</th>
                <th>Nama Pemesan</th>
                <th>Dihapus Pada</th>
                <th>Pulihkan</th>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalShowImage" role="dialog" tabindex="-1" style="z-index:9999;">
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

    <div class="modal fade" id="modalGetListOrder" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg" style="width:100%; padding:0; margin:0;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalGetListOrder">&times;</button>
            <h4 class="modal-title text-blue">Daftar Pesanan Yang Sudah Melewati Tanggal Estimasi</h4>
          </div>
          <div class="modal-body" style="height:90%; overflow:scroll;">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tableListPesananLewatTglEstimasi">
                  <thead>
                    <tr>
                      <th rowspan="2" style="vertical-align:middle;">No. Order</th>
                      <th rowspan="2" style="vertical-align:middle;">Kode Order</th>
                      <th rowspan="2" style="vertical-align:middle;">Nama Perusahaan</th>
                      <th rowspan="2" style="vertical-align:middle;">Nama Pemesan</th>
                      <th rowspan="2" style="vertical-align:middle;">Nama Purchasing</th>
                      <th rowspan="2" style="vertical-align:middle;">Tgl. Pemesanan</th>
                      <th rowspan="2" style="vertical-align:middle;">Tgl Estimasi</th>
                      <th rowspan="2" style="vertical-align:middle;">Status Order</th>
                      <th colspan="5" style="vertical-align:middle;"><center>Approved</center></th>
                      <th rowspan="2" style="vertical-align:middle;">Aksi</th>
                    </tr>
                    <tr>
                      <th>DK</th>
                      <th>EG</th>
                      <th>FR</th>
                      <th>EL</th>
                      <th>NI</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditTglEstimasi">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalEditTglEstimasi">&times;</button>
            <h4 class="modal-title text-blue">Ubah Tanggal Estimasi</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tanggal Estimasi</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTglEstimasi" class="form-control" readonly>
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnEditTanggal" class="btn btn-md btn-flat btn-warning">Ubah Tangggal</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalChangePassword" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalChangePassword">&times;</button>
            <h4 class="text-blue">Ganti Password</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Kata Sandi Lama</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning" style="float:left; width:90%;">
                        <input type="password" id="txtOldPass" class="form-control" placeholder="Masukan Kata Sandi Lama Anda" onkeyup="verifikasiPassowordLama(this);">
                      </div>
                      <div class="form-group has-success" style="float:left; display:none;" id="indikatorPasswordLama">
                        <label class="control-label">
                          <i class="fa fa-check" style="margin:10px 0 0 10px" id="iconIndikatorPasswordLama"></i>
                        </label>

                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td width="20%">Kata Sandi Baru</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="password" id="txtNewPass" class="form-control" placeholder="Masukan Kata Sandi Baru Anda" style="width:90%; float:left;">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td width="20%">Konfirmasi Kata Sandi Baru</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning" style="float:left; width:90%;">
                        <input type="password" id="txtConfirmPass" class="form-control" placeholder="Masukan Kembali Kata Sandi Baru Anda" onkeyup="konfirmasiPassword(this);">
                      </div>
                      <div class="form-group has-success" style="float:left; display:none;" id="indikatorKonfirmasiPassword">
                        <label class="control-label">
                          <i class="fa fa-check" style="margin:10px 0 0 10px" id="iconIndikatorKonfirmasiPassword"></i>
                        </label>

                      </div>
                    </td>
                  </tr>
                </table>
                <div class="alert alert-danger" id="alertChangePass" style="display:none;">
                  <center>
                    <label id="lblTextAlert"></label>
                  </center>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnChangePassword" class="btn btn-md btn-default btn-flat" onclick="changePassword();">
              <i class="fa fa-cogs"></i> Ubah Password
            </button>
          </div>
        </div>
      </div>
    </div>
