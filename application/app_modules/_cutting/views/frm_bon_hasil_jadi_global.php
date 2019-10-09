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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariBonHasilGlobal" data-backdrop="static"><i class="fa fa-search"></i> Cari Bon Jadi Global</button>
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
            <div class="box-body" id="boxBody" style="display:none;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListBonHasilJadiGlobal">
                    <thead>
                      <th>Tebal</th>
                      <th>Ukuran</th>
                      <th>Merek</th>
                      <th>Warna</th>
                      <th>Jumlah Berat</th>
                      <th>Jumlah Lembar</th>
                      <th>Gudang</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <div class="col-md-4">
                    <center>
                      <label>Mandor Potong (Pembuat)</label>
                      <p style="margin-top:100px;">
                        (&nbsp;<u>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </u>&nbsp;)
                      </p>
                    </center>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <center>
                      <label>Gudang (Penerima)</label>
                      <p style="margin-top:100px;">
                        (&nbsp;<u>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </u>&nbsp;)
                      </p>
                    </center>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer" id="boxFooter" style="display:none;">
              <button type="button" id="btnKirimBonHasilJadiGlobal" class="btn btn-md btn-flat btn-primary"><i class="fa fa-send"></i> Kirim</button>
              <a href="#" target="_blank" id="btnPrintBonHasilJadiGlobal" class="btn btn-md btn-flat btn-success"><i class="fa fa-print"></i> Cetak</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariBonHasilGlobal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariBonHasilGlobal">&times;</button>
              <h4 class="modal-title text-blue">Cari Bon Hasil Jadi Global</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Jenis Gudang</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbJenisGudang">
                            <option value="">--Pilih Jenis Gudang--</option>
                            <option value="CAMPUR_STANDARD">Campur & Standard</option>
                            <option value="KANTONG">Kantong</option>
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
                            <input type="text" id="txtTanggal" class="form-control" placeholder="Masukan Tanggal" readonly>
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
              <button type="button" id="btnCariBonHasilJadiGlobal" class="btn btn-md btn-flat btn-success" onclick="searchListBonHasilJadiGlobal();"><i class="fa fa-search"></i> Cari Bon Hasil Global</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
