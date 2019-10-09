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
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahSparePartBaru" data-backdrop="static" onclick="modalTambahSparePartBaru();"><span class="fa fa-plus"></span> Tambah Spare Part</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalTambahPembelianBahanBaru" data-backdrop="static" onclick="modalTambahPembelianSparePart();"><span class="fa fa-plus"></span> Tambah Pembelian Spare Part</button>
          <button type="button" class="btn btn-md btn-flat btn-info" data-toggle="modal" data-target="#modalCheckHistory" data-backdrop="static" onclick="modalCheckHistorySparePart();"><span class="fa fa-search"></span> Cek History Spare Part</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalPengeluaranSparePart" data-backdrop="static" onclick="modalPengeluaranSparePart();"><span class="fa fa-sign-out"></span> Pengeluaran Spare Part</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalKoreksian" data-backdrop="static" onclick="modalKoreksiSparePart();" style="margin-top:3px;"><span class="fa fa-check"></span> Koreksian Spare Part</button>
          <button type="button" class="btn btn-md btn-flat bg-olive" data-toggle="modal" data-target="#modal_cariBonPermintaan" data-backdrop="static" onclick="modalCariBonPermintaan('SPARE_PART');" style="margin-top:3px;"><span class="fa fa-list"></span> Bon Permintaan Sparepart</button>
          <button type="button" class="btn btn-md btn-flat btn-danger" data-toggle="modal" data-target="#modalTambahDataAwal" data-backdrop="static" onclick="modalTambahDataAwalSparePart();"><span class="fa fa-plus"></span> Tambah Data Awal</button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableDataMasterSparePart">
                <thead>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>Stok</th>
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
              <table class="table table-responsive table-striped" id="tableDataHistorySparePart" style="display:none;">
                <thead>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Keterangan History</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahSparePartBaru" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahSparePartBaru">&times;</button>
              <h4 class="modal-title text-blue">Tambah Spare Part Baru</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Kode Spare Part</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtKdSparePart" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Kode Accurate</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtKodeAccurate" class="form-control" placeholder="Masukan Kode Accurate">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalBuat" class="form-control" placeholder="Masukan Tanggal" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama Barang</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtNamaBarang" class="form-control" placeholder="Masukan Nama Spare Part">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Kode</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtKode" class="form-control" placeholder="Masukan Kode Barang">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtUkuran" class="form-control" placeholder="Masukan Ukuran">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Stok</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtStok" class="form-control number" placeholder="Masukan Stok">
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">Note : Kolom Berwarna Kuning Tidak Boleh Kosong</small>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanSparePartBaru" class="btn btn-md btn-flat btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCheckHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCheckHistory">&times;</button>
              <h4 class="modal-title text-blue">Cari History Spare Part</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglAwal" class="form-control" placeholder="Masukan Tanggal Awal">
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
                        <input type="text" id="txtTglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Spare Part</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSparePart1">

                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="searchHistorySparePart()"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalPengeluaranSparePart" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengeluaranSparePart">&times;</button>
              <h4 class="modal-title text-blue">Formulir Pengeluaran Spare Part</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll">
              <table class="table table-reponsive">
                <tr>
                  <td width="20%">Tanggal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglPengeluaran" class="form-control" placeholder="Masukan Tanggal Pengeluaran" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Pilih Spare Part</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSparePart2"></select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama Barang</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtNamaSparePart" class="form-control" placeholder="Nama Spare Part Akan Muncul Otomatis Saat Barang Sudah Dipilih" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlahPengeluaran" class="form-control number" placeholder="Masukan Jumlah" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbKeteranganPengeluaran">
                        <option value="">--Pilih Keterangan--</option>
                        <option value="PENGELUARAN (PEMBELIAN)">Pembelian</option>
                        <option value="PENGELUARAN (MESIN POTONG)">Mesin Potong</option>
                        <option value="PENGELUARAN (MESIN EXTRUDER)">Mesin Extruder</option>
                        <option value="PENGELUARAN (MESIN CETAK)">Mesin Cetak</option>
                        <option value="PENGELUARAN (MESIN BUBUT)">Mesin Bubut</option>
                        <option value="PENGELUARAN (GUDANG)">Gudang</option>
                        <option value="PENGELUARAN (PENGIRIMAN KE BREBES)">Pengiriman Ke Brebes</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
              <div class="pull-right">
                <button type="button" id="btnAddPengeluaranSparePart" class="btn btn-md btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                <button type="button" class="btn btn-md btn-flat btn-warning" onclick="resetFormPengeluaranSparePart();"><i class="fa fa-remove"></i> Batal</button>
              </div>
              <table class="table table-response table-striped" id="tableListPengeluaranSparePartTemp">
                <thead>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanPengeluaran" class="btn btn-md btn-flat btn-success" onclick="savePengeluaranSparePart();"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKoreksian" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="modalKoreksian">&times;</button>
              <h4 class="modal-title text-primary">Koreksi Spare Part</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalKoreksi" class="form-control" placeholder="Masukan Tanggal Koreksi" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Pilih Spare Part</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSparePart3"></select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama Barang</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtNamaBarangKoreksi" class="form-control" placeholder="Nama Spare Part Akan Muncul Otomatis Setelah Spare Part Dipilih" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Koreksi</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlahKoreksi" class="form-control number" placeholder="Masukan Jumlah Koreksi" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Koreksi</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenisKoreksi">
                        <option value="">--Pilih Jenis Koreksi--</option>
                        <option value="PLUS">Plus(+)</option>
                        <option value="MINUS">Minus(-)</option>
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
                        <option value="">--Pilih Keterangan--</option>
                        <option value="KOREKSI OPNAME">Koreksi Opname</option>
                        <option value="KOREKSI STOK"> Koreksi Stok</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
              <div class="pull-right">
                <button type="button" class="btn btn-md btn-flat btn-warning" onclick="resetFormKoreksiSparePart();"><i class="fa fa-remove"></i> Batal</button>
                <button type="button" class="btn btn-md btn-flat btn-primary" id="btnAddKoreksiSparePart"><i class="fa fa-plus"></i> Tambah</button>
              </div>
              <table class="table table-responsive" id="tableListKoreksiSparePartTemp">
                <thead>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Nama Spare Part</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanKoreksiSparePart" class="btn btn-md btn-flat btn-success" onclick="saveKoreksiSparePart();"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditHistorySparePart" role="dialog" tabindex="-1">
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
                        <input type="text" id="txtTanggalHistory" class="form-control" placeholder="Masukan Tanggal" readonly>
                        <div class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Spare Part</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSparePart4"></select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama Barang</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtNamaBarang2" placeholder="Masukan Nama Barang" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlahHistory" class="form-control number">
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">
                Note : 1. Jika Tidak Ingin Memindahkan/Mengubah Barang Kolom Spare Part Dibiarkan Kosong<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       2. Kolom Berwarna Kuning Tidak Boleh Kosong
              </small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-warning" id="btnEditHistorySparePart"><span class="fa fa-pencil"></span> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahPembelianBahanBaru" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahPembelianBahanBaru">&times;</button>
                <h4 class="modal-title text-primary">Tambah Pembelian Spare Part Baru</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <fieldset>
                  <legend>Formulir Permintaan Pembelian Spare Part</legend>
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Permintaan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKdPermintaan" class="form-control" placeholder="Masukan Kode Permintaan" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%">Tanggal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" class="form-control" id="txtTanggalBeli" placeholder="Masukan Tanggal Pembelian" readonly>
                            <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>Nama Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control" id="txtNamaCustomer" placeholder="Masukan Nama Customer" maxlength="100">
                        </div>
                      </td>
                    </tr> -->
                    <tr>
                      <td>Spare Part</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbGudangBahan"></select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Spare Part</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaBahan" class="form-control" placeholder="Akan Muncul Otomatis Saat BijiWarna Sudah Dipilih" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Pembelian</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" class="form-control number" id="txtJumlahPermintaan" placeholder="Masukan Jumlah Pembelian" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <textarea id="txtKeterangan" class="form-control" rows="5" cols="50"></textarea>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnTambahPembelian">Tambah</button>
                <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormPembelianSparePart();">Batal</button>
                <small class="text-red">
                  Note : 1. Kolom Berwarna Kuning Tidak Boleh Kosong <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        2. Jika Tidak Ingin Mengubah Barang Maka Kolom Barang Dikosongkan Saja
                </small>
              </fieldset>

              <fieldset>
                <legend>Daftar Pembelian Barang</legend>
                <table class="table table-responsive table-striped table-hover" id="tableListPembelianSparePartTemp">
                  <thead>
                    <th>No.</th>
                    <th>Kode Permintaan</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
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
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="saveDanKirimPermintaanSparePart();"><span class="fa fa-check"></span> Kirim Permintaan</button>
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
              <button type="button" id="btnSimpanDataAwal" class="btn btn-md btn-flat btn-success" onclick="saveDataAwalSparePart()"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
