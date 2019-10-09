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
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="col-md-6">
            <div class="input-group date">
              <input type="text" id="txtTanggalCari" class="form-control" placeholder="Pilih Tanggal Untuk Mencari" onchange="cariRencanaKerjaPerBagian(this,'EXTRUDER');">
              <div class="input-group-addon">
                <span class="fa fa-calendar"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-striped" id="tableRencanaKerjaExtruder">
                <thead>
                  <th>No.</th>
                  <th>Tgl. Rencana</th>
                  <th>No. Mesin</th>
                  <th>Order</th>
                  <th>Merek</th>
                  <th>Berat</th>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Tebal</th>
                  <th>Strip</th>
                  <th>Jumlah Permintaan</th>
                  <th>Sisa</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
