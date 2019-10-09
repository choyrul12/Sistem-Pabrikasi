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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalSearchLaporanRencanaPPIC" data-backdrop="static"><i class="fa fa-search"></i> Cari Laporan Rencana PPIC</button>
            </div>
            <div class="col-md-12" style="margin-top:10px;">
              <div class="col-md-6" style="display: none;" id="alertKirimanBalikGudangHasil">
                <a href="#" style="text-decoration : none;" onclick="modalKirimanBalik()">
                  <div class="alert alert-info">
                    <h4>Ada Kiriman Balik Dari Gudang Hasil.</h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="laporanRencanaPPIC" style="display:none;">
                    <table class="table table-responsibe table-striped" id="tableLaporanRencanaPPIC">
                      <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Merek</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Jumlah Mesin</th>
                        <th>Tebal</th>
                        <th>Berat</th>
                        <th>Jumlah Permintaan</th>
                        <th>Sisa</th>
                        <th>Strip</th>
                        <th>Keterangan</th>
                        <th>No. Mesin</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modalSearchLaporanRencanaPPIC" role="dialog" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" data-target="#modalSearchLaporanRencanaPPIC">&times;</button>
                  <h4 class="modal-title text-blue">Cari Laporan Rencana PPIC</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-responsive">
                        <tr>
                          <td>Tanggal</td>
                          <td>:</td>
                          <td>
                            <div class="form-group has-warning">
                              <div class="input-group date">
                                <input type="text" id="txtTanggalCari" class="form-control" placeholder="Masukan Tanggal" readonly>
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
                  <button type="button" class="btn btn-md btn-flat btn-success" onclick="searchLaporanRencanaPpic();"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
