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
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariLaporanBahanBaku"><i class="fa fa-search"></i> Cari Laporan Bahan Baku</button>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive table-striped" style="display:none;">
                  <thead>
                    <th>No.</th>
                    <th>Jumlah Permintaan</th>
                    <th>Status</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCariLaporanBahanBaku" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariLaporanBahanBaku">&times;</button>
            <h4 class="modal-title text-primary">Cari Laporan Bahan Baku</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tangggal" readonly>
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
            <button type="button" id="btnCariLaporanBahanBaku" class="btn btn-md btn-flat btn-success"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
