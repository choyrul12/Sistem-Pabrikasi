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
	</head>

	<body class="hold-transition skin-purple sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
	      <a href="<?php echo base_url(); ?>_cabang/main" class="logo">
	        <span class="logo-mini"><img class="user-image" src="<?php echo base_url(); ?>assets/images/logo_plastik_white.png" width="45px" height="45px"></span>
	        <span class="logo-lg"><b><?php echo strtoupper($this->session->userdata("fabricationGroup")); ?></b> LTE</span>
	      </a>
	      <nav class="navbar navbar-static-top">
	        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	          <span class="sr-only">Toggle navigation</span>
	        </a>
	        <div class="navbar-custom-menu">
	          <ul class="nav navbar-nav">
							<?php
								if($this->session->userdata("fabricationStatus") == 1){
							?>
	            <li class="notifications-menu">
	              <a href="#" data-toggle="modal" data-target="#modal-trash" onclick="dataTableDetailOrderTrash();">
	                <i class="fa fa-trash"></i>
	                <div class="label label-warning" id="count-trash"></div>
	              </a>
	            </li>
							<?php } ?>
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
			<div class="modal fade" id="modal-trash">
				<div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
			      <div class="modal-header">
			        <button type="button" name="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="text-danger"><b>Tempat Sampah</b></h4>
			      </div>
			      <div class="modal-body" style="height:83%; overflow-y:scroll;">
							<table class="table table-responsive table-striped" id="tableTrash">
                <thead>
                  <tr>
										<th rowspan="2" style="vertical-align:middle;">No.Order</th>
                    <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                    <th rowspan="2" style="vertical-align:middle;">Jenis/Merek</th>
                    <th colspan="2"><center>Warna</center></th>
                    <th colspan="1"><center>Atas Klip</center></th>
                    <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                    <th rowspan="2" style="vertical-align:middle;">Jumlah</th>
                    <th rowspan="2" style="vertical-align:middle;">Keterangan</th>
                    <th rowspan="2" style="vertical-align:middle;">Status</th>
										<th rowspan="2" style="vertical-align:middle;">Action</th>
                  </tr>
                  <tr>
                    <th><center>Plastik</center></th>
                    <th><center>Cetak</center></th>
                    <th><center>Los/Strip</center></th>
                  </tr>
                </thead>
              </table>
			      </div>
			    </div>
			  </div>
			</div>
