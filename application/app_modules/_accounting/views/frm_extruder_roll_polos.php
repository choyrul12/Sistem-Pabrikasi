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
              <h3 class="box-title text-blue">Hasil Extruder</h3>
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariHistory" data-backdrop="static"><i class="fa fa-search"></i> Cari History</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4 pull-right">
                    <table class="table">
                      <tr>
                        <td>Search : </td>
                        <td>
                          <div class="form-group">
                            <div class="input-group date">
                              <input type="text" id="txtSearch" class="form-control" placeholder="Cari Tanggal...">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <table class="table table-responsive table-striped table-bordered" id="tableHasilExtruder">
                    <thead>
                      <th>Kode Barang</th>
                      <th>Merek</th>
                      <th>Panjang</th>
                      <th>Warna</th>
                      <th>Tanggal</th>
                      <th>Hasil</th>
                      <th>Jumlah Roll</th>
                      <th>Jenis Roll</th>
                      <th>Shift</th>
                      <th width="200px">Last Update</th>
                      <th>User</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <a href="#" id="btnPrintLaporanHasilExtruder" class="btn btn-md btn-flat btn-success"><i class="fa fa-download"></i> Export To Excel</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistory" role="dialog" tabindex="-1">
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
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
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
                            <input type="text" id="txtTglAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
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
              <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryExtruderKeRollPolos();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
