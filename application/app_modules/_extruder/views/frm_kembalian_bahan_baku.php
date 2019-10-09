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
          <div class="box-header">
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahKembalianBahanBaku" data-backdrop="static" onclick="modalTambahKembalianBahanBaku()"><i class="fa fa-plus"></i> Tambah Kembalian Bahan Baku</button>
            <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalCariHistoryKembalianBahanBaku" data-backdrop="static"><i class="fa fa-search"></i> Cari Kembalian Bahan Baku</button>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div id="historyKembalianBahanBakuWrapper" style="display : none">
                  <table class="table table-responsive table-striped" id="tableHistoryKembalianBahanBaku">
                    <thead>
                      <th>No.</th>
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

    <div class="modal fade" id="modalTambahKembalianBahanBaku" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahKembalianBahanBaku">&times;</button>
            <h4 class="modal-title text-blue">Formulir Tambah Kembalian Bahan Baku</h4>
          </div>
          <div class="modal-body" style="height : 500px; overflow-y:scroll;">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Bahan</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbBahanBaku">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" id="txtTgl" class="form-control" placeholder="Masukan Tanggal" readonly>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Kembalian</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJumlahKembalian" class="form-control number" placeholder="Masukan Jumlah Permintaan (KG)">
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" id="btnTambahKembalianBahanBakuPending" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveAddKembalianBahanBaku();"><i class="fa fa-plus"></i> Tambah</button>
              </div>
              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tableListKembalianExtruderPending">
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
            <button type="button" id="btnSimpanKembalianBahanBaku" class="btn btn-md btn-flat btn-success" onclick="saveKirimKembalianBahanBaku();"><i class="fa fa-check"></i> Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCariHistoryKembalianBahanBaku" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistoryKembalianBahanBaku">&times;</button>
            <h4 class="modal-title text-blue">Cari History Kembalian Bahan Baku</h4>
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
                          <input type="text" id="txtTglAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
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
                          <input type="text" id="txtTglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
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
            <button type="button" id="btnCari" class="btn btn-md btn-flat btn-primary" onclick="searchHistoryKembalianBahanBaku();"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
