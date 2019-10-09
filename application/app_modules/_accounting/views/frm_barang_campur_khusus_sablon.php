<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?> <span id="title_kuantitas"></span></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <button type="button" class="btn btn-md btn-flat btn-primary margin" data-toggle="modal" data-target="#modalCariHistoryBarangSablon" data-backdrop="static"><i class="fa fa-search"></i> Cari History</button>
          </div>
          <div class="box-body" style="display: none;">
            <div class="col-md-3">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-bookmark-o"></i> &nbsp;Saldo Awal</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                  <b>Berat</b> <a class="pull-right"><b><span id="dataAwalBerat"></span></b></a></br>
                  <b>Lembar</b> <a class="pull-right"><b><span id="dataAwalLembar"></span></b></a>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-3">
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-exchange"></i> &nbsp;Total Masuk</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                  <b>Berat</b> <a class="pull-right"><b><span id="totalBeratMasuk"></span></b></a></br>
                  <b>Lembar</b> <a class="pull-right"><b><span id="totalLembarMasuk"></span></b></a>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-3">
              <div class="box box-danger box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-exchange"></i> &nbsp;Total Keluar</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                  <b>Berat</b> <a class="pull-right"><b><span id="totalBeratKeluar"></span></b></a></br>
                  <b>Lembar</b> <a class="pull-right"><b><span id="totalLembarKeluar"></span></b></a>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-3">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-bookmark-o"></i> &nbsp;Saldo Akhir</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                  <b>Berat</b> <a class="pull-right"><b><span id="saldoBeratAkhir"></span></b></a></br>
                  <b>Lembar</b> <a class="pull-right"><b><span id="saldoLembarAkhir"></span></b></a>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <h3 class="box-title text-center">Detail Barang Masuk Sablon</h3>
                <table class="table table-responsive table-striped" id="tableDataBarangSablonMasuk">
                  <thead>
                    <th style="width: 15px;">No</th>
                    <th>Tanggal</th>
                    <th>Berat</th>
                    <th>Lembar</th>
                    <th>Keterangan</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <h3 class="box-title text-center">Detail Barang Keluar Sablon</h3>
                <table class="table table-responsive table-striped" id="tableDataBarangSablonKeluar">
                  <thead>
                    <th style="width: 15px;">No</th>
                    <th>Tanggal</th>
                    <th>Berat</th>
                    <th>Lembar</th>
                    <th>Keterangan</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalCariHistoryBarangSablon" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistory">&times;</button>
            <h4 class="modal-title text-blue">Cari History</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tanggal Awal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group">
                        <div class="input-group date">
                          <input type="text" id="txtTglAwal" class="form-control" placeholder="Pilih Tanggal Awal">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal Akhir</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <div class="input-group date">
                          <input type="text" id="txtTglAkhir" class="form-control" placeholder="Pilih Tanggal Akhir">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Ukuran</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <select class="form-control" id="listBarangSablon">
                          <option>Pilih Ukuran</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryBarangSablon()"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
