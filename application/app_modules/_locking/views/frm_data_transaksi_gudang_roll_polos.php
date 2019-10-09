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
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title text-blue">Detail Transaksi Gudang Roll Polos</h4>
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariData" data-backdrop="static"><i class="fa fa-search"></i> Cari Data</button>
            </div>
            <div class="box-body">
              <div class="row" id="row" style="display:none;">
                <div class="col-md-12">
                  <fieldset>
                    <legend>DETAIL KELUAR DAN MASUK STOK DARI POTONG</legend>
                      <table class="table table-responsive table-striped" id="tableDataTransaksiGudangRollPolos">
                        <thead>
                          <th>Ukuran</th>
                          <th>Tanggal</th>
                          <th>Berat</th>
                          <th>Bobin</th>
                          <th>Payung</th>
                          <th>Payung Kuning</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <legend>HASIL EXTRUDER</legend>
                      <table class="table table-responsive table-striped" id="tableDataTransaksiHasilExtruder">
                        <thead>
                          <th>Ukuran</th>
                          <th>Tanggal</th>
                          <th>Berat</th>
                          <th>Bobin</th>
                          <th>Payung</th>
                          <th>Payung Kuning</th>
                          <th>Shift</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="box-footer" id="footer" style="display:none;">
              <button type="button" id="btnLock" class="btn btn-md btn-flat btn-danger"><i class="fa fa-lock"></i> Kunci</button>
              <a href="#" id="btnExport" class="btn btn-md btn-flat btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariData" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariData">&times;</button>
              <h4 class="modal-title text-primary">Cari Data Transaksi</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped">
                    <tr>
                      <td width="20%">Tanggal Awal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
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
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
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
              <button type="button" id="btnCari" class="btn btn-md btn-flat btn-success" onclick="searchListGudangRollPolos()"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
