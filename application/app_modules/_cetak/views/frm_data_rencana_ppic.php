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
                <h4 class="box-title text-blue">List Rencana Kerja PPIC</h4>
              </div>
              <div class="col-md-9">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" id="cmbBulan">
                      <option value="">--Pilih Bulan--</option>
                      <?php
                      $arrBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                      for ($i=1; $i <=12; $i++) {
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $arrBulan[$i-1]; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control" id="cmbTahun">
                      <option value="">--Pilih Tahun--</option>
                      <?php
                      $last5Years = date("Y",strtotime("-12 years"));
                      for ($i=date("Y"); $i > $last5Years ; $i--) {
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="button" id="btnCariRencanaPPIC" class="btn btn-md btn-flat btn-primary" onclick="searchDataRencanaPPIC();"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableRencanaPPIC">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Customer</th>
                      <th>Merek</th>
                      <th>Berat</th>
                      <th>Ukuran</th>
                      <th>Warna Plastik</th>
                      <th>Warna Cat</th>
                      <th>Strip</th>
                      <th>Tebal</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKonversiBerat" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKonversiBerat">&times;</button>
              <h4 class="modal-title text-blue">Konversi Ke Kilogram</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Permintaan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" id="txtPemintaanKonversi" class="form-control" placeholder="Masukan Jumlah Permintaan" readonly>
                            <span class="input-group-addon">
                              <label id="lblSatuan" class="text-blue">LEMBAR</label>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtUkuranKonversi" class="form-control" placeholder="Masukan Ukuran" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtBeratKonversi" class="form-control" placeholder="Masukan Barat" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtTebalKonversi" class="form-control" placeholder="Masukan Tebal" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Konversi</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group">
                            <input type="text" id="txtJumlahKonversi" class="form-control number" placeholder="Masukan Jumlah Konversi">
                            <span class="input-group-addon">
                              <label class="text-blue">KG</label>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanKonversi" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalBuatRencana" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="width:1110px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalBuatRencana">&times;</button>
              <h4 class="modal-title text-blue">Buat Rencana</h4>
            </div>
            <div class="modal-body" style="height : 500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableRencanaDetailPPIC">
                    <thead>
                      <th>No.</th>
                      <th>Nama Customer</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna Plastik</th>
                      <th>Tebal</th>
                      <th>Jumlah Permintaan</th>
                      <th>Sisa</th>
                      <th>Status</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>

                <div class="col-md-6">
                  <input type="hidden" id="txtJnsBrg" value="">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Rencana</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKodeRencana" class="form-control" placeholder="Masukan Kode Rencana" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Kode Barang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtKodeBarang" class="form-control" placeholder="Masukan Kode Barang Cetak" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek Bahan Roll</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="txtKodeGdRoll">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Pengerjaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglPengerjaan" class="form-control" placeholder="Masukan Tanggal Pengerjaan" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Mesin</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <select class="form-control" id="cmbMesin">

                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtNamaCustomer" class="form-control" placeholder="Masukan Nama Customer" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtMerek" class="form-control" placeholder="Masukan Merek" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtUkuran" class="form-control" placeholder="Masukan Ukuran" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Warna Cat</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaCat" class="form-control" placeholder="Masukan Warna Cat" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Strip</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtStrip" class="form-control" placeholder="Masukan Strip" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Warna Plastik</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtWarnaPlastik" class="form-control" placeholder="Masukan Warna Plastik" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tebal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtTebal" class="form-control" placeholder="Masukan Tebal Plastik" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtStatus" class="form-control" placeholder="Masukan Status" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Permintaan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPermintaan" class="form-control number" placeholder="Masukan Jumlah Permintaan">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <button type="button" id="btnResetFormBuatRencana" class="btn btn-md btn-flat btn-danger pull-right"><i class="fa fa-remove"></i> Batal</button>
                  <button type="button" id="btnTambahRencanaPending" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="col-md-12">
                  <h4 class="text-blue">List Perencanaan Kerja Dengan Customer</h4>
                  <table class="table table-responsive table-striped" id="tableRencanaCetakPending">
                    <thead>
                      <th>No.</th>
                      <th>No. Mesin</th>
                      <th>Merek</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Tebal</th>
                      <th>Jumlah Permintaan</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSimpanRencanaPending" class="btn btn-md btn-flat btn-success" onclick="saveRencanaCetak();"><i class="fa fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditStatusRencana" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditStatusRencana">&times;</button>
              <h4 class="modal-title text-blue">Edit Status Rencana</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td>Status Pengerjaan</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <select class="form-control" id="cmbStatusPengerjaan">
                        <option value="">--Pilih Status Pengerjaan---</option>
                        <option value="PENDING">PENDING</option>
                        <option value="PROGRESS">PROGRESS</option>
                        <option value="FINISH">FINISH</option>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnUbahStatusPengerjaan" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
