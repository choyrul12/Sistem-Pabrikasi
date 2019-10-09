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
              <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalCariHistoriSisa" data-backdrop="static"><i class="fa fa-search"></i> Cari History Sisa</button>
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariHistoryPolos" data-backdrop="static" onclick="modalTambahHistoryTertinggal('POLOS')"><i class="fa fa-plus"></i> Tambah History Sisa Polos Yang Tertinggal</button>
              <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalCariHistoryCetak" data-backdrop="static" onclick="modalTambahHistoryTertinggal('CETAK')"><i class="fa fa-plus"></i> Tambah History Sisa Cetak Yang Tertinggal</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListHistorySisa">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Sisa</th>
                      <th>Tanggal Potong</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Merek</th>
                      <th>Berat</th>
                      <th>Payung</th>
                      <th>Payung Kuning</th>
                      <th>Bobin</th>
                      <th>Status Pengambilan</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistoriSisa" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistoriSisa">&times;</button>
              <h4 class="modal-title text-blue">Cari History Sisa</h4>
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
                            <input type="text" id="txtTanggalAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Akhir</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggalAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
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
              <button type="button" id="btnSearchHistorySisa" class="btn btn-md btn-flat btn-success" onclick="searchHistorySisa();"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistoryPolos" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahHistoryPolos">&times;</button>
              <h4 class="modal-title text-blue">Tambah History Sisa Polos Tertinggal</h4>
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
                            <input type="text" id="txtTglAwal_Polos" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Akhir</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhir_Polos" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
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
              <button type="button" id="btnCariHistorySisaPolosTertinggal" class="btn btn-md btn-flat btn-success"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistoryCetak" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahHistoryCetak">&times;</button>
              <h4 class="modal-title text-blue">Tambah History Sisa Cetak Tertinggal</h4>
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
                            <input type="text" id="txtTglAwal_Cetak" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Akhir</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhir_Cetak" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
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
              <button type="button" id="btnCariHistorySisaCetakTertinggal" class="btn btn-md btn-flat btn-success"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalSisaPengambilan_POLOS" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalSisaPengambilan_POLOS">&times;</button>
              <h4 class="modal-title text-blue">Input Data Sisa Pengambilan Polos</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Ukuran</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuranPOLOS">

                          </select>
                          <input type="hidden" id="txtKdGdRollPOLOS" value="">
                          <input type="hidden" id="txtKetBarangPOLOS" value="">
                        </div>
                      </td>
                    </tr>
                    <div class="trJumlahPOLOS">
                      <tr>
                        <td>Panjang</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtPanjangPlastikPOLOS" class="form-control" placeholder="Masukan Panjang Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtMerekPOLOS" class="form-control" placeholder="Masukan Merek" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Warna Plastik</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtWarnaPlastikPOLOS" class="form-control" placeholder="Masukan Warna Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Permintaan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtPermintaanPOLOS" class="form-control" placeholder="Masukan Jenis Permintaan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSisaPOLOS" class="form-control number" placeholder="Masukan Jumlah Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungPOLOS" class="form-control number" placeholder="Masukan Jumlah Payung Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungKuningPOLOS" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bobin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobinPOLOS" class="form-control number" placeholder="Masukan Jumlah Bobin">
                          </div>
                        </td>
                      </tr>
                      <tr id="trUkuranTumpukPOLOS" style="display:none;">
                        <td>Ukuran Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbUkuranTumpukPOLOS">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr id="trSisaTumpukPOLOS" style="display:none;">
                        <td>Sisa Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSisaTumpukPOLOS" class="form-control number" placeholder="Masukan Jumlah Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trPayungTumpukPOLOS" style="display:none;">
                        <td>Payung Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungTumpukPOLOS" class="form-control number" placeholder="Masukan Jumlah Payung Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trPayungKuningTumpukPOLOS" style="display:none;">
                        <td>Payung Kuning Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungKuningTumpukPOLOS" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trBobinTumpukPOLOS" style="display:none;">
                        <td>Bobin Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobinTumpukPOLOS" class="form-control number" placeholder="Masukan Jumlah Bobin Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Shift</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbShiftPOLOS">
                              <option value="">--Pilih Shift--</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                    </div>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKeteranganPOLOS">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="POTONG BESOK">POTONG BESOK</option>
                            <option value="KEMBALI GUDANG">KEMBALI GUDANG (SISA MESIN)</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="trTanggalAwalPOLOS" style="display:none;">
                      <td id="tdTanggalAwal">Tanggal Sisa</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwalPOLOS" class="form-control" placeholder="Masukan Tanggal Sisa" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trTanggalAkhirPOLOS" style="display:none;">
                      <td id="tdTanggalAkhirPOLOS">Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhirPOLOS" class="form-control" placeholder="Masukan Tanggal Kembali" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahSisaPengambilanPOLOS" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>

                <div class="col-md-12">
                  <h4 class="text-blue">Berat Pengambilan Operator</h4>
                  <table class="table table-responsive table-striped" id="tableBeratPengambilanOperatorPOLOS">
                    <thead>
                      <th>No.</th>
                      <th>Ukuran</th>
                      <th>Merek</th>
                      <th>Warna Plastik</th>
                      <th>Jumlah Sisa</th>
                      <th>Jumlah Payung</th>
                      <th>Jumlah Payung Kuning</th>
                      <th>Bobin</th>
                      <th>Keterangan</th>
                      <th>Shift</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="height:30px;">
              <button type="button" id="btnSimpanSisaPengambilanPOLOS" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalSisaPengambilan_CETAK" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalSisaPengambilan_CETAK">&times;</button>
              <h4 class="modal-title text-blue">Input Data Sisa Pengambilan Cetak</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Ukuran</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuranCETAK">

                          </select>
                          <input type="hidden" id="txtKdGdRollCETAK" value="">
                          <input type="hidden" id="txtKetBarangCETAK" value="">
                        </div>
                      </td>
                    </tr>
                    <div class="trJumlahCETAK">
                      <tr>
                        <td>Panjang</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtPanjangPlastikCETAK" class="form-control" placeholder="Masukan Panjang Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtMerekCETAK" class="form-control" placeholder="Masukan Merek" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Warna Plastik</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtWarnaPlastikCETAK" class="form-control" placeholder="Masukan Warna Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Permintaan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtPermintaanCETAK" class="form-control" placeholder="Masukan Jenis Permintaan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSisaCETAK" class="form-control number" placeholder="Masukan Jumlah Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungCETAK" class="form-control number" placeholder="Masukan Jumlah Payung Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungKuningCETAK" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bobin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobinCETAK" class="form-control number" placeholder="Masukan Jumlah Bobin">
                          </div>
                        </td>
                      </tr>
                      <tr id="trUkuranTumpukCETAK" style="display:none;">
                        <td>Ukuran Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbUkuranTumpukCETAK">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr id="trSisaTumpukCETAK" style="display:none;">
                        <td>Sisa Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSisaTumpukCETAK" class="form-control number" placeholder="Masukan Jumlah Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trPayungTumpukCETAK" style="display:none;">
                        <td>Payung Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungTumpukCETAK" class="form-control number" placeholder="Masukan Jumlah Payung Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trPayungKuningTumpukCETAK" style="display:none;">
                        <td>Payung Kuning Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungKuningTumpukCETAK" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trBobinTumpukCETAK" style="display:none;">
                        <td>Bobin Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobinTumpukCETAK" class="form-control number" placeholder="Masukan Jumlah Bobin Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Shift</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbShiftCETAK">
                              <option value="">--Pilih Shift--</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                    </div>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKeteranganCETAK">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="POTONG BESOK">POTONG BESOK</option>
                            <option value="KEMBALI GUDANG">KEMBALI GUDANG (SISA MESIN)</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="trTanggalAwalCETAK" style="display:none;">
                      <td id="tdTanggalAwal">Tanggal Sisa</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwalCETAK" class="form-control" placeholder="Masukan Tanggal Sisa" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trTanggalAkhirCETAK" style="display:none;">
                      <td id="tdTanggalAkhirCETAK">Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhirCETAK" class="form-control" placeholder="Masukan Tanggal Kembali" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahSisaPengambilanCETAK" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>

                <div class="col-md-12">
                  <h4 class="text-blue">Berat Pengambilan Operator</h4>
                  <table class="table table-responsive table-striped" id="tableBeratPengambilanOperatorCETAK">
                    <thead>
                      <th>No.</th>
                      <th>Ukuran</th>
                      <th>Merek</th>
                      <th>Warna Plastik</th>
                      <th>Jumlah Sisa</th>
                      <th>Jumlah Payung</th>
                      <th>Jumlah Payung Kuning</th>
                      <th>Bobin</th>
                      <th>Keterangan</th>
                      <th>Shift</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="height:30px;">
              <button type="button" id="btnSimpanSisaPengambilanCETAK" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditSisaPengambilan_POLOS" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditSisaPengambilan_POLOS">&times;</button>
              <h4 class="modal-title text-blue">Input Data Sisa Pengambilan Polos</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <div class="trJumlahPOLOS_Edit">
                      <tr>
                        <td width="20%">Panjang</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtPanjangPlastikPOLOS_Edit" class="form-control" placeholder="Masukan Panjang Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtMerekPOLOS_Edit" class="form-control" placeholder="Masukan Merek" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Warna Plastik</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtWarnaPlastikPOLOS_Edit" class="form-control" placeholder="Masukan Warna Plastik" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Permintaan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group">
                            <input type="text" id="txtPermintaanPOLOS_Edit" class="form-control" placeholder="Masukan Jenis Permintaan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSisaPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Payung Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungKuningPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bobin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobinPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Bobin">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Double / Single</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahDoubleSinglePOLOS_Edit" class="form-control number" placeholder="Masukan Double / Single">
                          </div>
                        </td>
                      </tr>
                      <tr id="trUkuranTumpukPOLOS_Edit" style="display:none;">
                        <td>Ukuran Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbUkuranTumpukPOLOS_Edit">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr id="trSisaTumpukPOLOS_Edit" style="display:none;">
                        <td>Sisa Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSisaTumpukPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trPayungTumpukPOLOS_Edit" style="display:none;">
                        <td>Payung Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungTumpukPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Payung Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trPayungKuningTumpukPOLOS_Edit" style="display:none;">
                        <td>Payung Kuning Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayungKuningTumpukPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Sisa Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr id="trBobinTumpukPOLOS_Edit" style="display:none;">
                        <td>Bobin Tumpuk</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobinTumpukPOLOS_Edit" class="form-control number" placeholder="Masukan Jumlah Bobin Tumpuk">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Shift</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbShiftPOLOS_Edit">
                              <option value="">--Pilih Shift--</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                    </div>
                    <!-- <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKeteranganPOLOS_Edit">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="POTONG BESOK">POTONG BESOK</option>
                            <option value="KEMBALI GUDANG">KEMBALI GUDANG (SISA MESIN)</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="trTanggalAwalPOLOS_Edit" style="display:none;">
                      <td id="tdTanggalAwal_Edit">Tanggal Sisa</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwalPOLOS_Edit" class="form-control" placeholder="Masukan Tanggal Sisa" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trTanggalAkhirPOLOS_Edit" style="display:none;">
                      <td id="tdTanggalAkhirPOLOS_Edit">Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhirPOLOS_Edit" class="form-control" placeholder="Masukan Tanggal Kembali" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr> -->
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahSisaPengambilanPOLOS_Edit" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-pencil"></i> Ubah</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" id="btnSimpanSisaPengambilanPOLOS" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button> -->
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
