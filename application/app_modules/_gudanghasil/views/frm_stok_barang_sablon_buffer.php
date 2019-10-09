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
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-backdrop="static" data-target="#modalTambahGudangHasil" onclick="modalTambahBarangBaru('SABLON','POLOS')"><i class="fa fa-plus"></i> Tambah Barang Baru</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-backdrop="static" data-target="#modalCariHistory" onclick="modalCariHistory('SABLON','POLOS')"><i class="fa fa-search"></i> Cari History</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-backdrop="static" data-target="#modalPengambilanSablon" onclick="modalPengambilanSablon('SABLON','CETAK')"><i class="fa fa-plus"></i> Tambah Pengambilan Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-backdrop="static" data-target="#modalKoreksiGudangHasil" onclick="modalKoreksiGudangHasil('SABLON','POLOS')"><i class="fa fa-pencil"></i> Koreksi Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-backdrop="static" data-target="#modalPengembalianCampur" onclick="modalPengembalianBarang('SABLON','POLOS')"><i class="fa fa-plus"></i> Tambah Pengembalian Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-backdrop="static" data-target="#modalPengembalianStandard" onclick="modalPengembalianBarangStandard('SABLON','POLOS','STANDARD')" style="margin-top:5px;"><i class="fa fa-plus"></i> Tambah Pengembalian Ke Standard</button>
          <button type="button" class="btn btn-md btn-flat btn-primary" onclick="getKodeBahanSablon()" data-toggle="modal" data-backdrop="static" data-target="#modalTambahBahanSablon" onclick="" style="margin-top:5px;"><i class="fa fa-plus"></i> Tambah Bahan Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-primary" onclick="" data-toggle="modal" data-backdrop="static" data-target="#modalCariHistoryBahanSablon" onclick="" style="margin-top:5px;"><i class="fa fa-search"></i> Cari History Bahan Sablon</button>
          <button type="button" class="btn btn-md btn-flat btn-primary" onclick="modalPermintaanBahanSablon()" data-toggle="modal" data-backdrop="static" data-target="#modalPermintaanBahanSablon" style="margin-top:5px;"><i class="fa fa-plus"></i> Buat Permintaan Bahan Sablon</button>
        </div>

        <div class="col-md-12" style="margin-top: 10px;">
          <div class="col-md-6" style="display: none;" id="alertKirimanBarangKeGudangBuffer">
            <div class="alert alert-info">
              <h4>
                <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#modalApproveHasilPotong" onclick="modalKirimanUntukBufferSablon('STANDARD')">
                  Ada Kiriman Barang Dari Gudang Campur / Standard
                </a>
              </h4>
            </div>
          </div>
          <div class="col-md-6" style="display: none; cursor: pointer;" id="alertKirimanBahanSablon">
            <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#modalKirimanBahanSablon" onclick="modalKirimanBahanSablon()">
            <div class="alert alert-info">
              <h4>
                  Ada Kiriman Bahan Sablon Dari Gudang Bahan
              </h4>
            </div>
            </a>
          </div>
        </div>

        <div class="col-md-12" style="margin-top:10px;"  id="masterContainerHasil">
          <h3>Stok Plastik</h3>
          <table class="table table-responsive table-striped" id="tableDataMasterGudangHasilBuffer">
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
          <h3>Stok Bahan Sablon</h3>
          <table class="table table-responsive table-striped" id="tableDataBahanSablon">
            <thead>
              <th style="width: 10px">No</th>
              <th>Nama Bahan</th>
              <th>Warna</th>
              <th>Jenis</th>
              <th>Status</th>
              <th>Stok</th>
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

        <div class="col-md-12" id="historyBahanSablon" style="display:none; margin-top:10px;">
        <div>
          <div class="col-md-3">
            <div class="box box-warning box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bookmark-o"></i> &nbsp;Saldo Awal</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="">
                <b>Berat</b> <a class="pull-right"><b><span id="saldoAwal"></span></b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <div class="col-md-3">
            <div class="box box-success box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-exchange"></i> &nbsp;Total Pengambilan</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="">
                <b>Berat</b> <a class="pull-right"><b><span id="totalPengambilan"></span></b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <div class="col-md-3">
            <div class="box box-danger box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-exchange"></i> &nbsp;Total Pemakaian</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="">
                <b>Berat</b> <a class="pull-right"><b><span id="totalPemakaian"></span></b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <div class="col-md-3">
            <div class="box box-warning box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bookmark-o"></i> &nbsp;Saldo Akhir</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="">
                <b>Berat</b> <a class="pull-right"><b><span id="saldoAkhir"></span></b></a>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
          <div class="col-md-12">
            <h3 class="text-primary">History Pengambilan <span id="titleNmBahan1"></span></h3>
            <table class="table table-responsive table-striped" id="tableHistoryBahanSablonMasuk">
              <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <!-- <th>Action</th> -->
              </thead>
            </table>
            <h3 class="text-primary">History Pemakaian <span id="titleNmBahan2"></span></h3>
            <table class="table table-responsive table-striped" id="tableHistoryBahanSablonKeluar">
              <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Pengambilan</th>
                <th>Sisa Pengambilan</th>
                <th>Pemakaian</th>
                <th style="text-align: center;">Barang</th>
                <!-- <th>Action</th> -->
              </thead>
            </table>
        </div>
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
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="cariHistoryGudangHasilBuffer('CAMPUR')"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalPengambilanSablon" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengambilanSablon">&times;</button>
              <h4 class="modal-title text-blue">Formulir Pengambilan Barang Sablon(Buffer) Ke Sablon</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="15%">Tanggal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggalPengambilan" class="form-control" placeholder="Masukan Tanggal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuran2">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran Barang Sablon (Buffer)</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuranBarangSablon">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtLembarPengambilan" class="form-control number" placeholder="Masukan Jumlah Lembar Pengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratPengambilan" class="form-control number" placeholder="Masukan Jumlah Berat Pengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtKeteranganPengambilan" class="form-control" placeholder="Masukan Keterangan Pengambilan">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" id="btnAddPengambilanCampur" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <h4 class="text-primary">Daftar Pengambilan Sablon Di Gudang Sablon(Buffer)</h4>
                  <table class="table table-responsive table-striped" id="tablePengambilanSablonTemp">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Ukuran</th>
                      <th>Berat</th>
                      <th>Lembar</th>
                      <th>Warna Plastik</th>
                      <th>Merek</th>
                      <th>Permintaan</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSavePengambilanCampur" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKoreksiGudangHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKoreksiGudangHasil">&times;</button>
              <h4 class="modal-title text-blue">Formulir Koreksi Barang Sablon</h4>
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
                            <input type="text" id="txtTglKoreksi" class="form-control" placeholder="Masukan Tanggal Koreksi" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
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
                          <input type="text" id="txtBeratKoreksi" class="form-control number" placeholder="Masukan Jumlah Berat Koreksi">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtLembarKoreksi" class="form-control number" placeholder="Masukan Jumlah Lembar Koreksi">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Koreksian</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbJenisKoreksi">
                            <option value="PLUS">PLUS</option>
                            <option value="MINUS">MINUS</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <input type="text" id="txtKeterangan" class="form-control" placeholder="Masukan Ketarangan">
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormKoreksiGudangBuffer('SABLON');"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnAddKoreksiGudangHasil" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <table class="table table-responsive" id="tableListKoreksiGudangBufferTemp">
                    <thead>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Ukuran</th>
                      <th>Berat</th>
                      <th>Lembar</th>
                      <th>Warna</th>
                      <th>Merek</th>
                      <th>Jenis Koreksi</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSaveKoreksiGudangHasil" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Selesai</button>
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

      <div class="modal fade" id="modalPengembalianStandard" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengembalianSablon">&times;</button>
              <h4 class="modal-title text-blue">Proses Pengembalian Barang Ke Standard</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Ukuran Barang Sablon</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuran5">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%">Ukuran Barang Standard</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuran5_1">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer2" class="form-control" placeholder="Masukan Nama Customer">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggalPengembalian2" class="form-control" placeholder="Masukan Tanggal" readonly>
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
                          <input type="text" id="txtBeratPengembalian2" class="form-control number" placeholder="Masukan Jumlah Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lembar</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtLembarPengembalian2" class="form-control number" placeholder="Masukan Jumlah Lembar">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan Pengembalian</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKeteranganPengembalian" class="form-control" value="PENGEMBALIAN KE GUDANG STANDARD" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnAddPengembalianBarangStandard"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListPengembalianGudangBuffer">
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
              <button type="button" class="btn btn-md btn-flat btn-success" id="btnSavePengembalianStandard"><i class="fa fa-check"></i> Selesai</button>
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
                      <li class="active"><a href="#HasilPotong" data-toggle="tab" aria-expanded="true" onclick="modalKirimanUntukBufferSablon('STANDARD')">Dari Gudang Standard</a></li>
                      <li><a href="#HasilSablon" data-toggle="tab" aria-expanded="true" onclick="modalKirimanUntukBufferSablon('CAMPUR')">Dari Gudang Campur</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="HasilPotong">
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-responsive table-striped" id="tableListKirimanDariBagianSABLON_STANDARD">
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
                              <button type="button" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveApproveKirimanUntukBufferSablon('STANDARD')"><i class="fa fa-check"></i> Approve All</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="HasilSablon">
                        <div class="row">
                          <div class="col-md-12">
                            <table class="table table-responsive table-striped" id="tableListKirimanDariBagianSABLON_CAMPUR">
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
                              <button type="button" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveApproveKirimanUntukBufferSablon('CAMPUR')"><i class="fa fa-check"></i> Approve All</button>
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

      <div class="modal fade" id="modalTambahBahanSablon" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengembalianSablon">&times;</button>
              <h4 class="modal-title text-blue">Form Tambah Bahan Sablon</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Bahan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="kdBahanSablon" id="kdBahanSablon" readonly="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <select class="form-control" id="jenisBahanSablon" onchange="getBahanSablon()">
                            <option value="" selected="selected">Pilih Jenis Bahan</option>
                            <option value="Cat Murni">CAT MURNI</option>
                            <option value="Cat Campur">CAT CAMPUR</option>
                            <option value="Minyak">MINYAK</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="frmBahanSablon" style="display: none;">
                      <td>Nama Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <select class="form-control" id="namaBahanSablon">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Stok</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="stokBahanSablon" class="form-control number" disabled="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <div class="input-group date">
                            <input type="text" id="tglBahanSablon" class="form-control" placeholder="Masukan Tanggal" disabled="">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-primary pull-right margin" onclick="addBahanSablon()"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListTambahBahanSablon">
                    <thead style="background-color:grey;">
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Nama Bahan</th>
                      <th>Warna</th>
                      <th>Status</th>
                      <th>Stok</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="saveBahanSablon()"><i class="fa fa-check"></i> Selesai</button>
            </div>
          </div>
        </div>
      </div>

      <div id="modalKirimanBahanSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1050px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Kiriman Bahan Sablon<span id="title_jenis"></span></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
            <div class="content">
              <table class="table table-responsive table-striped" id="tableDataKirimanBahanSablon">
                <thead>
                  <th style="width: 15px;">No.</th>
                  <th>Tanggal</th>
                  <th>Nama Bahan</th>
                  <th>Jenis</th>
                  <th>Warna</th>
                  <th>Berat</th>
                </thead>
                <tbody>

                </tbody>
              </table>
              <div style="text-align: center; bottom: 0px;">

              </div>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;">
              <button class="btn btn-flat bg-navy margin" onclick="approveKirimanBahanSablon()" style="margin: auto; width:30%; position: relative;">APPROVE</button>
            </div>
          </div>
        </div>
      </div>

      <div id="modalEditBahanSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-edit">&nbsp;&nbsp;Form Edit Stok</i></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Bahan :</label>
                <input type="hidden" name="kd_bahanSablon" id="kd_bahanSablon">
                <input class="form-control" type="text" name="nama_bahanSablon" id="nama_bahanSablon" readonly>
              </div>
              <div class="form-group">
                <label>Warna :</label>
                <input type="text" class="form-control" name="warna" id="warna" readonly="">
              </div>
              <div class="form-group">
                <label>Jenis :</label>
                <input type="text" class="form-control" name="edit_jenisBahanSablon" id="edit_jenisBahanSablon" readonly="">
              </div>
              <div class="form-group">
                <label>Stok :</label>
                <input type="text" class="form-control" name="stok_bahanSablon" id="stok_bahanSablon">
              </div>
            <div class="form-group">
              <button type="submit" onclick="updateListBahanSablon()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>UPDATE</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistoryBahanSablon" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistory">&times;</button>
              <h4 class="modal-title text-blue">Cari History Bahan Sablon</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="tglAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
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
                        <input type="text" id="tglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Pilih Jenis</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cariJenis">
                        <option selected="" value="">Pilih Jenis</option>
                        <option value="CAT MURNI">Cat Murni</option>
                        <option value="CAT CAMPUR">Cat Campur</option>
                        <option value="MINYAK">Minyak</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr id="fldBahanSablon" style="display: none;">
                  <td>Pilih Bahan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cariBahan"></select>
                    </div>
                  </td>
                </tr>
              </table>
              <small class="text-red">
                Note : Kolom Berwarna Kuning Tidak Boleh Kosong
              </small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="cariHistoryBahanSablon()"><i class="fa fa-search"></i> Cari History</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalPermintaanBahanSablon" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPengembalianSablon">&times;</button>
              <h4 class="modal-title text-blue">Form Permintaan Bahan Sablon</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td>Jenis Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <select class="form-control" id="jenisPermintaanBahan" onchange="getPermintaanBahanSablon()">
                            <option value="" selected="selected">Pilih Jenis Bahan</option>
                            <option value="Cat Murni">CAT MURNI</option>
                            <option value="Cat Campur">CAT CAMPUR</option>
                            <option value="Minyak">MINYAK</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="frmPilihBahan" style="display: none;">
                      <td>Nama Bahan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <select class="form-control" id="BahanSablon">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Perminataan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="jumlahPermintaan" placeholder="Jumlah Perminataan" class="form-control number" disabled="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <div class="input-group date">
                            <input type="text" id="tglPermintaan" class="form-control" placeholder="Masukan Tanggal" disabled="">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-primary pull-right margin" onclick="addPermintaanBahanSablon()"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListPermintaanBahanSablon">
                    <thead style="background-color:grey;">
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Nama Bahan</th>
                      <th>Jenis</th>
                      <th>Warna</th>
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
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="kirimPermintaanBahanSablon()"><i class="fa fa-send"></i> Kirim Permintaan</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
