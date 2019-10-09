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
          <button type="button" class="btn btn-md btn-flat btn-block btn-primary" data-toggle="modal" data-target="#modalHasilGlobalExtruder"><span class="fa fa-search"></span> Cari Hasil Global Extruder</button>
        </div>
        <div class="col-md-12" style="margin-top:10px">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title text-blue">Laporan Hasil Global Extruder</h3>
              <span class="help-block pull-right" id="spanPeriode"></span>
            </div>
            <div class="box-body">
              <table class="table table-responsive table-striped" id="tableHasilExtruderGlobal">
                <thead>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Total Berat</th>
                  <th>Apal</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="box-footer">
              <a href="#" id="btnPrintLaporan" class="btn btn-md btn-flat btn-success pull-right">Print Out</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalHasilGlobalExtruder" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalHasilGlobalExtruder">&times;</button>
              <h4 class="modal-title text-purple">Cari Hasil Global Extruder</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalAwal" class="form-control" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="20%">Tanggal Akhir</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalAkhir" class="form-control" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="20%">Jenis Barang</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenis">
                        <option value="LOKAL">LOKAL</option>
                        <option value="EXPORT">EXPORT</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-primary pull-right" onclick="getLaporanHasilExtruderGlobal()">Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
