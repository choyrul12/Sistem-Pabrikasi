<style>
     .dataTable > thead > tr > td[class*="sort"]::after{display: none}
     .dataTable > thead > tr > th{background-color: #337ab7; color: #FFF;}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <p><h1><?php echo $Data['Title']; ?></h1> </p>
    <div class="input-group input-group-sm col-md-3" style="width: 270px; font-size: 14px;">
      <input type="text" class="form-control date" id="tanggal1" placeholder="Pilih Tanggal Awal">
      <input type="text" class="form-control date" id="tanggal2" placeholder="Pilih Tanggal Akhir">
      <span class="input-group-btn">
        <button type="button" class="btn btn-info btn-flat" style="height: 60px;" onclick="orderPerHariByDate()"> Cari </button>
      </span>
    </div>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
  </section>

  <section class="content">
    <div class="nav-tabs-custom" style="cursor: move;">
      <ul class="nav nav-tabs pull-right ui-sortable-handle">
        <li><a href="#CBG" data-toggle="tab"  onclick="changeTitle('Cabang')">Cabang</a></li>
        <li><a href="#LK" data-toggle="tab" onclick="changeTitle('Luar Kota')">Luar Kota</a></li>
        <li class="active" id="test"><a href="#DK" data-toggle="tab"  onclick="changeTitle('Dalam Kota')">Dalam Kota</a></li>
        <li class="pull-left header"><i class="fa fa-inbox"></i> Order <span id="title">Dalam Kota</span> ( <span id="tglTitle"></span> )</li>
      </ul>
      <div class="tab-content padding">
        <div class="chart tab-pane active" id="DK">
          <div class="col-md-12" id="table-wrapper">
            <table id="datatableOrderDK" class="table table-bordered table-responsive table-striped" style="font-size:13px;">
              <thead>
                <th style="width: 10px;">No</th>
                <th>No. Order</th>
                <th style="vertical-align: middle; text-align: center;">Kode Order</th>
                <th style="vertical-align: middle;">Nama Perusahaan</th>
                <th style="vertical-align: middle;">Nama Pemesan</th>
                <th style="vertical-align: middle;">Tgl. Pemesanan</th>
                <th style="vertical-align: middle;">Tgl. Estimasi</th>
                <th style="vertical-align: middle;">Status Order</th>
                <th style="vertical-align: middle;">Action</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="chart tab-pane" id="LK">
          <div class="col-md-12" id="table-wrapper">
            <table id="datatableOrderLK" class="table table-bordered table-responsive table-striped" style="font-size:13px;">
              <thead>
                <th style="width: 10px;">No</th>
                <th>No. Order</th>
                <th style="vertical-align: middle; text-align: center;">Kode Order</th>
                <th style="vertical-align: middle;">Nama Perusahaan</th>
                <th style="vertical-align: middle;">Nama Pemesan</th>
                <th style="vertical-align: middle;">Tgl. Pemesanan</th>
                <th style="vertical-align: middle;">Tgl. Estimasi</th>
                <th style="vertical-align: middle;">Status Order</th>
                <th style="vertical-align: middle;">Action</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="chart tab-pane" id="CBG">
          <div class="col-md-12" id="table-wrapper">
            <table id="datatableOrderCBG" class="table table-bordered table-responsive table-striped" style="font-size:13px;">
              <thead>
                <th style="width: 10px;">No</th>
                <th>No. Order</th>
                <th style="vertical-align: middle; text-align: center;">Kode Order</th>
                <th style="vertical-align: middle;">Nama Perusahaan</th>
                <th style="vertical-align: middle;">Nama Pemesan</th>
                <th style="vertical-align: middle;">Tgl. Pemesanan</th>
                <th style="vertical-align: middle;">Tgl. Estimasi</th>
                <th style="vertical-align: middle;">Status Order</th>
                <th style="vertical-align: middle;">Action</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
  </section>
</div>
<div class="modal fade" id="print-out" role="dialog">
  <div class="modal-dialog modal-lg" style="width:100%;">
    <div class="modal-content" style="width:100%;">
      <div class="modal-header">
        <button type='button' class='close' data-dismiss='modal' data-target="#print-out" aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title'><b class="text-primary">Print Out</b></h4>
        <!-- <div id="notif" class="pull-left" style="width:72%;"></div>
        <button type="button" name="button" class="btn btn-sm btn-warning btn-flat pull-right" id="btn-produk-servis" data-toggle='modal' data-target="#product_service_modal">Produk & Servis</button>
        <a class="btn btn-sm btn-primary btn-flat pull-right modal_link" id="btn-note" data-toggle='modal'>Note</a>
        <button type="button" name="button" class="btn btn-sm btn-success btn-flat pull-right" id="btn-approve">Approve</button>
        <button type="button" id="btnShowHistory" data-toggle='modal' data-target="#modal-history-order" class="btn btn-sm btn-flat btn-danger pull-right">History Order</button> -->
      </div>
      <div class="modal-body">
        <iframe src="" id="cetakFakturLoad" style="width: 100%; height: 500px;"></iframe>
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
