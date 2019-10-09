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
        <button type="button" class="btn btn-md btn-flat btn-primary btn-block" data-toggle="modal" data-target="#modalCariDataBonRollPolos" data-backdrop="static"><i class="fa fa-search"></i> Cari Data Bon Roll Polos</button>
      </div>
      <div class="modal fade" id="modalCariDataBonRollPolos" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" data-target="#modalCariDataBonRollPolos">&times;</button>
              <h4 class="modal-title text-blue">Cari Data Bon Roll Polos</h4>
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
                            <input type="text" id="txtTanggal" class="form-control" placeholder="Pilih Tanggal" readonly>
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
              <button type="button" id="btnCariDataBonRollPolos" class="btn btn-md btn-flat btn-primary" onclick="searchDataBonRollPolos();"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" id="rowBonRollPolosMesin" style="display:block; margin-top:10px;">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title text-blue">Bon Roll Polos Mesin</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12" style="max-height:700px; overflow-y:scroll;">
                <table class="table table-responsive table-striped" id="tableDataBonRollPolos">
                  <thead>
                    <th>Tebal</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Warna</th>
                    <th>Roll</th>
                    <th>Jenis Roll</th>
                    <th>Jenis Barang</th>
                    <th>Shift</th>
                    <th>Status Bon</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" id="btnKirimDataBonRollPolos" class="btn btn-md btn-flat btn-primary"><i class="fa fa-check"></i> Kirim</button>
            <a href="" id="btnPrintDataBonRollPolos" class="btn btn-md btn-flat btn-success"><i class="fa fa-print"></i> Print Preview</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
