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
          <button type="button" class="btn btn-md btn-flat btn-primary btn-block" data-toggle="modal" data-target="#modalCariHasilExtruder" data-backdrop="static"><i class="fa fa-search"></i> Cari Hasil</button>
        </div>

        <div class="modal fade" id="modalCariHasilExtruder" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHasilExtruder">&times;</button>
                <h4 class="modal-title text-blue">Cari Hasil Extruder</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td>Shift</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbPilihShift">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Mesin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbPilihMesin">
                              <option value="LOKAL">LOKAL</option>
                              <option value="EXPORT">EXPORT</option>
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
                              <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal" readonly>
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
                <button type="button" id="btnCariHasilExtruder" class="btn btn-md btn-flat btn-success" onclick="searchHasilExtruder();"><i class="fa fa-search"></i> Cari</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row" id="rowHasilExtruder" style="display:none; margin-top:10px;">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title text-primary">Laporan Hasil Extruder</h3>
              <div class="box-tools pull-right">
                <label id="lblTanggal"></label>
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tableHasilExtruder">
                  <thead>
                    <th>Tebal</th>
                    <th>Biji Warna</th>
                    <th>Ukuran</th>
                    <th>Berat Hasil</th>
                    <th>Roll</th>
                    <th>Berat Roll</th>
                    <th>Jenis Roll</th>
                    <th>Shift</th>
                    <th>Merek</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>

              <div class="col-md-6">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h4 class="modal-title text-blue">Biji Warna</h4>
                  </div>
                  <div class="box-body">
                    <table class="table table-responsive" id="tableBijiWarna">
                      <tr>
                        <td width="30%">Penggunaan Strip</td>
                        <td width="1%">:</td>
                        <td id="tdPenggunaanStrip">0</td>
                      </tr>
                      <tr>
                        <td>Penambahan Biji</td>
                        <td>:</td>
                        <td id="tdPenambahanBiji">0</td>
                      </tr>
                      <tr>
                        <td>Pengurangan Biji</td>
                        <td>:</td>
                        <td id="tdPenguranganBiji">0</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h4 class="modal-title text-blue" id="h4Tanggal">Hasil Global <?php echo date("d F Y"); ?></h4>
                  </div>
                  <div class="box-body">
                    <table class="table table-responsive">
                      <tr>
                        <td width="35%">Sisa Bahan Sebelumnya</td>
                        <td width="1%">:</td>
                        <td id="tdSisaShiftSebelumnya">0</td>
                      </tr>
                      <tr>
                        <td>Pemakaian Bahan</td>
                        <td>:</td>
                        <td id="tdTotal">0</td>
                      </tr>
                      <tr>
                        <td>Total Bahan Hari Ini</td>
                        <td>:</td>
                        <td id="tdSisa">0</td>
                      </tr>
                      <tr>
                        <td>Berat Hasil Jadi</td>
                        <td>:</td>
                        <td id="tdBerat">0</td>
                      </tr>
                      <tr>
                        <td>Apal</td>
                        <td>:</td>
                        <td id="tdApal">0</td>
                      </tr>
                      <tr>
                        <td>Jumlah Biji Warna</td>
                        <td>:</td>
                        <td id="tdJumlahBijiWarna">0</td>
                      </tr>
                      <tr>
                        <td>Roll</td>
                        <td>:</td>
                        <td id="tdRoll">0</td>
                      </tr>
                      <tr>
                        <td>Plus/Minus</td>
                        <td>:</td>
                        <td id="tdPlusMinus">0</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <a href="#" id="btnPrintHasilExtruder" class="btn btn-md btn-flat btn-primary" target="_blank"><i class="fa fa-print"></i> Cetak Laporan</a>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
