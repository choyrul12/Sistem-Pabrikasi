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
        <div class="col-md-8">
          <table class="table table-responsive">
            <tr>
              <td width="10%">Tanggal</td>
              <td width="1%">:</td>
              <td width="40%">
                <div class="input-group date">
                  <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </td>
              <td width="39%">
                <button type="button" id="btnLihatHasilJobPotong" class="btn btn-md btn-flat btn-success" onclick="searchHasilJob();"><i class="fa fa-search"></i> Cari Hasil</button>
              </td>
            </tr>
          </table>
        </div>

        <div class="col-md-12">
          <h4 class="text-blue" id="h4TitleHasilJob">Hasil Job Tanggal : <?php echo date("d-m-Y"); ?></h4>
        </div>

        <div class="col-md-12" style="overflow-x : scroll; max-height:720px; overflow-y:scroll;">
          <table class="table table-responsive table-striped table-bordered" id="tableHasilJobPotong">
            <thead style="background-color:#00a65a;">
              <th style="vertical-align:middle;">No.</th>
              <th style="vertical-align:middle;">Tanggal</th>
              <th style="vertical-align:middle;">Customer</th>
              <th style="vertical-align:middle;">Ukuran</th>
              <th style="vertical-align:middle;">Permintaan</th>
              <th style="vertical-align:middle;">Warna</th>
              <th style="vertical-align:middle;">Jml. Selesai</th>
              <th style="vertical-align:middle;">Merek</th>
              <th style="vertical-align:middle;">Brt. Pengambilan</th>
              <th style="vertical-align:middle;">Payung</th>
              <th style="vertical-align:middle;">Payung Kuning</th>
              <th style="vertical-align:middle;">Bobin</th>
              <th style="vertical-align:middle;">Sisa</th>
              <th style="vertical-align:middle;">Sisa Payung</th>
              <th style="vertical-align:middle;">Sisa Payung Kuning</th>
              <th style="vertical-align:middle;">Sisa Bobin</th>
              <th style="vertical-align:middle;">Apal</th>
              <th style="vertical-align:middle;">Pipa</th>
              <th style="vertical-align:middle;">Berat Bersih</th>
              <th style="vertical-align:middle;">Plus/Minus</th>
              <th style="vertical-align:middle;">Persentase</th>
              <th style="vertical-align:middle;">Action</th>
            </thead>

            <tbody>
            </tbody>

            <tfoot style="background-color:#00c0ef;">
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>Total</th>
              <th id="thTotalJumlahSelesai">0</th>
              <th></th>
              <th id="thTotalJumlahBrtPengambilan">0,0</th>
              <th id="thTotalJumlahPayung">0</th>
              <th id="thTotalJumlahPayungKuning">0</th>
              <th id="thTotalJumlahBobin">0</th>
              <th id="thTotalJumlahSisa">0,0</th>
              <th id="thTotalJumlahSisaPayung">0</th>
              <th id="thTotalJumlahSisaPayungKuning">0</th>
              <th id="thTotalJumlahSisaBobin">0</th>
              <th id="thTotalJumlahApal">0,0</th>
              <th id="thTotalJumlahPipa">0</th>
              <th id="thTotalJumlahBeratBersih">0</th>
              <th id="thTotalJumlahPlusMinus">0</th>
              <th id="thTotalPersentase">0,0</th>
              <th></th>
            </tfoot>
          </table>
        </div>

        <div class="modal fade" id="modalInputHasil" role="dialog" tabindex="-1">
          <div class="modal-dialog" style="width:100%; padding-left:15px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalInputHasil">&times;</button>
                <h4 class="modal-title text-blue">Input Hasil Potong</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" id="ketBarang" value="0">
                    <input type="hidden" id="ketMerek" value="0">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">ID Transaksi</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="idTransaksi" class="form-control" placeholder="Masukan Id Transaksi" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td width="10%">Tgl. Rencana</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtTglPengerjaan" class="form-control" placeholder="Masukan Tanggal Pengerjaan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtMerek" class="form-control" placeholder="Masukan Merek" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Permintaan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPermintaan" class="form-control" placeholder="Masukan Permintaan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Warna Plastik</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtWarnaPlastik" class="form-control" placeholder="Masukan Warna Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive" id="tableDetailRencana">
                      <tr>
                        <td width="10%">Customer</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control txtCustomer" placeholder="Masukan Nama Customer" readonly>
                          </div>
                        </td>
                        <td width="5%">Lembar</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control number txtLembar" placeholder="Masukan Jumlah Lembar" readonly>
                          </div>
                        </td>
                        <td width="5%">Berat</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control number txtBerat" placeholder="Masukan Jumlah Berat" readonly>
                          </div>
                        </td>
                        <td width="5%">Tebal</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control txtTebal" placeholder="Masukan Tebal" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td width="10%">Roll(Ukuran)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control txtUkuran" placeholder="Masukan Ukuran" readonly>
                          </div>
                        </td>
                        <td width="5%">Gudang</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control txtGudang" placeholder="Masukan Gudang" readonly>
                          </div>
                        </td>
                        <td width="5%">Strip</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control txtStrip" placeholder="Masukan Strip" readonly>
                          </div>
                        </td>
                        <td width="5%">No. Mesin</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" class="form-control txtNoMesin" placeholder="Masukan No. Mesin" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%" id="tdBahan">Bahan Dari Extruder</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBahan" class="form-control number" placeholder="Masukan Bahan" readonly>
                          </div>
                        </td>
                        <td width="10%" id="tdBobin">Bobin Extruder</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobin" class="form-control number" placeholder="Masukan Jumlah Bobin" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td id="tdPayung">Payung Extruder</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayung" class="form-control number" placeholder="Masukan Jumlah Payung" readonly>
                          </div>
                        </td>
                        <td width="10%" id="tdPayungKuning">Payung Kuning Extruder</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuning" class="form-control number" placeholder="Masukan Jumlah Payung Kuning" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Sisa Semalam</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBeratSisaSemalam" class="form-control number" placeholder="Masukan Berat Sisa Semalam" readonly>
                          </div>
                        </td>
                        <td width="10%">Bobin Sisa Semalam</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobinSisaSemalam" class="form-control number" placeholder="Masukan Bobin Sisa Semalam" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Sisa Semalam</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungSisaSemalam" class="form-control number" placeholder="Masukan Payung Sisa Semalam" readonly>
                          </div>
                        </td>
                        <td>Payung Kuning Sisa Semalam</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuningSisaSemalam" class="form-control number" placeholder="Masukan Payung Kuning Sisa Semalam" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Berat Pengambilan</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBeratPengambilan" class="form-control number" placeholder="Masukan Berat Pengambilan" readonly>
                          </div>
                        </td>
                        <td width="10%">Bobin (Pengambilan)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobinPengambilan" class="form-control number" placeholder="Masukan Bobin (Pengambilan)" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung (Pengambilan)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungPengambilan" class="form-control number" placeholder="Masukan Payung (Pengambilan)" readonly>
                          </div>
                        </td>
                        <td>Payung Kuning (Pengambilan)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuningPengambilan" class="form-control number" placeholder="Masukan Payung Kuning (Pengambilan)" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Sisa</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisa" class="form-control number" placeholder="Masukan Jumlah Sisa" readonly>
                          </div>
                        </td>
                        <td width="10%">Sisa Bobin</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaBobin" class="form-control number" placeholder="Masukan Sisa Bobin" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaPayung" class="form-control number" placeholder="Masukan Sisa Payung" readonly>
                          </div>
                        </td>
                        <td>Sisa Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaPayungKuning" class="form-control number" placeholder="Masukan Sisa Payung Kuning" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12" id="tumpuk" style="display:none;">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Ukuran Tumpuk</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select id="cmbUkuranTumpuk" class="form-control" readonly>

                            </select>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%" id="tdBahanTumpuk">Bahan Dari Extruder (Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBahanTumpuk" class="form-control number" placeholder="Masukan Bahan (Tumpuk)" readonly>
                          </div>
                        </td>
                        <td width="10%" id="tdBobinTumpuk">Bobin Extruder (Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobinTumpuk" class="form-control number" placeholder="Masukan Jumlah Bobin (Tumpuk)" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td id="tdPayungTumpuk">Payung Extruder (Tumpuk)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungTumpuk" class="form-control number" placeholder="Masukan Jumlah Payung (Tumpuk)" readonly>
                          </div>
                        </td>
                        <td width="10%" id="tdPayungKuningTumpuk">Payung Kuning Extruder (Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuningTumpuk" class="form-control number" placeholder="Masukan Jumlah Payung Kuning (Tumpuk)" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Sisa Semalam (Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBeratSisaSemalamTumpuk" class="form-control number" placeholder="Masukan Berat Sisa Semalam (Tumpuk)" readonly>
                          </div>
                        </td>
                        <td width="10%">Bobin Sisa Semalam (Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobinSisaSemalamTumpuk" class="form-control number" placeholder="Masukan Bobin Sisa Semalam (Tumpuk)" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Sisa Semalam (Tumpuk)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungSisaSemalamTumpuk" class="form-control number" placeholder="Masukan Payung Sisa Semalam (Tumpuk)" readonly>
                          </div>
                        </td>
                        <td>Payung Kuning Sisa Semalam (Tumpuk)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuningSisaSemalamTumpuk" class="form-control number" placeholder="Masukan Payung Kuning Sisa Semalam (Tumpuk)" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Berat (Pengambilan Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBeratPengambilanTumpuk" class="form-control number" placeholder="Masukan Berat (Pengambilan Tumpuk)" readonly>
                          </div>
                        </td>
                        <td width="10%">Bobin (Pengambilan Tumpuk)</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobinPengambilanTumpuk" class="form-control number" placeholder="Masukan Bobin (Pengambilan Tumpuk)" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung (Pengambilan Tumpuk)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungPengambilanTumpuk" class="form-control number" placeholder="Masukan Payung (Pengambilan Tumpuk)" readonly>
                          </div>
                        </td>
                        <td>Payung Kuning (Pengambilan Tumpuk)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuningPengambilanTumpuk" class="form-control number" placeholder="Masukan Payung Kuning (Pengambilan Tumpuk)" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Sisa Tumpuk</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaTumpuk" class="form-control number" placeholder="Masukan Jumlah Sisa Tumpuk" readonly>
                          </div>
                        </td>
                        <td width="10%">Sisa Bobin Tumpuk</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaBobinTumpuk" class="form-control number" placeholder="Masukan Sisa Bobin Tumpuk" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa Payung Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaPayungTumpuk" class="form-control number" placeholder="Masukan Sisa Payung Tumpuk" readonly>
                          </div>
                        </td>
                        <td>Sisa Payung Kuning Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaPayungKuningTumpuk" class="form-control number" placeholder="Masukan Sisa Payung Kuning Tumpuk" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="10%">Hasil Lembar</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtHasilLembar" class="form-control number" placeholder="Masukan Hasil Lembar">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Hasil Berat(Bersih)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtHasilBeratBersih" class="form-control number" placeholder="Masukan Hasil Berat Bersih">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Hasil Berat(Kotor)</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtHasilBeratKotor" class="form-control number" placeholder="Masukan Hasil Berat Kotor">
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
                            <select class="form-control" id="cmbRollPipa">
                              <option value="">--Pilih Roll Pipa--</option>
                              <option value="PAYUNG">Payung</option>
                              <option value="PAYUNG_KUNING">Payung Kuning</option>
                              <option value="PAYUNG_KUNING_PAYUNG">Payung Kuning & Payung</option>
                              <option value="BOBIN">Bobin</option>
                              <option value="BOBIN_PAYUNG">Bobin & Payung</option>
                              <option value="BOBIN_PAYUNG_KUNING">Bobin & Payung Kuning</option>
                              <option value="BOBIN_PAYUNG_KUNING_PAYUNG">Bobin & Payung Kuning & Payung</option>
                            </select>
                          </div>
                          <div id="payung" class="col-md-6" style="display:none;">
                            <table class="table table-responsibe">
                              <tr>
                                <td width="20%" id="tdPayung">Jumlah Payung</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtJumlahPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Rumus Roll</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtRumusRollPayung" class="form-control number" placeholder="Masukan Rumus Roll" readonly>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div id="payungKuningPayung" class="col-md-6" style="display:none;">
                            <table class="table table-responsive">
                              <tr>
                                <td width="20%">Jumlah Payung</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtJumlahPayung_PKP" class="form-control number" placeholder="Masukan Jumlah Payung">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="20%">Jumlah Payung Kuning</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtJumlahPayungKuning_PKP" class="form-control number" placeholder="Masukan Jumlah Payung Kuning">
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div id="bobin" class="col-md-6" style="display:none;">
                            <table class="table table-responsive">
                              <tr>
                                <td width="20%">Ukuran</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtUkuranPlastik" class="form-control" placeholder="Masukan Ukuran" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Double / Single</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtDoubleSingle" class="form-control number" placeholder="Masukan Double Single">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Banyaknya Pipa</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtBanyaknyaPipa" class="form-control number" placeholder="Masukan Jumlah Pipa">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Rumus</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtRumus" class="form-control number" placeholder="Masukan Rumus" readonly>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div id="bobinPayung" class="col-md-6" style="display:none;">
                            <table class="table table-responsibe">
                              <tr>
                                <td width="20%" id="tdBobinPayung_Payung">Jumlah Payung</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtJumlahBobinPayung_Payung" class="form-control number" placeholder="Masukan Jumlah Payung">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Rumus Roll Payung</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtRumusRollBobinPayung_Payung" class="form-control number" placeholder="Masukan Rumus Roll Payung" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Jumlah Bobin</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtJumlahBobinPayung_Bobin" class="form-control number" placeholder="Masukan Jumlah Bobin">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Double / Single</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtDoubleSingleBobinPayung" class="form-control number" placeholder="Masukan Double/Single">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>Rumus</td>
                                <td>:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtRumusBobinPayung" class="form-control number" placeholder="Masukan Rumus" readonly>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div id="bobin_payung_kuning_payung" class="col-md-12" style="display:none;">
                            <div class="col-md-6">
                              <table class="table table-responsive">
                                <tr>
                                  <td width="20%">Ukuran</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_UkuranPlastik" class="form-control" placeholder="Masukan Ukuran" readonly>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Double / Single</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_DoubleSingle" class="form-control number" placeholder="Masukan Double Single">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Banyaknya Pipa</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_BanyaknyaPipa" class="form-control number" placeholder="Masukan Jumlah Pipa">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Rumus</td>
                                  <td>:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_Rumus" class="form-control number" placeholder="Masukan Rumus" readonly>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="col-md-6">
                              <table class="table table-responsive">
                                <tr>
                                  <td width="20%">Jumlah Payung</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_JumlahPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="20%">Rumus Payung</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_RumusPayung" class="form-control number" placeholder="Masukan Rumus Payung" readonly>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="20%">Jumlah Payung Kuning</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_JumlahPayungKuning" class="form-control number" placeholder="Masukan Jumlah Payung Kuning">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="20%">Rumus Payung Kuning</td>
                                  <td width="1%">:</td>
                                  <td>
                                    <div class="form-group has-warning">
                                      <input type="text" id="txtBPKP_RumusPayungKuning" class="form-control number" placeholder="Masukan Rumus Payung Kuning" readonly>
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
                            <select class="form-control" id="cmbShift">
                              <option value="">--Pilih Shift--</option>
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
                            <input type="text" id="txtKetarangan" class="form-control" placeholder="Masukan Keterangan">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Roll Pipa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahRollPipa" class="form-control number" placeholder="Masukan Roll Pipa" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Plus/Minus</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPlusMinus" class="form-control numberFive" placeholder="Masukan Plus/Minus" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-md btn-flat btn-success" onclick="hitungRollPipa(); hitungPlusMinus();">Hitung Ulang Plus/Minus</button>
                <button type="button" id="btnSaveHasilExtruder" class="btn btn-md btn-flat btn-primary" onclick="saveInputHasil();"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" class="btn btn-md btn-flat btn-danger"><i class="fa fa-remove"></i> Batal</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
