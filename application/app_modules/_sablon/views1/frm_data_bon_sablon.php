<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?> <span id="tanggal"></span></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-success">
        <div class="box-body">
          <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_cariHasilSablon"><i class="fa fa-search"></i> Cari Bon Hasil Sablon</button>
          <div class="table-responsive">
          <table class="table table-responsive table-striped" id="tableDataBonHasilSablonPerTgl" style="display: none;">
            <thead>
              <th>No</th>
              <th>Tanggal</th>
              <th>Customer</th>
              <th>Merek</th>
              <th>Ukuran</th>
              <th>Warna Plastik</th>
              <th>Warna Cetak</th>
              <th>Hasil Lembar</th>
              <th>Hasil Berat</th>
              <th>Status Bon</th>
            </thead>
          </table>
          </div>
          <div id="button"></div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_cariHasilSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="text-align: center;">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Bon Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_cari" id="tgl_cari" placeholder="Tanggal Bon">
                </div>
              </div>
            <div class="form-group">
              <button type="submit" onclick="cariBonHasilSablon()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
