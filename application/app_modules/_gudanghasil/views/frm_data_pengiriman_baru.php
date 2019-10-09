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
        <div class="table-responsive col-md-12">
        <div class="form-group col-md-3 pull-right">
          <input type="text" class="form-control" style="margin-top: 2; margin-bottom: 0;" name="ukuran" id="searchPengirimanBaru" onkeyup="searchDataPengirminan()" placeholder="Cari">
        </div>
          <table class="table table-responsive table-striped" id="tableDataPengirimanBaru">
            <thead>
              <th>No.</th>
              <th>Ukuran</th>
              <th>Pemesan</th>
              <th>Tanggal Pesan</th>
              <th>Warna</th>
              <th>Merek</th>
              <th>Dll</th>
              <th>SM</th>
              <th>Jumlah Order</th>
              <th>Total Terkirim</th>
              <th>Sisa</th>
              <th>Note</th>
              <th>Action</th>
            </thead>
          </table>
        </div>
          
        </div>
      </div>

      <div class="modal fade" id="modalLihatNote" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalLihatNote">&times;</button>
              <h4 class="modal-title text-blue">Note Pesanan</h4>
            </div>
            <div class="modal-body" style="height : 300px; overflow-y:scroll;">
              <div id="noteWrapper">

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKirimPesanan" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:1110; margin:30px 0 30px 230px;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKirimPesanan">&times;</button>
              <h4 class="modal-title text-blue">Kirim Pesanan</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <legend>Data Pesanan</legend>
                    <table class="table table-responsive table-striped" id="tableDataPesanan">
                      <thead>
                        <th>No</th>
                        <th>Tgl. Pesan</th>
                        <th>Nama Pemesan</th>
                        <th>Ukuran</th>
                        <th>Warna Plastik</th>
                        <th>Merek</th>
                        <th>DLL</th>
                        <th>Jumlah Order</th>
                        <th>Jumlah Terkirim</th>
                        <th>Sisa</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <legend>Formulir Pengiriman Barang</legend>
                    <table class="table table-responsive">
                      <tr>
                        <td width="20%">Tgl. Pengiriman</td>
                        <td width="1%">:</td>
                        <td>
                          <div class="form-group has-warning">
                            <div class="input-group date">
                              <input type="text" id="txtTglPengiriman" class="form-control" placeholder="Pilih Tanggal" readonly>
                              <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Customer</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtNamaCustomer" class="form-control" placeholder="Masukan Nama Customer">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jumlah Order</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahOrder" class="form-control number" placeholder="Jumlah Order" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jumlah Per Kg</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPerKg" class="form-control number" placeholder="Satuan KG">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jumlah Per Lembar</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahPerLembar" class="form-control number" placeholder="Satuan Lembar">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td id="tdJumlahDikirim">Jumlah Yang Dikirim</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJumlahDikirim" class="form-control number" placeholder="Satuan Sesuai Pesanan">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtKeterangan" class="form-control" value="PENGIRIMAN BARANG" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Barang</td>
                        <td>:</td>
                        <td>
                          <div class="form-group has-warning">
                            <input type="text" id="txtJenisBarang" class="form-control" placeholder="Jenis Barang" readonly>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <button type="button" id="btnAddItemPengiriman" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button>
                    <input type="hidden" id="txtJenisJumlah" value="">
                    <input type="hidden" id="txtIdDp" value="">
                    <input type="hidden" id="txtWarna" value="">
                    <input type="hidden" id="txtKdGdHasil" value="">
                    <input type="hidden" id="txtKdGdBahan" value="">
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <legend>Daftar Pengiriman</legend>
                    <table class="table table-responsive table-striped" id="tableListPengirimanBaruTemp">
                      <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Ukuran</th>
                        <th>Jumlah Order</th>
                        <th>Jumlah Terkirim</th>
                        <th>Jumlah Per Kg</th>
                        <th>Jumlah Per Lembar</th>
                        <th>Warna Plastik</th>
                        <th>Merek</th>
                        <th>Permintaan</th>
                        <th>Action</th>
                      </thead>
                      <tbody style="max-height:400px; overflow-y:scroll;">

                      </tbody>
                    </table>
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSelesaiKiriman" class="btn btn-md btn-flat btn-success"><i class="fa fa-check"></i> Kirim</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div id="modal_editStatus" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Edit Status</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="id" id="idDp">
              <select class="form-control" id="status">
                <option value="Open">Open</option>
                <option value="Close">Close</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" onclick="updateStatus()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>UPDATE</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>

</div>
