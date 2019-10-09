<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?> <span id="tanggal"></span></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-success">
        <div class="box-body">
          <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_pengembalianHD"><i class="fa fa-plus"></i> Pengembalian Barang HD</button>
          <table class="table table-responsive table-striped" id="tableDataPengembalianHD" >
            <thead>
              <th width="5px;">No</th>
              <th>Tanggal</th>
              <th>Customer</th>
              <th>Merek</th>
              <th>Ukuran</th>
              <th>Warna Plastik</th>
              <th>Lembar</th>
              <th>Berat</th>
              <th colspan="2" style="text-align: center;">Action</th>
            </thead>
          </table>
          <div class="form-group" style="text-align: center; margin-bottom: 5px;">
              <button type="submit" onclick="kirimPengembalianHD()" class="btn btn-flat bg-navy margin" style="align-items: center; margin: 0; position: relative; width: 15%;"><b><i class="fa fa-check"></i> KIRIM</b></button>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_pengembalianHD" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" style="width: 350px;">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Pengembalian Barang HD</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <select class="form-control" value="" name="ukuran" id="ukuranHD">
                  <option value="" selected="selected">Pilih Ukuran HD</option>
                  
                </select>
              </div>
              <div class="form-group">
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian" placeholder="Tanggal Pengembalian">
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="" name="customer" id="customer" placeholder="Customer">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="" name="berat" id="berat" placeholder="Jumlah Berat">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="" name="lembar" id="lembar" placeholder="Jumlah Lembar">
              </div>
            <div class="form-group">
              <button type="submit" onclick="addPengembalianHD()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>SAVE</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div id="edit_pengembalianHD" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
        <div class="modal-dialog modal-sm" style="width: 350px;">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Edit Pengembalian HD</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" name="id" id="id_jadi">
                <label>Ukuran :</label>
                <input type="text" class="form-control" name="merek" id="editUkuranHD" value="" readonly="">
              </div>
              <div class="form-group">
                <input type="hidden" name="id" id="id_jadi">
                <label>Customer :</label>
                <input type="text" class="form-control" name="customer" id="edit_customer" value="">
              </div>  
              <div class="form-group">
                <label>Tanggal Pengembalian :</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_pengembalian" id="edit_tgl_pengembalian" placeholder="Tanggal Pengembalian">
                </div>
              </div>
              <div class="form-group">
                <label>Berat :</label>
                <input type="text" class="form-control" value="" name="berat" id="editBerat" placeholder="Jumlah Berat">
              </div>
              <div class="form-group">
                <label>Lembar :</label>
                <input type="text" class="form-control" value="" name="lembar" id="editLembar" placeholder="Jumlah Lembar">
              </div>
              <div class="form-group">
                <button type="submit" onclick="updateListPengembalianHD()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>UPDATE</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
