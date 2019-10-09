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
        <div class="col-md-5">
          <div class="box box-solid">
            <div class="box-header">
              <label class="text-primary">Cari Histori Order</label>
            </div>
            <div class="box-body">
              <select class="form-control" name="cmb_customer" id="cmb_customer_history"></select>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="text-blue" style="margin:0; padding:0;">Data History Baru</h4>
            </div>
            <div class="box-body">
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
                  <th>Note Produk</th>
                </thead>
              </table>
            </div>
          </div>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="text-blue" style="margin:0; padding:0;">Data History Lama</h4>
            </div>
            <div class="box-body">
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
