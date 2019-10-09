<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
  </section>
  <section class="content">
    <div class="box box-success">
      <div class="box-header">

      </div>
      <div class="box-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li><a href="#stok-sablon" data-toggle="tab">Stok Barang Sablon</a></li>
            <li><a href="#stok-kantong" data-toggle="tab">Stok Barang Kantong</a></li>
            <li><a href="#stok-campur" data-toggle="tab">Stok Barang Campur</a></li>
            <li class="active"><a href="#stok-standar" data-toggle="tab">Stok Barang Standar</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i> Cek Stok Barang Jadi</li>
          </ul>
          <div class="tab-content no-padding">
            <div class="tab-pane active" id="stok-standar">
              <div class="box box-danger">
                <div class="box-header">
                  <button class="btn btn-flat btn-md btn-primary" onclick="modalCariHistoryHasil('STANDARD')" data-toggle="modal" data-target="#modal-check-hasil">
                    <span class="fa fa-search"></span>&nbsp;
                    Detail Histori Keluar Masuk Barang (Standar)
                  </button>
                </div>
                <div class="box-body">
                  <table class="table table-responsive table-striped" id="table-stok-standar">
                    <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align:middle;">Kode Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                        <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                        <th colspan="2"><center>Stok</center></th>
                        <th rowspan="2" style="vertical-align:middle;">Warna</th>
                        <th rowspan="2" style="vertical-align:middle;">Merek</th>
                        <th rowspan="2" style="vertical-align:middle;">Jenis Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Gudang</th>
                      </tr>
                      <tr>
                        <th><center>Berat</center></th>
                        <th><center>Lembar</center></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="stok-campur">
              <div class="box box-info">
                <div class="box-header">
                  <button class="btn btn-flat btn-md btn-primary" onclick="modalCariHistoryHasil('CAMPUR')" data-toggle="modal" data-target="#modal-check-hasil">
                    <span class="fa fa-search"></span>&nbsp;
                    Detail Histori Keluar Masuk Barang (Campur)
                  </button>
                </div>
                <div class="box-body">
                  <table class="table table-responsive table-striped" id="table-stok-campur">
                    <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align:middle;">Kode Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                        <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                        <th colspan="2"><center>Stok</center></th>
                        <th rowspan="2" style="vertical-align:middle;">Warna</th>
                        <th rowspan="2" style="vertical-align:middle;">Merek</th>
                        <th rowspan="2" style="vertical-align:middle;">Jenis Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Gudang</th>
                      </tr>
                      <tr>
                        <th><center>Berat</center></th>
                        <th><center>Lembar</center></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="stok-kantong">
              <div class="box box-warning">
                <div class="box-header">
                  <button class="btn btn-flat btn-md btn-primary" onclick="modalCariHistoryHasil('KANTONG')" data-toggle="modal" data-target="#modal-check-hasil">
                    <span class="fa fa-search"></span>&nbsp;
                    Detail Histori Keluar Masuk Barang (Kantong)
                  </button>
                </div>
                <div class="box-body">
                  <table class="table table-responsive table-striped" id="table-stok-kantong">
                    <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align:middle;">Kode Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                        <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                        <th colspan="2"><center>Stok</center></th>
                        <th rowspan="2" style="vertical-align:middle;">Warna</th>
                        <th rowspan="2" style="vertical-align:middle;">Merek</th>
                        <th rowspan="2" style="vertical-align:middle;">Jenis Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Gudang</th>
                      </tr>
                      <tr>
                        <th><center>Berat</center></th>
                        <th><center>Lembar</center></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="stok-sablon">
              <div class="box box-primary">
                <div class="box-header">
                  <button class="btn btn-flat btn-md btn-primary" onclick="modalCariHistoryHasil('SABLON')" data-toggle="modal" data-target="#modal-check-hasil">
                    <span class="fa fa-search"></span>&nbsp;
                    Detail Histori Keluar Masuk Barang (Sablon)
                  </button>
                </div>
                <div class="box-body">
                  <table class="table table-responsive table-striped" id="table-stok-sablon">
                    <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align:middle;">Kode Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                        <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                        <th colspan="2"><center>Stok</center></th>
                        <th rowspan="2" style="vertical-align:middle;">Warna</th>
                        <th rowspan="2" style="vertical-align:middle;">Merek</th>
                        <th rowspan="2" style="vertical-align:middle;">Jenis Barang</th>
                        <th rowspan="2" style="vertical-align:middle;">Gudang</th>
                      </tr>
                      <tr>
                        <th><center>Berat</center></th>
                        <th><center>Lembar</center></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-check-hasil" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal" data-target="#modal-check-hasil">&times;</button>
            <div class="modal-title">
              <h3 class="text-primary">Pilih Periode History</h3>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <div class="input-group date">
                    <input class="form-control" type="text" id="txt_tgl_awal" required readonly placeholder="Tanggal Awal">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-group date">
                    <input class="form-control" type="text" id="txt_tgl_akhir" required readonly placeholder="Tanggal Akhir">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>

                <div class="col-md-12" style="margin-top : 10px;">
                  <select class="form-control" id="cmb-barang-hasil" required></select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-flat btn-md btn-success" id="btn-check-hasil">Cari History</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
