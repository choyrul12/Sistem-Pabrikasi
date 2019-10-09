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
    <div class="container">
      <div class="row" id="fileInputHasil">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title text-blue">Input Hasil Extruder</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" id="txtKdGdRoll" value="">
                <input type="hidden" id="txtJumlahPermintaan" value="">
                <input type="hidden" id="txtKetMerekHasil" value="">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Kode Extruder</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning" style="width:150px;">
                        <input type="text" id="txtKodeExtruder3" class="form-control" placeholder="Masukan Kode Extruder" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Warna Plastik</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:100px;">
                        <input type="text" id="txtWarnaPlastik" class="form-control" placeholder="Masukan Warna Plastik" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal Perngerjaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:200px;">
                        <div class="input-group date">
                          <input type="text" id="txtTglHasil" class="form-control" placeholder="Pilih Tanggal Pengerjaan" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>No. Mesin</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:200px;">
                        <input type="text" id="txtNoMesin" class="form-control" placeholder="Masukan No. Mesin" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:250px;">
                        <input type="text" id="txtMerek" class="form-control" placeholder="Masukan Merek" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:100px;">
                        <select class="form-control" id="txtJenisBarang">
                          <option value="LOKAL">LOKAL</option>
                          <option value="EXPORT">EXPORT</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:100px;">
                        <input type="text" id="txtJnsPermintaan" class="form-control" placeholder="Masukan Jenis Permintaan" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Biji Warna</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:300px;">
                        <select class="form-control" id="cmbBijiWarna">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Komposisi</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning"  style="width:200px;">
                        <input type="text" id="txtKomposisi" class="form-control number" placeholder="Masukan Jumlah Komposisi">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbKeterangan" style="width:100px;">
                          <option value="TS">TS</option>
                          <option value="STRIP">STRIP</option>
                        </select>
                        <table class="table table-responsive" id="tableStripWrapper" style="display:none;">
                          <tr>
                            <td width="10%">Strip</td>
                            <td width="1%">:</td>
                            <td>
                              <div class="form-group has-warning" style="width:250px;">
                                <select class="form-control" id="cmbWarnaStrip">

                                </select>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Ukuran</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:150px;">
                        <input type="text" id="txtUkuranHasil" class="form-control" placeholder="Masukan Ukuran" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tebal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:70px;">
                        <input type="text" id="txtTebalHasil" class="form-control" placeholder="Masukan Tebal Plastik">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Berat</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:100px;">
                        <input type="text" id="txtBeratHasil" class="form-control" placeholder="Masukan Berat Hasil">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Strip</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:150px;">
                        <input type="text" id="txtStripHasil" class="form-control" placeholder="Masukan Strip Plastik" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Roll Pipa</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:200px;">
                        <select class="form-control" id="cmbRollPipa">
                          <option value="">--Pilih Jenis Roll--</option>
                          <option value="BOBIN">Bobin</option>
                          <option value="PAYUNG">Payung</option>
                          <option value="PAYUNG_KUNING">Payung Kuning</option>
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-responsive" id="fieldRollPipaBobin" style="display:none;">
                            <tr>
                              <td width="20%">Panjang Plastik</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning" style="width:150px;">
                                  <input type="text" id="txtPanjangPlastik" class="form-control" placeholder="Masukan Panjang Plastik">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Double / Single</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning" style="width:150px;">
                                  <input type="text" id="txtDoubleSingle" class="form-control number" placeholder="Double / Single">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Rumus Roll</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning" style="width:70px;">
                                  <input type="text" id="txtRumusRoll" class="form-control number" placeholder="Masukan Rumus Roll">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Jumlah Bobin</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning" style="width:150px;">
                                  <input type="text" id="txtJumlahBobin" class="form-control number" placeholder="Masukan Jumlah Bobin">
                                </div>
                              </td>
                            </tr>
                          </table>

                          <table class="table table-responsive" id="fieldRollPayung" style="display:none;">
                            <tr>
                              <td width="20%" id="tdPayung">Payung</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning" style="width:150px;">
                                  <input type="text" id="txtPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Rumus Roll</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning" style="width:70px;">
                                  <input type="text" id="txtRumusRollPayung" class="form-control number" placeholder="Masukan Rumus Roll">
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Shift</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="width:70px;">
                        <select class="form-control" id="cmbShift">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Hasil</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning" style="float:left; margin-right:10px;">
                        <input type="text" id="txtJumlahHasil" class="form-control number" placeholder="Masukan Jumlah Hasil (Kg)"  style="width:400px;">
                      </div>
                      <label id="lblSisa" style="float:left;">22222 Kg</label>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" class="btn btn-md btn-flat btn-primary" id="btnSaveHasilExtruder"><i class="fa fa-check"></i> Simpan</button>
            <button type="button" class="btn btn-md btn-flat btn-danger"><i class="fa fa-remove"></i> Batal</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
