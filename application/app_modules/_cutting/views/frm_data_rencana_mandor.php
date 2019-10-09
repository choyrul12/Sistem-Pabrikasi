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
              <div class="row">
                <div class="col-md-12">
                  <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalSisaPengambilan_POLOS" data-backdrop="static" onclick="modalSisaPengambilan('POLOS');"><i class="fa fa-book"></i> Sisa Pengambilan Polos</button>
                  <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalSisaPengambilan_CETAK" data-backdrop="static" onclick="modalSisaPengambilan('CETAK');"><i class="fa fa-book"></i> Sisa Pengambilan Cetak</button>
                  <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalTambahRencanaSusulan" data-backdrop="static" onclick="modalBuatRencanaKerjaSusulan();"><i class="fa fa-plus"></i> Buat Rencana Susulan</button>
                  <button type="button" class="btn btn-md btn-flat btn-info" onclick="datatablesRencanaMandorPotong('<?php echo date("Y-m-d"); ?>')"><i class="fa fa-book"></i> Rencana Kerja Tanggal <?php echo date("d F Y"); ?></button>
                  <button type="button" class="btn btn-md btn-flat btn-danger" onclick="datatablesRencanaMandorPotong('<?php echo date("Y-m-d",strtotime("-1 days")); ?>')"><i class="fa fa-book"></i> Rencana Kerja Tanggal <?php echo date("d F Y",strtotime("-1 days")); ?></button>
                  <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalSearchRencanaKerja" data-backdrop="static"><i class="fa fa-search"></i> Cari Rencana</button>
                </div>
              </div>
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
                  <table class="table table-responsive table-striped" id="tableDataRencanaMandor">
                    <thead>
                      <th>No.</th>
                      <th>Tgl. Rencana</th>
                      <th>No. Mesin</th>
                      <th>Order</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Tebal</th>
                      <th>Strip</th>
                      <th>Jumlah</th>
                      <th>Sisa</th>
                      <th>Keterangan</th>
                      <th>Gambar</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h4 class="box-title text-green">Hasil Job Potong</h4>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableHasilJobPotong">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Rencana</th>
                      <th>No. Mesin</th>
                      <th>Nama Customer</th>
                      <th>Merek</th>
                      <th>Tebal</th>
                      <th>Ukuran</th>
                      <th>Berat Pengambilan (Tanpa Sisa)</th>
                      <th>Warna Plastik</th>
                      <th>Hasil (Lembar)</th>
                      <th>Hasil (Berat)</th>
                      <th>Total Apal</th>
                      <th>Total Pipa</th>
                      <th>Total Sisa</th>
                      <th>Plus/Minus</th>
                      <th>Shift</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-md btn-flat btn-primary" onclick="saveHasilJobPotong('<?php echo date('Y-m-d'); ?>')"><i class="fa fa-check"></i> Simpan</button>
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

      <div class="modal fade" id="modalTambahRencanaSusulan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahRencanaSusulan">&times;</button>
              <h4 class="modal-title text-blue">Buat Rencana Kerja Susulan</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Cutting</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKodePotong" class="form-control" placeholder="Masukan Kode Potong" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Rencana</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglRencana" class="form-control" placeholder="Masukan Tanggal Rencana" readonly>
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
                          <input type="text" id="txtNoMesin" class="form-control" placeholder="Masukan No. Mesin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Mesin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahMesin" class="form-control" placeholder="Masukan Jumlah Mesin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Order</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer" class="form-control" placeholder="Masukan Nama Customer">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdHasil">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td id="trKeteranganMerek">Keterangan Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtKeteranganMerek" class="form-control" placeholder="Masukan Keterangan Merek">
                        </div>
                      </td>
                    </tr>
                    <tr id="trBahanPolos" style="display:none;">
                      <td>Bahan Polos</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdBahan">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTebalPlastik" class="form-control" placeholder="Masukan Tebal Plastik">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Rencana Yang Mau Dibuat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPermintaan" class="form-control number" placeholder="Masukan Jumlah Permintaan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Satuan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbSatuan">
                            <option value="">--Pilih Satuan--</option>
                            <option value="KG">KG</option>
                            <option value="LEMBAR">LEMBAR</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Shift</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbShiftRencana">
                            <option value="">--Pilih Shift--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Strip</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div id="comboStripWrapper">
                            <select class="form-control" id="cmbWarnaStrip">
                              <option value="">--Pilih Warna Strip--</option>
                              <option value="MERAH PUTIH">Merah Putih</option>
                              <option value="MERAH">Merah</option>
                              <option value="PINK">Pink</option>
                              <option value="MERAH ORANGE">Merah Orange</option>
                              <option value="PUTIH SUSU">Putih Susu</option>
                              <option value="LOSE">Lose</option>
                              <option value="BIRU">Biru</option>
                              <option value="CUSTOM">Custom</option>
                            </select>
                          </div>
                          <div id="textStripWrapper" style="display:none;">
                            <div class="input-group" style="float:left; width:100%;">
                              <input type="text" id="txtWarnaStrip" class="form-control" placeholder="Masukan Strip" style="width:90%; margin-right:10px;">
                              <button type="button" class="close" id="btnClose" style="float:left;">&times;</button>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtBeratRencana" class="form-control" placeholder="Masukan Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtKeterangan" class="form-control" placeholder="Masukan Keterangan Jika Tumpuk">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormBuatRencanaKerjaSusulan();"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahRencanaSusulanPending" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <h4 class="text-blue">List Rencana Kerja Susulan</h4>
                  <table class="table table-responsive table-striped" id="tableListRencanaKerjaSusulanPending">
                    <thead>
                      <th>No.</th>
                      <th>No.Mesin</th>
                      <th>Customer</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Tebal</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa Sebelumnya</th>
                      <th>Strip</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="height:30px;">
              <button type="button" id="btnSimpanRencanaSusulan" class="btn btn-md btn-flat btn-success" onclick="saveRencanaPotongSusulan();"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalSearchRencanaKerja" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalSearchRencanaKerja">&times;</button>
              <h4 class="modal-title text-blue">Cari Rencana Kerja</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td>Tanggal Rencana</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglCariRencana" class="form-control" placeholder="Masukan Tanggal Rencana" readonly>
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
              <button type="button" id="btnCariRencanaKerja" class="btn btn-md btn-flat btn-success" onclick="searchRencanaMandorPotong();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditMerek" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditMerek">&times;</button>
              <h4 class="modal-title text-blue">Ubah Merek</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Ukuran</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdGdHasil">

                          </select>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnUbahMerek" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditTanggal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditTanggal">&times;</button>
              <h4 class="modal-title text-blue">Ubah Tanggal Rencana</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal Rencana</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" class="form-control" id="txtTanggalRencana" readonly>
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
              <button type="button" id="btnEditTanggalRencana" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditMesin" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditMesin">&times;</button>
              <h4 class="modal-title text-blue">Edit Mesin</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">No.Mesin</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNoMesin_Edit" class="form-control" placeholder="Masukan No. Mesin">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditMesin" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalInputHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalInputHasil">&times;</button>
              <h4 class="modal-title text-blue">Input Hasil Potong</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
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
                          <input type="text" class="form-control number txtLembar" placeholder="Masukan Jumlah Lembar">
                        </div>
                      </td>
                      <td width="5%">Berat</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number txtBerat" placeholder="Masukan Jumlah Berat">
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
                          <input type="text" id="txtBeratPengambilan" class="form-control number" placeholder="Masukan Berat Pengambilan">
                        </div>
                      </td>
                      <td width="10%">Bobin (Pengambilan)</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBobinPengambilan" class="form-control number" placeholder="Masukan Bobin (Pengambilan)">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung (Pengambilan)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungPengambilan" class="form-control number" placeholder="Masukan Payung (Pengambilan)">
                        </div>
                      </td>
                      <td>Payung Kuning (Pengambilan)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuningPengambilan" class="form-control number" placeholder="Masukan Payung Kuning (Pengambilan)">
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
                          <select id="cmbUkuranTumpuk" class="form-control">

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
                          <input type="text" id="txtSisaTumpuk" class="form-control number" placeholder="Masukan Jumlah Sisa Tumpuk">
                        </div>
                      </td>
                      <td width="10%">Sisa Bobin Tumpuk</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtSisaBobinTumpuk" class="form-control number" placeholder="Masukan Sisa Bobin Tumpuk">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Sisa Payung Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtSisaPayungTumpuk" class="form-control number" placeholder="Masukan Sisa Payung Tumpuk">
                        </div>
                      </td>
                      <td>Sisa Payung Kuning Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtSisaPayungKuningTumpuk" class="form-control number" placeholder="Masukan Sisa Payung Kuning Tumpuk">
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
                                  <input type="text" id="txtRumusRollBobinPayung_Bobin" class="form-control number" placeholder="Masukan Rumus" value="30" readonly>
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
                          <input type="text" id="txtKetarangan" class="form-control" placeholder="Masukan Keterangan" onkeyup="hitungRollPipa(); hitungPlusMinus();" onmousedown="hitungRollPipa(); hitungPlusMinus();">
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
            <div class="modal-footer" style="height:30px;">
              <button type="button" id="btnSaveHasilExtruder" class="btn btn-md btn-flat btn-primary" onclick="saveInputHasil();"><i class="fa fa-check"></i> Simpan</button>
              <button type="button" class="btn btn-md btn-flat btn-danger"><i class="fa fa-remove"></i> Batal</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditRencana" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahRencanaSusulan">&times;</button>
              <h4 class="modal-title text-blue">Edit Rencana</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" id="txtKdPPIC_Edit" value="">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Cutting</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKodePotong_Edit" class="form-control" placeholder="Masukan Kode Potong" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Rencana</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglRencana_Edit" class="form-control" placeholder="Masukan Tanggal Rencana" readonly>
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
                          <input type="text" id="txtNoMesin_Edit1" class="form-control" placeholder="Masukan No. Mesin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Mesin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahMesin_Edit" class="form-control" placeholder="Masukan Jumlah Mesin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Order</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer_Edit" class="form-control" placeholder="Masukan Nama Customer">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdHasil_Edit">

                          </select>
                          <small class="text-red">NOTE : Jika Tidak Ingin Mengubah Merek Maka Kolom Merek Dikosongkan Saja.</small>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td id="trKeteranganMerek_Edit">Keterangan Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtKeteranganMerek_Edit" class="form-control" placeholder="Masukan Keterangan Merek">
                        </div>
                      </td>
                    </tr>
                    <tr id="trBahanPolos_Edit" style="display:none;">
                      <td>Bahan Polos</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdBahan_Edit">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTebalPlastik_Edit" class="form-control" placeholder="Masukan Tebal Plastik">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Rencana Yang Mau Dibuat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPermintaan_Edit" class="form-control number" placeholder="Masukan Jumlah Permintaan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Satuan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbSatuan_Edit">
                            <option value="">--Pilih Satuan--</option>
                            <option value="KG">KG</option>
                            <option value="LEMBAR">LEMBAR</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Shift</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbShiftRencana_Edit">
                            <option value="">--Pilih Shift--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Strip</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div id="comboStripWrapper_Edit">
                            <select class="form-control" id="cmbWarnaStrip_Edit">
                              <option value="">--Pilih Warna Strip--</option>
                              <option value="MERAH PUTIH">Merah Putih</option>
                              <option value="MERAH">Merah</option>
                              <option value="PINK">Pink</option>
                              <option value="MERAH ORANGE">Merah Orange</option>
                              <option value="CUSTOM">Custom</option>
                            </select>
                          </div>
                          <div id="textStripWrapper_Edit" style="display:none;">
                            <div class="input-group" style="float:left; width:100%;">
                              <input type="text" id="txtWarnaStrip_Edit" class="form-control" placeholder="Masukan Strip" style="width:90%; margin-right:10px;">
                              <button type="button" class="close" id="btnClose_Edit" style="float:left;">&times;</button>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtBeratRencana_Edit" class="form-control" placeholder="Masukan Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtKeterangan_Edit" class="form-control" placeholder="Masukan Keterangan Jika Tumpuk">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <!-- <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormBuatRencanaKerjaSusulan();"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahRencanaSusulanPending" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button> -->
                </div>
              </div>
            </div>
            <div class="modal-footer" style="height:30px;">
              <button type="button" id="btnSimpanRencanaSusulan_Edit" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
