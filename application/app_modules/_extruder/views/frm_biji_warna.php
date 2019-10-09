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
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalMintaBijiWarna" onclick="modalMintaBijiWarna()"><i class="fa fa-plus"></i> Minta Biji Warna</button>
            <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalTambahStokBijiWarna" onclick="modalTambahBijiWarna()"><i class="fa fa-plus"></i> Tambah Stok Biji Warna</button>
            <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalHistoryBijiWarna" onclick="modalCariHistoryBijiWarna()"><i class="fa fa-search"></i> History Biji Warna</button>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div id="bijiWarnaWrapper" style="display:block">
                  <table class="table table-responsive table-striped" id="tableListBijiWarna">
                    <thead>
                      <th>No.</th>
                      <th>Biji Warna</th>
                      <th>Stok</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>

                <div id="historyBijiWarnaWrapper" style="display:none;">
                  <div class="col-md-6">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua">
                        <i class="fa fa-info-circle" style="margin-top:25%;"></i>
                      </span>
                      <div class="info-box-content">
                        <span class="info-box-number" id="spanTotalPemakaian">Total Pemakaian : </span>
                        <span class="info-box-number" id="spanTotalPermintaan">Total Permintaan : </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableListHistoryBijiWarna">
                      <thead>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Keterangan</th>
                      </thead>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableListHistoryBijiWarna_GudangBahan">
                      <thead>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Keterangan</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalMintaBijiWarna" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-toggle="modal" data-target="#modalMintaBijiWarna">&times;</button>
            <h4 class="modal-title text-blue">Formulir Permintaan Biji Warna</h4>
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
                          <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Biji Warna</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBijiWarna">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJumlahPermintaan" class="form-control number" placeholder="Masukan Jumlah Permintaan (KG)">
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormMintaBijiWarna();"><i class="fa fa-remove"></i> Batal</button>
                <button type="button" id="btnTambahPermintaanBijiWarna" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
              </div>
              <div class="col-md-12">
                <table class="table table-responsive table-stiped" id="tableListPermintaanBijiWarna">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Biji Warna</th>
                    <th>Jumlah Permintaan</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSelesaiPermintaan" class="btn btn-md btn-flat btn-success" onclick="savePermintaanBijiWarna();"><i class="fa fa-send"></i> Kirim</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalTambahStokBijiWarna" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahStokBijiWarna">&times;</button>
            <h4 class="modal-title text-blue">Tambah Stok Biji Warna</h4>
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
                          <input type="text" id="txtTanggalTambah" class="form-control" placeholder="Pilih Tanggal" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Biji Warna</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBijiWarnaBaru">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJumlahPermintaanBaru" class="form-control number" placeholder="Masukan Jumlah Permintaan (KG)">
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormTambahBijiWarna();"><i class="fa fa-remove"></i> Batal</button>
                <button type="button" id="btnTambahStokBijiWarnaPending" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
              </div>
            </div>
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableListStokBijiWarna">
                <thead>
                  <th>Biji Warna</th>
                  <th>Jumlah Permintaan</th>
                  <th>Warna</th>
                  <th>Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnAddSelesaiStokBijiWarna" class="btn btn-md btn-flat btn-success" onclick="saveBijiWarnaBaru();"><i class="fa fa-check"></i> Selesai</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalHistoryBijiWarna" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalHistoryBijiWarna">&times;</button>
            <h4 class="modal-title text-blue">Cari History Biji Warna</h4>
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
                    <td>Biji Warna</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBijiWarna_History">

                        </select>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnCariHistoryBijiWarna" class="btn btn-md btn-flat btn-primary" onclick="searchHistoryBijiWarna()"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
