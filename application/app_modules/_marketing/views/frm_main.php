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
      <div class="box box-default collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Pencarian</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: none;">
          <table class="table table-responsive table-striped" id="table-pencarian">
            <thead>
              <th>No. Order</th>
              <th>Customer</th>
              <th>Ukuran</th>
              <th>Merek</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Jumlah Pesan</th>
              <th>Kode Harga</th>
              <th>Warna Cetak</th>
              <th>Warna Plastik</th>
              <th>Tgl.Pesan</th>
              <th>Status Pesanan</th>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal fade" role="dialog" id="modal-lihat-detail-pesanan">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="height:600px; overflow-y:scroll">
            <div class="modal-header">
              <button type='button' class='close' data-dismiss='modal' data-target="#modal-lihat-detail-pesanan" aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <center>
                <h3 class="text-primary"><b>Klip Plastik</b></h3>
                <p>
                  <b>
                    Jl.Yos Sudarso No.115A (Daan Mogot Km.19) Batu Ceper<br>
                    Kota Tangerang<br>
                    Telp.021-551-8899 | Fax.021-551-3905
                  </b>
                </p>
              </center>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">No. Order</td>
                      <td width="1%">:</td>
                      <td id="td_no_order"></td>
                    </tr>
                    <tr>
                      <td>Nama Perusahaan</td>
                      <td>:</td>
                      <td id="td_nm_perusahaan"></td>
                    </tr>
                    <tr>
                      <td>Nama Owner</td>
                      <td>:</td>
                      <td id="td_nm_owner"></td>
                    </tr>
                    <tr>
                      <td>Nama Pemesan</td>
                      <td>:</td>
                      <td id="td_nm_pemesan"></td>
                    </tr>
                    <tr>
                      <td>Nama Purchasing</td>
                      <td>:</td>
                      <td id="td_nm_purchasing"></td>
                    </tr>
                  </table>
                </div>

                <div class="col-md-6">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tgl. Pesan</td>
                      <td width="1%">:</td>
                      <td id="td_tgl_pesan"></td>
                    </tr>
                    <tr>
                      <td>Tgl. Estimasi</td>
                      <td>:</td>
                      <td id="td_tgl_estimasi"></td>
                    </tr>
                    <tr>
                      <td>Term Payment</td>
                      <td>:</td>
                      <td id="td_term_payment"></td>
                    </tr>
                    <tr>
                      <td>Proof</td>
                      <td>:</td>
                      <td id="td_proof"></td>
                    </tr>
                    <tr>
                      <td>Expedisi</td>
                      <td>:</td>
                      <td id="td_expedisi"></td>
                    </tr>
                  </table>
                </div>

                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tabel-lihat-pesanan-detail">
                    <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align:middle;">Jumlah</th>
                        <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                        <th rowspan="2" style="vertical-align:middle;">Harga</th>
                        <th rowspan="2" style="vertical-align:middle;">Merek</th>
                        <th colspan="2"><center>Warna</center></th>
                        <th rowspan="2" style="vertical-align:middle;">SM</th>
                        <th rowspan="2" style="vertical-align:middle;">DLL</th>
                        <th rowspan="2" style="vertical-align:middle;">Kode Harga</th>
                        <th rowspan="2" style="vertical-align:middle;">Status Pesanan</th>
                        <th rowspan="2" style="vertical-align:middle;">Status Pengiriman</th>
                      </tr>
                      <tr>
                        <th><center>Plastik</center></th>
                        <th><center>Cetak</center></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header">
                    <label class="pull-left">Note :</label>
                  </div>
                  <div class="box-body">
                    <div class="pull-left" id="paragraf-note">

                    </div>
                  </div>
                  <div class="box-footer">
                    <p id="last-update">Last Update : </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-detail-customer" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modal-detail-customer">&times;</button>
              <h3 class="modal-title">Data Customer</h3>
            </div>
            <div class="modal-body" style="height:550px;overflow-y:scroll;">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-responsive">
                    <tr>
                      <td width="15%">Kode Customer</td>
                      <td width="1%">:</td>
                      <td id="td_kd_cust"></td>
                    </tr>
                    <tr>
                      <td>Nama Perusahaan</td>
                      <td>:</td>
                      <td id="td_nm_perusahaan1"></td>
                    </tr>
                    <tr>
                      <td>Nama Owner</td>
                      <td>:</td>
                      <td id="td_nm_owner1"></td>
                    </tr>
                    <tr>
                      <td>Nama Purchasing</td>
                      <td>:</td>
                      <td id="td_nm_purchasing1"></td>
                    </tr>
                    <tr>
                      <td>No.telp</td>
                      <td>:</td>
                      <td id="td_no_telp"></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td id="td_alamat"></td>
                    </tr>
                  </table>
                </div><!--col-md-6_FIRST-->
                <div class="col-md-6">
                  <table class="table table-responsive">
                    <tr>
                      <td width="15%">Kota/ Provinsi/ Negara</td>
                      <td width="1%">:</td>
                      <td id="td_kota_prov_negara"></td>
                    </tr>
                    <tr>
                      <td>Kode Pos</td>
                      <td>:</td>
                      <td id="td_kd_pos"></td>
                    </tr>
                    <tr>
                      <td>No.Fax</td>
                      <td>:</td>
                      <td id="td_no_fax"></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td id="td_email"></td>
                    </tr>
                    <tr>
                      <td>Website</td>
                      <td>:</td>
                      <td id="td_website"></td>
                    </tr>
                    <tr>
                      <td>Note</td>
                      <td>:</td>
                      <td>
                        <div style="width:100%;height:150px;overflow-x:scroll;overflow-y:scroll;" id="td_note">

                        </div>
                      </td>
                    </tr>
                  </table>
                </div><!--col-md-6_SECOND-->
                <div class="col-md-12">
                  <fieldset>
                    <legend>Produk Servis</legend>
                    <table class="table table-responsive table-striped" id="table-product-service">
                      <thead>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Term Payment</th>
                        <th>Merek</th>
                        <th>Gambar</th>
                        <th>Pilihan</th>
                      </thead>
                    </table>
                  </fieldset>
                </div>
              </div><!--row-->
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-note" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modal-note">&times;</button>
              <h3 class="modal-title">Note</h3>
            </div>
            <div class="modal-body">
              <div id="note-wrapper"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
