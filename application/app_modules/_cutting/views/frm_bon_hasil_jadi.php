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
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariBonHasil"><i class="fa fa-search"></i> Cari Bon Hasil Jadi</button>
        </div>
        <div class="col-md-12" style="margin-top:10px;">
          <div class="box box-primary" id="boxBonHasilJadi" style="display:none;">
            <div class="box-header with-border">
              <h3 class="box-title text-blue">Hasil Mandor Potong</h3>
              <small class="text-muted pull-right">Tanggal : <?php echo date("d F Y"); ?></small>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListBonHasilJadi">
                    <thead>
                      <th>Merek</th>
                      <th>Tebal</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Berat</th>
                      <th>Lembar</th>
                      <th>Gudang</th>
                      <th>Keterangan</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <a href="#" target="_blank" id="btnCetakBonHasilCutting" class="btn btn-md btn-flat btn-success"><i class="fa fa-print"></i> Cetak Bon</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariBonHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariBonHasil">&times;</button>
              <h4 class="modal-title text-blue">Cari Bon Hasil Cutting</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <tr>
                    <td width="20%">Jenis Gudang</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbJenisGudang">
                          <option value="">--Pilih Jenis Gudang--</option>
                          <option value="CAMPUR">Campur</option>
                          <option value="STANDARD">Standard</option>
                          <option value="KANTONG">Kantong</option>
                          <option value="EXPORT">Export</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbMerek">
                          <option value="">--Pilih Merek--</option>
                          <option value="Zippin">Zippin</option>
                          <option value="Klip">Klip</option>
                          <option value="Klip In">Klip In</option>
                          <option value="KP">KP</option>
                          <option value="Kantong">Kantong</option>
                          <option value="CB">CB</option>
                          <option value="MP">MP</option>
                          <option value="PON">PON</option>
                          <option value="Cetak">Cetak</option>
                          <!-- <option value="Export">Export</option> -->
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
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariBonHasilJadi" class="btn btn-md btn-flat btn-success" onclick="searchListBonHasilJadi();"><i class="fa fa-search"></i> Cari Hasil Bon</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
