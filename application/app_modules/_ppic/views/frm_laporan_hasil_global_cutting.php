<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
    <button type="button" class="btn btn-md btn-flat btn-primary btn-block margin" data-toggle="modal" data-target="#modalCariHasilGlobalCutting" style="width: 21%;"><span class="fa fa-search"></span> Cari Hasil Global Potong</button>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-danger" style="display: none;">
        <div class="box-body" id="section-to-print">
          <h3 class="page-header text-blue">
            Laporan Hasil Global Cutting
            <small class="text-muted pull-right" id="tglHasilGlobal"></small>
          </h3>
          <table class="table table-responsive table-striped table-hover" id="tableLaporanHasilGlobalCutting" style="width: 100%;">
            <thead>
              <th style="text-align: center;">No</th>
              <th style="text-align: center;">Tanggal</th>
              <th style="text-align: center;">Lembar Polos</th>
              <th style="text-align: center;">Berat Polos</th>
              <th style="text-align: center;">Lembar Cetak</th>
              <th style="text-align: center;">Berat Cetak</th>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <div class="col-md-3 pull-right">
            <button type="button" id="btnCetakLaporanGlobalCutting" onclick="print();" class="btn btn-md btn-flat btn-info btn-block"><span class="fa fa-print"></span> Cetak</button>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalCariHasilGlobalCutting" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHasilGlobalCutting">&times;</button>
              <h4 class="modal-title text-green">Cari Hasil Global Potong</h4>
            </div>
            <div class="modal-body">
              <table class="table table-resposive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="input-group date">
                      <input type="text" id="txtTglAwal" class="form-control" placeholder="Masukan Tanggal Awal">
                      <div class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Akhir</td>
                  <td>:</td>
                  <td>
                    <div class="input-group date">
                      <input type="text" id="txtTglAkhir" class="form-control" placeholder="Masukan Tanggal Akhir">
                      <div class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariLaporanHasilGlobalPotong" onclick="cariHasilGlobalPotong()" class="btn btn-md btn-flat btn-success pull-right"><span class="fa fa-search"></span> Cari Laporan</button>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
