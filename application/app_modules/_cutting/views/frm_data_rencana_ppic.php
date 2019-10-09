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
                <h4 class="text-blue">List Rencana Kerja PPIC</h4>
              </div>
              <div class="col-md-9">
                <button type="button" class="btn btn-md btn-flat btn-success" onclick="datatablesRencanaPpicPotong('<?php echo date("Y-m-d",strtotime("+1 days")); ?>','<?php echo date("Y-m-d",strtotime("+1 days")); ?>')"><i class="fa fa-mail-forward"></i> Rencana Kerja Tanggal <?php echo date("d F Y",strtotime("+1 days")); ?></button>
                <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalCariRencanaKerja" data-backdrop="static"><i class="fa fa-search"></i> Cari Rencana Kerja</button>
                <!-- <button type="button" class="btn btn-md btn-flat btn-danger" data-toggle="modal" data-target="#modalInputRencanaKerja" data-backdrop="static">Test</button> -->
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
                  <table class="table table-responsive table-striped table-bordered" id="tableRencanaPpicPotong">
                    <thead>
                      <th style="width: 10px;">No.</th>
                      <th>Tanggal</th>
                      <th>Customer</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Jumlah Mesin</th>
                      <th>Tebal</th>
                      <th>Berat</th>
                      <th>Jumlah</th>
                      <th>Sisa</th>
                      <th>Strip</th>
                      <th>Keterangan</th>
                      <th>No. Mesin</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalMintaBahanRoll" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalMintaBahanRoll">&times;</button>
              <h4 class="modal-title text-blue">Minta Bahan Roll</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Ukuran</td>
                      <td width="1%">:</td>
                      <td>

                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Permintaan</td>
                      <td>:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Warna</td>
                      <td>:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Jumlah Permintaan</td>
                      <td>:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Tanggal Permintaan</td>
                      <td>:</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariRencanaKerja" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariRencanaKerja">&times;</button>
              <h4 class="modal-title text-blue">Cari Rencana Kerja</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td>Tanggal Awal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>Tanggal Akhir</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr> -->
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariRencana" class="btn btn-md btn-flat btn-primary" onclick="searchRencanaPpicPotong();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="modal fade" id="modalKonversiBerat" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKonversiBerat">&times;</button>
              <h4 class="modal-title text-blue">Konversi Berat Ke Kilogram</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Jumlah Permintaan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtJumlahPermintaan_Konversi" class="form-control number" placeholder="Masukan Jumlah Permintaan" readonly style="width:90%; float:left; margin-right:10px;">
                          <label class="text-blue" style="float:left;" id="lblSatuanAsli_Konversi">Lembar</label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtUkuran_Konversi" class="form-control" placeholder="Masukan Ukuran" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtBerat_Konversi" class="form-control" placeholder="Masukan Berat" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtTebal_Konversi" class="form-control" placeholder="Masukan Tebal" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Konversi</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKonversi_Konversi" class="form-control number" placeholder="Masukan Jumlah Konversi" style="width:90%; float:left; margin-right:10px;">
                          <label class="text-blue" style="float:left;">KG</label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Satuan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbSatuan">
                            <option value="">Pilih Satuan Konversi</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSaveKonversi" class="btn btn-md btn-flat btn-primary"><i class="fa fa-check"></i> Simpan Data</button>
              <button type="button" id="btnResetKonversi" class="btn btn-md btn-flat btn-danger"><i class="fa fa-remove"></i> Batal Konversi</button>
            </div>
          </div>
        </div>
      </div> -->

      <div class="modal fade" id="modalEditStatus" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditStatus">&times;</button>
              <h4 class="modal-title text-blue">Edit Status Pengerjaan</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Status</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbStatus_Edit">
                            <option value="FINISH">Finish</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnUbahStatusRencana" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
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

      <div class="modal fade" id="modalEditKeteranganMandor" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditKeteranganMandor">&times;</button>
              <h4 class="modal-title text-blue">Edit Keterangan Mandor</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Keterangan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKetMandor_Edit" class="form-control" placeholder="Masukan Keterangan Mandor">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditKetMandor" class="btn btn-md btn-flat btn-primary"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalInputRencanaKerja" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalInputMesin">&times;</button>
              <h4 class="modal-title text-blue">Buat Rencana Kerja</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive" id="tableRencanaPpic">
                    <thead>
                      <th>Tanggal</th>
                      <th>Customer</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna Plastik</th>
                      <th>Tebal</th>
                      <th>Berat</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa</th>
                      <th>Strip</th>
                      <th>Keterangan</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <h4 class="text-blue">Buat Rencana Kerja</h4>
                  <table class="table table-responsive">
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
                      <td>Tanggal Rencana</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggalRencana" class="form-control" placeholder="Pilih Tanggal Rencana" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Mesin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtMesin" class="form-control" placeholder="Masukan Mesin">
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
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtUkuran" class="form-control" placeholder="Masukan Ukuran" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td id="tdBeratBahan">Berat Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdGdRoll">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtCustomer" class="form-control" placeholder="Masukan Nama Customer" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tebal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTebal" class="form-control" placeholder="Masukan Tebal Plastik">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKeterangan" class="form-control" placeholder="Masukan Keterangan">
                          <small class="text-red">NB : Keterangan Wajib Diisi, Untuk Ukuran Tumpuk Harap Diisi Dengan Tumpuk</small>
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
                      <td>Jumlah Pembuatan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPembuatan" class="form-control number" placeholder="Masukan Jumlah Pembuatan">
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
                      <td>Gambar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <img src="" alt="" id="imgContohPlastik" class="img-responsive gambar" width="100px" height="100px">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <input type="hidden" id="txtKdPpic" value="">
                  <input type="hidden" id="txtKdGdHasil" value="">
                  <input type="hidden" id="txtWarnaPlastik" value="">
                  <input type="hidden" id="txtSatuan" value="">
                  <input type="hidden" id="txtMerek" value="">
                  <input type="hidden" id="txtKetMerek" value="">
                  <input type="hidden" id="txtJnsPermintaan" value="">
                  <input type="hidden" id="txtJmlPermintaan" value="">
                  <input type="hidden" id="txtBerat" value="">
                </div>
                <div class="col-md-12">
                  <button type="button" id="btnReset" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormBuatRencanaPending();"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahRencanaPotong" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveTambahRencanaPotongPending();"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableRencanaPotongPending">
                    <thead>
                      <th>No.</th>
                      <th>No.Mesin</th>
                      <th>Order</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Tebal</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa Potong</th>
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
              <button type="button" id="btnSaveRencanaPotong" class="btn btn-md btn-flat btn-success" onclick="saveRencanaPotong()"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
