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
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Data SPK Extruder</h3>
          <button type="button" id="btn-tambah-spk-extruder" class="btn btn-flat btn-md btn-primary" onclick="modalTambahSpkExtruder('POLOS')" data-toggle="modal" data-target="#modal-tambah-spk-extruder">
            <span class="fa fa-plus"></span>
            Tambah SPK
          </button>
          <button type="button" id="btn-cari-spk-extruder" class="btn btn-flat btn-md btn-warning" data-toggle="modal" data-target="#modal-cari-spk-extruder">
            <span class="fa fa-search"></span>
            Cari SPK
          </button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-bordered table-striped" id="table-list-spk-extruder">
                <thead>
                  <th>Kode SPK</th>
                  <th>Tgl. Permintaan</th>
                  <th>Customer</th>
                  <th>Permintaan</th>
                  <th>Ukuran</th>
                  <th>Warna Plastik</th>
                  <th style="width:1%">Tebal</th>
                  <th>Merek</th>
                  <th>Ket.Merek</th>
                  <th>Berat</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Strip</th>
                  <th>Keterangan</th>
                  <th>Status Pengerjaan</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-tambah-spk-extruder" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal" data-target="#modal-tambah-spk-extruder" onclick="resetFormTambahSpkExt();">&times;</button>
              <h3 class="modal-title" id="modalTitleSpkExtruder">Tambah SPK Extruder</h3>
            </div>
            <div class="modal-body" style="height:550px; overflow-y:scroll;">
              <table class="table">
                <tr>
                  <td>Kode SPK</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtKdPpic" value="" class="form-control" required readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Nama Customer</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtNmCustomer" value="" class="form-control" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tgl. Perencanaan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTglRencana" class="form-control" required readonly="">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Merek</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbBarangExtruder" required></select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group has-warning">
                          <input type="text" id="txtMerek" class="form-control" placeholder="Merek" readonly required>
                        </div>
                        <div class="form-group">
                          <input type="text" id="txtKetMerek" class="form-control" placeholder="Keterangan Merek">
                        </div>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaPlastik" class="form-control" placeholder="Warna Plastik" readonly required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group has-warning">
                          <input type="text" id="txtPermintaan" class="form-control" placeholder="Permintaan" readonly required>
                        </div>
                        <div class="form-group">
                          <input type="text" id="txtKetPermintaan" class="form-control" placeholder="Keterangan Permintaan">
                        </div>
                        <div class="form-group has-warning">
                          <input type="text" id="txtUkuran" class="form-control" placeholder="Ukuran" required>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tebal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtTebal" value="" class="form-control" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Berat</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtBerat" value="" class="form-control" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Permintaan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <input type="text" id="txtJumlahPermintaan" value="" class="form-control number" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Satuan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbSatuan">
                        <option value="#">--Pilih Satuan--</option>
                        <option value="KG">Kilogram</option>
                        <option value="LEMBAR">Lembar</option>
                        <option value="TON">TON</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Strip</td>
                  <td>:</td>
                  <td id="td-strip-wrapper">
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbStrip" onchange="changeStripCustom(this)">
                        <option value="#">--Pilih Strip--</option>
                        <option value="Merah">Merah</option>
                        <option value="Pink">Pink</option>
                        <option value="Merah Orange">Merah Orange</option>
                        <option value="Orange">Orange</option>
                        <option value="Merah Putih">Merah Putih</option>
                        <option value="Lose">Lose</option>
                        <option value="Putih Susu">Putih Susu</option>
                        <option value="Custom">Custom</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbStatus">
                        <!-- <option value="#">--Pilih Status--</option> -->
                        <option value="BIASA">BIASA</option>
                        <option value="TUNDA">TUNDA</option>
                        <option value="URGENT">URGENT</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td>
                    <textarea id="txtKeterangan" rows="8" cols="80"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>Gambar</td>
                  <td>:</td>
                  <td>
                    <input type="file" id="fileFoto" value="" accept="image/*" class="btn btn-flat btn-md btn-primary" style="float:left;" onchange="previewImage(this);">
                    <div class="input-group" id="inputGroup" style="float:left;">
                      <img src="" id="preview-fileFoto" style="float:left; margin-left:10px;margin-top:10px;" width="100px" height="100px" >
                      <button type="button" class="close" id="clearImage" style="margin-left:5px;" onclick="clearPreviewImage('fileFoto');">&times;</button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>
                    <button type="button" id="btnSimpanSpkExtruder" class="btn btn-flat btn-md btn-success">Simpan</button>
                    <button type="button" id="btnBatalSpkExtruder" class="btn btn-flat btn-md btn-warning" onclick="resetFormTambahSpkExt();">Bersihkan</button>
                    <button type="button" class="btn btn-flat btn-md btn-danger" data-dismiss="modal" data-target="#modal-tambah-spk-extruder" onclick="resetFormTambahSpkExt();">Batal</button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-cari-spk-extruder" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modal-cari-spk-extruder">&times;</button>
              <h3 class="modal-title">Cari SPK Exruder</h3>
            </div>
            <div class="modal-body">
              <table class="table">
                <tr>
                  <td>Tanggal Awal</td>
                  <td>:</td>
                  <td>
                    <div class="input-group date">
                      <input class="form-control" type="text" id="txt_tgl_awal" required readonly placeholder="Tanggal Awal">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Akhir</td>
                  <td>:</td>
                  <td>
                    <div class="input-group date">
                      <input class="form-control" type="text" id="txt_tgl_akhir" required readonly placeholder="Tanggal Akhir">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <button type="button" id="btn-cari-spk-extruder" class="btn btn-flat btn-md btn-info" onclick="cariSpkExtruder()">
                      <span class="fa fa-search"></span>
                      Cari
                    </button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalStopSpk" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalStopSpkExtruder">&times;</button>
              <h4 class="modal-title text-danger">
                Pemberhentian SPK Extruder
              </h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="checkbox" id="chkStatusPengerjaan" data-toggle="toggle" data-on="Start" data-off="Stop" data-onstyle="success" data-offstyle="danger">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control" id="cmbStatusPengerjaan">
                      <option value="">--Pilih Status--</option>
                      <option value="PENDING">PENDING</option>
                      <!-- <option value="PROGRESS">PROGRESS</option> -->
                      <!-- <option value="FINISH">FINISH</option> -->
                    </select>
                  </div>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea id="txtKetStop" rows="8" cols="80" class="form-control" placeholder="Keterangan Stop"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-4 pull-right">
                <button type="button" id="btnStopSpk" class="btn btn-md btn-block btn-flat btn-primary">Ubah</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
