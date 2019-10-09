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
        <div class="form-group col-md-3 pull-right">
          <input type="text" class="form-control" style="margin-top: 2; margin-bottom: 2;" name="ukuran" id="searchOrderTerkirim" onkeyup="searchDataTerkirim()" placeholder="Cari">
        </div>
          <table class="table table-responsive table-striped" id="tableDataOrderTerkirim">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Pemesan</th>
              <th>Ukuran</th>
              <th>Warna</th>
              <th>Merek</th>
              <th>Dll</th>
              <th>Jumlah Order</th>
              <th>Total Terkirim</th>
              <th>Sisa</th>
              <th>Action</th>
            </thead>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalLihatDetailPengiriman" role="dialog" tabindex="-1">
        <div class="modal-dialog" style="width:1110; margin:30px 0 30px 230px;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalLihatDetailPengiriman">&times;</button>
              <h4 class="modal-title text-primary">Data Detail Pengiriman</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                <input type="hidden" name="id_dp" id="id_dp">
                  <table class="table table-responsive table-striped table-bordered" id="tableListDetailPengiriman">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Kirim</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Merek</th>
                      <th>Berat</th>
                      <th>Lembar</th>
                      <th>Jumlah Terkirim</th>
                      <th>Status</th>
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

      <div class="modal fade" id="modalEditDataOrderTerkirim" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalEditDataOrderTerkirim">&times;</button>
              <h4 class="modal-title text-blue">Edit Data Order Terkirim</h4>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Tgl. Pengiriman</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group">
                          <input type="text" id="txtTglPengiriman" class="form-control" placeholder="Pilih Tanggal" readonly>
                          <input type="hidden" name="id_detail_pengiriman" id="id_detail_pengiriman">
                          <input type="hidden" name="txtJumlahSebelum" id="txtJumlahSebelum">
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
                        <input type="text" id="txtNamaCustomer" class="form-control" placeholder="Masukan Nama Customer" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtNamaBarang" class="form-control" readonly>
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
                  <!-- <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtKeterangan" class="form-control" value="PENGIRIMAN BARANG" readonly>
                      </div>
                    </td>
                  </tr> -->
                  <!-- <tr>
                    <td>Jenis Barang</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJenisBarang" class="form-control" placeholder="Jenis Barang" readonly>
                      </div>
                    </td>
                  </tr> -->
                </table>
                <!-- <button type="button" id="btnAddItemPengiriman" class="btn btn-md btn-flat btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</button> -->
                <input type="hidden" id="txtJenisJumlah" value="">
                <input type="hidden" id="txtIdDp" value="">
                <input type="hidden" id="txtWarna" value="">
                <input type="hidden" id="txtKdGdHasil" value="">
                <input type="hidden" id="txtKdGdBahan" value="">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="updateEditDataOrderTerkirim" onclick="updateDataOrderTerkirim()" class="btn btn-md btn-flat btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
