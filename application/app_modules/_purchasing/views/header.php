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
      option:checked, option:hover {
          color: white;
          background: #488f8f;
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
            <!-- <li class="notifications-menu">
              <a href="#" data-toggle="modal" data-target="#modalTrashGudangBahan" onclick="modalTrashPurchasing()">
                <i class="fa fa-trash"></i>
                <span class="label label-danger" id="numTrashPurchasing"></span>
                <div class="label label-warning" id="count-trash"></div>
              </a>
            </li> -->
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
                    <h3 class="box-title">Bahan Baku</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashBahanBaku">
                        <thead>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Warna</th>
                          <th>Stok</th>
                          <th style="text-align: center;">Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-danger collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Biji Warna</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashBijiWarna">
                        <thead>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Warna</th>
                          <th>Stok</th>
                          <th style="text-align: center;">Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-primary collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Minyak</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashMinyak">
                        <thead>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Stok</th>
                          <th style="text-align: center;">Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-success collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Cat Murni</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashCatMurni">
                        <thead>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Warna</th>
                          <th>Stok</th>
                          <th style="text-align: center;">Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-warning collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Cat Campur</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashCatCampur">
                        <thead>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Warna</th>
                          <th>Stok</th>
                          <th style="text-align: center;">Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-warning collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Apal</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-responsive table-striped" id="tableTrashApal">
                        <thead>
                          <th>No</th>
                          <th>Jenis</th>
                          <th>Warna</th>
                          <th>Stok</th>
                          <th style="text-align: center;">Action</th>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="box box-warning collapsed-box">
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
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Ukuran</th>
                          <th>Stok Awal</th>
                          <th>Stok Sekarang</th>
                          <th style="text-align: center;">Action</th>
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
    <section>
      <div id="modal_editStokBahan" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">Form Edit Stok Bahan</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Bahan :</label>
                <input type="hidden" name="kdBahan" id="kdBahan" value="">
                <input type="text" class="form-control" name="nama_bahan" id="nama_bahan" placeholder="Nama Bahan">
              </div>
              <div class="form-group" id="kolom_warna">
                <label>Warna :</label>
                <input type="text" class="form-control" name="warna_bahan" id="warna_bahan" placeholder="Warna Bahan">
              </div>
              <div class="form-group">
                <label>Stok :</label>
                <input type="number" class="form-control" name="stok_bahan" id="stok_bahan" placeholder="Stok Bahan">
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="updateStokBahan()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Update</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_daftarPermintaanBarang" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 905px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Permintaan <span id='title_header'></span></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableListPermintaanBarang">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th>Tanggal</th>
                    <th>Bagian</th>
                    <th>Nama Bahan</th>
                    <th id='th_warna'>Warna</th>
                    <th>Jumlah</th>
                    <th colspan="2" style="text-align: center; width: 30px">Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <div class="form-group col-md-12" style="text-align:center; position: absolute; bottom: 5px;">
                  <button class="btn btn-flat bg-navy" style="width:30%;" id="approve_permintaan">APPROVE</button>
                </div>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_daftarPermintaanSparePart" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 905px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Permintaan <span id='title_header'></span></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableListPermintaanSparePart">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th>Tanggal</th>
                    <th>Nama Spare Part</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th colspan="2" style="text-align: center; width: 30px">Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <div class="form-group col-md-12" style="text-align:center; position: absolute; bottom: 5px;">
                  <button class="btn btn-flat bg-navy" style="width:30%;" onclick="approve_permintaan_sp()">APPROVE</button>
                </div>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_daftarRencanaPembeliBarang" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 905px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Rencana Pembelian <span id="title_header_rencana"></span> </h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableListRencanaPembelianBarang">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>Nama Bahan</th>
                    <th id="th_warna1">Warna</th>
                    <th>Jumlah</th>
                    <th colspan="2" style="text-align: center; width: 30px">Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_inputHasilPembelianBarang" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-shopping-cart">&nbsp;&nbsp;Input Hasil Pembelian Bahan</i></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group col-md-6">
                <label>Tanggal Permintaan :</label>
                <input type="hidden" name="id" id="id">
                <input type="text" class="form-control" name="tgl_permintaan" id="tgl_permintaan" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Customer :</label>
                <input type="text" class="form-control" name="customer" id="customer" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Nama Barang :</label>
                <input type="text" class="form-control" name="nm_barang" id="nm_barang" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Jumlah Permintaan :</label>
                <input type="text" class="form-control" name="jum_permintaan" id="jum_permintaan" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Jumlah Pembelian :</label>
                <input type="number" class="form-control" name="jum_pembelian" id="jum_pembelian" placeholder="Jumlah Pembelian">
              </div>
              <div class="form-group col-md-6">
              <label>Tanggal Pembelian</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_pembelian" id="tgl_pembelian" placeholder="Tanggal Pembelian">
                </div>
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="kirimHasilPembelianBahan()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 45%;"><b>Kirim Ke Gudang</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_addBahan" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">Form Tambah <span id="title_addBahan"></span></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group col-md-6">
                <label>Kode Bahan :</label>
                <input type="text" class="form-control" name="kd_gd_bahan" id="kd_gd_bahan" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>ID Acurate :</label>
                <input type="text" class="form-control" name="kd_accurate" id="kd_accurate" placeholder="ID Acurate *">
              </div>
              <div class="form-group col-md-6">
                <label>Nama Barang :</label>
                <input type="text" class="form-control" name="nmBarang" id="nmBarang" placeholder="Nama Barang *">
              </div>
              <div class="form-group col-md-6" id="addWarna">
                <label>Warna :</label>
                <input type="text" class="form-control" name="warna" id="warna" placeholder="Warna">
              </div>
              <div class="form-group col-md-6">
                <label>Stok :</label>
                <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok *">
              </div>
              <div class="form-group col-md-6">
                <label>Satuan :</label>
                <select class="form-control" id="satuan" name="satuan">
                  <option value="" selected="selected">Pilih Satuan *</option>
                  <option value="KG">Kg</option>
                  <option value="LEMBAR">Lembar</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Status :</label>
                <select class="form-control" name="status" id="status">
                  <option selected="" value="">Pilih Status *</option>
                  <option value="LOKAL">Lokal</option>
                  <option value="EXPORT">Export</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Tanggal :</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tanggal *">
                </div>
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" id='add' class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 51%;"><b>Simpan</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_historyBahanBaku" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 1000px; margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;History <span id="title_header_history"></span></h3>
              <h4 class="modal-title" style="text-align: center; color: black;"><span id="tgl_history"></span></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableHistoryBahanBaku">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th style="width: 50px">Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="col-xs-4">
                  <table class="table">
                    <tbody><tr>
                      <th style="width:50%">Total Masuk:</th>
                      <td style="text-align: right;"><span id="total_masuk"></span></td>
                    </tr>
                    <tr>
                      <th>Total Keluar:</th>
                      <td style="text-align: right;"><span id="total_keluar"></span></td>
                    </tr>
                   <!--  <tr>
                      <th>Saldo:</th>
                      <td style="text-align: right;"><span id="saldo"></span></td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
  </section>
