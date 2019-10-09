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
          <table class="table table-responsive table-striped" id="tableApproveOrder">
            <thead>
              <th>No</th>
              <th>Tanggal</th>
              <th>Pemesan</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalDetailOrder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailOrder">&times;</button>
              <h4 class='modal-title'><b class="text-primary">Detail Pesanan</b></h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <table class="table table-responsive table-striped" id="tableDetailOrder">
                <thead>
                  <tr>
                    <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                    <th rowspan="2" style="vertical-align:middle;">Jenis/Merek</th>
                    <th rowspan="2" style="vertical-align:middle;">Jenis Gudang</th>
                    <th colspan="2"><center>Warna</center></th>
                    <th colspan="1"><center>Atas Klip</center></th>
                    <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                    <th rowspan="2" style="vertical-align:middle;">Jumlah</th>
                    <th rowspan="2" style="vertical-align:middle;">Keterangan</th>
                    <th rowspan="2" style="vertical-align:middle;">Status</th>
                    <th rowspan="2" style="vertical-align:middle;">Action</th>
                  </tr>
                  <tr>
                    <th><center>Plastik</center></th>
                    <th><center>Cetak</center></th>
                    <th><center>Los/Strip</center></th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="modal-footer">
              <center>
                <button type="button" id="btnApprove" class="btn btn-md btn-flat btn-success"><span class="fa fa-check"></span>Aprrove</button>
              </center>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditOrder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditOrder">&times;</button>
              <h4 class="modal-title text-blue">Edit Pesanan</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <input type="hidden" id="txtNoOrder">
              <table class="table table-responsive">
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbUkuran" required></select>
                      <span class="text-red">Note : Tidak Perlu Dipilih Jika Tidak Ingin Mengganti Barang</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="col-md-12">
                      <table class="table">
                        <tr>
                          <td>
                            <input type="text" id="txtMerek" class="form-control" readonly placeholder="Merek">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" id="txtUkuran" class="form-control" readonly placeholder="Ukuran">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" id="txtWarnaPlastik" class="form-control" readonly placeholder="Warna Plastik">
                          </td>
                        </tr>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Los/Strip</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtStrip" class="form-control" required placeholder="Strip">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenis">
                        <option value="STANDARD">STANDARD</option>
                        <option value="KHUSUS">KHUSUS</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Cetak</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtCetak" class="form-control" placeholder="Warna Cetak" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tebal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtTebal" class="form-control" placeholder="Tebal / Berat / Lembar" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlah" class="form-control" placeholder="Jumlah Pesanan" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Satuan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSatuan">
                        <option value="BAL">BAL</option>
                        <option value="KALENG">KALENG</option>
                        <option value="KG">KILOGRAM</option>
                        <option value="LEMBAR">LEMBAR</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <textarea id="txtKeterangan" rows="8" cols="50" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success pull-right" id="btnUbahPesananDetail">Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
