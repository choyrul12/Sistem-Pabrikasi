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
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariLaporanHasilCutting" data-backdrop="static"><i class="fa fa-search"></i> Cari Laporan Hasil Cutting</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="tableLaporanHasilCuttingWrapper">
                    <table class="table table-responsive table-striped" id="tableLaporanHasilCutting">
                      <thead>
                        <th>No.</th>
                        <th>Lembar Polos</th>
                        <th>Berat Polos</th>
                        <th>Lembar Cetak</th>
                        <th>Berat Cetak</th>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariLaporanHasilCutting" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariLaporanHasilCutting">&times;</button>
              <h4 class="modal-title text-blue">Cari Laporan Hasil Cutting</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTanggal" class="form-control" placeholder="Masukan Tanggal" readonly>
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariLaporanHasilPotong" class="btn btn-md btn-flat btn-success" onclick="searchLaporanHasilPotong();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
