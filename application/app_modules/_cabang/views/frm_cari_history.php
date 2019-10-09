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
        <div class="col-md-4">
          <button type="button" class="btn btn-md btn-flat btn-primary btn-block" data-toggle="modal" data-target="#modalCariHistoryOrder"><span class="fa fa-search"></span> Cari History</button>
        </div>
        <div class="col-md-12" style="margin-top:10px;">
          <div id="tableWrapper" style="display:none;">
            <table class="table table-responsive table-striped" id="tableHistoryOrder">
              <thead>
                <th>No.</th>
                <th>Tanggal</th>
                <th>No.Po</th>
                <th>Pemesan</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
            </table>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalCariHistoryOrder" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariHistoryOrder">&times;</button>
              <h4 class="modal-title text-blue">Cari History</h4>
            </div>
            <div class="modal-body">
              <table class="table table-responsive">
                <tr>
                  <td width="20%">Tanggal Awal</td>
                  <td width="1%">:</td>
                  <td>
                    <div class="input-group date">
                      <input type="text" id="txtTglAwal" class="form-control" placeholder="Tanggal Awal">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Akhir</td>
                  <td>:</td>
                  <td>
                    <div class="input-group date">
                      <input type="text" id="txtTglAkhir" class="form-control" placeholder="Tanggal Akhir">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>:</td>
                  <td>
                    <select class="form-control" id="cmbStatus">
                      <option value="ALL">ALL</option>
                      <option value="WAITING">WAITING</option>
                      <option value="OPEN">OPEN</option>
                      <option value="PROGRESS">PROGRESS</option>
                      <option value="PACKING">PACKING</option>
                      <option value="FINISH">FINISH</option>
                    </select>
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnCariHistory" class="btn btn-md btn-success btn-flat pull-right"  onclick="cariHistoryOrder();">Cari</button>
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
