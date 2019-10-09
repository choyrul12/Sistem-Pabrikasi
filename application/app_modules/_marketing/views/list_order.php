<style>
     .dataTable > thead > tr > td[class*="sort"]::after{display: none}
     .dataTable > thead > tr > th{background-color: #337ab7; color: #FFF;}
     .modal.fade.in {overflow-x:hidden; overflow-y:auto;}
</style>
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
      <div class="col-md-12" id="btn-wrapper" style="margin-bottom:10px;">
        <button type="button" id="btn-closed-order" class="btn btn-primary btn-flat btn-block">Closed Order</button>
      </div>
      <div class="col-md-12 table-responsive">
        <table id="data-order" class="table table-bordered table-striped" style="font-size:13px; width: 100%;">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align: middle;">No. Order</th>
              <th rowspan="2" style="vertical-align: middle; width:40px;">Kode Order</th>
              <th rowspan="2" style="vertical-align: middle;">Nama Perusahaan</th>
              <th rowspan="2" style="vertical-align: middle;">Nama Pemesan</th>
              <th rowspan="2" style="vertical-align: middle;">Nama Purchasing</th>
              <th rowspan="2" style="vertical-align: middle;">Tgl. Pemesanan</th>
              <th rowspan="2" style="vertical-align: middle;">Tgl. Estimasi</th>
              <th rowspan="2" style="vertical-align: middle;">Status Order</th>
              <th colspan="5" style="vertical-align: middle;"><center>Approved</center></th>
              <th rowspan="2" style="vertical-align: middle;">Aksi</th>
            </tr>
            <tr>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">DK</b></center>
              </td>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">EG</b></center>
              </td>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">FR</b></center>
              </td>
              <!-- <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">DC</b></center>
              </td> -->
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">EL</b></center>
              </td>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">NI</b></center>
              </td>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>

        <table id="data-order-closed" class="table table-bordered table-responsive table-striped" style="display:none; font-size:13px;">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align: middle;">No. Order</th>
              <th rowspan="2" style="vertical-align: middle;">Kode Order</th>
              <th rowspan="2" style="vertical-align: middle;">Nama Perusahaan</th>
              <th rowspan="2" style="vertical-align: middle;">Nama Pemesan</th>
              <th rowspan="2" style="vertical-align: middle;">Tgl. Pesan</th>
              <th rowspan="2" style="vertical-align: middle;">Tgl. Selesai</th>
              <th rowspan="2" style="vertical-align: middle;">Status Order</th>
              <th colspan="5" style="vertical-align: middle;"><center>Approved</center></th>
              <th rowspan="2" style="vertical-align: middle;">Aksi</th>
            </tr>
            <tr>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">DK</b></center>
              </td>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">EG</b></center>
              </td>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">FR</b></center>
              </td>
              <!-- <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">DC</b></center>
              </td> -->
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">EL</b></center>
              </td>
              <td style="background-color:#fcfcfc;">
                <center><b class="text-primary">NI</b></center>
              </td>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>

      <div class="modal fade" id="print-out" role="dialog">
        <div class="modal-dialog modal-lg" style="width:100%;">
          <div class="modal-content" style="width:100%;">
            <div class="modal-header">
              <button type='button' class='close' data-dismiss='modal' data-target="#print-out" aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <h4 class='modal-title'><b class="text-primary">Print Out</b></h4>
              <div id="notif" class="pull-left" style="width:72%;"></div>
              <button type="button" name="button" class="btn btn-sm btn-warning btn-flat pull-right" id="btn-produk-servis" data-toggle='modal' data-target="#product_service_modal">Produk & Servis</button>
              <a class="btn btn-sm btn-primary btn-flat pull-right modal_link" id="btn-note" data-toggle='modal'>Note</a>
              <button type="button" name="button" class="btn btn-sm btn-success btn-flat pull-right" id="btn-approve">Approve</button>
              <button type="button" id="btnShowHistory" data-toggle='modal' data-target="#modal-history-order" class="btn btn-sm btn-flat btn-danger pull-right">History Order</button>
            </div>
            <div class="modal-body">
              <iframe src="" id="cetakFakturLoad" style="width: 100%; height: 500px;"></iframe>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="product_service_modal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" name="button" data-dismiss='modal' data-target="#note-customer" aria-label='Close'><span aria-hidden="tre"></span>&times;</button>
              <h3 class="modal-title">Note Customer</h3>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <table class="table table-responsive table-striped">
                <thead>
                  <th>Produk Servis</th>
                  <th>Term Payment</th>
                  <th>Ukuran</th>
                  <th>Harga</th>
                  <th>Merek</th>
                  <th>Foto</th>
                  <th>Note</th>
                </thead>
                <tbody id="produk-service-table">

                </tbody>
              </table>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" role="dialog" id="show-note-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type='button' class='close' data-dismiss='modal' data-target="#show-note-modal" aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <h4 class="modal-title">Note</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div id="json-wrapper">

              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" role="dialog" id="modal-lihat-detail-pesanan">
        <div class="modal-dialog modal-lg" style="width:100%;">
          <div class="modal-content" style="width:100%;">
            <div class="modal-header">
              <button type='button' class='close' data-dismiss='modal' data-target="#modal-lihat-detail-pesanan" aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll">
              <center>
                <h3 class="text-primary"><b>Klip Plastik</b></h3>
                <p style="font-size:12px;">
                  <b>
                    Jl.Yos Sudarso No.115A (Daan Mogot Km.19) Batu Ceper<br>
                    Kota Tangerang<br>
                    Telp.021-551-8899 | Fax.021-551-3905
                  </b>
                </p>
              </center>
              <div class="col-md-6">
                <table class="table table-responsive" style="font-size:12px;">
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
                <table class="table table-responsive" style="font-size:12px;">
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
                <table class="table table-responsive table-striped" id="tabel-lihat-pesanan-detail" style="font-size:12px;">
                  <thead>
                    <tr>
                      <th rowspan="2" style="vertical-align:middle;">Jumlah</th>
                      <th rowspan="2" style="vertical-align:middle;">Sisa</th>
                      <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                      <th rowspan="2" style="vertical-align:middle;">Harga</th>
                      <th rowspan="2" style="vertical-align:middle;">Merek</th>
                      <th colspan="2"><center>Warna</center></th>
                      <th rowspan="2" style="vertical-align:middle;">SM</th>
                      <th rowspan="2" style="vertical-align:middle;">DLL</th>
                      <th rowspan="2" style="vertical-align:middle;">Kode Harga</th>
                      <th rowspan="2" style="vertical-align:middle;">Status Pesanan</th>
                      <th rowspan="2" style="vertical-align:middle;">Status Kirim</th>
                    </tr>
                    <tr>
                      <th><center>Plastik</center></th>
                      <th><center>Cetak</center></th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header">
                    <label class="pull-left">Note :</label>
                  </div>
                  <div class="box-body">
                    <div class="pull-left" id="paragraf-note" style="font-size:12px;">

                    </div>
                  </div>
                  <div class="box-footer">
                    <p id="last-update" class="pull-right" style="font-size:12px;">Last Update : </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-history-order" role="dialog">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modal-history-order">&times;</button>
              <h3 class="modal-title">Data History Order</h3>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <h4>History Baru</h4>
              <table class="table table-striped table-responsive" id="history-table" style="font-size:14px;">
                <thead>
                  <th>Tgl. Pesan</th>
                  <th>Tgl. Estimasi</th>
                  <th>No.Customer</th>
                  <th>Nama Owner</th>
                  <th>Nama Purchasing</th>
                  <th>Jumlah</th>
                  <th>Ukuran</th>
                  <th>Term Payment</th>
                  <th>Harga</th>
                  <th>Merek</th>
                  <th>Plastik</th>
                  <th>Cetak</th>
                  <th>Strip</th>
                  <th>Dll</th>
                  <th>Kode Harga</th>
                  <th>Note Pesanan</th>
                </thead>
              </table>
              <h4>History Lama</h4>
              <table class="table table-striped table-responsive" id="history-table-lama" style="font-size:14px;">
                <thead>
                  <th>Tgl. Pesan</th>
                  <th>Tgl. Estimasi</th>
                  <th>No.Customer</th>
                  <th>Nama Owner</th>
                  <th>Nama Purchasing</th>
                  <th>Jumlah</th>
                  <th>Ukuran</th>
                  <th>Term Payment</th>
                  <th>Harga</th>
                  <th>Merek</th>
                  <th>Plastik</th>
                  <th>Cetak</th>
                  <th>Strip</th>
                  <th>Dll</th>
                  <th>Kode Harga</th>
                  <th>Note Produk</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalLihatNotePesanan" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalLihatNotePesanan">&times;</button>
              <h4 class="modal-title text-header">Note Pesanan</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <div id="textNote">

                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
