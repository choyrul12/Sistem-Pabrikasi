<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
    <ol class="breadcrumb">
      <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
      <li><?php echo $Link["Segment1"]; ?></li>
      <li><?php echo $Link["Segment2"]; ?></li>
    </ol>
    <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalTambahPembelianBahanBaru" data-backdrop="static" onclick="modalTambahPembelianBahanBaku('BAHAN_BAKU');"><span class="fa fa-plus"></span> Tambah Pembelian Bahan Baku</button>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_addBahan" data-backdrop='static' onclick="getKdBahan('BAHAN BAKU')"><i class="fa fa-plus"></i> Tambah Bahan Baku</button>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_searchHistoryBahan" data-backdrop='static'><i class="fa fa-search"></i> History Bahan Baku</button>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow" id="alert_permintaanBahan" style="cursor: pointer; display: none;" onclick="listPermintaanPembelianBarang('BAHAN BAKU')">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-list-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-number">Permintaan Pembelian</span>
            <span class="info-box-text">Bahan Baku</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_permintaanBahan"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua" id="alert_rencanaPembelianBahan" style="cursor: pointer; display: none;" onclick="listRencanaPembelianBarang('BAHAN BAKU')">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-shopping-cart"></i></span>
          <div class="info-box-content">
            <span class="info-box-number">Rencana Pembelian</span>
            <span class="info-box-text">Bahan Baku</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_rencanaPembelianBahan"></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content" id="tbMasterBahanBaku">
    <table class="table table-responsive table-striped" id="tableMasterBahanBaku">
      <thead>
      	<th style="width: 15px;">No</th>
    		<th>Nama Barang</th>
      	<th>Warna</th>
      	<th>Stok</th>
      	<!-- <th colspan="2" style="text-align: center; width: 30px">Action</th> -->
      </thead>
    </table>
  </section>
    <section>
      <div class="modal fade" id="modalTambahPembelianBahanBaru" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahPembelianBahanBaru">&times;</button>
              <h4 class="modal-title text-primary">Tambah Pembelian Bahan Baku Baru</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <fieldset>
                <legend>Formulir Permintaan Pembelian Bahan Baku</legend>
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Kode Permintaan</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtKdPermintaan" class="form-control" placeholder="Masukan Kode Permintaan" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td width="20%">Tanggal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <div class="input-group date">
                          <input type="text" class="form-control" id="txtTanggalBeli" placeholder="Masukan Tanggal Pembelian" readonly>
                          <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td>Nama Customer</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control" id="txtNamaCustomer" placeholder="Masukan Nama Customer" maxlength="100">
                      </div>
                    </td>
                  </tr> -->
                  <tr>
                    <td>Bahan Baku</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbGudangBahan"></select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Bahan Baku</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtNamaBahan" class="form-control" placeholder="Akan Muncul Otomatis Saat Bahan Baku Sudah Dipilih" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Pembelian</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" class="form-control number" id="txtJumlahPermintaan" placeholder="Masukan Jumlah Pembelian" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                        <textarea id="txtKeterangan" class="form-control" rows="5" cols="50"></textarea>
                      </div>
                    </td>
                  </tr>
                </table>
                <button type="button" class="btn btn-md btn-flat btn-primary pull-right" id="btnTambahPembelian">Tambah</button>
                <button type="button" class="btn btn-md btn-flat btn-warning pull-right" onclick="resetFormPembelian('BAHAN BAKU');">Batal</button>
                <small class="text-red">
                  Note : 1. Kolom Berwarna Kuning Tidak Boleh Kosong <br>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         2. Jika Tidak Ingin Mengubah Barang Maka Kolom Barang Dikosongkan Saja
                </small>
              </fieldset>

              <fieldset>
                <legend>Daftar Pembelian Barang</legend>
                <table class="table table-responsive table-striped table-hover" id="tableListPembelianBahanBakuTemp">
                  <thead>
                    <th>No.</th>
                    <th>Kode Permintaan</th>
                    <th>Tanggal</th>
                    <th>Bahan Baku</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </fieldset>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-md btn-flat btn-success" onclick="saveDanKirimPermintaan('BAHAN BAKU');"><span class="fa fa-check"></span> Kirim Permintaan</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_searchHistoryBahan" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search">&nbsp;&nbsp;Cari History Bahan Baku</i></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="Tanggal Awal">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Tanggal Akhir">
                </div>
              </div>
              <div class="form-group">
                <select class="form-control" value="" name="BahanBaku" id="BahanBaku">


                </select>
              </div>
              <div class="form-group">
                <button type="submit" onclick="cariHistoryBahanBaku('Bahan Baku')" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
