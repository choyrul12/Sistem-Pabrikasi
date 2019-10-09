<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
    <ol class="breadcrumb">
      <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
      <li><?php echo $Link["Segment1"]; ?></li>
      <li><?php echo $Link["Segment2"]; ?></li>
    </ol>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_searchHistoryApal" data-backdrop='static'><i class="fa fa-search"></i> History Apal</button>
  </section>
  <section class="content" id="rencanaPIC">
    <table class="table table-responsive table-striped" id="tableMasterApal">
      <thead>
      	<th style="width: 15px;">No</th>
    		<th>Jenis</th>
      	<th>Warna</th>
      	<th>Stok</th>
      	<!-- <th colspan="2" style="text-align: center; width: 30px">Action</th> -->
      </thead>
    </table>
  </section>
  <section>
      <div id="modal_editStokApal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">Form Edit Stok Apal</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Jenis :</label>
                <input type="hidden" name="kd_gd_apal" id="kd_gd_apal">
                <input type="text" class="form-control" name="jenis_apal" id="jenis_apal" placeholder="Jenis Apal" readonly="readonly"> 
              </div>
              <div class="form-group" id="kolom_warna">
                <label>Warna :</label>
                <input type="text" class="form-control" name="warna_apal" id="warna_apal" placeholder="Warna" readonly="readonly"> 
              </div>
              <div class="form-group">
                <label>Stok :</label>
                <input type="number" class="form-control" name="stok_apal" id="stok_apal" placeholder="Stok Apal">
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="updateStokApal()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Update</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_searchHistoryApal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search">&nbsp;&nbsp;Cari History Apal</i></h4>
          </div>
          <!-- body modal -->
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="Tanggal Awal">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Tanggal Akhir">
              </div>
            </div>
            <div class="form-group">
              <select class="form-control" value="" name="Apal" id="Apal">
                
                
              </select>
            </div>
            <div class="form-group">
              <button type="submit" onclick="cariHistoryApal()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_historyApal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 1000px; margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;History Apal</h3>
              <h4 class="modal-title" style="text-align: center; color: black;"><span id="tgl_history_apal"></span></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableHistoryApal">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th style="width: 50px">Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="col-xs-4">
                  <table class="table">
                    <tbody><tr>
                      <th style="width:50%">Total Masuk:</th>
                      <td style="text-align: right;"><span id="total_masuk_apal"></span></td>
                    </tr>
                    <tr>
                      <th>Total Keluar:</th>
                      <td style="text-align: right;"><span id="total_keluar_apal"></span></td>
                    </tr>
                   <!--  <tr>
                      <th>Saldo:</th>
                      <td style="text-align: right;"><span id="saldo"></span></td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
