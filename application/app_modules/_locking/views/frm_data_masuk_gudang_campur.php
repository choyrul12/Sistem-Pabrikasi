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
            <div class="box-title">
              <h4 class="text-primary">Detail Gudang Campur</h4>
            </div>
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariData" data-backdrop="static"><i class="fa fa-search"></i> Cari Data</button>
          </div>
          <div class="box-body">
            <div class="row" id="row" style="display:none;">
              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tableData">
                  <thead>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Merek</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Tanggal</th>
                    <th>Berat</th>
                    <th>Lembar</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer" id="footer" style="display:none;">
            <button type="button" class="btn btn-md btn-flat btn-danger" id="btnLock"><i class="fa fa-lock"></i> Kunci</button>
            <button type="button" class="btn btn-md btn-flat btn-success" id="btnExport"><i class="fa fa-file-excel-o"></i> Export Excel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCariData" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariData">&times;</button>
            <h4 class="modal-title text-blue">Cari Data</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
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
                        <input type="text" id="txtTglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-md btn-flat btn-success" onclick="searchDataGudangHasil('CAMPUR')">Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
