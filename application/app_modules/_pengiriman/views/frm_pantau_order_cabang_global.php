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
            <h4 class="box-title">Pantau Order Cabang Global</h4>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive table-striped" id="tableListPantauOrderCabangGlobal">
                  <thead>
                    <th>No.</th>
                    <th>Tanggal Pesan</th>
                    <th>Nama Pemesan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalDetailPesanan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="width:1110px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailPesanan">&times;</button>
              <h4 class="modal-title text-blue">Detail Pesanan</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListDetailPesanan">
                    <thead>
                      <th>Ukuran</th>
                      <th>Jenis / Merek</th>
                      <th>Plastik</th>
                      <th>Cetak</th>
                      <th>Los / Strip</th>
                      <th>Tebal</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditPesananDetail" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditPesananDetail">&times;</button>
              <h4 class="modal-title text-blue">Edit Detail Pesanan</h4>
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
                          <select class="form-control" id="cmbUkuran">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Warna Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaCetak" class="form-control" placeholder="Masukan Warna Cetakan Plastik">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Strip</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaStrip" class="form-control" placeholder="Masukan Warna Strip">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbJenis">
                            <option value="">--Pilih Jenis Barang--</option>
                            <option value="STANDARD">Standard</option>
                            <option value="KHUSUS">Khusus</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtTebal" class="form-control" placeholder="Masukan Tebal Plastik">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Permintaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPermintaan" class="form-control number">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Satuan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbSatuan">
                            <option value="">--Pilih Satuan--</option>
                            <option value="LEMBAR">Lembar</option>
                            <option value="KG">Kilogram</option>
                            <option value="BAL">BAL</option>
                            <option value="KALENG">Kaleng</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <textarea id="txtKetarangan" class="form-control" rows="5" cols="80" placeholder="Masukan Keterangan"></textarea>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditPesananDetail" class="btn btn-md btn-flat btn-primary"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>
