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
          <h4 class="text-blue">Permintaan Cat Murni</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <!-- <table class="table table-responsive table-striped" id="tableDataPermintaan">
                <thead>
                  <th>No.</th>
                  <th>Kode Permintaan</th>
                  <th>Tanggal Permintaan</th>
                  <th>Status Permintaan</th>
                  <th>Pengguna</th>
                  <th>Action</th>
                </thead>
              </table> -->

              <table class="table table-responsive table-striped" id="tableDetailPermintaan">
                <thead>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Warna / Ukuran</th>
                  <th>Tanggal</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Keterangan</th>
                  <th>Status Permintaan</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>

      <div class="box box-primary" style="display:none;">
        <div class="box-header with-border">
          <h4 class="text-blue">Permintaan Sparepart</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <!-- <table class="table table-responsive table-striped" id="tableDataPermintaanSparepart">
                <thead>
                  <th>No.</th>
                  <th>Kode Permintaan</th>
                  <th>Tanggal Permintaan</th>
                  <th>Status Permintaan</th>
                  <th>Pengguna</th>
                  <th>Action</th>
                </thead>
              </table> -->

              <table class="table table-responsive table-striped" id="tableDetailPermintaanSparePart">
                <thead>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Warna</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Keterangan</th>
                  <th>Status Permintaan</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>

      <div class="modal fade" id="modalLihatPesanan" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" id="btnCloseDetailPermintaan" class="close" data-dismiss="modal" data-target="#modalLihatPesanan">&times;</button>
              <h4 class="text-blue">Detail Permintaan</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableDetailPermintaan">
                    <thead>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Warna / Ukuran</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa</th>
                      <th>Keterangan</th>
                      <th>Status Permintaan</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalInputPenerimaanBarang" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" id="btnClosePenerimaanBarang" class="close" data-dismiss="modal" data-target="#modalInputPenerimaanBarang">&times;</button>
              <h4 class="text-blue">Input Penerimaan Barang</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Nama Supplier</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaSupplier" class="form-control" placeholder="Masukan Nama Supplier">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Penerimaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglTerima" class="form-control" placeholder="Masukan Tanggal Penerimaan" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trJumlahPermintaan" style="display:none;">
                      <td>Jumlah Penerimaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPenerimaan" class="form-control number" placeholder="Masukan Jumlah Penerimaan">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnTerima" class="btn btn-md btn-success btn-flat"><i class="fa fa-check"></i> Terima</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalLihatPermintaanSparePart" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" id="btnCloseDetailPermintaanSparePart" class="close" data-dismiss="modal" data-target="#modalLihatPermintaanSparePart">&times;</button>
              <h4 class="text-blue">Detail Permintaan</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableDetailPermintaanSparePart">
                    <thead>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Warna</th>
                      <th>Jumlah Permintaan</th>
                      <th>Keterangan</th>
                      <th>Status Permintaan</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalInputPenerimaanBarangSparePart" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" id="btnClosePenerimaanBarangSparePart" class="close" data-dismiss="modal" data-target="#modalInputPenerimaanBarangSparePart">&times;</button>
              <h4 class="text-blue">Input Penerimaan Barang</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Nama Supplier</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaSupplier" class="form-control" placeholder="Masukan Nama Supplier">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Penerimaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglTerima" class="form-control" placeholder="Masukan Tanggal Penerimaan" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trJumlahPermintaan" style="display:none;">
                      <td>Jumlah Penerimaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPenerimaan" class="form-control number" placeholder="Masukan Jumlah Penerimaan">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnTerima" class="btn btn-md btn-success btn-flat"><i class="fa fa-check"></i> Terima</button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
