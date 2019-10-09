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
            <button type="button" class="btn btn-md btn-flat btn-primary" data-toggle="modal" data-target="#modalTambahKirimanApal" data-backdrop="static" onclick="modalTambahBonApal()"><i class="fa fa-plus"></i> Tambah Barang Apal</button>
            <button type="button" class="btn btn-md btn-flat btn-success" data-toggle="modal" data-target="#modalCariDataBarangApal" data-backdrop="staic"><i class="fa fa-search"></i> Cari Barang Apal</button>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive" id="tableListDataKirimanApal">
                  <thead>
                    <th>Tanggal</th>
                    <th>Jenis Apal</th>
                    <th>Jumlah Barang Apal</th>
                    <th>Shift</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  </tbody>

                  <!-- <tfoot>
                    <tr>
                      <td colspan="2"><span style="float:right">Total Apal</span></td>
                      <td colspan="3" id="thTotal"></td>
                    </tr>
                  </tfoot> -->
                </table>
                <div class="col-md-4">
                  <h4 id="h4Total">Total Apal : 0</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <center>
              <button type="button" id="btnKirimApal" class="btn btn-md btn-flat btn-success"><i class="fa fa-send"></i> Kirim</button>
              <a href="#" id="btnPrintDataBonApal" target="_blank" class="btn btn-md btn-flat btn-info"><i class="fa fa-print"></i> Print Data Bon Apal</a>
            </center>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalTambahKirimanApal" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalTambahKirimanApal">&times;</button>
            <h4 class="modal-title text-primary">Tambah Barang Apal</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-responsive">
                  <tr>
                    <td width="20%">Jumlah Apal</td>
                    <td width="1%">:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtJumlahApal" class="form-control number" placeholder="Masukan Jumlah Apal">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Warna</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <select class="form-control" id="cmbJenisApal">

                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Shift</td>
                    <td>:</td>
                    <td>
                      <div class="form-group has-warning">
                        <input type="text" id="txtShift" class="form-control" placeholder="Masukan Shift">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
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
            <button type="button" id="btnTambahBarangApal" class="btn btn-md btn-flat btn-primary" onclick="saveTambahApalPending();"><i class="fa fa-plus"></i> Tambah</button>
            <button type="button" class="btn btn-md btn-flat btn-danger" onclick="resetFormTambahBonApal();"><i class="fa fa-remove"></i> Batal</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCariDataBarangApal" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-target="#modalCariDataBarangApal">&times;</button>
            <h4 class="modal-title text-blue">Cari Data Bon Apal</h4>
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
                          <input type="text" id="txtTanggalCari" class="form-control" placeholder="Pilih Tanggal" readonly>
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
            <button type="button" id="btnCariDataBonApal" class="btn btn-md btn-flat btn-success" onclick="searchDataBonApal();"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
