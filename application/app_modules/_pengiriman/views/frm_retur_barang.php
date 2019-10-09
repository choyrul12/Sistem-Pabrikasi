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
            <h4 class="box-title">Form Retur Barang</h4>
          </div>
          <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>Jenis Barang :</label>
              <select class="form-control" name="jns_barang" id="jns_barang">
                <option value="" selected>Pilih Jenis Barang</option>
                <option value="STANDARD">Standard</option>
                <option value="CAMPUR">Campur</option>
                <option value="SABLON">Sablon</option>
                <option value="KANTONG">Kantong</option>
              </select>
            </div>
            <div class="form-group" id="fieldBarang" style="display: none;">
              <label>Nama Barang :</label>
              <select class="form-control" id="nm_barang">
              </select>
            </div>
            <div class="form-group">
              <label>Customer :</label>
              <input class="form-control" type="text" name="customer" id="customer" disabled>
            </div>
            <div class="form-group">
              <label>Berat :</label>
              <input type="text" class="form-control" name="berat" id="berat" disabled>
            </div>
            <div class="form-group">
              <label>Lembar :</label>
              <input type="text" class="form-control" name="lembar" id="lembar" disabled>
            </div>
            <div class="form-group">
              <label>Tanggal :</label>
              <div class="input-group date">
              <div class="input-group-addon" style="">
                <i class="fa fa-calendar"></i>
              </div>
                <input type="text" id="tgl_retur" class="form-control" disabled>
              </div>
            </div>
            <button type="button" id="btn_addBarangRetur" class="btn btn-md btn-flat btn-success margin" onclick="addBarangRetur();"><i class="fa fa-plus"></i> Add Barang Retur</button>
          </div>
          </div>
          <div class="col-md-12">
            <table class="table table-responsive table-striped" id="tableDataBarangRetur">
              <thead>
                <th style="width: 15px;">No.</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Ukuran</th>
                <th>Merek</th>
                <th>Warna</th>
                <th>Jenis</th>
                <th>Berat</th>
                <th>Lembar</th>
                <th>Action</th>
              </thead>
            </table>
          </div>
          <div class="box-footer">
            <button type="button" id="btnKirimPilihan_Cabang" class="btn btn-md btn-flat btn-success margin" onclick="kirimBarangReturPengiriaman();"><i class="fa fa-send"></i> Kirim Barang Retur</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
      <div id="modalEditRetur" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-edit">&nbsp;&nbsp;Form Edit Retur</i></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Barang :</label>
                <input type="hidden" name="id_permintaan_jadi" id="id_permintaan_jadi">
                <input class="form-control" type="text" name="produk" id="produk" readonly>
              </div>
              <div class="form-group">
                <label>Customer :</label>
                <input type="text" class="form-control" name="customer_edit" id="customer_edit">
              </div>
              <div class="form-group">
                <label>Tanggal :</label>
                <div class="input-group date">
                <div class="input-group-addon" style="">
                  <i class="fa fa-calendar"></i>
                </div>
                  <input type="text" id="tgl_retur_edit" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label>Berat :</label>
                <input type="text" class="form-control" name="berat_edit" id="berat_edit">
              </div>
              <div class="form-group">
                <label>Lembar :</label>
                <input type="text" class="form-control" name="lembar_edit" id="lembar_edit">
              </div>
            <div class="form-group">
              <button type="submit" onclick="updateListRetur()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>UPDATE</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
