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
              <h4 class="box-title text-blue">Detail Transaksi Gudang Roll Cetak</h4>
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="modalCariTransaksi" data-backdrop="static"><i class="fa fa-search"></i> Cari Data</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <legend>DETAIL KELUAR DAN MASUK STOK DARI POTONG</legend>
                      <table class="table table-responsive table-striped" id="tableDataTransaksiGudangRollPotong_Cetak">
                        <thead>
                          <th>Ukuran</th>
                          <th>Tanggal</th>
                          <th>Berat</th>
                          <th>Bobin</th>
                          <th>Payung</th>
                          <th>Payung Kuning</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <legend>HASIL CETAK</legend>
                      <table class="table table-responsive table-striped" id="tableDataTransaksiHasilCetak">
                        <thead>
                          <th>Ukuran</th>
                          <th>Tanggal</th>
                          <th>Berat</th>
                          <th>Bobin</th>
                          <th>Payung</th>
                          <th>Payung Kuning</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <legend>DETAIL KELUAR DAN MASUK STOK DARI CETAK</legend>
                      <table class="table table-responsive table-striped" id="tableDataTransaksiGudangRollCetak">
                        <thead>
                          <th>Ukuran</th>
                          <th>Tanggal</th>
                          <th>Berat</th>
                          <th>Bobin</th>
                          <th>Payung</th>
                          <th>Payung Kuning</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="button" id="btnLock" class="btn btn-md btn-flat btn-danger"><i class="fa fa-lock"></i> Kunci</button>
              <a href="#" id="btnExport" class="btn btn-md btn-flat btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
