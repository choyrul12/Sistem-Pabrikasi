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
              <h4 class="box-title text-blue">Detail Gudang Standard</h4>
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
                  <table class="table table-responsive table-striped" id="tableBarangSTANDARD">
                    <thead>
                      <th width="10%">Kode Barang</th>
                      <th width="5%">Customer</th>
                      <th width="8%">Merek</th>
                      <th width="5%">Ukuran</th>
                      <th width="5%">Warna</th>
                      <th width="10%">Tanggal</th>
                      <th>Berat</th>
                      <th>Lembar</th>
                      <th>Diperbarui</th>
                      <th>User</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <a href="#" id="btnPrintLaporan" class="btn btn-md btn-flat btn-success"><i class="fa fa-download"></i> Export To Excel</a>
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
              <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryBarangHasil('STANDARD')"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
