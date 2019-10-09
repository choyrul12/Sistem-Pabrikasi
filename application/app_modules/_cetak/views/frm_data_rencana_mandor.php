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
              <div class="col-md-3">
                <h4 class="box-title text-blue">List Rencana Kerja Mandor</h4>
              </div>
              <div class="col-md-9">
                <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalBuatRencanaKerjaSusulan" data-backdrop="static" onclick="modalBuatRencanaSusulanCetak();"><i class="fa fa-plus"></i> Buat Rencana Kerja Susulan</button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableRencanaMandor">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Rencana</th>
                      <th>No. Mesin</th>
                      <th>Nama Customer</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna Plastik</th>
                      <th>Warna Cat</th>
                      <th>Tebal</th>
                      <th>Jumlah</th>
                      <th>Sisa</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
                <div class="col-md-12">
                  <h3 class="text-blue">Hasil Job Cetak</h3>
                  <div style="overflow:scroll; height:500px;">
                    <table class="table table-responsive table-striped" id="tableHasilCetakPending">
                      <thead>
                        <th>No.</th>
                        <th>Customer</th>
                        <th>Merek</th>
                        <th>Ukuran</th>
                        <th>Warna Plastik</th>
                        <th>Berat Bahan</th>
                        <th>Jumlah Payung</th>
                        <th>Jumlah Payung Kuning</th>
                        <th>Jumlah Bobin</th>
                        <th>Sisa Bahan</th>
                        <th>Hasil Cetak</th>
                        <th>Hasil Roll Payung</th>
                        <th>Hasil Roll Payung Kuning</th>
                        <th>Hasil Roll Bobin</th>
                        <th>Berat Pipa</th>
                        <th>Jumlah Apal</th>
                        <th>Plus/Minus</th>
                        <th>Action</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12" style="margin-top:10px">
                  <button type="button" id="btnSimpanHasilCetak" class="btn btn-md btn-flat btn-success pull-right" onclick="saveHasilJobCetak();"><i class="fa fa-check"></i> Selesai</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalBuatRencanaKerjaSusulan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="width:1110px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalBuatRencanaKerjaSusulan">&times;</button>
              <h4 class="modal-title text-blue">Buat Rencana Kerja Susulan</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Cetak</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKodeCetak" class="form-control" value="" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tgl. Pengerjaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPengerjaan" class="form-control" placeholder="Masukan Tanggal Pengerjaan" readonly>
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
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbMesin">
                            <option value="Mesin 1"> Mesin 1 </option>
                            <option value="Mesin 2"> Mesin 2 </option>
                            <option value="Mesin 3"> Mesin 3 </option>
                            <option value="Mesin 4"> Mesin 4 </option>
                            <option value="Mesin 5"> Mesin 5 </option>
                            <option value="Mesin 6"> Mesin 6 </option>
                            <option value="Mesin 7"> Mesin 7 </option>
                            <option value="Mesin 8"> Mesin 8 </option>
                            <option value="Mesin 9"> Mesin 9 </option>
                            <option value="Mesin 10"> Mesin 10 </option>
                            <option value="Mesin 11"> Mesin 11 </option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNama" class="form-control" placeholder="Masukan Nama Customer">
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
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek Polos</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbMerekPolos">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Warna Strip</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaStrip" class="form-control" placeholder="Masukan Warna Strip">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Warna Cat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaCat" class="form-control" placeholder="Masukan Warna Cat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTebal" class="form-control numberFive" placeholder="Masukan Tebal">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Rencana Yang Mau Dibuat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlah" class="form-control number" placeholder="Masukan Jumlah Yang Mau Dibuat (KG)">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormBuatRencanaSusulanPending();"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahRencanaSusulanPending" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>

                <div class="col-md-12" style="margin-top:20px;">
                  <table class="table table-responsive table-striped" id="tableRencanaSusulanPending">
                    <thead>
                      <th>No.</th>
                      <th>No. Mesin</th>
                      <th>Nama Customer</th>
                      <th>Ukuran</th>
                      <th>Merek</th>
                      <th>Warna Plastik</th>
                      <th>Warna Cat</th>
                      <th>Tebal</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSelesaiRencana" class="btn btn-md btn-flat btn-success" onclick="saveRencanaCetakSusulan();"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditStatusRencana" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditStatusRencana">&times;</button>
              <h4 class="modal-title text-blue">Edit Status Rencana</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td>Status Pengerjaan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbStatusPengerjaan">
                        <option value="">--Pilih Status Pengerjaan---</option>
                        <option value="PENDING">PENDING</option>
                        <option value="PROGRESS">PROGRESS</option>
                        <option value="FINISH">FINISH</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnUbahStatusPengerjaan" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditMesin" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditMesin">&times;</button>
              <h4 class="modal-title text-blue">Ganti Mesin</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">No. Mesin</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbNoMesin">
                        <option value="">--Pilih Mesin--</option>
                        <option value="Mesin 1"> Mesin 1 </option>
                        <option value="Mesin 2"> Mesin 2 </option>
                        <option value="Mesin 3"> Mesin 3 </option>
                        <option value="Mesin 4"> Mesin 4 </option>
                        <option value="Mesin 5"> Mesin 5 </option>
                        <option value="Mesin 6"> Mesin 6 </option>
                        <option value="Mesin 7"> Mesin 7 </option>
                        <option value="Mesin 8"> Mesin 8 </option>
                        <option value="Mesin 9"> Mesin 9 </option>
                        <option value="Mesin 10"> Mesin 10 </option>
                        <option value="Mesin 11"> Mesin 11 </option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditMesin" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalInputHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="width:1110px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalInputHasil">&times;</button>
              <h4 class="modal-title text-blue">Input Hasil</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" id="txtKdGdRollPolos" value="">
                  <input type="hidden" id="txtKdGdRollCetak" value="">
                  <table class="table table-responsive">
                    <tr>
                      <td>Kode Transaksi</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKodeTransaksi" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
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
                      <td>Nama Operator</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaOperator" class="form-control" placeholder="Masukan Nama Operator">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtMerek" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>No. Mesin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNoMesin" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtUkuran" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Warna Plastik</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaPlastik" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Pengerjaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPengerjaanHasil" class="form-control" placeholder="Masukan Tanggal Pengerjaan" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Barang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJenisBarang" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtMerekBahan" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Pengambilan Berat (Extruder)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratPengambilanExtruder" class="form-control number" value="0" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Pengambilan Bobin (Extruder)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBobinPengambilanExtruder" class="form-control number" value="0" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Pengambilan Payung Extruder</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungPengambilanExtruder" class="form-control number" value="0" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Pengambilan Payung Kuning (Extruder)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuningPengambilanExtruder" class="form-control number" value="0" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat Bahan (Gudang)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratBahan" class="form-control number" placeholder="Masukan Jumlah Berat Bahan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Bahan (Gudang)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungBahan" class="form-control number" placeholder="Masukan Jumlah Payung Bahan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Kuning Bahan (Gudang)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungKuningBahan" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Bahan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Bobin Bahan (Gudang)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobinBahan" class="form-control number" placeholder="Masukan Jumlah Bobin Bahan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Sisa Berat Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahSisaBeratBahan" class="form-control number" placeholder="Masukan Jumlah Sisa Berat Bahan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratHasilCetak" class="form-control number" placeholder="Masukan Jumlah Berat Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungHasilCetak" class="form-control number" placeholder="Masukan Jumlah Payung Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Kuning Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungKuningHasilCetak" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Hasil Catak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Bobin Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobinHasilCetak" class="form-control number" placeholder="Masukan Jumlah Bobin Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat Payung Terbuang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratPayungTerbuang" class="form-control number" placeholder="Masukan Jumlah Berat Payung Terbuang">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat Payung Kuning Terbuang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratPayungKuningTerbuang" class="form-control number" placeholder="Masukan Jumlah Berat Payung Kuning Terbuang">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat Bobin Terbuang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratBobinTerbuang" class="form-control number" placeholder="Masukan Jumlah Berat Bobin Terbuang">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Apal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="txtJenisApal">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="trJumlahApal" style="display:none">
                      <td>Jumlah Apal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahApal" class="form-control number" placeholder="Masukan Jumlah Apal">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Roll</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbJenisRoll" onchange="hitungRollPipa();">
                            <option value="">--Pilih Jenis Roll--</option>
                            <option value="PAYUNG">PAYUNG</option>
                            <option value="PAYUNG_KUNING">PAYUNG KUNING</option>
                            <option value="BOBIN">BOBIN</option>
                            <option value="PAYUNG_KUNING_PAYUNG">PAYUNG KUNING & PAYUNG</option>
                            <option value="PAYUNG_BOBIN">PAYUNG & BOBIN</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <table class="table table-responsive" id="tablePAYUNG" style="display:none;">
                            <tr>
                              <td width="20%">Sisa Payung</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtSisaPayung" class="form-control number" placeholder="Masukan Sisa Payung" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                          </table>

                          <table class="table table-responsive" id="tablePAYUNG_KUNING" style="display:none;">
                            <tr>
                              <td width="20%">Sisa Payung Kuning</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtSisaPayungKuning" class="form-control number" placeholder="Masukan Sisa Payung Kuning" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                          </table>

                          <table class="table table-responsive" id="tableBOBIN" style="display:none;">
                            <tr>
                              <td width="20%">Panjang</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtPanjangPlastik" class="form-control" placeholder="Masukan Panjang Plastik" readonly>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Double / Single</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtDoubleSingle" class="form-control number" placeholder="Masukan Double / Single" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Sisa Bobin</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtBobin" class="form-control number" placeholder="Masukan Bobin" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                          </table>

                          <table class="table table-responsive" id="tablePAYUNG_KUNING_PAYUNG" style="display:none;">
                            <tr>
                              <td width="20%">Jumlah Payung</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtPayung_PKP" class="form-control number" placeholder="Masukan Jumlah Payung" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Jumlah Payung Kuning</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtPayungKuning_PKP" class="form-control number" placeholder="Masukan Jumlah Payung Kuning" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                          </table>

                          <table class="table table-responsive" id="tablePAYUNG_BOBIN" style="display:none;">
                            <tr>
                              <td width="20%">Sisa Payung</td>
                              <td width="1%">:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtPayung_PB" class="form-control number" placeholder="Masukan Jumlah Payung" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Panjang Plastik</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtPanjangPlastik_PB" class="form-control" placeholder="Masukan Panjang Plastik" readonly>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Double / Single</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtDoubleSingle_PB" class="form-control number" placeholder="Masukan Double/Single" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Sisa Bobin</td>
                              <td>:</td>
                              <td>
                                <div class="form-group has-warning">
                                  <input type="text" id="txtBobin_PB" class="form-control number" placeholder="Masukan Jumlah Bobin" onkeyup="hitungRollPipa();">
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Cat Murni</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div id="tableCatMurniWrapper" style="width:100%; position:relative; float:left;">
                            <button type="button" id="btnTambahCatMurni" class="btn btn-md btn-flat btn-primary pull-right" style="float:left; margin-top:10px;"><i class="fa fa-plus"></i> Tambah</button>
                            <form name="frmCatMurni">
                              <table class="table table-responsive" style="float:left; width:85%;">
                                <tr>
                                  <td>
                                    <select class="form-control" name="cmbCatMurni" id="cmbCatMurni1">
                                      <option value="">--Pilih Jenis Cat Murni--</option>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="txtJumlahCatMurni" class="form-control number" placeholder="Masukan Jumlah Cat Murni">
                                  </td>
                                  <td>
                                    <input type="text" name="txtSisaCatMurni" class="form-control number" placeholder="Masukan Sisa Cat Murni">
                                  </td>
                                </tr>
                              </table>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Cat Campur</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div id="tableCatCampurWrapper" style="width:100%; position:relative; float:left;">
                            <button type="button" id="btnTambahCatCampur" class="btn btn-md btn-flat btn-danger pull-right" style="float:left; margin-top:10px;"><i class="fa fa-plus"></i> Tambah</button>
                            <form name="frmCatCampur">
                              <table class="table table-responsive" style="float:left; width:85%;">
                                <tr>
                                  <td>
                                    <select class="form-control" name="cmbCatCampur" id="cmbCatCampur1">
                                      <option value="">--Pilih Jenis Cat Campur--</option>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="txtJumlahCatCampur" class="form-control number" placeholder="Masukan Jumlah Cat Campur">
                                  </td>
                                  <td>
                                    <input type="text" name="txtSisaCatCampur" class="form-control number" placeholder="Masukan Sisa Cat Campur">
                                  </td>
                                </tr>
                              </table>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Minyak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div id="tableMinyakWrapper" style="width:100%; position:relative; float:left;">
                            <button type="button" id="btnTambahMinyak" class="btn btn-md btn-flat btn-success pull-right" style="float:left; margin-top:10px;"><i class="fa fa-plus"></i> Tambah</button>
                            <form name="frmMinyak">
                              <table class="table table-responsive" style="float:left; width:85%;">
                                <tr>
                                  <td>
                                    <select class="form-control" name="cmbMinyak" id="cmbMinyak1">
                                      <option value="">--Pilih Jenis Minyak--</option>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="txtJumlahMinyak" class="form-control number" placeholder="Masukan Jumlah Minyak">
                                  </td>
                                  <td>
                                    <input type="text" name="txtSisaMinyak" class="form-control number" placeholder="Masukan Sisa Minyak">
                                  </td>
                                </tr>
                              </table>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKeterangan" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Roll Pipa</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtRollPipa" class="form-control number" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Plus/Minus</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPlusminus" class="form-control numberFive" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <label class="text-red pull-left">
                NOTE : Untuk Pengambilan Extruder Silahkan Input Terlebih Dahulu Di Menu Pengambilan Extruder
              </label>
              <button type="button" id="btnSimpanHasil" class="btn btn-md btn-flat btn-success" onclick="saveInputHasilCetak();"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalDetailJob" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailJob">&times;</button>
              <h4 class="modal-title text-blue" id="modal-title">Detail Hasil Job</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tablePemakaianBahanCetak">
                    <thead>
                      <th>Nama Bahan</th>
                      <th>Jumlah Pengambilan</th>
                      <th>Sisa Pengambilan</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditPenggunaanBahan" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditDetailJobCetak">&times;</button>
              <h4 class="modal-title text-blue">Edit Penggunaan Bahan</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="10%" id="tdJenisBarang">Jenis Barang</td>
                      <td width="1%">:</td>
                      <td>
                        <table class="table table-responsive">
                          <tr>
                            <td>
                              <div class="form-group has-warning">
                                <select class="form-control" id="cmbJenis">

                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group has-warning">
                                <input type="text" id="txtJumlahPengambilan" class="form-control number" placeholder="Masukan Jumlah Pengambilan">
                              </div>
                            </td>
                            <td>
                              <div class="form-group has-warning">
                                <input type="text" id="txtSisaPengambilan" class="form-control number" placeholder="Masukan Sisa Pengambilan">
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditPenggunaanBahan" class="btn btn-md btn-flat btn-primary"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

    </section>

</div>
