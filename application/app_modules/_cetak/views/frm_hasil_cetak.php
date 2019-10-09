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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariHasilCetak" data-backdrop="static"><i class="fa fa-search"></i> Cari Hasil Cetak</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="tableHasilCetakWrapper" style="display:none;">
                    <table class="table table-responsive table-striped" id="tableHasilCetak">
                      <thead>
                        <th>No.</th>
                        <th>Tgl. Rencana</th>
                        <th>Nama Customer</th>
                        <th>Merek</th>
                        <th>Ukuran</th>
                        <th>Warna Plastik</th>
                        <th>Warna Cat</th>
                        <th>Berat Bahan</th>
                        <th>Berat Bobin</th>
                        <th>Berat Payung</th>
                        <th>Berat Payung Kuning</th>
                        <th>Hasil Cetak</th>
                        <th>Hasil Roll Bobin</th>
                        <th>Hasil Payung</th>
                        <th>Hasil Payung Kuning</th>
                        <th>Berat Roll</th>
                        <th>Jumlah Apal</th>
                        <th>Plusminus</th>
                        <th>Action</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHasilCetak" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button"class="close" data-dismiss="modal" data-target="#modalCariHasilCetak">&times;</button>
              <h4 class="modal-title text-blue">Cari Hasil Cetak</h4>
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
                            <input type="text" id="txtTglAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
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
                            <input type="text" id="txtTglAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
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
              <button type="button" id="btnSearch" class="btn btn-md btn-flat btn-success" onclick="searchDataListHasilCetak();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditDetailJobCetak" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditDetailJobCetak">&times;</button>
              <h4 class="modal-title text-blue">Edit Detail Job Cetak</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Kode Cetak</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtKodeCetak" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Customer</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtNamaCustomer" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Merek</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtMerek" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ukuran</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtUkuran" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Warna Plastik</td>
                      <td>:</td>
                      <td>
                        <div class="form-group">
                          <input type="text" id="txtWarnaPlastik" class="form-control" readonly>
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
                      <td>Jumlah Berat Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratBahan" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Berat Pengambilan Bahan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungPengambilan" class="form-control number" placeholder="Masukan Jumlah Payung Pengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Kuning Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungKuningPengambilan" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Pengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Bobin Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobinPengambilan" class="form-control number" placeholder="Masukan Jumlah Bobin Pengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Sisa Pengambilan</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahSisaBeratBahan" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Sisa Pengambilan">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Berat Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratHasilCetak" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Berat Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungHasilCetak" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Payung Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Kuning Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahPayungKuningHasilCetak" class="form-control number" placeholder="Masukan Jumlah Payung Kuning Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Bobin Hasil Cetak</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBobinHasilCetak" class="form-control number" placeholder="Masukan Jumlah Bobin Hasil Cetak">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Apal</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahApal" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Apal">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Terbuang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratPayungTerbuang" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Payung Terbuang">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Bobin Terbuang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratBobinTerbuang" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Bobin Terbuang">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Payung Kuning Terbuang</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtJumlahBeratPayungKuningTerbuang" class="form-control number" onkeyup="hitungPlusMinus();" placeholder="Masukan Jumlah Payung Kuning Terbuang">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Berat Roll Pipa</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtRollPipa" class="form-control number" placeholder="Masukan Berat Roll Pipa" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Plus/Minus</td>
                      <td>:</td>
                      <td>
                        <div class="form-group has-warning">
                          <input type="text" id="txtPlusminus" class="form-control numberFive" placeholder="Masukan Plus/Minus" readonly>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditDetailJob" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalDetailJob" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailJob">&times;</button>
              <h4 class="modal-title text-blue" id="modal-title">Detail Hasil Job</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tablePemakaianBahanCetak">
                    <thead>
                      <th>Nama Bahan</th>
                      <th>Jumlah Pengambilan</th>
                      <th>Sisa Pengambilan</th>
                      <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalEditPenggunaanBahan" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditDetailJobCetak">&times;</button>
              <h4 class="modal-title text-blue">Edit Penggunaan Bahan</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="10%" id="tdJenisBarang">Jenis Barang</td>
                      <td width="1%">:</td>
                      <td>
                        <table class="table table-responsive">
                          <tr>
                            <td>
                              <div class="form-group has-warning">
                                <select class="form-control" id="cmbJenis">

                                </select>
                              </div>
                            </td>
                            <td>
                              <div class="form-group has-warning">
                                <input type="text" id="txtJumlahPengambilan" class="form-control number" placeholder="Masukan Jumlah Pengambilan">
                              </div>
                            </td>
                            <td>
                              <div class="form-group has-warning">
                                <input type="text" id="txtSisaPengambilan" class="form-control number" placeholder="Masukan Sisa Pengambilan">
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnEditPenggunaanBahan" class="btn btn-md btn-flat btn-primary"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
