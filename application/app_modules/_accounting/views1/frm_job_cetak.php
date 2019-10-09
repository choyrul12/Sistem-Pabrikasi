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
              <h4 class="box-title text-blue">Detail Hasil Cetak</h4>
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariHistory" data-backdrop="static"><i class="fa fa-search"></i> Cari History</button>
            </div>
            <div class="box-body" style="overflow-x:scroll;">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped table-bordered" id="tableListJobCetak">
                    <thead>
                      <tr>
                        <th rowspan="2" style="vertical-align:middle;">No.</th>
                        <th rowspan="2" style="vertical-align:middle;">Customer</th>
                        <th rowspan="2" style="vertical-align:middle;">Merek</th>
                        <th rowspan="2" style="vertical-align:middle;">Ukuran</th>
                        <th rowspan="2" style="vertical-align:middle;">Warna Plastik</th>
                        <th rowspan="2" style="vertical-align:middle;">Berat Bahan</th>
                        <th rowspan="2" style="vertical-align:middle;">Berat Bobin</th>
                        <th rowspan="2" style="vertical-align:middle;">Berat Payung</th>
                        <th rowspan="2" style="vertical-align:middle;">Berat Payung Kuning</th>
                        <th rowspan="2" style="vertical-align:middle;">Berat Sisa</th>
                        <th rowspan="2" style="vertical-align:middle;">Hasil Cetak</th>
                        <th rowspan="2" style="vertical-align:middle;">Hasil Bobin</th>
                        <th rowspan="2" style="vertical-align:middle;">Hasil Payung</th>
                        <th rowspan="2" style="vertical-align:middle;">Hasil Payung Kuning</th>
                        <th colspan="3" style="vertical-align:middle;"><center>Pipa</center></th>
                        <th rowspan="2" style="vertical-align:middle;">Apal</th>
                        <th rowspan="2" style="vertical-align:middle;">Plus/Minus</th>
                        <th rowspan="2" style="vertical-align:middle;">Action</th>
                      </tr>
                      <tr>
                        <th>Bobin</th>
                        <th>Payung</th>
                        <th>Payung Kuning</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <a href="#" id="btnPrintLaporan" class="btn btn-md btn-flat btn-success"><i class="fa fa-download"></i> Export To Excel</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistory" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistory">&times;</button>
              <h4 class="modal-title text-blue">Cari History</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <tr>
                      <td width="20%">Tanggal Awal</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group has-warning">
                          <div class="input-group date">
                            <input type="text" id="txtTglAwal" class="form-control" placeholder="Pilih Tanggal Awal" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
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
                            <input type="text" id="txtTglAkhir" class="form-control" placeholder="Pilih Tanggal Akhir" readonly>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryJobCetak();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalDetailJob" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalDetailJob">&times;</button>
              <h4 class="modal-title text-blue" id="modal-title">Detail Hasil Job</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tablePemakaianBahanCetak">
                    <thead>
                      <th>Nama Bahan</th>
                      <th>Jumlah Pengambilan</th>
                      <th>Sisa Pengambilan</th>
                      <th>Action</th>
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
