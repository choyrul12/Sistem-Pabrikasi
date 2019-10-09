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
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahBarangBaru" data-backdrop="static" onclick="modalTambahBarangBaru('POLOS')"><i class="fa fa-plus"></i> Tambah Barang Baru</button>
          <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalCariHistoryGudangRoll" data-backdrop="static" onclick="modalCariHistory('POLOS')"><i class="fa fa-search"></i> Cari History Stok</button>
          <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalTambahDataAwal" data-backdrop="static" onclick="modalTambahDataAwal('POLOS')"><i class="fa fa-plus"></i> Tambah Data Awal</button>
          <button type="button" class="btn btn-md btn-flat btn-danger" data-toggle="modal" data-target="#modalTambahSelisihBarang" data-backdrop="static" onclick="modalTambahSelisihBarang('POLOS')"><i class="fa fa-plus"></i> Tambah Selisih Barang</button>
        </div>
        <div class="col-md-12" style="margin-top : 10px;" id="alertWrapper">
          <div class="col-md-6" style="display: block;" id="alertPermintaanRollPolos">
            <div class="alert alert-danger" data-toggle="modal" data-target="#modalApprove" data-backdrop="static" style="cursor:pointer;" onclick="datatablesApprovePermintaan('POLOS');">
              <h4>
                <i class="icon fa fa-info"></i>
                <a href="#" style="text-decoration:none;">Ada Permintaan Dari Potong / Cetak</a>
              </h4>
            </div>
          </div>
          <div class="col-md-6" id="alertHasilExtruder">
            <!-- <div class="alert alert-info" data-toggle="modal" data-target="#modalApproveSisa" data-backdrop="static" style="cursor:pointer;">
              <h4>
                <i class="icon fa fa-info"></i>
                <a href="#" style="text-decoration:none;">Ada Sisa Dari Potong</a>
              </h4>
            </div> -->
            <div class="alert alert-success" data-toggle="modal" data-target="#modalApproveHasilExtruder" data-backdrop="static" style="cursor:pointer;" onclick="datatablesApproveHasilExtruder();">
              <h4>
                <i class="icon fa fa-info"></i>
                <a href="#" style="text-decoration:none;">Ada Hasil Dari Extruder</a>
              </h4>
            </div>
          </div>
        </div>
        <div class="col-md-12" style="margin-top : 10px;" id="masterContainerRoll">
          <table class="table table-responsive table-striped" id="tableDataMasterGudangRollPolos">
            <thead>
              <th>Id</th>
              <th>Warna</th>
              <th>Jenis</th>
              <th>Tebal</th>
              <th>Ukuran</th>
              <th>Stok</th>
              <th>Bobin</th>
              <th>Payung</th>
              <th>Payung Kuning</th>
              <th>Merek</th>
              <th>Status Barang</th>
              <th>Action</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
          </table>
        </div>

        <div class="col-md-12" id="historyContainerRoll" style="display:none; margin-top:10px;">

          <div class="col-md-4" id="infoSaldoWrapper">
            <div class="info-box" style="position:relative;">
              <span class="info-box-icon bg-aqua" style="padding-top:70px; position:absolute; height:100%;">
                <i class="fa fa-bookmark-o" style="vertical-align:middle; line-height:2;"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Saldo Awal </span>
                <span class="info-box-text text-blue" id="textSaldoAwalBerat">Berat : 10000</span>
                <span class="info-box-text text-blue" id="textSaldoAwalBobin">Bobin : 10000</span>
                <span class="info-box-text text-blue" id="textSaldoAwalPayung">Payung : 10000</span>
                <span class="info-box-text text-blue" id="textSaldoAwalPayungKuning">Payung Kuning : 10000</span>
                <hr style="margin:5px 0 5px 0">
                <span class="info-box-number text-red">Saldo Akhir  </span>
                <span class="info-box-text text-red" id="textSaldoAkhirBerat">Berat : 10000</span>
                <span class="info-box-text text-red" id="textSaldoAkhirBobin">Bobin : 10000</span>
                <span class="info-box-text text-red" id="textSaldoAkhirPayung">Payung : 10000</span>
                <span class="info-box-text text-red" id="textSaldoAkhirPayungKuning">Payung Kuning : 10000</span>
              </div>
            </div>
          </div>

          <div class="col-md-4" id="infoFlowWrapper">
            <div class="info-box" style="position:relative;">
              <div class="info-box-icon bg-green" style="padding-top:70px; position:absolute; height:100%;">
                <i class="fa fa-exchange" style="vertical-align:middle; line-height:2;"></i>
              </div>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Masuk </span>
                <span class="info-box-text text-blue" id="textMasukBerat">Berat : 10000</span>
                <span class="info-box-text text-blue" id="textMasukBobin">Bobin : 10000</span>
                <span class="info-box-text text-blue" id="textMasukPayung">Payung : 10000</span>
                <span class="info-box-text text-blue" id="textMasukPayungKuning">Payung Kuning : 10000</span>
                <hr style="margin:5px 0 5px 0">
                <span class="info-box-number text-red">Keluar  </span>
                <span class="info-box-text text-red" id="textKeluarBerat">Berat : 10000</span>
                <span class="info-box-text text-red" id="textKeluarBobin">Bobin : 10000</span>
                <span class="info-box-text text-red" id="textKeluarPayung">Payung : 10000</span>
                <span class="info-box-text text-red" id="textKeluarPayungKuning">Payung Kuning : 10000</span>
              </div>
            </div>
            <button type="button" class="btn btn-md btn-flat btn-block btn-primary" id="btnRefreshTableHistory"><i class="fa fa-refresh"></i> Refresh Table</button>
          </div>

          <div class="col-md-4" id="infoFlowWrapper2">
            <div class="info-box" style="position:relative;">
              <div class="info-box-icon bg-yellow" style="position:absolute; height:100%;">
                <i class="fa fa-long-arrow-right" style="vertical-align:middle; line-height:2;"></i>
              </div>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Masuk Dari Extruder</span>
                <span class="info-box-text text-blue" id="textMasukBeratExtruder">Berat : 10000</span>
                <span class="info-box-text text-blue" id="textMasukBobinExtruder">Bobin : 10000</span>
                <span class="info-box-text text-blue" id="textMasukPayungExtruder">Payung : 10000</span>
                <span class="info-box-text text-blue" id="textMasukPayungKuningExtruder">Payung Kuning : 10000</span>
              </div>
            </div>
            <div class="info-box" style="position:relative;">
              <div class="info-box-icon bg-maroon" style="position:absolute; height:100%;">
                <i class="fa fa-lock" style="vertical-align:middle; line-height:2;"></i>
              </div>

              <div class="info-box-content">
                <span class="info-box-number text-blue">Stok Data Master</span>
                <span class="info-box-text text-blue" id="textMasterBerat">Berat : 10000</span>
                <span class="info-box-text text-blue" id="textMasterBobin">Bobin : 10000</span>
                <span class="info-box-text text-blue" id="textMasterPayung">Payung : 10000</span>
                <span class="info-box-text text-blue" id="textMasterPayungKuning">Payung Kuning : 10000</span>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <h2 class="text-blue">Detail Keluar Masuk Stok Dari Potong <span id="title"></span></h2>
            <h4><span id="titleTgl"></span></h4>
            <h3 class="text-primary" id="txtDetailHistory"></h3>
          </div>
          <table class="table table-responsive table-striped" id="tableHistoryGudangRoll">
            <thead>
              <th>Tanggal</th>
              <th>Berat</th>
              <th>Payung</th>
              <th>Payung Kuning</th>
              <th>Bobin</th>
              <th>Keterangan Transaksi</th>
              <th>Keterangan History</th>
              <th>Action</th>
            </thead>
          </table>

          <div class="col-md-12" style="margin-top:30px;">
            <h2 class="text-blue">Detail Masuk Dari Extruder</h2>
          </div>
          <table class="table table-responsive table-striped" id="tableHistoryGudangRollExtruder">
            <thead>
              <th>Tanggal</th>
              <th>Berat</th>
              <th>Payung</th>
              <th>Payung Kuning</th>
              <th>Bobin</th>
              <th>Shift</th>
              <th>Keterangan History</th>
              <th>Action</th>
            </thead>
          </table>
        </div>

        <div class="modal fade" id="modalTambahBarangBaru" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahBarangBaru">&times;</button>
                <h4 class="text-blue" id="txtTitleModalTambahBaru">Formulir Tambah Data Baru</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Kode Gudang Roll</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtKdGdRoll" class="form-control" placeholder="Masukan Kode Gudang" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Kode Accurate</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <input type="text" id="txtKdAccurate" class="form-control" placeholder="Masukan Kode Accurate">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Strip</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <input type="text" id="txtStrip" class="form-control" placeholder="Masukan Strip">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Barang</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbJenisBarang">
                          <option value="LOKAL">LOKAL</option>
                          <option value="EXPORT">EXPORT</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbJenisPermintaan">
                          <option value="POLOS">POLOS</option>
                          <option value="CETAK">CETAK</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Warna Plastik</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtWarnaPlastik" class="form-control" placeholder="Masukan Warna Plastik">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tebal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtTebal" class="form-control number" placeholder="Masukan Tebal">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Ukuran</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtUkuran" class="form-control" placeholder="Masukan Ukuran">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Stok</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtStok" class="form-control number" placeholder="Masukan Jumlah Stok (Kg)">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Bobin</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtBobin" class="form-control number" placeholder="Masukan Jumlah Bobin">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Payung</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbMerek">
                          <option value="">--Pilih Merek--</option>
                          <option value="Klip">Klip</option>
                          <option value="KlipKlop">KlipKlop</option>
                          <option value="Klip In">Klip In</option>
                          <option value="KP">KP</option>
                          <option value="Zippin">Zippin</option>
                          <option value="MP">MP</option>
                          <option value="Klip Double">Klip Double</option>
                          <option value="Export">Export</option>
                          <option value="PON">PON</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnSaveBarangGudangRoll" class="btn btn-md btn-flat btn-primary" onclick="saveGudangRoll()"><i class="fa fa-check"></i> Simpan</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalCariHistoryGudangRoll" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistoryGudangRoll">&times;</button>
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
                          <input type="text" id="txtTanggalAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
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
                          <input type="text" id="txtTanggalAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
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
                        <select class="form-control" id="cmbUkuran">

                        </select>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryRoll('POLOS');"><i class="fa fa-search"></i> Cari</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalTambahDataAwal" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahDataAwal">&times;</button>
                <h4 class="modal-title text-primary">Tambah Data Awal</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive" style="margin-bottom:0;">
                      <tr>
                        <td width="20%">Tanggal Transaksi</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <div class="input-group date">
                              <input type="text" id="txtTglTransaksi" class="form-control" placeholder="Pilih Tanggal" readonly>
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
                        <td>Stok</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahStok" class="form-control number" placeholder="Masukan Jumlah Stok">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bobin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahBobin" class="form-control number" placeholder="Masukan Jumlah Bobin">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                          </div>
                        </td>
                      </tr>
                    </table>
                    <button type="button" id="btnTambahDataAwal" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableListDataAwalTemp">
                      <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Ukuran</th>
                        <th>Warna Plastik</th>
                        <th>Stok</th>
                        <th>Payung</th>
                        <th>Bobin</th>
                        <th>Merek</th>
                        <th>Jenis Barang</th>
                        <th>Action</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnSaveTambahDataAwal" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Selesai</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalTambahSelisihBarang" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahSelisihBarang">&times;</button>
                <h4 class="modal-title text-blue">Tambah Selisih Barang</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Tanggal</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <div class="input-group date">
                              <input type="text" id="txtTglTransaksi1" class="form-control" placeholder="Pilih Tanggal" readonly>
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Barang</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbJenisBarang2">
                              <option value="LOKAL">LOKAL</option>
                              <option value="EXPORT">EXPORT</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Selisih</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbJenisSelisih">
                              <option value="PENAMBAHAN">PENAMBAHAN</option>
                              <option value="PENGURANGAN">PENGURANGAN</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbMerek2">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Selisih Berat</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSelisihBerat" class="form-control number" placeholder="Masukan Jumlah Selisih Berat (KG)">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bobin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSelisihBobin" class="form-control number" placeholder="Masukan Jumlah Selisih Bobin">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSelisihPayung" class="form-control number" placeholder="Masukan Jumlah Selisih Payung">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahSelisihPayungKuning" class="form-control number" placeholder="Masukan Jumlah Selisih Payung Kuning">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKeteranganSelisih" class="form-control" placeholder="Masukan Keterangan">
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnSaveSelisihBarang" class="btn btn-md btn-flat btn-success" onclick="saveTambahSelisihBarang('POLOS');"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" id="btnReset" class="btn btn-md btn-flat btn-danger" onclick="resetFormTambahSelisihBarang('POLOS')"><i class="fa fa-remove"></i> Batal</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalEditTransaksi" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalEditTransaksi">&times;</button>
                <h4 class="modal-title text-blue">Edit Transaksi</h4>
              </div>
              <div class="modal-body">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTanggalTransaksi" class="form-control" placeholder="Masukan Tanggal" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td>Tanggal Potong</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTanggalPotong" class="form-control" placeholder="Masukan Tanggal Potong" readonly>
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
                        <select class="form-control" id="cmbMerek">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Berat</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtBerat" class="form-control number" placeholder="Masukan Berat" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Payung</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtPayung" class="form-control number" placeholder="Masukan Payung" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Bobin</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtBobin" class="form-control number" placeholder="Masukan Bobin" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Payung Kuning</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtPayungKuning" class="form-control number" placeholder="Masukan Payung Kuning" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbMerek">
                          <option value="">--Pilih Keterangan--</option>
                          <option value="OPERATOR POTONG">OPERATOR POTONG</option>
                          <option value="OPERATOR(SISA SEMALAM)">OPERATOR(SISA SEMALAM)</option>
                          <option value="OPERATOR(SISA MESIN)">OPERATOR(SISA MESIN)</option>
                          <option value="MANDOR POTONG (EXTRUDER)">MANDOR POTONG (EXTRUDER)</option>
                          <option value="MANDOR POTONG (CETAK)">MANDOR POTONG (CETAK)</option>
                        </select>
                      </div>
                    </td>
                  </tr> -->
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnUpdate" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalEditPengembalianPotong" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalEditPengembalianPotong">&times;</button>
                <h4 class="modal-title text-blue">Edit Sisa Potong</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" id="txtKdCuttingHide" value="">
                    <input type="hidden" id="txtKdGdRollHide" value="">
                    <input type="hidden" id="txtSisaHide" value="">
                    <input type="hidden" id="txtBobinHide" value="">
                    <input type="hidden" id="txtPayungHide" value="">
                    <input type="hidden" id="txtPayungKuningHide" value="">
                    <input type="hidden" id="txtTglSisaHide" value="">
                    <input type="hidden" id="txtTglPotongHide" value="">
                    <input type="hidden" id="txtUkuranHide" value="">
                    <input type="hidden" id="txtJnsPermintaanHide" value="">
                    <input type="hidden" id="txtMerekHide" value="">
                    <input type="hidden" id="txtWarnaPlastikHide" value="">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Merek</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbMerekEditSisa">

                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Permintaan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJnsPermintaanEditSisa" class="form-control" placeholder="Masukan Jenis Permintaan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Sisa</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtSisaEditSisa" class="form-control number" placeholder="Masukan Sisa">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Bobin</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtBobinEditSisa" class="form-control number" placeholder="Masukan Bobin">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungEditSisa" class="form-control number" placeholder="Masukan Payung">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Payung Kuning</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtPayungKuningEditSisa" class="form-control number" placeholder="Masukan Payung Kuning">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKeteranganEditSisa" class="form-control" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <small class="text-red">NB : Untuk Merek Jika Tidak Ingin Diubah Maka Kosongkan Saja</small>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnEditSisaPotong" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalApprove" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
            <div class="modal-content" style="width:100%; height:100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalApprove">&times;</button>
                <h4 class="modal-title text-primary">Silahkan Approve</h4>
              </div>
              <div class="modal-body" style="height:83%; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12" id="tableApprovePermintaan">

                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#PermintaanPotong" data-toggle="tab" aria-expanded="true">Permintaan Bahan Untuk Bagian Potong</a></li>
                        <!-- <li><a href="#SisaPotongHariIni" data-toggle="tab" aria-expanded="false" onclick="datatablesApproveSisaPotongHariIni('POLOS');">Sisa Potong Hari Ini</a></li> -->
                        <li><a href="#PermintaanCetak" data-toggle="tab" aria-expanded="false" onclick="datatablesApprovePermintaanCetak('POLOS');">Permintaan Bahan Untuk Bagian Cetak</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="PermintaanPotong">
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table table-responsive table-striped" id="tableApprovePermintaanPOTONG">
                                <thead>
                                  <th>Ukuran</th>
                                  <th>Merek</th>
                                  <th>Warna</th>
                                  <th>Berat</th>
                                  <th>Bobin</th>
                                  <th>Payung</th>
                                  <th>Payung Kuning</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Action</th>
                                </thead>
                              </table>
                              <center style="margin-top:10px;">
                                <button type="button" id="btnApprovePermintaanPOTONG" class="btn btn-md btn-flat btn-success" onclick="saveApprovePengembalianPotong('POLOS');"><i class="fa fa-check"></i> Approve</button>
                              </center>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="PermintaanCetak">
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table table-responsive table-striped" id="tableApprovePermintaanCETAK">
                                <thead>
                                  <th>Ukuran</th>
                                  <th>Merek</th>
                                  <th>Warna</th>
                                  <th>Berat</th>
                                  <th>Bobin</th>
                                  <th>Payung</th>
                                  <th>Payung Kuning</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Action</th>
                                </thead>
                              </table>
                              <center style="margin-top:10px;">
                                <button type="button" id="btnApprovePermintaanCETAK" class="btn btn-md btn-flat btn-success" onclick="saveApprovePengambilanCetak();"><i class="fa fa-check"></i> Approve</button>
                              </center>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="SisaPotongHariIni">
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table table-responsive table-striped" id="tableApproveSisaHariIniPOTONG">
                                <thead>
                                  <th>Ukuran</th>
                                  <th>Merek</th>
                                  <th>Warna</th>
                                  <th>Berat</th>
                                  <th>Bobin</th>
                                  <th>Payung</th>
                                  <th>Payung Kuning</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Action</th>
                                </thead>
                              </table>
                              <center style="margin-top:10px;">
                                <button type="button" id="btnApproveSisaHariIniPOTONG" class="btn btn-md btn-flat btn-success" onclick="saveApproveSisaPotongHariIni('POLOS');"><i class="fa fa-check"></i> Approve</button>
                              </center>
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

        <!-- <div class="modal fade" id="modalApproveSisa" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalApproveSisa">&times;</button>
                <h4 class="modal-title text-blue">Approve Sisa Potong</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableApproveHasilExtruder">
                      <thead>
                        <th>Tanggal</th>
                        <th>Tebal</th>
                        <th>Ukuran</th>
                        <th>Panjang</th>
                        <th>Warna</th>
                        <th>Berat</th>
                        <th>Bobin</th>
                        <th>Payung</th>
                        <th>Payung Kuning</th>
                        <th>Shift</th>
                        <th>Merek</th>
                        <th>Action</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnApproveSisaPotong" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Approve</button>
              </div>
            </div>
          </div>
        </div> -->

        <div class="modal fade" id="modalApproveHasilExtruder" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
            <div class="modal-content" style="width:100%; height:100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalApproveHasilExtruder">&times;</button>
                <h4 class="modal-title text-blue">Approve Hasil Extruder</h4>
              </div>
              <div class="modal-body" style="height:83%; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableApproveHasilExtruder">
                      <thead>
                        <th>Tanggal</th>
                        <th>Tebal</th>
                        <th>Ukuran</th>
                        <th>Panjang</th>
                        <th>Warna</th>
                        <th>Berat</th>
                        <th>Bobin</th>
                        <th>Payung</th>
                        <th>Payung Kuning</th>
                        <th>Shift</th>
                        <th>Merek</th>
                        <th>Action</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnApproveHasilExtruder" class="btn btn-md btn-flat btn-success" onclick="saveApproveHasilExtruder()"><i class="fa fa-check"></i> Approve</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
