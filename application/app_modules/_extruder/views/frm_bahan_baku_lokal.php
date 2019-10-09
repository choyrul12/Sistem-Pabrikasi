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
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalMintaBahanBaku" data-backdrop="static" onclick="modalMintaBahanBaku()"><i class="fa fa-plus"></i> Minta Bahan Baku</button>
            <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalCariBahanBaku" data-backdrop="static"><i class="fa fa-search"></i> Cari Bahan Baku</button>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div id="jumalahBahanBakuWrapper">
                  <table class="table table-responsive table-bordered" id="tableJumlahBahanBaku">
                    <thead>
                      <th>Stok Bahan Baku Shift 3 Kemarin</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <center>
                            <h3 class="text-red" id="txtSisaBijiKemarin">0000</h3>
                            <label id="txtJumlahPenambahanBahanBaku">(+) NOTE : Penambahan Bahan Baku Hari Ini</label>
                          </center>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="historyBahanBakuWrapper" style="display:none;">
                  <h3 class="text-blue" id="txtDetailBahan"></h3>
                  <table class="table table-responsive table-striped" id="tableListHistoryBahanBakuExtruder">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Pengambilan</th>
                      <th>Bahan</th>
                      <th>Warna</th>
                      <th>Jumlah</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalMintaBahanBaku" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalMintaBahanBaku">&times;</button>
            <h4 class="modal-title text-primary">Formulir Permintaan Bahan Baku</h4>
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
                    <td>Bahan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="txtBahan">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Permintaan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJumlahPermintaan" class="form-control number" placeholder="Masukan Jumlah Permintaan">
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
                </table>
                <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormMintaBahanBaku();"><i class="fa fa-remove"></i> Batal</button>
                <button type="button" id="btnTambahPermintaanBahanBaku" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
              </div>

              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tabelPermintaanExtruderPending">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Bahan Baku</th>
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
            <button type="button" id="btnKirimPermintaan" class="btn btn-md btn-flat btn-success" onclick="savePermintaanBahanBaku('BAHAN BAKU','LOKAL')"><i class="fa fa-send"></i> Kirim</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCariBahanBaku" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariBahanBaku">&times;</button>
            <h4 class="modal-title text-primary">Cari Bahan Baku</h4>
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
                          <input type="text" id="txtTglAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td width="20%">Tanggal Akhir</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTglAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
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
            <button type="button" id="btnCariBahanBaku" class="btn btn-md btn-flat btn-primary" onclick="searchHistoryBahanBaku();"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
