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
    <div class="container" id="rowBuatRencanaKerjaExtruder">
      <div class="box box-primary">
        <div class="box-header with-border">

        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive" id="tableDetailRencanaPpic">
                <thead>
                  <th>No</th>
                  <th>Customer</th>
                  <th>Permintaan</th>
                  <th>Merek</th>
                  <th>Ukuran</th>
                  <th>Warna Plastik</th>
                  <th>Tebal</th>
                  <th>Berat</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Strip</th>
                  <th>Status</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Kode Extruder</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtKodeExtruder" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Pengerjaan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglPengerjaan" class="form-control" placeholder="Pilih Tanggal Pengerjaan" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>No.Mesin</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbNoMesin">

                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Order</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtNamaCustomer" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jenis Mesin</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbJenisMesin">
                        <option value="KLIP">KLIP</option>
                        <option value="ZP">ZP</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Ukuran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtUkuranOrder" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Warna</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtWarna" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tebal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtTebalOrder" class="form-control" placeholder="Masukan Tebal Plastik">
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Status</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtPrioritasOrder" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Rencana Yang Mau Dibuat</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlahRencanaPembuatan" class="form-control number" placeholder="Masukan Jumlah Yang Mau Dibuat (KG)">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Strip</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning" id="cmbStripWrapper">
                      <select class="form-control" id="cmbStrip">
                        <option value="LOSE">Lose</option>
                        <option value="MERAH">Merah</option>
                        <option value="PINK">Pink</option>
                        <option value="MERAH ORAGE">Merah Orange</option>
                        <option value="PUTIH SUSU">Putih Susu</option>
                        <option value="BIRU">Biru</option>
                        <option value="HITAM">Hitam</option>
                        <option value="CUSTOM">Custom</option>
                      </select>
                    </div>
                    <div class="form-group has-warning" id="txtStripWrapper" style="display:none;">
                      <div class="input-group" style="width:100%">
                        <input type="text" id="txtStrip" class="form-control" placeholder="Masukan Strip" style="width:95%; float:left">
                        <button type="button" id="closeTxtStrip" class="close" style="margin:5px 0 0 5px;">&times;</button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Motoran</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtMotoran" class="form-control" placeholder="Masukan Motoran">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Extruder</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtExtruder" class="form-control" placeholder="Masukan Extruder">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Bahan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div id="comboWrapper">
                        <select class="form-control" id="cmbBahan">
                          <option value="TITAN VANE + PETLIN">TITAN VANE + PETLIN</option>
                          <option value="PETLIN + EXXON">PETLIN + EXXON</option>
                          <option value="CUSTOM">CUSTOM</option>
                        </select>
                      </div>
                      <div id="textWrapper" style="display:none;">
                        <div class="input-group" style="width:100%;">
                          <textarea id="txtBahan" rows="5" cols="40" class="form-control" placeholder="Masukan Bahan" style="float:left; width:96%;"></textarea>
                          <button type="button" class="close" id="removeTextWrapper">&times;</button>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Berat</td>
                  <td>:</td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="txtBeratOrder" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-4 pull-right">
              <button type="button" id="btnResetRencana" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormBuatRencanaBaru();"><i class="fa fa-remove"></i> Batal</button>
              <button type="button" id="btnTambahRencana" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
            </div>
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableListRencanaExtruder">
                <thead>
                  <th>No.</th>
                  <th>No. Mesin</th>
                  <th>Motoran</th>
                  <th>Order</th>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Tebal</th>
                  <th>Jumlah Permintaan</th>
                  <th>Strip</th>
                  <th>Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="button" id="btnSaveRencanaExtruder" class="btn btn-md btn-flat btn-success" onclick="saveRencanaExtruder();"><i class="fa fa-check"></i> Simpan</button>
        </div>
      </div>
    </div>
  </section>

</div>
