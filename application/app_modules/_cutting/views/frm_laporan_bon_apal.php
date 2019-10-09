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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariLaporan" data-backdrop="static"><i class="fa fa-search"></i> Cari Laporan Bon Apal</button>
            </div>
            <div class="box-body">
              <div id="dataBonApalWrapper" style="display:none;">
                <button type="button" class="btn btn-md btn-flat btn-warning" id="btnModalEditKeteranganApal" data-toggle="modal" data-target="#modalEditKeterangan" data-backdrop="static" onclick="modalTambahKeteranganApal();"><i class="fa fa-pencil"></i> Edit Keterangan Apal</button>
                  <table class="table table-responsive table-striped" id="tableListApal">
                    <thead>
                      <th>Customer</th>
                      <th>Merek</th>
                      <th>No. Mesin</th>
                      <th>Apal</th>
                      <th>Warna</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <button type="button" id="btnBuatBon" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalBuatBon"><i class="fa fa-plus"></i> Buat Bon</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalCariLaporan" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalCariLaporan">&times;</button>
                <h4 class="modal-title text-blue">Cari Laporan Bon Apal</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Tanggal</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <div class="input-group date">
                              <input type="text" id="txtTanggal" class="form-control" placeholder="Masukan Tanggal" readonly>
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbJenis">
                              <option value="">--Pilih Jenis--</option>
                              <option value="POLOS">Polos</option>
                              <option value="CETAK">Cetak</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnCariLaporanBonApal" onclick="searchBonApal()" class="btn btn-md btn-flat btn-success"><i class="fa fa-search"></i> Cari Laporan</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalEditKeterangan" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-target="#modalEditKeterangan">&times;</button>
                <h4 class="modal-title text-blue">Edit Keterangan Apal</h4>
              </div>
              <div class="modal-body" style="height:500px; overflow-y:scroll;">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Jenis Apal</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <select class="form-control" id="cmbJenisApal"></select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jumlah Apal</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahApal" class="form-control number" placeholder="Masukan Jumlah Apal">
                          </div>
                        </td>
                      </tr>
                    </table>
                    <button type="button" id="btnResetEditBonApal" class="btn btn-md btn-flat btn-danger pull-right" onclick="resetTambahBonApalPending()"><i class="fa fa-remove"></i> Batal</button>
                    <button type="button" id="btnTambahApalGlobalPerJenis" class="btn btn-md btn-flat btn-primary pull-right" onclick="saveTambahBonApal();"><i class="fa fa-plus"></i> Tambah</button>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-responsive table-striped" id="tableListDataBonApalPending">
                      <thead>
                        <th>No.</th>
                        <th>Jenis Apal</th>
                        <th>Jumlah Apal</th>
                        <th>Action</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnSaveApalGlobalPerJenis" class="btn btn-md btn-flat btn-success" onclick="saveTransaksiDetailHistoryApal();"><i class="fa fa-check"></i> Selesai</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalBuatBon" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-target="#modalBuatBon" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-blue">Buat Bon</h4>
              </div>
              <div class="modal-body">
                <div id="buatBonApalWrapper" style="display:block;">
                  <table class="table table-responsive table-striped" id="tableListBon">
                    <thead>
                      <th>Ukuran</th>
                      <th>Merek</th>
                      <th>No. Mesin</th>
                      <th>Apal</th>
                      <th>Warna</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <div class="col-md-4">
                    <label>Keterangan : </label>
                    <ul>
                      <li><label id="liMerah">Merah = 0</label></li>
                      <li><label id="liHijau">Hijau = 0</label></li>
                      <li><label id="liKuning">Kuning = 0</label></li>
                      <li><label id="liBiru">Biru = 0</label></li>
                      <li><label id="liOrange">Orange = 0</label></li>
                      <li><label id="liCoklat">Coklat = 0</label></li>
                      <li><label id="liHitam">Hitam = 0</label></li>
                      <li><label id="liUngu">Ungu = 0</label></li>
                      <li><label id="liSilver">Silver = 0</label></li>
                      <li><label id="liStrip">Strip = 0</label></li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <ul>
                      <li><label id="liPutihSusu">Putih Susu = 0</label></li>
                      <li><label id="liPutih">Putih = 0</label></li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <ul>
                      <li><label id="liLaporan">Laporan = 0</label></li>
                    </ul>
                  </div>
                  <div class="col-md-12">
                    <!-- <button type="button" id="btnKirimBonApal" class="btn btn-md btn-flat btn-primary"><i class="fa fa-send"></i> Kirim</button> -->
                    <a href="#" target="_blank" id="btnPrint" class="btn btn-md btn-flat btn-success"><i class="fa fa-print"></i> Cetak</a>
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
