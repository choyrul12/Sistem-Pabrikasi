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
              <button type="button" id="btnCariDataKartuStok" class="btn btn-md btn-flat btn-primary" onclick="modalCetakKartuStok()">
                <i class="fa fa-search"></i> Cari Data Kartu Stok
              </button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Nama Barang</td>
                      <td width="1%">:</td>
                      <td id="tdNamaBarang">

                      </td>
                    </tr>
                    <tr>
                      <td>Status Barang</td>
                      <td>:</td>
                      <td id="tdStatusBarang">

                      </td>
                    </tr>
                    <tr>
                      <td>Periode</td>
                      <td>:</td>
                      <td id="tdPeriode">

                      </td>
                    </tr>
                  </table>
                  <table class="table table-responsive table-bordered" id="tableDataKartuStok">
                    <thead>
                      <tr>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Keterangan Transaksi</th>
                        <th colspan="4"><center>Masuk</center></th>
                        <th colspan="4"><center>Keluar</center></th>
                        <th colspan="4"><center>Sisa</center></th>
                        <th colspan="4"><center>Sub Total</center></th>
                      </tr>
                      <tr>
                        <th>BR</th>
                        <th>B</th>
                        <th>P</th>
                        <th>PK</th>
                        <th>BR</th>
                        <th>B</th>
                        <th>P</th>
                        <th>PK</th>
                        <th>BR</th>
                        <th>B</th>
                        <th>P</th>
                        <th>PK</th>
                        <th>BR</th>
                        <th>B</th>
                        <th>P</th>
                        <th>PK</th>
                      </tr>
                    </thead>
                    <tfoot style="background-color:rgba(0, 180, 255, 0.8); color:#FFF;">
                      <td></td>
                      <td></td>
                      <td id="totalJumlahMasukBerat">0</td>
                      <td id="totalJumlahMasukBobin">0</td>
                      <td id="totalJumlahMasukPayung">0</td>
                      <td id="totalJumlahMasukPayungKuning">0</td>
                      <td id="totalJumlahKeluarBerat">0</td>
                      <td id="totalJumlahKeluarBobin">0</td>
                      <td id="totalJumlahKeluarPayung">0</td>
                      <td id="totalJumlahKeluarPayungKuning">0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tfoot>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariDataKartuStok" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistoryGudangRoll">&times;</button>
              <h4 class="modal-title text-blue">Cari History</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
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
                        <input type="text" id="txtTanggalAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
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
                        <option value="POLOS">POLOS</option>
                        <option value="CETAK">CETAK</option>
                      </select>
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
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchCetakDataKartuStok();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>

    </section>

</div>
