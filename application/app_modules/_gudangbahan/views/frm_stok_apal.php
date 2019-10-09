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
      <div class="box box-primary">
        <div class="box-header with-border">
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahApalBaru" data-backdrop="static" onclick="modalTambahApalBaru();"><span class="fa fa-plus"></span> Tambah Apal Baru</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalPenjualanApalBaru" data-backdrop="static" onclick="modalPenjualanApal();"><span class="fa fa-plus"></span> Penjualan Apal</button>
          <button type="button" class="btn btn-md btn-flat btn-info" data-toggle="modal" data-target="#modalCheckHistory" data-backdrop="static" onclick="modalCheckHistoryApal();"><span class="fa fa-search"></span> Cek History Apal</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalKoreksian" data-backdrop="static" onclick="modalKoreksiGudangApal();" style="margin-top:3px;"><span class="fa fa-check"></span> Koreksian Apal</button>
          <button type="button" class="btn btn-md btn-flat btn-danger" data-toggle="modal" data-target="#modalEditDataAwal" data-backdrop="static" onclick="modalEditDataAwalApal()" style="margin-top:3px;"><span class="fa fa-pencil"></span> Ubah Data Awal</button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-info fade" role="alert" id="alertApproveApal">
                <h4>
                  <i class="icon fa fa-check"></i>
                  <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#modalApprove" data-backdrop="static" onclick="modalApproveApal();">
                    Ada Kiriman Apal Dari Extruder/Potong/Sablon/Cetak/Gudang Hasil
                  </a>
                </h4>
              </div>
            </div>
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableDataMasterApal">
                <thead>
                  <th>Id</th>
                  <th>Jenis Apal</th>
                  <th>Sub Jenis Apal</th>
                  <th>Stok</th>
                  <!-- <th>Action</th> -->
                </thead>
              </table>

              <div class="col-md-4" id="infoSaldoWrapper" style="display:none;">
                <div class="info-box bg-aqua">
                  <div class="info-box-icon" style="padding-top:23px;">
                    <i class="fa fa-bookmark-o"></i>
                  </div>

                  <div class="info-box-content">
                    <span class="info-box-number" id="textSaldoAwal"></span>
                    <br>
                    <span class="info-box-number" id="textSaldoAkhir"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4" id="infoFlowWrapper" style="display:none;">
                <div class="info-box bg-green">
                  <div class="info-box-icon" style="padding-top:23px;">
                    <i class="fa fa-exchange"></i>
                  </div>

                  <div class="info-box-content">
                    <span class="info-box-number" id="textBarangMasuk">Masuk : 0</span>
                    <br>
                    <span class="info-box-number" id="textBarangKeluar">Keluar : 0</span>
                  </div>
                </div>
                <button type="button" class="btn btn-md btn-flat btn-block btn-primary" id="btnRefreshTableHistory"><i class="fa fa-refresh"></i> Refresh Table</button>
              </div>
              <div class="col-md-12">
                <h3 class="text-primary" id="txtDetailHistory"></h3>
              </div>
              <table class="table table-responsive table-striped" id="tableDataHistoryApal" style="display:none;">
                <thead>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Keterangan History</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahApalBaru" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahBahanBaru">&times;</button>
              <h4 class="modal-title text-blue" id="modalTitleTambahApalBaru">Tambah Apal Baru</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Kode Apal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" class="form-control" id="txtKdApal" placeholder="Masukan Kode Apal" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Id Accurate</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="txtKdAccurate" placeholder="Masukan Kode Accurate">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" class="form-control" id="txtTanggal" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Apal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenisApal">
                        <option value="">--Pilih Jenis Apal--</option>
                        <option value="CETAK">Cetak</option>
                        <option value="POLOS">Polos</option>
                        <option value="HD">HD</option>
                        <option value="KANTONG SAK">Kantong Sak</option>
                        <option value="SAPUAN">Sapuan</option>
                        <option value="STRIP">Strip</option>
                        <option value="TEPUNG">Tepung</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Sub Jenis</td>
                  <td>:</td>
                  <td>
                    <div class="form-group" id="subJenis">
                      <select class="form-control" id="cmbSubJenis">
                        <option value="">--Pilih Jenis Apal Telebih Dahulu--</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Stok</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" class="form-control number" id="txtStok" placeholder="Masukan Jumlah Stok">
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">Note : Kolom Berwarna Kuning Tidak Boleh Kosong</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success pull-right" id="btnSimpanApalBaru">Simpan Apal Baru</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalPenjualanApalBaru" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahPembelianBahanBaru">&times;</button>
              <h4 class="modal-title text-primary">Penjualan Apal</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <fieldset>
                <legend>Formulir Penjualan Apal</legend>
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" class="form-control" id="txtTanggalJual" placeholder="Masukan Tanggal Penjualan" readonly>
                          <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Customer</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" id="txtNamaCustomer" placeholder="Masukan Nama Customer" maxlength="50">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Apal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbGudangApal"></select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Penjualan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control number" id="txtJumlahPermintaan" placeholder="Masukan Jumlah Penjualan" readonly>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnTambahPenjualan" onclick="savePenjualanApalTemp();">Tambah</button>
                <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormPenjualanApal();">Batal</button>
                <small class="text-red">
                  Note : 1. Kolom Berwarna Kuning Tidak Boleh Kosong <br>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         2. Jika Tidak Ingin Mengubah Barang Maka Kolom Barang Dikosongkan Saja
                </small>
              </fieldset>

              <fieldset>
                <legend>Daftar Penjualan Apal</legend>
                <table class="table table-responsive table-striped table-hover" id="tableListPenjualanApalTemp">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Customer</th>
                    <th>Jenis Apal</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </fieldset>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="savePenjualanApal();"><span class="fa fa-check"></span> Selesai</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCheckHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCheckHistory">&times;</button>
              <h4 class="modal-title text-primary">Cari History Apal</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" class="form-control" id="txtTglAwal" placeholder="Masukan Tanggal Awal" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
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
                        <input type="text" class="form-control" id="txtTglAkhir" placeholder="Masukan Tanggal Akhir" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Apal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbGudangApal2"></select>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">Note : Kolom Berwarna Kuning Tidak Boleh Kosong</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="searchHistoryApal();"><span class="fa fa-search"></span> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKoreksian" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKoreksian">&times;</button>
              <h4 class="modal-title text-blue">Koreksi Apal</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <fieldset>
                <legend>Formulir Koreksi Apal</legend>
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" class="form-control" id="txtTanggalKoreksi" placeholder="Masukan Tanggal Koreksi" readonly>
                          <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Apal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbGudangApal4"></select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Koreksi</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control number" id="txtJumlahKoreksi" placeholder="Masukan Jumlah Koreksi" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Koreksi</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbJenisKoreksi">
                          <<option value="#">--Pilih Jenis Koreksi--</option>
                          <option value="PLUS">PLUS (+)</option>
                          <option value="MINUS">MINUS (-)</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control comboKeterangan" id="cmbKeterangan">
                          <option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>
                        </select>
                        <div class="input-group" id="input-group" style="width:100%;float:left; display:none;">
                          <input type="text" class="form-control textKeterangan" id="cmbKeterangan" style="width:98%; float:left;" disabled>
                          <button type="button" class="close" id="close" style="margin-top:6px;">&times;</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnAddKoreksi"><span class="fa fa-plus"></span> Simpan</button>
                <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormKoreksiApal();">Batal</button>
                <small class="text-red">
                  Note : 1. Kolom Berwarna Kuning Tidak Boleh Kosong<br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  2. Jika Tidak Ingin Mengubah Barang Maka Kolom Barang Dikosongkan Saja
                </small>
              </fieldset>
              <fieldset>
                <legend>Daftar Koreksi Apal</legend>
                <table class="table table-responsive table-striped" id="tableListKoreksiApalTemp">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Apal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </fieldset>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="saveKoreksiApal();"><span class="fa fa-check"></span> Selesai</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditHistory">&times;</button>
              <h4 class="text-blue">Ubah Data History</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalHistory" class="form-control" placeholder="Masukan Tanggal">
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtNama" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Apal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbGudangApal3"></select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Sub Jenis</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtSubJenis" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlah" class="form-control number">
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">
                Note : 1. Jika Tidak Ingin Memindahkan/Mengubah Barang Kolom Jenis Apal Dibiarkan Kosong<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       2. Kolom Berwarna Kuning Tidak Boleh Kosong
              </small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-warning" id="btnEditHistory"><span class="fa fa-pencil"></span> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditDataAwal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengeluaran">&times;</button>
              <h4 class="text-blue"></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td>Pilih Apal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbGudangApal5"></select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%">Tanggal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggalPengeluaran" class="form-control" placeholder="Masukan Tanggal Pengeluaran" readonly>
                            <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis</td>
                      <td>:</td>
                      <td>
                        <input type="text" id="txtJenisApal" class="form-control" placeholder="Jenis Apal Akan Muncul Otomatis Setalah Pemilihan Barang" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Sub Jenis Apal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtSubJenisApal" class="form-control" placeholder="Sub Jenis Apal Akan Muncul Otomatis Setalah Pemilihan Barang" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahApal" class="form-control number" placeholder="Masukan Jumlah Pengeluaran" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <small class="text-red">
                    Note : 1. Jika Tidak Ingin Memindahkan/Mengubah Barang Kolom Biji Warna Dibiarkan Kosong<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           2. Kolom Berwarna Kuning Tidak Boleh Kosong
                  </small>
                  <div class="col-md-4 pull-right">
                    <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnUbahDataAwal" onclick="editDataAwalApal();"><i class="fa fa-check"></i> Simpan</button>
                    <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormUbahDataAwalApal();"><i class="fa fa-remove"></i> Batal</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <small>Form Ini Digunakan untuk melakukan perubahan stok awal barang masuk (history)</small>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalApprove" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalApprove">&times;</button>
              <h4 class="modal-title text-blue" id="modalTitle">Data Permintaan / Kembalian Dari Extruder</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableDataApproveGudangApal">
                    <thead>
                      <th>Tanggal</th>
                      <th>Bagian</th>
                      <th>Jenis Apal</th>
                      <th>Sub Jenis Apal</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnApproveApal" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Approve All</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditDataForApprove" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditDataForApprove">&times;</button>
              <h4 class="modal-title text-blue">Ubah Data</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Nama Barang</td>
                  <td width="1%">:</td>
                  <td><input type="text" id="txtNamaBarangForApprove" placeholder="Nama Barang" class="form-control" readonly></td>
                </tr>
                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlahForApprove" placeholder="Jumlah" class="form-control number">
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-primary" id="btnEditForApprove">Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
