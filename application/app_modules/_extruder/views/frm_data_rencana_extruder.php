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
        <div class="col-md-4 pull-right">
          <button type="button" class="btn btn-md btn-flat btn-primary pull-right" data-toggle="modal" data-target="#modalBuatRencanaSusulan" onclick="modalBuatRencanaSusulan();">Buat Rencana Susulan</button>
        </div>
        <div class="col-md-12">
          <fieldset>
            <legend class="text-blue">Mesin KLIP</legend>
            <div class="table-responsive">
              <table class="table table-responsive table-striped table-bordered" id="tableRencanaMandorExtruder_KP">
                <thead>
                  <th>Tgl. Rencana</th>
                  <th>No. Mesin</th>
                  <th>Order</th>
                  <th>Merek</th>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Tebal</th>
                  <th>Berat</th>
                  <th>Strip</th>
                  <th>Jumlah</th>
                  <th>Sisa</th>
                  <th>Status</th>
                  <th>Ket</th>
                  <th>T</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </fieldset>
        </div>

        <div class="col-md-12">
          <fieldset>
              <table class="table table-responsive table-striped table-bordered" id="tableRencanaMandorExtruder_ZP">
                <thead>
                  <th>Tgl. Rencana</th>
                  <th>No. Mesin</th>
                  <th>Order</th>
                  <th>Merek</th>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Tebal</th>
                  <th>Berat</th>
                  <th>Strip</th>
                  <th>Jumlah</th>
                  <th>Sisa</th>
                  <th>Status</th>
                  <th>Ket</th>
                  <th>T</th>
                  <th>Action</th>
                </thead>
              </table>
          </fieldset>
        </div>
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Job Extuder (LOKAL)</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableHasilJobExtruder_Lokal">
                    <thead>
                      <th>No.</th>
                      <th>No. Mesin</th>
                      <th>Biji Warna</th>
                      <th>Ukuran</th>
                      <th>Berat</th>
                      <th>Roll (Pipa)</th>
                      <th>Hasil</th>
                      <th>Merek</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Sisa Biji Kemarin</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaBijiKemarin_Lokal" class="form-control number" placeholder="Masukan Sisa Biji Kemarin">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Penambahan Biji Baru</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPenambahanBijiBaru_Lokal" class="form-control number" placeholder="Masukan Penambahan Biji Baru">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Pengurangan Biji</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPenguranganBiji_Lokal" class="form-control number" placeholder="Masukan Pengurangan Biji">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Biji Warna</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBijiWarna_Lokal" class="form-control numberFive" placeholder="Masukan Biji Warna">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Corong</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtCorong_Lokal" class="form-control number" placeholder="Masukan Corong">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa Bahan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisabahan_Lokal" class="form-control number" placeholder="Masukan Sisa Bahan">
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Total Bahan</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisa_Lokal" onfocus="hitungJumlahTotalExtruder('LOKAL');" class="form-control number" placeholder="Masukan Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Pemakaian Bahan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtTotal_Lokal" class="form-control number" placeholder="Masukan Total">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Berat Hasil Jadi</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBerat2_Lokal" class="form-control number" placeholder="Masukan Berat">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Apal</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtApal_Lokal" class="form-control number" placeholder="Masukan Apal">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Roll Pipa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtRollPipa_Lokal" class="form-control number" placeholder="Masukan Roll Pipa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Plus/Minus</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPlusMinus_Lokal" onfocus="hitungJumlahTotalExtruder('LOKAL');" class="form-control number" placeholder="Masukan Plus Minus">
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <button type="button" id="btnSimpanHasilJob_Lokal" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveHasilJobExtruderFinal('LOKAL')"><i class="fa fa-check"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12" style="display:none;">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Job Extuder (EXPORT)</h3>
            </div>
            <div class="box-body" style="height:400px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableHasilJobExtruder_Export">
                    <thead>
                      <th>No.</th>
                      <th>No. Mesin</th>
                      <th>Biji Warna</th>
                      <th>Ukuran</th>
                      <th>Berat</th>
                      <th>Roll (Pipa)</th>
                      <th>Hasil</th>
                      <th>Merek</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Sisa Biji Kemarin</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaBijiKemarin_Export" class="form-control number" placeholder="Masukan Sisa Biji Kemarin">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Penambahan Biji Baru</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPenambahanBijiBaru_Export" class="form-control number" placeholder="Masukan Penambahan Biji Baru">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Pengurangan Biji</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPenguranganBiji_Export" class="form-control number" placeholder="Masukan Pengurangan Biji">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Biji Warna</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBijiWarna_Export" class="form-control numberFive" placeholder="Masukan Biji Warna">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Corong</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtCorong_Export" class="form-control number" placeholder="Masukan Corong">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa Bahan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisabahan_Export" class="form-control number" placeholder="Masukan Sisa Bahan">
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Sisa</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisa_Export" class="form-control number" onfocus="hitungJumlahTotalExtruder('EXPORT');" placeholder="Masukan Sisa" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtTotal_Export" class="form-control number" placeholder="Masukan Total" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Berat</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBerat2_Export" class="form-control number" placeholder="Masukan Berat">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Apal</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtApal_Export" class="form-control number" placeholder="Masukan Apal">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Roll Pipa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtRollPipa_Export" class="form-control number" placeholder="Masukan Roll Pipa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Plus/Minus</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPlusMinus_Export" class="form-control number" onfocus="hitungJumlahTotalExtruder('EXPORT');" placeholder="Masukan Plus Minus" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <button type="button" id="btnSimpanHasilJob_Export" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-check"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalEditStatus" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalEditStatus">&times;</button>
                <h4 class="modal-title text-primary">Edit Status Rencana</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped">
                      <tr>
                        <td width="20%">Kode Rencana</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKodeRencana" class="form-control" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Status Pengerjaan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbStatusRencana">
                              <!-- <option value="PENDING">PENDING</option>
                              <option value="PROGRESS">PROGRESS</option> -->
                              <option value="COMPLETE">COMPLETE</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnUbahStatusRencana" class="btn btn-md btn-flat btn-primary"><i class="fa fa-pencil"></i> Ubah</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalGantiMesin" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalGantiMesin">&times;</button>
                <h4 class="modal-title text-blue">Penggantian Mesin</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Kode Rencana</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKodeRencana2" class="form-control" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>No. Mesin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbNoMesin">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Mesin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="txtJenisMesin">
                              <option value="KLIP">KLIP</option>
                              <option value="ZP">ZP</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnEditGantiMesin" class="btn btn-md btn-flat btn-primary"><i class="fa fa-pencil"></i> Ubah</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalBuatRencanaSusulan" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg" style="width:100%">
            <div class="modal-content" style="width:100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalBuatRencanaSusulan">&times;</button>
                <h4 class="modal-title text-blue">Buat Rencana Susulan</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Kode Extruder</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKodeExtruder2" class="form-control" placeholder="Akan Muncul Otomatis" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>No. Mesin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbNoMesin3">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Mesin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="txtJenisMesin2">
                              <option value="KLIP">KLIP</option>
                              <option value="ZP">ZP</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Order</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtNamaCustomer2" class="form-control" placeholder="Masukan Nama Customer">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbMerekGudangRoll">

                            </select>
                          </div>
                          <div class="col-md-6">
                            <table class="table table-responsive">
                              <tr>
                                <td width="20%">Ukuran</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtUkuranPlastik" class="form-control" placeholder="Masukan Ukuran Plastik">
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table table-responsive">
                              <tr>
                                <td>Ket. Merek</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group">
                                    <input type="text" id="txtKetMerek" class="form-control" placeholder="Masukan Keterangan Merek">
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Tebal</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtTebal1" class="form-control" placeholder="Masukan Tebal Plastik">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbStatus">
                              <option value="TUNDA">TUNDA</option>
                              <option value="BIASA">BIASA</option>
                              <option value="URGENT">URGENT</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jumlah Rencana Pembuatan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahRencanaPembuatan" class="form-control number" placeholder="Masukan Jumlah Yang Ingin Dibuat (Kg)">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Strip</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning" id="cmbStripWrapper">
                            <select class="form-control" id="cmbStrip">
                              <option value="LOSE">Lose</option>
                              <option value="MERAH">Merah</option>
                              <option value="PINK">Pink</option>
                              <option value="MERAH ORANGE">Merah Orange</option>
                              <option value="CUSTOM">Custom</option>
                            </select>
                          </div>
                          <div class="form-group has-warning" id="txtStripWrapper" style="display:none;">
                            <div class="input-group" style="width:100%">
                              <input type="text" id="txtStrip" class="form-control" placeholder="Masukan Strip" style="width:95%; float:left">
                              <button type="button" id="closeTxtStrip" class="close" style="margin:5px 0 0 5px;">&times;</button>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Motoran</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtMotoran" class="form-control" placeholder="Masukan Motoran">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Extruder</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtExtruder" class="form-control" placeholder="Masukan Extruder">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bahan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <div class="form-group has-warning">
                              <div id="comboWrapper">
                                <select class="form-control" id="cmbBahan">
                                  <option value="TITAN VANE + PETLIN">TITAN VANE + PETLIN</option>
                                  <option value="PETLIN + EXXON">PETLIN + EXXON</option>
                                  <option value="CUSTOM">CUSTOM</option>
                                </select>
                              </div>
                              <div id="textWrapper" style="display:none;">
                                <div class="input-group" style="width:100%;">
                                  <textarea id="txtBahan" rows="5" cols="40" class="form-control" placeholder="Masukan Bahan" style="float:left; width:96%;"></textarea>
                                  <button type="button" class="close" id="removeTextWrapper">&times;</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Berat & Isi / Ball</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtBeratOrder" class="form-control" placeholder="Masukan Berat & Isi / Ball">
                          </div>
                        </td>
                      </tr>
                    </table>
                    <button type="button" id="btnResetRencanaSusulan" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormBuatRencanaSusulanBaru();"><i class="fa fa-remove"></i> Batal</button>
                    <button type="button" id="btnAddRencanaSusulan" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableRencanaSusulanPending">
                      <thead>
                        <th>No.</th>
                        <th>No. Mesin</th>
                        <th>Motoran</th>
                        <th>Order</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Tebal</th>
                        <th>Jumlah Permintaan</th>
                        <th>Strip</th>
                        <th>Action</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnSimpanRencanaSusulan" class="btn btn-md btn-flat btn-success" onclick="saveRencanaExtruderSusulan();"><i class="fa fa-check"></i> Selesai</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalInputHasil" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg" style="width:100%;">
            <div class="modal-content" style="width:100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalInputHasil">&times;</button>
                <h4 class="modal-title text-blue">Input Hasil</h4>
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
                <button type="button" class="btn btn-md btn-flat btn-primary" id="btnSaveHasilExtruder"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" class="btn btn-md btn-flat btn-danger"><i class="fa fa-remove"></i> Batal</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalEditJobExtruder" role="dialog" tabindex="-1" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalEditJobExtruder">&times;</button>
                <h4 class="modal-title text-blue">Ubah Hasil Job Extruder</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll; ">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" id="txtJumlahBijiWarna">
                    <input type="hidden" id="txtTglRencana">
                    <input type="hidden" id="txtWarnaStrip">
                    <input type="hidden" id="txtJumlahPemakaianStrip">
                    <input type="hidden" id="txtKetMerekHasil_Edit" value="">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Kode Extruder</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKodeExtruder_Edit" class="form-control" placeholder="Masukan Kode Extruder" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJenisBarang_Edit" class="form-control" placeholder="Masukan Jenis Barang" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>No. Mesin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtNoMesin_Edit" class="form-control" placeholder="Masukan No. Mesin" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Biji Warna</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbBijiWarna_Edit">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Komposisi</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKomposisi_Edit" class="form-control" placeholder="Masukan Jumlah Komposisi">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Ukuran</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtUkuranPlastik_Edit" class="form-control" placeholder="Masukan Ukuran Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Berat</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBeratHasil_Edit" class="form-control" placeholder="Masukan Berat Hasil" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Roll Pipa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbRollPipa_Edit">
                              <option value="">--Pilih Jenis Roll--</option>
                              <option value="BOBIN">Bobin</option>
                              <option value="PAYUNG">Payung</option>
                              <option value="PAYUNG_KUNING">Payung Kuning</option>
                            </select>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table table-responsive" id="fieldRollPipaBobin_Edit" style="display:none;">
                                <tr>
                                  <td width="20%">Panjang Plastik</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning" style="width:150px;">
                                      <input type="text" id="txtPanjangPlastik_Edit" class="form-control" placeholder="Masukan Panjang Plastik">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Double / Single</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning" style="width:150px;">
                                      <input type="text" id="txtDoubleSingle_Edit" class="form-control number" placeholder="Double / Single">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Rumus Roll</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning" style="width:70px;">
                                      <input type="text" id="txtRumusRoll_Edit" class="form-control number" placeholder="Masukan Rumus Roll">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Jumlah Bobin</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning" style="width:150px;">
                                      <input type="text" id="txtJumlahBobin_Edit" class="form-control number" placeholder="Masukan Jumlah Bobin">
                                    </div>
                                  </td>
                                </tr>
                              </table>

                              <table class="table table-responsive" id="fieldRollPayung_Edit" style="display:none;">
                                <tr>
                                  <td width="20%" id="tdPayung_Edit">Payung</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning" style="width:150px;">
                                      <input type="text" id="txtPayung_Edit" class="form-control number" placeholder="Masukan Jumlah Payung">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Rumus Roll</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning" style="width:70px;">
                                      <input type="text" id="txtRumusRollPayung_Edit" class="form-control number" placeholder="Masukan Rumus Roll">
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
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbShift_Edit">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbKeterangan_Edit">
                              <option value="TS">TS</option>
                              <option value="STRIP">STRIP</option>
                            </select>
                            <table class="table table-responsive" id="tableStripWrapper_Edit" style="display:none;">
                              <tr>
                                <td width="10%">Strip</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning" style="width:250px;">
                                    <select class="form-control" id="cmbWarnaStrip_Edit">

                                    </select>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Hasil</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahHasil_Edit" class="form-control number" placeholder="Masukan Jumlah Hasil">
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnEditHasilJobExtruder" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
