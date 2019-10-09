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
        <button type="button" class="btn btn-md btn-flat btn-primary btn-block" data-toggle="modal" data-target="#modalCariLaporanRencanaMandor" data-backdrop="static"><i class="fa fa-search"></i> Cari Hasil</button>
      </div>

      <div class="modal fade" id="modalCariLaporanRencanaMandor" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariLaporanRencanaMandor">&times;</button>
              <h4 class="modal-title text-blue">Cari Laporan Rencana Mandor</h4>
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
              <button type="button" id="btnCariLaporanRencanaMandor" class="btn btn-md btn-flat btn-success" onclick="searchDataLaporanRencanaMandor();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="rowHasilPencarian" style="display:none; margin-top:10px;">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title text-blue">Hasil Mandor Extruder</h3>
            <div class="box-tools pull-right">
              <small id="lblTanggal" class="text-muted"></small>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-responsive table-striped" id="tableDataLaporanRencanaMandor">
              <thead>
                <th>No.Mesin</th>
                <th>Biji Warna</th>
                <th>Ukuran</th>
                <th>Berat</th>
                <th>Roll</th>
                <th>Shift</th>
                <th>Merek</th>
                <th>Action</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-body">
            <table class="table table-responsive">
              <tr>
                <td width="20%">Sisa Biji Kemarin</td>
                <td width="1%">:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtSisaBijiKemarin" class="form-control number" placeholder="Masukan Sisa Biji Kemarin">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Penambahan Biji Baru</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtPenambahanBijiBaru" class="form-control number" placeholder="Masukan Penambahan Biji Baru">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Pengurangan Biji Baru</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtPenguranganBijiBaru" class="form-control number" placeholder="Masukan Pengurangan Biji Baru">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Biji Warna</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahBijiWarna" class="form-control numberFive" placeholder="Masukan Jumlah Biji Warna">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Corong</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahCorong" class="form-control number" placeholder="Masukan Jumlah Corong">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Sisa Bahan</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahSisaBahan" class="form-control number" placeholder="Masukan Jumlah Sisa Bahan">
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-body">
            <table class="table table-responsive">
              <tr>
                <td width="20%">Total Bahan</td>
                <td width="1%">:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahSisa" class="form-control number" placeholder="Masukan Jumlah Sisa" onfocus="hitungJumlahTotalExtruder()">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Pemakaian Bahan</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtTotal" class="form-control number" placeholder="Masukan Jumlah Total">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Berat Hasil Jadi</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahBerat" class="form-control number" placeholder="Masukan Jumlah Berat">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Apal</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahApal" class="form-control number" placeholder="Masukan Jumlah Apal">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Roll Pipa</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtJumlahRollPipa" class="form-control number" placeholder="Masukan Jumlah Roll Pipa">
                  </div>
                </td>
              </tr>
              <tr>
                <td>Plus / Minus</td>
                <td>:</td>
                <td>
                  <div class="form-group has-warning">
                    <input type="text" id="txtPlusMinus" class="form-control number" placeholder="Masukan Plus Minus">
                  </div>
                </td>
              </tr>
            </table>
            <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnSimpanLaporanRencanaMandor"><i class="fa fa-check"></i> Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditHasil" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg" style="width:1120px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalEditHasil">&times;</button>
            <h4 class="modal-title text-blue">Edit Hasil</h4>
          </div>
          <div class="modal-body" style="height:500px; overflow-y:scroll;">
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
                      <div class="form-group has-warning" style="width:500px;">
                        <!-- <input type="text" id="txtMerek" class="form-control" placeholder="Masukan Merek" readonly> -->
                        <select class="form-control" id="cmbMerek">

                        </select>
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
                        <input type="text" id="txtTebalHasil" class="form-control number" placeholder="Masukan Tebal Plastik">
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
          <div class="modal-footer">
            <button type="button" class="btn btn-md btn-flat btn-primary" id="btnSaveHasilExtruder"><i class="fa fa-pencil"></i> Ubah</button>
            <button type="button" class="btn btn-md btn-flat btn-danger"><i class="fa fa-remove"></i> Batal</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
