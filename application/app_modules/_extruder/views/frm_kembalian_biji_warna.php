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
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahPengembalianBijiWarna" data-backdrop="static" onclick="modalTambahKembalianBijiWarna();"><i class="fa fa-plus"></i> Tambah Pengembalian Biji Warna</button>
            <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalCariPengembalianBijiWarna" data-backdrop="static"><i class="fa fa-search"></i> Cari Pengembalian Biji Warna</button>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div id="historyKembalianBijiWarnaWrapper" style="display:none;">
                  <table class="table table-responsive table-striped" id="tableHistoryKembalianBijiWarna">
                    <thead>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Bahan</th>
                      <th>Jumlah Kembalian</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalTambahPengembalianBijiWarna" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahPengembalianBijiWarna">&times;</button>
            <h4 class="modal-title text-blue">Formulir Tambah Pengembalian Biji Warna</h4>
          </div>
          <div class="modal-body" style="height : 500px; overflow-y:scroll;">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Biji Warna</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBijiWarna">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJumlah" class="form-control number" placeholder="Masukan Jumlah Kembalian (KG)">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal Pengembalian" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" id="btnTambahPengembalianBijiWarnaPending" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
              </div>

              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tableListPengembalianBijiWarnaPending">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Bahan</th>
                    <th>Jumlah Kembalian</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnKirimKembalianBijiWarna" class="btn btn-md btn-flat btn-success" onclick="saveKirimKembalianBijiWarna();"><i class="fa fa-send"></i> Kirim</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCariPengembalianBijiWarna" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariPengembalianBijiWarna">&times;</button>
            <h4 class="modal-title text-blue">Cari Pengembalian Biji Warna</h4>
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
            <button type="button" id="btnSearch" class="btn btn-md btn-flat btn-primary" onclick="searchHistoryKembalianBijiWarna();"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
