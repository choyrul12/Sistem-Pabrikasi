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
      <div class="box box-primary">
          <div class="box-header">
            <a href="#" class="btn btn-flat btn-md btn-success" onclick="dataTableOrderCabangTerkirim()">Data Order Terkirim</a>
            <a href="#" class="btn btn-flat btn-md btn-primary" data-toggle="modal" data-target="#modalSearchCabangOrderBulanan">Cari Order Cabang Per Bulan</a>
            <a href="#" class="btn btn-flat btn-md btn-warning" onclick="dataTableOrderCabangBulanSebelumnya('<?php echo date("Y-m",strtotime("-1 months")); ?>')">Data Order Bulan Sebelumnya</a>
          </div>
          <div class="box-body">
            <table class="table table-responsive table-striped" id="table-order-cabang">
              <thead>
                <tr>
                  <th rowspan="2" style="vertical-align:middle;">No</th>
                  <th rowspan="2" style="vertical-align:middle;">Tanggal Pesan</th>
                  <th rowspan="2" style="vertical-align:middle;">Pemesan</th>
                  <th rowspan="2" style="vertical-align:middle;">Jumlah Pesanan</th>
                  <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                  <th rowspan="2" style="vertical-align:middle;">Merek</th>
                  <th rowspan="2" style="vertical-align:middle;">Jenis Barang</th>
                  <th colspan="2"><center>Warna</center></th>
                  <th rowspan="2" style="vertical-align:middle;">S/M</th>
                  <th rowspan="2" style="vertical-align:middle;">DLL</th>
                  <th rowspan="2" style="vertical-align:middle;">Note</th>
                  <th rowspan="2" style="vertical-align:middle;">Status Pesanan</th>
                  <th rowspan="2" style="vertical-align:middle;">Print Out</th>
                </tr>
                <tr>
                  <th><center>Plastik</center></th>
                  <th><center>Cetak</center></th>
                </tr>
              </thead>
            </table>

            <table class="table table-responsive table-striped" id="tableOrderCabangTerkirim" style="display:none;">
              <thead>
                <th style="vertical-align:middle;">Tanggal Pesan</th>
                <th style="vertical-align:middle;">Pemesan</th>
                <th style="vertical-align:middle;">Jumlah Pesanan</th>
                <th style="vertical-align:middle;">Total Yang Dikirim</th>
                <th style="vertical-align:middle;">Sisa</th>
                <th style="vertical-align:middle;">Ukuran</th>
                <th style="vertical-align:middle;">Warna</th>
                <th style="vertical-align:middle;">Merek</th>
                <th style="vertical-align:middle;">DLL</th>
                <th style="vertical-align:middle;">Status Pesanan</th>
                <th style="vertical-align:middle;">Print Out</th>
              </thead>
            </table>
          </div>
      </div>
      <div class="modal fade" id="modalPrintOut" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalPrintOut">&times;</button>
              <h3 class="modal-title text-primary">Print Out</h3>
            </div>
            <div class="modal-body">
              <iframe src="" id="framePrintOut" style="width: 100%; height: 500px;"></iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalKirimKeGudang" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalKirimKeGudang">&times;</button>
              <h3 class="modal-title text-primary">Kirim Pesanan Ke Gudang</h3>
            </div>
            <div class="modal-body" style="height:550px; overflow-y:scroll;">
              <h4 id="h4-no-order">No. Order : </h4>
              <table class="table table-responsive table-striped" id="tableDetailPesanan">
                <thead>
                  <tr>
                    <th rowspan="2" style="vertical-align:middle;"><center>Tanggal</center></th>
                    <th rowspan="2" style="vertical-align:middle;"><center>Jumlah Order</center></th>
                    <th rowspan="2" style="vertical-align:middle;"><center>Ukuran</center></th>
                    <th rowspan="2" style="vertical-align:middle;"><center>Merek</center></th>
                    <th colspan="2" style="vertical-align:middle;"><center>Warna</center></th>
                    <th rowspan="2" style="vertical-align:middle;"><center>Strip</center></th>
                    <th rowspan="2" style="vertical-align:middle;"><center>Dll</center></th>
                  </tr>
                  <tr>
                    <th><center>Plastik</center></th>
                    <th><center>Cetak</center></th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="modal-footer">
              <div class="col-md-4 pull-right">
                <button type="button" id="btnKirimKeGudang" class="btn btn-flat btn-block btn-primary">Kirim Ke Gudang</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalSearchCabangOrderBulanan" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalSearchCabangOrderBulanan">&times;</button>
              <h4 class="modal-title text-info">Cari Data Order Cabang Per Bulan</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4" id="comboCustomWrapper">
                  <select class="form-control" id="cmbTahun" onchange="changeCustomCombo(this)">
                    <option value="">--Pilih Tahun--</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="Custom">Custom</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-control" id="cmbBulan">
                    <option value="">--Pilih Bulan--</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <button type="button" id="btnSearchCabangOrder" class="btn btn-flat btn-block btn-info" onclick="dataTableOrderCabangBulanan()">
                    Cari Order Cabang
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalNotif" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalNotif">&times;</button>
              <h4 class="modal-title">Notifikasi</h4>
            </div>
            <div class="modal-body" id="notifContent">

            </div>
          </div>
        </div>
      </div>
    </section>

</div>
