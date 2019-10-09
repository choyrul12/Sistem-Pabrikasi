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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariHasilCutting" data-backdrop="static"><i class="fa fa-search"></i> Cari Hasil Cutting</button>
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
                  <div id="laporanHasilCuttingWrapper" style="display:none;">
                    <h4 class="text-blue">Laporan Hasil Cutting</h4>
                    <label class="text-primary pull-right" id="lblTglJadi"></label>
                    <table class="table table-responsive table-striped" id="tableLaporanHasilCutting">
                      <thead>
                        <th>No. Mesin</th>
                        <th>Nama Customer</th>
                        <th>Merek</th>
                        <th>Ukuran</th>
                        <th>Warna Plastik</th>
                        <th>Permintaan</th>
                        <th>Total Lembar</th>
                        <th>Total Berat (Bersih)</th>
                        <th>Total Berat (Kotor)</th>
                        <th>Total Apal</th>
                        <th>Total Pipa</th>
                        <th>Hasil (Lembar)</th>
                        <th>Hasil (Berat)</th>
                        <th>Berat Pengambilan (Tanpa Sisa)</th>
                        <th>Plus / Minus</th>
                        <th>Gudang</th>
                        <th>Action</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" target="_blank" id="btnCetakHasilCutting" class="btn btn-md btn-flat btn-success" style="display:none;"><i class="fa fa-print"></i> Cetak Hasil Cutting</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHasilCutting" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHasilCutting">&times;</button>
              <h4 class="modal-title text-blue">Cari Hasil Cutting</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <input type="hidden" id="cmbShift" value="1">
                    <!-- <tr>
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
                    </tr> -->
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
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="searchHasilCutting();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditHasilCutting" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditHasilCutting">&times;</button>
              <h4 class="modal-title text-blue">Edit Hasil Cutting</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <input type="hidden" id="ketMerek" value="">
              <input type="hidden" id="ketBarang" value="">
              <input type="hidden" id="txtMerek" value="">

              <!-- <input type="hidden" id="txtBeratPengambilan" value=""> -->
              <!-- <input type="hidden" id="txtBahan" value="">
              <input type="hidden" id="txtBeratSisaSemalam" value="">
              <input type="hidden" id="txtSisa" value=""> -->
              <input type="hidden" id="txtJumlahBeratKotor" value="">
              <input type="hidden" id="txtJumlahBeratBersih" value="">
              <input type="hidden" id="txtJumlahApalLama" value="">

              <!-- <input type="hidden" id="txtBeratPengambilanTumpuk" value=""> -->
              <!-- <input type="hidden" id="txtBahanTumpuk" value="">
              <input type="hidden" id="txtBeratSisaSemalamTumpuk" value="">
              <input type="hidden" id="txtSisaTumpuk" value=""> -->

              <input type="hidden" id="txtSubBeratLama" value="">
              <input type="hidden" id="txtSubLembarLama" value="">
              <input type="hidden" id="txtJumlahBeratLama" value="">
              <input type="hidden" id="txtJumlahLembarLama" value="">

              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="10%">Tanggal Rencana</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTglRencana" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Input Hasil</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglInput" class="form-control" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbMerek">

                          </select>
                          <small class="text-red">Note : Jika Tidak Ingin Merubah Barang Hasil, Kolom Merek Dibiarkan Kosong</small>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Permintaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJnsPermintaan" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Apal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahApal" class="form-control number">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat Kotor</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtHasilBeratKotor" class="form-control number">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat Bersih</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtHasilBeratBersih" class="form-control number">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahLembar" class="form-control number">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="10%">Customer</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer" class="form-control" readonly>
                        </div>
                      </td>
                      <td width="5%">Lembar</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahSubLembar" class="form-control number" onkeyup="hitungHasilGlobalPotong(); hitungPlusMinus();">
                        </div>
                      </td>
                      <td width="5%">Berat</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahSubBerat" class="form-control number" onkeyup="hitungHasilGlobalPotong(); hitungPlusMinus();">
                        </div>
                      </td>
                      <td width="5%">Tebal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTebal" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="10%">Roll (Ukuran)</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" name="txtUkuran" class="form-control" readonly>
                        </div>
                      </td>
                      <td width="5%">Gudang</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJenisGudang" class="form-control" readonly>
                        </div>
                      </td>
                      <td width="5%">Strip</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaStrip" class="form-control" readonly>
                        </div>
                      </td>
                      <td width="5%">No.Mesin</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNoMesin" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="10%" id="tdPengambilanBagian">Berat Pengambilan Extruder</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBahan" class="form-control number" readonly="">
                        </div>
                      </td>
                      <td width="10%" id="tdBobinPengambilanBagian">Bobin Pengambilan Bagian</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBobin" class="form-control number" readonly="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="10%" id="tdPayungPengambilanBagian">Payung Pengambilan Extruder</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayung" class="form-control number" readonly="">
                        </div>
                      </td>
                      <td width="10%" id="tdPayungKuningPengambilanBagian">Payung Kuning Pengambilan Bagian</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuning" class="form-control number" readonly="">
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
                          <input type="text" class="form-control number" id="txtBeratSisaSemalam" readonly="">
                        </div>
                      </td>
                      <td width="10%">Bobin Sisa Semalam</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtBobinSisaSemalam" readonly="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="10%">Payung Sisa Semalam</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtPayungSisaSemalam" readonly="">
                        </div>
                      </td>
                      <td width="10%">Payung Kuning Sisa Semalam</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtPayungKuningSisaSemalam" readonly="">
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
                          <input type="text" class="form-control number" id="txtBeratPengambilan">
                        </div>
                      </td>
                      <td width="10%">Bobin Pengambilan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtBobinPengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="10%">Payung Pengambilan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtPayungPengambilan">
                        </div>
                      </td>
                      <td width="10%">Payung Kuning Pengambilan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtPayungKuningPengambilan">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tbody>
                      <tr>
                        <td width="10%">Sisa</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisa" class="form-control number" placeholder="Masukan Jumlah Sisa" readonly="">
                          </div>
                        </td>
                        <td width="10%">Sisa Bobin</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaBobin" class="form-control number" placeholder="Masukan Sisa Bobin" readonly="">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaPayung" class="form-control number" placeholder="Masukan Sisa Payung" readonly="">
                          </div>
                        </td>
                        <td>Sisa Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaPayungKuning" class="form-control number" placeholder="Masukan Sisa Payung Kuning" readonly="">
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="col-md-12" id="tumpuk" style="display:block;">
                  <!-- <table class="table table-responsive">
                    <tr>
                      <td width="10%">Ukuran Tumpuk</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select id="cmbUkuranTumpuk" class="form-control">

                          </select>
                        </div>
                      </td>
                    </tr>
                  </table> -->
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
                          <input type="text" id="txtBeratPengambilanTumpuk" class="form-control number" placeholder="Masukan Berat (Pengambilan Tumpuk)">
                        </div>
                      </td>
                      <td width="10%">Bobin (Pengambilan Tumpuk)</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBobinPengambilanTumpuk" class="form-control number" placeholder="Masukan Bobin (Pengambilan Tumpuk)">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung (Pengambilan Tumpuk)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungPengambilanTumpuk" class="form-control number" placeholder="Masukan Payung (Pengambilan Tumpuk)">
                        </div>
                      </td>
                      <td>Payung Kuning (Pengambilan Tumpuk)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuningPengambilanTumpuk" class="form-control number" placeholder="Masukan Payung Kuning (Pengambilan Tumpuk)">
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
                      <td width="10%">Jenis Roll</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select id="cmbRollPipa" class="form-control">
                            <option value="">--Pilih Roll Pipa--</option>
                            <option value="PAYUNG">Payung</option>
                            <option value="PAYUNG_KUNING">Payung Kuning</option>
                            <option value="PAYUNG_KUNING_PAYUNG">Payung Kuning &amp; Payung</option>
                            <option value="BOBIN">Bobin</option>
                            <option value="BOBIN_PAYUNG">Bobin &amp; Payung</option>
                            <option value="BOBIN_PAYUNG_KUNING">Bobin &amp; Payung Kuning</option>
                            <option value="BOBIN_PAYUNG_KUNING_PAYUNG">Bobin &amp; Payung Kuning &amp; Payung</option>
                          </select>
                        </div>
                        <div id="payung" class="col-md-6" style="display:none;">
                          <table class="table table-responsibe">
                            <tr>
                              <td width="10%" id="tdPayung">Jumlah Payung</td>
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
                              <td width="10%">Jumlah Payung</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtJumlahPayung_PKP" class="form-control number" placeholder="Masukan Jumlah Payung">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td width="10%">Jumlah Payung Kuning</td>
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
                              <td width="10%">Ukuran</td>
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
                              <td width="10%" id="tdBobinPayung_Payung">Jumlah Payung</td>
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
                                  <input type="text" class="form-control number" id="txtJumlahBobinPayung_Rumus" placeholder="Masukan Rumus" value="30" readonly>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div id="bobin_payung_kuning_payung" class="col-md-12" style="display:none;">
                          <div class="col-md-6">
                            <table class="table table-responsive">
                              <tr>
                                <td width="10%">Ukuran</td>
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
                                <td width="10%">Jumlah Payung</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtBPKP_JumlahPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="10%">Rumus Payung</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtBPKP_RumusPayung" class="form-control number" placeholder="Masukan Rumus Payung" readonly>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="10%">Jumlah Payung Kuning</td>
                                <td width="1%">:</td>
                                <td>
                                  <div class="form-group has-warning">
                                    <input type="text" id="txtBPKP_JumlahPayungKuning" class="form-control number" placeholder="Masukan Jumlah Payung Kuning">
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="10%">Rumus Payung Kuning</td>
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
                      <td width="10%">Roll Pipa</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahRollPipa" class="form-control number" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Plus/Minus</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPlusMinus" class="form-control numberFive" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="height:30px;">
              <button type="button" id="hitungUlangPlusMinus" class="btn btn-md btn-flat btn-warning" onclick="hitungUlangRollPipaDanPlusMinus();"><i class="fa fa-refresh"></i> Hitung Ulang Plus/Minus</button>
              <button type="button" id="btnEditHasilCutting" class="btn btn-md btn-flat btn-primary" disabled><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
