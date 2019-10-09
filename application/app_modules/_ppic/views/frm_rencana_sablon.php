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
          <h3 class="box-title">Data SPK Sablon</h3>
          <button type="button" id="btn-tambah-spk-sablon" class="btn btn-flat btn-md btn-primary" onclick="modalTambahSpkSablon('SABLON','CETAK')" data-toggle="modal" data-target="#modal-tambah-spk-sablon">
            <span class="fa fa-plus"></span>
            Tambah SPK
          </button>
          <button type="button" id="btn-cari-spk-sablon" class="btn btn-flat btn-md btn-warning" data-toggle="modal" data-target="#modal-cari-spk-sablon">
            <span class="fa fa-search"></span>
            Cari SPK
          </button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-bordered table-striped" id="table-list-spk-sablon">
                <thead>
                  <th>Kode SPK</th>
                  <th>Tgl. Permintaan</th>
                  <th>Customer</th>
                  <th>Merek</th>
                  <th>Ukuran</th>
                  <th>Warna Plastik</th>
                  <th>Warna Cetak</th>
                  <th>Berat</th>
                  <th>Tebal</th>
                  <th>Strip</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Status Pengerjaan</th>
                  <th>Keterangan</th>
                  <th>Gambar</th>
                  <th>Action</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-tambah-spk-sablon" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal" data-target="#modal-tambah-spk-sablon" onclick="resetFormTambahSpkExt();">&times;</button>
              <h3 class="modal-title" id="modalTitleSpkSablon">Tambah SPK Sablon</h3>
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
                      <select class="form-control" id="cmbBarangSablon" required></select>
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
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaPlastik" class="form-control" placeholder="Warna Plastik" readonly required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group has-warning">
                          <input type="text" id="txtPermintaan" class="form-control" placeholder="Permintaan" readonly required>
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
                  <td>Warna Cetak</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning" id="comboCustomWrapper">
                      <select class="form-control" id="cmbWarnaCetak" onchange="changeCustomCombo(this)">
                        <option value="Putih">Putih</option>
                        <option value="Biru">Biru</option>
                        <option value="Merah">Merah</option>
                        <option value="Coklat">Coklat</option>
                        <option value="Kuning">Kuning</option>
                        <option value="Hitam">Hitam</option>
               		      <option value="Hijau">Hijau</option>
                        <option value="Violet">Violet</option>
                        <option value="Custom">Custom</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Atas Klip</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbStrip">
                        <option value="POLOS">POLOS</option>
                        <option value="MERAH">MERAH</option>
                        <option value="PUTIH SUSU">PUTIH SUSU</option>
                        <option value="MERAH ORANGE">MERAH ORANGE</option>
                        <option value="MERAH PUTIH SUSU">MERAH PUTIH SUSU</option>
                        <option value="ORANGE">ORANGE</option>
                        <option value="CUSTOM">CUSTOM</option>
                      </select>

                      <div class="input-group" id="inputGroup2" style="display:none; width:100%; float:left;">
                        <input type="text" id="txtStrip" class="form-control" style="width:98%; float:left;" placeholder="Masukan Warna Strip">
                          <button type="button" class="close" style="margin-top:6px;" id="btnCloseCustomStrip">&times;</button>
                      </div>
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
                  <td>Gambar Depan</td>
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
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>
                    <button type="button" id="btnSimpanSpkSablon" class="btn btn-flat btn-md btn-success">Simpan</button>
                    <button type="button" id="btnBatalSpkSablon" class="btn btn-flat btn-md btn-warning" onclick="resetFormTambahSpkSablon();">Bersihkan</button>
                    <button type="button" class="btn btn-flat btn-md btn-danger" data-dismiss="modal" data-target="#modal-tambah-spk-sablon" onclick="resetFormTambahSpkSablon();">Batal</button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-cari-spk-sablon" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modal-cari-spk-sablon">&times;</button>
              <h3 class="modal-title">Cari SPK Sablon</h3>
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
                    <button type="button" id="btn-cari-spk-sablon" class="btn btn-flat btn-md btn-info" onclick="cariSpkSablon()">
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
              <button type="button" class="close" data-dismiss="modal" data-target="#modalStopSpkSablon">&times;</button>
              <h4 class="modal-title text-danger">
                Pemberhentian SPK Sablon
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
                      <!-- <option value="PROGRESS">PROGRESS</option>
                      <option value="FINISH">FINISH</option> -->
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
