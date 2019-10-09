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
      <div class="col-md-4">
        <button type="button" class="btn btn-md btn-flat btn-primary btn-block" data-toggle="modal" data-target="#modalCariKirimanHasil" data-backdrop="static"><i class="fa fa-search"></i> Cari</button>
      </div>

      <div class="modal fade" id="modalCariKirimanHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariKirimanHasil">&times;</button>
              <h4 class="modal-title text-blue">Cari Kiriman Hasil Extruder</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td>Shift</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbPilihShift">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbPilihJenis">
                            <option value="LOKAL">LOKAL</option>
                            <option value="EXPORT">EXPORT</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariKirimanHasilExtruder" class="btn btn-md btn-flat btn-success" onclick="searchKirimanHasilExtruder();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="rowLaporanHasilExtruder" style="display:none; margin-top:10px;">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title text-blue">Laporan Hasil Extruder</h3>
            <div class="box-tools pull-right">
              <label id="lblTanggal"></label>
            </div>
          </div>
          <div class="box-body">
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tabelKirimHasilExtruder">
                <thead>
                  <th>Tanggal</th>
                  <th>Total</th>
                  <th>Apal</th>
                  <th>Shift</th>
                  <th>Jenis Barang</th>
                  <th>Status Pengiriman PPIC</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="col-md-2 pull-right">
              <button type="button" id="btnKirimHasilExtruder" class="btn btn-md btn-flat btn-success btn-block" onclick="saveKirimHasilKePpic();"><i class="fa fa-send"></i> Kirim</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
