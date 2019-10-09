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
            <div class="box-header with-berder">
              <button type="button" class="btn btn-md btn-flat btn-primary margin" data-toggle="modal" data-target="#modalCariHistory" data-backdrop="static"><i class="fa fa-search"></i> Cari History Order Luar Kota</button>
            </div>
            <div class="box-body">
              <div id="dataWrapper" style="display:none;">
                <h4 class="text-blue" id="h4Judul"></h4>
                <table class="table table-responsive table-striped" id="tableListHistoryOrderLuarKota">
                  <thead>
                    <th width="15px">No.</th>
                    <th>Tanggal Pesan</th>
                    <th>Nama Pemesan</th>
                    <th>Status</th>
                    <th style="text-align: center;">Action</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalCariHistory" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistory">&times;</button>
                <h4 class="modal-title text-blue">Cari History Order Luar Kota</h4>
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
                        <td>Tanggal Awal</td>
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
                <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryOrderLuarKota();"><i class="fa fa-search"></i> Cari</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalDetailPesanan" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:1110px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailPesanan">&times;</button>
                <h4 class="modal-title text-blue">Detail Pesanan</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableListDetailPesanan">
                      <thead>
                        <th>Ukuran</th>
                        <th>Jenis / Merek</th>
                        <th>Plastik</th>
                        <th>Cetak</th>
                        <th>Los / Strip</th>
                        <th>Tebal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
</div>
