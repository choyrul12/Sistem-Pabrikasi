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
          <table class="table table-responsive table-striped table-bordered" id="tablePantauOrder">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Pemesan</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalPrintOut" role="dialog">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type='button' class='close' data-dismiss='modal' data-target="#modalPrintOut" aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <h4 class='modal-title'><b class="text-primary">Print Out</b></h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <iframe src="" id="cetakFakturLoad" style="width: 100%; height: 500px;"></iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalDetailOrder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
          <div class="modal-content" style="width:100%; height:100%;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailOrder">&times;</button>
              <h4 class='modal-title'><b class="text-primary">Detail Pesanan</b></h4>
            </div>
            <div class="modal-body" style="height:83%; overflow-y:scroll;">
              <table class="table table-responsive table-striped" id="tableDetailOrder">
                <thead>
                  <tr>
                    <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                    <th rowspan="2" style="vertical-align:middle;">Jenis/Merek</th>
                    <th rowspan="2" style="vertical-align:middle;">Jenis Gudang / Tipe Barang</th>
                    <th colspan="2"><center>Warna</center></th>
                    <th colspan="1"><center>Atas Klip</center></th>
                    <th rowspan="2" style="vertical-align:middle;">Tebal</th>
                    <th rowspan="2" style="vertical-align:middle;">Jumlah</th>
                    <th rowspan="2" style="vertical-align:middle;">Keterangan</th>
                    <th rowspan="2" style="vertical-align:middle;">Status</th>
                  </tr>
                  <tr>
                    <th><center>Plastik</center></th>
                    <th><center>Cetak</center></th>
                    <th><center>Los/Strip</center></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
