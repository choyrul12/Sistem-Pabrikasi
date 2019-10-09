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
          <button type="button" id="btnCariBonHasil" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariBonHasil" data-backdrop="static"><i class="fa fa-search"></i> Cari Hasil Jadi</button>
        </div>
        <div class="col-md-12">
          <table class="table table-responsive table-striped" id="tableDetailHasilJadi" style="display: none;">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Ukuran</th>
              <th>Berat</th>
              <th>Lembar</th>
              <th>Warna Plastik</th>
              <th>Merek</th>
              <th>Permintaan</th>
              <th>Customer</th>
              <th>Jenis Barang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </thead>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modalCariBonHasil" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariBonHasil">&times;</button>
              <h4 class="modal-title text-blue">Cari Bon Hasil</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td>Tanggal Awal</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalAwal" class="form-control" placeholder="Masukan Tanggal Awal" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Akhir</td>
                  <td>:</td>
                  <td>
                    <div class="form-group has-warning">
                      <div class="input-group date">
                        <input type="text" id="txtTanggalAkhir" class="form-control" placeholder="Masukan Tanggal Akhir" readonly>
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariBon" onclick="cariHasilJadi();" class="btn btn-md btn-flat btn-primary"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
