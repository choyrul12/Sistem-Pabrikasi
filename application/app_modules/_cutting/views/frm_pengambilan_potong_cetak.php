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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahPengambilan" data-backdrop="static" onclick="modalTambahPengambilanPotong('CETAK');"><i class="fa fa-plus"></i> Tambah Pengambilan</button>
              <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalCariHistory" data-backdrop="static"><i class="fa fa-search"></i> Cari History</button>
              <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalTambahPengambilanTertinggal" data-backdrop="static" onclick="modalTambahPengambilanPotongTertinggal('CETAK');"><i class="fa fa-search"></i> Tambah Pengambilan Tertinggal</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableDataPengambilanCetak">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Ambil</th>
                      <th>Tanggal Potong</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Merek</th>
                      <th>Berat</th>
                      <th>Payung</th>
                      <th>Payung Kuning</th>
                      <th>Bobin</th>
                      <th>Status Pengambilan</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="button" id="btnPrintPreview" class="btn btn-md btn-flat btn-info"><i class="fa fa-print"></i> Cetak</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahPengambilan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-toggle="modal" data-target="#modalTambahPengambilan">&times;</button>
              <h4 class="modal-title text-blue">Tambah Pengambilan Barang Di Cetak</h4>
            </div>
            <div class="modal-body" style="height:87%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal Pengambilan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPengambilan" class="form-control" placeholder="Masukan Tanggal Pengambilan" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Potong</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPotong" class="form-control" placeholder="Masukan Tanggal Potong" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trUkuran" style="display:none;">
                      <td>Ukuran Extruder</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdCutting">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratPengambilan" class="form-control number" placeholder="Masukan Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayung" class="form-control number" placeholder="Masukan Jumlah Payung">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung Kuning</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuning" class="form-control number" placeholder="Masukan Jumlah Payung Kuning">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Bobin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobin" class="form-control number" placeholder="Masukan Jumlah Bobin">
                        </div>
                      </td>
                    </tr>
                    <tr id="trUkuranTumpuk" style="display:none;">
                      <td>Ukuran Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbUkuranTumpuk">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr id="trBeratTumpuk" style="display:none;">
                      <td>Berat Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratTumpuk" class="form-control number" placeholder="Masukan Jumlah Berat Tumpuk">
                        </div>
                      </td>
                    </tr>
                    <tr id="trPayungTumpuk" style="display:none;">
                      <td>Payung Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungTumpuk" class="form-control number" placeholder="Masukan Jumlah Payung Tumpuk">
                        </div>
                      </td>
                    </tr>
                    <tr id="trPayungKuningTumpuk" style="display:none;">
                      <td>Payung Kuning Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuningTumpuk" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Tumpuk">
                        </div>
                      </td>
                    </tr>
                    <tr id="trBobinTumpuk" style="display:none;">
                      <td>Bobin Tumpuk</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBobinTumpuk" class="form-control number" placeholder="Masukan Jumlah Bobin Tumpuk">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKetarangan">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="PAGI">Pagi</option>
                            <option value="MALEM">Malem</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Status Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtStatusPengambilan" class="form-control" value="EXTRUDER" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetFormPengambilanBagian();"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahPengambilan" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistory">&times;</button>
              <h4 class="modal-title text-blue">Cari History Pengambilan Cetak</h4>
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
                      <td>Tanggal Akhir</td>
                      <td>:</td>
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
              <button type="button" class="btn btn-md btn-flat btn-success"  onclick="searchPengambilanPotong('CETAK');"><i class="fa fa-search"></i> Cari Pengambilan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalTambahPengambilanTertinggal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-toggle="modal" data-target="#modalTambahPengambilanTertinggal">&times;</button>
              <h4 class="modal-title text-blue">Tambah Pengambilan Barang Di Cetak</h4>
            </div>
            <div class="modal-body" style="height:87%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal Pengambilan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPengambilanTertinggal" class="form-control" placeholder="Masukan Tanggal Pengambilan" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Potong</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPotongTertinggal" class="form-control" placeholder="Masukan Tanggal Potong" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trUkuranTertinggal" style="display:none;">
                      <td>Ukuran Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdCuttingTertinggal">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>Jenis Barang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbJenisBarang">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdGdRoll">

                          </select>
                        </div>
                      </td>
                    </tr>-->
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratPengambilanTertinggal" class="form-control number" placeholder="Masukan Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungTertinggal" class="form-control number" placeholder="Masukan Jumlah Payung">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung Kuning</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuningTertinggal" class="form-control number" placeholder="Masukan Jumlah Payung Kuning">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Bobin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobinTertinggal" class="form-control number" placeholder="Masukan Jumlah Bobin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKetaranganTertinggal">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="PAGI">Pagi</option>
                            <option value="MALEM">Malem</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Status Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtStatusPengambilanTertinggal" class="form-control" value="CETAK" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahPengambilanTertinggal" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditPengambilan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-toggle="modal" data-target="#modalEditPengambilan">&times;</button>
              <h4 class="modal-title text-blue">Edit Pengambilan Barang Di Cetak</h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal Pengambilan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPengambilan_Edit" class="form-control" placeholder="Masukan Tanggal Pengambilan" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Potong</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPotong_Edit" class="form-control" placeholder="Masukan Tanggal Potong" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr id="trUkuran_Edit" style="display:none;">
                      <td>Ukuran Extruder</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdCutting_Edit">

                          </select>
                        </div>
                        <small class="text-red"><b>NOTE : Jika Tidak Ingin Merubah Barang Dan Rencana Maka Kolom Ini Dibiarkan Kosong Saja.</b></small>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>Jenis Barang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbJenisBarang">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKdGdRoll">

                          </select>
                        </div>
                      </td>
                    </tr> -->
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtBeratPengambilan_Edit" class="form-control number" placeholder="Masukan Berat">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayung_Edit" class="form-control number" placeholder="Masukan Jumlah Payung">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Payung Kuning</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPayungKuning_Edit" class="form-control number" placeholder="Masukan Jumlah Payung Kuning">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Bobin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobin_Edit" class="form-control number" placeholder="Masukan Jumlah Bobin">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Double / Single</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtDoubleSingle_Edit" class="form-control number" placeholder="Masukan Double / Single">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbKetarangan_Edit">
                            <option value="">--Pilih Keterangan--</option>
                            <option value="PAGI">Pagi</option>
                            <option value="MALEM">Malem</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Status Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtStatusPengambilan_Edit" class="form-control" value="EXTRUDER" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" class="btn btn-md btn-flat btn-danger pull-right"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnEditPengambilan" class="btn btn-md btn-flat btn-warning pull-right"><i class="fa fa-pencil"></i> Ubah</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    </section>

</div>
