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
              <input type="text" id="txtTanggalCari" class="form-control" placeholder="Pilih Tanggal Untuk Mencari" onchange="cariRencanaKerjaPerBagian(this,'CUTTING');">
              <div class="input-group-addon">
                <span class="fa fa-calendar"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-responsive table-bordered table-striped" id="tableRencanaKerjaCutting">
            <thead>
              <th>No.</th>
              <th>Tgl. Rencana</th>
              <th>No. Mesin</th>
              <th>Order</th>
              <th>Merek</th>
              <th>Ukuran</th>
              <th>Warna Plastik</th>
              <th>Berat</th>
              <th>Tebal</th>
              <th>Strip</th>
              <th>Jumlah Permintaan</th>
              <th>Sisa</th>
              <th>Status Pengerjaan</th>
              <th>Keterangan</th>
            </thead>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalShowHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalShowHistory">&times;</button>
              <h4 class="modal-title text-blue">History Rencana Potong</h4>
            </div>
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableHistoryRencana">
                    <thead>
                      <th>No.</th>
                      <th>Tgl. Rencana Sebelumnya</th>
                      <th>Tgl. Rencana Perubahan</th>
                      <th>Hasil Lembar</th>
                      <th>Hasil Berat</th>
                      <th>Diperbarui</th>
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
    </section>

</div>
