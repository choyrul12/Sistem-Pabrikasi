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
        <button type="button" class="btn btn-md btn-flat btn-primary btn-block" data-toggle="modal" data-target="#modalCariRencanaKerjaMandor" data-backdrop="static"><i class="fa fa-search"></i> Cari Rencana Kerja Mandor</button>
      </div>
      <div class="modal fade" id="modalCariRencanaKerjaMandor" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariRencanaKerjaMandor">&times;</button>
              <h4 class="modal-title text-blue">Cari Data Rencana Kerja Mandor (Selesai)</h4>
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
                            <input type="text" id="txtTanggalAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
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
                            <input type="text" id="txtTanggalAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
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
              <button type="button" id="btnCariHistoryRencanaKerja" class="btn btn-md btn-flat btn-success" onclick="searchRencacanaKerjaMandorExtruderSelesai();"><i class="fa fa-search"></i> Cari Rencana Kerja</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="rowListRencanaKerjaMandorExtruder" style="display:none; margin-top:10px;">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title text-blue">List Rencana Kerja Mandor <label id="lblTglAwal"></label> Sampai <label id="lblTglAkhir"></label></h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-responsive table-striped table-bordered" id="tableListRencanaExtruderSelesai">
                    <thead>
                      <th>Tgl. Rencana</th>
                      <th>No. Mesin</th>
                      <th>Order</th>
                      <th>Merek</th>
                      <th>Ket. Merek</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Tebal</th>
                      <th>Berat</th>
                      <th>Strip</th>
                      <th>Jumlah</th>
                      <th>Sisa</th>
                      <th>Status</th>
                      <th>Keteterangan</th>
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
