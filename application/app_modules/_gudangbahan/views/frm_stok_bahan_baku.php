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
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahBahanBaru" data-backdrop="static" onclick="modalTambahBahanBakuBaru('BAHAN_BAKU');"><span class="fa fa-plus"></span> Tambah Bahan Baru</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalTambahPembelianBahanBaru" data-backdrop="static" onclick="modalTambahPembelianBahanBaku('BAHAN_BAKU');"><span class="fa fa-plus"></span> Tambah Pembelian Bahan Baru</button>
          <button type="button" class="btn btn-md btn-flat btn-info" data-toggle="modal" data-target="#modalCheckHistory" data-backdrop="static" onclick="modalCheckHistory('BAHAN_BAKU');"><span class="fa fa-search"></span> Cek History Bahan Baku</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalKoreksian" data-backdrop="static" onclick="modalKoreksi('BAHAN_BAKU');" style="margin-top:3px;"><span class="fa fa-check"></span> Koreksian Bahan Baku</button>
          <button type="button" class="btn btn-md btn-flat bg-olive" data-toggle="modal" data-target="#modal_cariBonPermintaan" data-backdrop="static" onclick="modalCariBonPermintaan('BAHAN_BAKU');" style="margin-top:3px;"><span class="fa fa-list"></span> Bon Permintaan Bahan</button>
          <button type="button" class="btn btn-md btn-flat btn-danger" data-toggle="modal" data-target="#modalTambahDataAwal" data-backdrop="static" onclick="modalTambahDataAwal('BAHAN_BAKU');"><span class="fa fa-plus"></span> Tambah Data Awal</button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                <div class="alert alert-info fade" role="alert" id="alertApproveBahanBakuExtruder">
                  <h4>
                    <i class="icon fa fa-check"></i>
                    <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#modalApprove" data-backdrop="static" onclick="modalApprove('EXTRUDER','BAHAN BAKU');">
                      Ada Permintaan / Kembalian Bahan Baku Dari Extruder
                    </a>
                  </h4>
                </div>
              </div>
              <div class="col-md-6">
                <div class="alert alert-success fade" role="alert" id="alertApprovePembelian">
                  <h4>
                    <i class="icon fa fa-check"></i>
                    <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#modalApprove" data-backdrop="static" onclick="modalApprovePembelian('BAHAN BAKU')">
                      Ada Barang Masuk Dari Pembelian
                    </a>
                  </h4>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableDataMasterBahanBaku">
                <thead>
                  <th>Id</th>
                  <th>Nama Bahan Baku</th>
                  <th>Stok</th>
                  <th>Warna</th>
                  <th>Action</th>
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
              <table class="table table-responsive table-striped table-bordered" id="tableDataHistoryBahanBaku" style="display:none;">
                <thead>
                  <th>Tanggal</th>
                  <th>Jumlah Barang</th>
                  <th>Keterangan Histori</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahBahanBaru" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahBahanBaru">&times;</button>
              <h4 class="modal-title text-blue" id="modalTitleTambahBahanBakuBaru">Tambah Bahan Baru</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Kode bahan</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" class="form-control" id="txtKdBahan" placeholder="Masukan Kode Bahan" readonly>
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
                  <td>Warna</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="txtWarna" placeholder="Masukan Warna">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama Bahan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" class="form-control" id="txtNamaBahanBaru" placeholder="Masukan Nama Bahan">
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
                <tr>
                  <td>Satuan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSatuan">
                        <option value="KG">Kilogram</option>
                        <option value="LEMBAR">Lembar</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbStatus">
                        <option value="LOKAL">LOKAL</option>
                        <option value="EXPORT">EXPORT</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">Note : Kolom Berwarna Kuning Tidak Boleh Kosong</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success pull-right" id="btnSimpanBahanBaru">Simpan Bahan Baru</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahPembelianBahanBaru" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahPembelianBahanBaru">&times;</button>
              <h4 class="modal-title text-primary">Tambah Pembelian Bahan Baru</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <fieldset>
                <legend>Formulir Penerimaan Pembelian Bahan Baku</legend>
                <table class="table table-responsive">
                  <!-- <tr>
                    <td width="20%">Kode Permintaan</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtKdPermintaan" class="form-control" placeholder="Masukan Kode Permintaan" readonly>
                      </div>
                    </td>
                  </tr> -->
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" class="form-control" id="txtTanggalPermintaan" placeholder="Masukan Tanggal Permintaan" readonly>
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
                      <div class="form-group has-warning">
                        <input type="text" class="form-control" id="txtNamaCustomer" placeholder="Masukan Nama Customer" maxlength="100">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Bahan Baku</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbGudangBahan"></select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Bahan Baku</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtNamaBahan" class="form-control" placeholder="Akan Muncul Otomatis Saat Bahan Sudah Dipilih" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control number" id="txtJumlahPermintaan" placeholder="Masukan Jumlah Permintaan" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Keterangan Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <textarea id="txtKeterangan" class="form-control" rows="8" cols="80"></textarea>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnTambahPembelian" onclick="saveCartPembelian();">Tambah</button>
                <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormPembelian();">Batal</button>
                <small class="text-red">
                  Note : 1. Kolom Berwarna Kuning Tidak Boleh Kosong <br>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         2. Jika Tidak Ingin Mengubah Barang Maka Kolom Barang Dikosongkan Saja
                </small>
              </fieldset>

              <fieldset>
                <legend>Daftar Permintaan Pembelian Barang</legend>
                <table class="table table-responsive table-striped table-hover" id="tableListPembelianBahanBakuTemp">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <!-- <th>Nama Customer</th> -->
                    <th>Bahan Baku</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </fieldset>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="saveDanKirimPermintaan();"><span class="fa fa-check"></span> Kirim Permintaan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCheckHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCheckHistoryBahanBaku">&times;</button>
              <h4 class="modal-title text-primary">Cari History Bahan Baku</h4>
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
                  <td>Bahan Baku</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbBahan1"></select>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">Note : Kolom Berwarna Kuning Tidak Boleh Kosong</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="searchHistory('BAHAN_BAKU');"><span class="fa fa-search"></span> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKoreksian" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKoreksian">&times;</button>
              <h4 class="modal-title text-blue">Koreksi Bahan Baku</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <fieldset>
                <legend>Formulir Koreksi Bahan Baku</legend>
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
                    <td>Bahan Baku</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBahan"></select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Bahan Baku</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control" id="txtNamaBahan" placeholder="Nama Bahan Baku Akan Tampil Otomatis" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Koreksi</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control number" id="txtJumlahKoreksi" placeholder="Masukan Jumlah Koreksi">
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
                        <select class="form-control" id="cmbKeterangan">
                          <option value='#'>Pilih Jenis Koreksi Terlebih Dahulu</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnAddKoreksi" onclick="saveCartKoreksiBahanBaku('BAHAN_BAKU')"><span class="fa fa-plus"></span> Simpan</button>
                <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormKoreksi('BAHAN_BAKU');">Batal</button>
                <small class="text-red">
                  Note : 1. Kolom Berwarna Kuning Tidak Boleh Kosong<br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  2. Jika Tidak Ingin Mengubah Barang Maka Kolom Barang Dikosongkan Saja
                </small>
              </fieldset>
              <fieldset>
                <legend>Daftar Koreksi Bahan Baku</legend>
                <table class="table table-responsive table-striped" id="tableListKoreksi">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Bahan Baku</th>
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
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="saveKoreksi('BAHAN_BAKU');"><span class="fa fa-check"></span> Selesai</button>
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
                  <td>Bahan Baku</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbBahanEditHistory"></select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Warna</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtWarna" class="form-control" readonly>
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
                Note : 1. Jika Tidak Ingin Memindahkan/Mengubah Barang Kolom Bahan Baku Dibiarkan Kosong<br>
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
                  <table class="table table-responsive table-striped" id="tableDataApproveGudangBahan">
                    <thead>
                      <th>Tanggal</th>
                      <th>Nama Bahan Baku</th>
                      <th>Jumlah Permintaan</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnApproveBahanBaku" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Approve All</button>
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

      <div class="modal fade" id="modalTambahDataAwal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahDataAwal">&times;</button>
              <h4 class="text-blue">Tambah Data Awal</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Barang</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbBarang">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahDataAwal" class="form-control number" placeholder="Masukan Jumlah">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" id="btnTambahDataAwal" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <table class="table table-responsive table-striped" id="tableDaftarDataAwal">
                  <thead>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Data Awal</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanDataAwal" class="btn btn-md btn-flat btn-success" onclick="saveDataAwal('BAHAN_BAKU')"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
