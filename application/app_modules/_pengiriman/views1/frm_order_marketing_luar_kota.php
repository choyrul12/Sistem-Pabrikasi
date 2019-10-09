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
              <h4 class="box-title">Data Order Marketing Luar Kota Yang Siap Dikirim</h4>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableListDataOrderMarketing_LK">
                    <thead>
                      <th>No.</th>
                      <th>Tanggal Pesan</th>
                      <th>Tanggal Estimasi</th>
                      <th>Nama Pemesan</th>
                      <th>Jumlah Order</th>
                      <th>Total Terkirim</th>
                      <th>Sisa</th>
                      <th>Ukuran</th>
                      <th>Warna</th>
                      <th>Merek</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="button" id="btnKirimPilihan_Marketing" class="btn btn-md btn-flat btn-success" onclick="saveKirimPesananFullBatch();"><i class="fa fa-send"></i> Kirim (0) Item Pesanan</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
