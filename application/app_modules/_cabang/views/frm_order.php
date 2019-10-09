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
        <div class="col-md-6">
          <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-backdrop="static" data-keyboard="true" data-target="#modalOrder" onclick="modalOrderCabang();">Tambah Order Baru</button>
        </div>
        <div class="col-md-12">
          <div class="col-md-6">
            <table class="table table-responsive">
              <tr>
                <td width="25%">No. Order</td>
                <td width="1%">:</td>
                <td>
                  <input type="text" id="txtNoOrder" class="form-control" value="<?php echo $NoOrder; ?>" readonly>
                </td>
              </tr>
              <tr>
                <td>No. PO</td>
                <td>:</td>
                <td>
                  <input type="text" id="txtNoPo" class="form-control" value="<?php echo $NoPo; ?>" readonly>
                </td>
              </tr>
              <tr>
                <td>Kode Customer</td>
                <td>:</td>
                <td>
                  <input type="text" id="txtKdCust" class="form-control" value="<?php echo $DataCust[0]['kd_cust']; ?>" readonly>
                </td>
              </tr>
              <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td>
                  <input type="text" id="txtNmCust" class="form-control" value="<?php echo $DataCust[0]['nm_perusahaan']; ?>" readonly>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-responsive">
              <tr>
                <td width="25%">Tanggal Pesan</td>
                <td width="1%">:</td>
                <td>
                  <input type="text" id="txtTglPesan" class="form-control" value="<?php echo date('Y-m-d') ?>" readonly>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <table class="table table-responsive table-striped" id="tablePesananTemp">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align:middle;">Tanggal</th>
                <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                <th rowspan="2" style="vertical-align:middle;">Jenis / Merek</th>
                <th rowspan="2" style="vertical-align:middle;">Jenis Gudang / Tipe Barang</th>
                <th colspan="2"><center>Warna</center></th>
                <th colspan="1"><center>Atas Klip</center></th>
                <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                <th rowspan="2" style="vertical-align:middle;">Jumlah</th>
                <th rowspan="2" style="vertical-align:middle;">Keterangan</th>
                <th rowspan="2" style="vertical-align:middle;">Action</th>
              </tr>
              <tr>
                <th><center>Plastik</center></th>
                <th><center>Cetak</center></th>
                <th><center>Los / Strip</center></th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="col-md-12">
          <div class="col-md-4 pull-right" style="margin-top:10px;">
            <button type="button" class="btn btn-md btn-flat btn-warning btn-block" onclick="savePesananFinal();">Selesai</button>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalOrder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalOrder">&times;</button>
              <h3 class="modal-title text-primary" id="modalCabangOrderTitle">Tambah Order Baru</h3>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <table class="table table-responsive">
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbUkuran" required></select>
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
              <button type="button" class="btn btn-md btn-flat btn-success pull-right" onclick="saveDetailOrderTemp();">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
