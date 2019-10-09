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
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-backdrop="static" data-target="#modalTambahGudangHasil" onclick="modalTambahBarangBaru('SABLON','CETAK')"><i class="fa fa-plus"></i> Tambah Barang Baru</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-backdrop="static" data-target="#modalCariHistory" onclick="modalCariHistory('SABLON','CETAK')"><i class="fa fa-search"></i> Cari History</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-backdrop="static" data-target="#modalCariHistoryPengirimanHasilSablon"><i class="fa fa-search"></i> Cari History Pengiriman Hasil Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-danger" data-toggle="modal" data-backdrop="static" data-target="#modalPengirimanGudangCampur" onclick="modalPengirimanGudang('SABLON','CETAK')"><i class="fa fa-plus"></i> Pengiriman</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-backdrop="static" data-target="#modalPengembalianCampur" onclick="modalPengembalianBarang('SABLON','CETAK')"><i class="fa fa-plus"></i> Tambah Pengembalian Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-backdrop="static" data-target="#modalTambahDataAwal" onclick="modalTambahDataAwalGudangHasil('SABLON','CETAK')"><i class="fa fa-plus"></i> Tambah Data Awal</button>
        </div>
        <div class="col-md-12" style="margin-top:10px;">
          <div class="col-md-6" style="display: none;" id="alertKirimanBarangKeSablon">
            <div class="alert alert-info">
              <h4>
                <a href="#" style="text-decoration : none;" data-toggle="modal" data-target="#modalApproveHasilPotong" onclick="modalKirimanDariBagian('SABLON','SABLON','CETAK')">
                  Hasil Sablon Sudah Dikirim, Klik Disini Untuk Melihatnya
                </a>
              </h4>
            </div>
          </div>
          <div class="col-md-6" style="display: none;" id="alertApproveReturBarangSablon">
            <a href="#" style="text-decoration : none;" onclick="modalApproveReturBarang('Sablon')">
              <div class="alert alert-info">
                <h4>Approve Barang Retur Dari Pengiriman.</h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-12" style="margin-top:10px;" id="masterContainerHasil">
          <table class="table table-responsive table-striped" id="tableDataMasterGudangHasilSablon">
            <thead>
              <th>Kode</th>
              <th>Ukuran</th>
              <th>Merek</th>
              <th>Warna</th>
              <th>Stok Berat</th>
              <th>Stok Lembar</th>
              <th>Jenis Barang</th>
              <th>Gudang</th>
              <th>Action</th>
            </thead>
          </table>
        </div>

        <div class="col-md-12" id="historyContainerHasil" style="display:none; margin-top:10px;">

          <div class="col-md-4" id="infoSaldoWrapper">
            <div class="info-box" style="position:relative;">
              <span class="info-box-icon bg-aqua" style="padding-top:23px; position:absolute; height:100%;">
                <i class="fa fa-bookmark-o" style="vertical-align:middle; line-height:2;"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Saldo Awal </span>
                <span class="info-box-text text-blue" id="textSaldoAwalBerat">Berat : 10000</span>
                <span class="info-box-text text-blue" id="textSaldoAwalLembar">Lembar : 10000</span>
                <hr style="margin:5px 0 5px 0">
                <span class="info-box-number text-red">Saldo Akhir  </span>
                <span class="info-box-text text-red" id="textSaldoAkhirBerat">Berat : 10000</span>
                <span class="info-box-text text-red" id="textSaldoAkhirLembar">Lembar : 10000</span>
              </div>
            </div>
          </div>

          <div class="col-md-4" id="infoFlowWrapper">
            <div class="info-box" style="position:relative;">
              <div class="info-box-icon bg-green" style="padding-top:23px; position:absolute; height:100%;">
                <i class="fa fa-exchange" style="vertical-align:middle; line-height:2;"></i>
              </div>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Masuk </span>
                <span class="info-box-text text-blue" id="textMasukBerat">Berat : 10000</span>
                <span class="info-box-text text-blue" id="textMasukLembar">Lembar : 10000</span>
                <hr style="margin:5px 0 5px 0">
                <span class="info-box-number text-red">Keluar  </span>
                <span class="info-box-text text-red" id="textKeluarBerat">Berat : 10000</span>
                <span class="info-box-text text-red" id="textKeluarLembar">Lembar : 10000</span>
              </div>
            </div>
            <button type="button" class="btn btn-md btn-flat btn-block btn-primary" id="btnRefreshTableHistory"><i class="fa fa-refresh"></i> Refresh Table</button>
          </div>

          <div class="col-md-4" id="infoSaldoWrapper">
            <div class="info-box" style="position:relative;">
              <span class="info-box-icon bg-yellow" style="padding-top:23px; position:absolute; height:100%;">
                <i class="fa fa-lock" style="vertical-align:middle; line-height:2;"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Stock Data Master </span>
                <span class="info-box-text text-blue" id="textBeratStok">Berat : 0.00</span>
                <span class="info-box-text text-blue" id="textLembarStok">Lembar : 0.00</span>
                <hr style="margin:5px 0 5px 0">
                <span class="info-box-number text-red">&nbsp;</span>
                <span class="info-box-text text-red">&nbsp;</span>
                <span class="info-box-text text-red">&nbsp;</span>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <h3 class="text-primary" id="txtDetailHistory"></h3>
          </div>
          <table class="table table-responsive table-striped" id="tableHistoryGudangHasilMasuk">
            <thead>
              <th>Tanggal</th>
              <th>Berat</th>
              <th>Lembar</th>
              <th>Keterangan</th>
              <th>Action</th>
            </thead>
          </table>
          <div class="col-md-12">
            <h3 class="text-primary" id="txtDetailHistory2"></h3>
          </div>
          <table class="table table-responsive table-striped" id="tableHistoryGudangHasilKeluar">
            <thead>
              <th>Tanggal</th>
              <th>Berat</th>
              <th>Lembar</th>
              <th>Keterangan</th>
              <th>Action</th>
            </thead>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalTambahGudangHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahGudangHasil">&times;</button>
              <h4 class="modal-title text-blue">Tambah Barang Baru</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <table class="table table-responsive">
                <tr>
                  <td width="25%">Kode Gudang Hasil</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtKdGdHasil1" class="form-control" placeholder="Masukan Kode Gudang Hasil" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggal1" class="form-control" placeholder="Masukan Tanggal" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Kode Accurate</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtKdAccurate1" class="form-control" placeholder="Masukan Kode Accurate">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Warna Plastik</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtWarnaPlastik1" class="form-control" placeholder="Masukan Warna Plastik">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtUkuran1" class="form-control" placeholder="Masukan Ukuran">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tebal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtStokTebal1" class="form-control number" placeholder="Masukan Tebal Plastik">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Stok Berat</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtStokBerat1" class="form-control number" placeholder="Masukan Stok (Kg)">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Stok Lembar</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtStokLembar1" class="form-control number" placeholder="Masukan Stok (Lembar)">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Merek</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbMerek1" style="display:block;">
                        <option value="">--Pilih Merek--</option>
                        <option value="Klip">Klip</option>
                        <option value="Klip Double">Klip Double</option>
                        <option value="Klip Klop">Klip Klop</option>
                        <option value="Klip In">Klip In</option>
                        <option value="KP">KP</option>
                        <option value="MP">MP</option>
                        <option value="PON">PON</option>
                        <option value="HD">HD</option>
                        <option value="Zippin">Zippin</option>
                        <option value="Export">Export</option>
                        <option value="Custom">Custom</option>
                      </select>
                      <div class="input-group textMerek" style="width:100%; float:left; display:none;">
                        <input type="text" id="txtMerek1" class="form-control" placeholder="Masukan Merek" style="width:97%;float:left;">
                        <button type="button" class="close" id="btnClose" style="padding-top:5px;">&times;</button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtKeterangan1" class="form-control" placeholder="Masukan Keterangan">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Permintaan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenisPermintaan1">
                        <option value="POLOS">Polos</option>
                        <option value="CETAK">Cetak</option>
                        <option value="CETAK/POLOS">Cetak/Polos</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Status Barang</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenisBarang1">
                        <option value="LOKAL">LOKAL</option>
                        <option value="EXPORT">EXPORT</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">
                Note : Kolom Berwarna Kuning Tidak Boleh Kosong
              </small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-primary" id="btnSaveGudangHasil">Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistory">&times;</button>
              <h4 class="modal-title text-blue">Cari History</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglAwal1" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
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
                        <input type="text" id="txtTglAkhir1" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Pilih Barang</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbUkuran1"></select>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">
                Note : Kolom Berwarna Kuning Tidak Boleh Kosong
              </small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="cariHistoryGudangHasil('CAMPUR')"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistoryPengirimanHasilSablon" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHasilSablon">&times;</button>
              <h4 class="modal-title text-blue">Cari Hasil Sablon</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglAwal2" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
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
                        <input type="text" id="txtTglAkhir2" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">
                Note : Kolom Berwarna Kuning Tidak Boleh Kosong
              </small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="cariHasilSablon()"><i class="fa fa-search"></i> Cari Hasil Sablon</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalPengirimanGudangCampur" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengirimanGudangCampur">&times;</button>
              <h4 class="modal-title text-blue">Formulir Pengiriman Gudang Hasil Sablon</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Pengiriman</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalPengiriman" class="form-control" placeholder="Masukan Tanggal" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Customer</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtNamaCustomer" class="form-control" placeholder="Masukan Nama Customer">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbUkuran3">

                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Berat</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtBeratPengiriman" class="form-control number" placeholder="Masukan Jumlah Berat Pengiriman">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Lembar</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtLembarPengiriman" class="form-control number" placeholder="Masukan Jumlah Lembar Pengiriman">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbKeteranganPengiriman">
                        <option value="">--Pilih Keterangan--</option>
                        <option value="PENGIRIMAN(KOREKSI STOK)">KOREKSI STOK</option>
                        <option value="PENGIRIMAN">PENGIRIMAN</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
              <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormPengirimanGudang('CAMPUR')"><i class="fa fa-delete"></i> Batal</button>
              <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnAddPengirimanCampur"><i class="fa fa-plus"></i> Tambah</button>
              <div class="col-md-12">
                <h4 class="text-blue">Daftar Pengririman Gudang Hasil Campur</h4>
                <table class="table table-responsive table-striped" id="tableListPengirimanGudangTemp">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>Ukuran</th>
                    <th>Berat</th>
                    <th>Lembar</th>
                    <th>Warna</th>
                    <th>Merek</th>
                    <th>Permintaan</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" id="btnSavePengirimanCampur"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditHistoryMasukGudangHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditHistoryMasukGudangHasil">&times;</button>
              <h4 class="modal-title text-blue">Edit Detail Barang Masuk / Keluar</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglHistoryMasuk" class="form-control" placeholder="Masukan Tanggal History" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuran6">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="trJumlahPengiriman" style="display:none;">
                      <td>Jumlah Pengiriman</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPengiriman" class="form-control number" style="width : 90%; float:left;" placeholder="Masukan Jumlah Pengiriman">
                          <span id="txtSatuan" style="float:left; margin-left:5px; margin-top : 5px;">LEMBAR</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratMasukHistory" class="form-control number" placeholder="Masukan Jumlah Berat History">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtLembarMasukHistory" class="form-control number" placeholder="Masukan Jumlah Lembar History">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <small class="text-red">
                    Note : 1. Kosongkan Kolom Merek Jika Tidak Ingin Memindahkan Barang
                  </small>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSaveEditHistoryGudangHasil" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalApproveHasilPotong" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="width:1120px; margin-left:5px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalApproveHasilPotong">&times;</button>
              <h4 class="modal-title text-blue">Silahkan Approve Kiriman Dari Bagian Potong</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <!-- <li class="active"><a href="#HasilPotong" data-toggle="tab" aria-expanded="true" onclick="modalKirimanDariBagian('STANDARD','POTONG')">Hasil Potong</a></li> -->
                      <li class="active"><a href="#HasilSablon" data-toggle="tab" aria-expanded="true" onclick="modalKirimanDariBagian('SABLON','SABLON','CETAK')">Hasil Sablon</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- <div class="tab-pane active" id="HasilPotong">
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-responsive table-striped" id="tableListKirimanDariBagianPOTONG">
                              <thead>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Ukuran</th>
                                <th>Berat</th>
                                <th>Lembar</th>
                                <th>Warna</th>
                                <th>Merek</th>
                                <th>Permintaan</th>
                                <th>Customer</th>
                                <th>Jenis Barang</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                              </thead>
                            </table>
                            <div style="margin-top:10px;">
                              <button type="button" class="btn btn-md btn-flat btn-danger pull-right" disabled title="Fitur Ini Belum Tersedia"><i class="fa fa-undo"></i> Kirim Balik Ke Potong</button>
                              <button type="button" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveApproveKirimanDariBagian('STANDARD','POTONG')"><i class="fa fa-check"></i> Approve All</button>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <div class="tab-pane active" id="HasilSablon">
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-responsive table-striped" id="tableListKirimanDariBagianSABLON">
                              <thead>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Ukuran</th>
                                <th>Berat</th>
                                <th>Lembar</th>
                                <th>Warna</th>
                                <th>Merek</th>
                                <th>Permintaan</th>
                                <th>Customer</th>
                                <th>Jenis Barang</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                              </thead>
                            </table>
                            <div style="margin-top:10px;">
                              <!-- <button type="button" class="btn btn-md btn-flat btn-danger pull-right" disabled title="Fitur Ini Belum Tersedia"><i class="fa fa-undo"></i> Kirim Balik Ke Potong</button> -->
                              <button type="button" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveApproveKirimanDariBagian('SABLON','SABLON','CETAK')"><i class="fa fa-check"></i> Approve All</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalPengembalianCampur" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengembalianCampur">&times;</button>
              <h4 class="modal-title text-blue">Proses Pengembalian Barang Sablon</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Ukuran</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuran4">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer1" class="form-control" placeholder="Masukan Nama Customer">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggalPengembalian" class="form-control" placeholder="Masukan Tanggal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratPengembalian" class="form-control number" placeholder="Masukan Jumlah Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtLembarPengembalian" class="form-control number" placeholder="Masukan Jumlah Lembar">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan Pengembalian</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKeteranganPengembalian">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="PENGEMBALIAN SABLON (BUKAN KOREKSI)">BUKAN KOREKSI</option>
                            <option value="PENGEMBALIAN SABLON (KOREKSI)">KOREKSI</option>
                            <option value="PENGEMBALIAN SABLON (RETUR)">RETUR</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnAddPengembalianBarang"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListPengembalianGudangHasil">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Customer</th>
                      <th>Ukuran</th>
                      <th>Berat</th>
                      <th>Lembar</th>
                      <th>Warna</th>
                      <th>Merek</th>
                      <th>Permintaan</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" id="btnSavePengembalian"><i class="fa fa-check"></i> Selesai</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahDataAwal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahDataAwal">&times;</button>
              <h4 class="text-blue">Tambah Data Awal</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Nama Barang</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbNamaBarang">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBerat" class="form-control number" placeholder="Masukan Jumlah Berat Data Awal">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahLembar" class="form-control number" placeholder="Masukan Jumlah Lembar Data Awal">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" id="btnAddDataAwal" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>

                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListDataAwalGudangHasilPending">
                    <thead>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Berat</th>
                      <th>Jumlah Lembar</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSaveDataAwal" class="btn btn-md btn-flat btn-success" onclick="saveDataAwalGudangHasil('SABLON')"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

    </section>
</div>
