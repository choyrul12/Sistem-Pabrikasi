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
              <div class="col-md-3">
                <h4 class="box-title text-blue">Pengambilan Extruder</h4>
              </div>
              <div class="col-md-9">
                <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahPengambilanExtruder" data-backdrop="static" onclick="modalPengambilanCetak();"><i class="fa fa-plus"></i> Tambah Pengambilan Extruder</button>
              </div>
            </div>
            <div class="box-body">
              <table class="table table-responsive table-striped" id="tableDataPengambilanExtruder">
                <thead>
                  <th>No.</th>
                  <th>Tanggal Pengambilan</th>
                  <th>Ukuran</th>
                  <th>Merek</th>
                  <th>Warna</th>
                  <th>Tebal</th>
                  <th>Berat</th>
                  <th>Bobin</th>
                  <th>Payung</th>
                  <th>Payung Kuning</th>
                  <th>Shift</th>
                  <th>Action</th>
                </div>
                </thead>
              </table>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahPengambilanExtruder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahPengambilanExtruder">&times;</button>
              <h4 class="modal-title text-blue">Tambah Pengambilan Extruder</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal Rencana</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglTransaksi" class="form-control" placeholder="Masukan Tanggal Transaksi" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
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
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBerat" class="form-control number" placeholder="Masukan Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Bobin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBobin" class="form-control number" placeholder="Masukan Bobin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayung" class="form-control number" placeholder="Masukan Payung">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung Kuning</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuning" class="form-control number" placeholder="Masukan Payung Kuning">
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
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSave" class="btn btn-md btn-flat btn-primary" onclick="savePengambilanCetak();"><i class="fa fa-plus"></i> Simpan</button>
              <button type="button" class="btn btn-md btn-flat btn-danger" onclick="resetPengambilanCetakExtruder();"><i class="fa fa-remove"></i> Batal</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
