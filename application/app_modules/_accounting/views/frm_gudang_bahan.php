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
            <div class="box-header with-header">
              <h3 class="box-title text-blue">Detail History Gudang Bahan</h3>
              <input type="hidden" name="tglAwal" id="tglAwal">
              <input type="hidden" name="tglAkhir" id="tglAkhir">
              <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalCariHistory" data-backdrop="static"><i class="fa fa-search"></i> Cari History</button>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive table-striped" id="tableHistoryGudangBahan">
                    <thead>
                      <th>Nama Barang</th>
                      <th>Saldo Awal</th>
                      <th>Masuk</th>
                      <th>Keluar</th>
                      <th>Sisa</th>
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
              <button type="button" id="btnCariHistory" class="btn btn-md btn-flat btn-success" onclick="searchHistoryGudangBahan('<?php echo $this->uri->rsegment(2); ?>')"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modalKeluarMasukBahan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1050px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Detail History Gudang Bahan</h3>
              <h4 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;<span id="nm_Bahan"></span></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
            <div class="content">
              <table class="table table-responsive table-striped table-bordered" id="tableDataKeluarMasukBahan">
                <thead style="background-color: #00a65a;">
                  <th style="text-align: center;">Tanggal</th>
                  <th style="text-align: center;">Masuk</th>
                  <th style="text-align: center;">Keluar</th>
                  <th style="text-align: center;">Saldo</th>
                </thead>
                <tbody>


                </tbody>
              </table>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: left; color: black;">
              <a href="#" id='btnExportExcel' class="btn btn-md btn-flat btn-success"><i class="fa fa-download"></i> Export To Excel</a>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
