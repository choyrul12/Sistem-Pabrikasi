<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?> <span id="tgl_list">( <?php echo date("F Y") ?> )</span></h1>
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
      <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_cariRencanaPIC"><i class="fa fa-search"></i> Cari Rencana PIC</button>
    </section>
    <section class="content" id="rencanaPIC">
    	<div class="table-responsive">
          <table class="table table-responsive table-striped" id="tableDataRencanaPIC">
            <thead>
            	<th>No</th>
          		<th>Tanggal</th>
              	<th>Customer</th>
              	<th>Merek</th>
              	<th>Permintaan</th>
              	<th>Ukuran</th>
              	<th>Warna Plastik</th>
              	<th>Warna Cetak</th>
              	<th>Jumlah</th>
              	<th>Sisa</th>
              	<th>Status</th>
              	<th>Keterangan</th>
              	<th colspan="2" style="text-align: center;">Action</th>
            </thead>
          </table>
        </div>
    </section>
    <section class="content">
      <div class="table-responsive">
          <table class="table table-responsive table-striped" id="tableSearchDataRencanaPIC" style="display: none;">
            <thead>
              <th>No</th>
              <th>Tanggal</th>
                <th>Customer</th>
                <th>Merek</th>
                <th>Permintaan</th>
                <th>Ukuran</th>
                <th>Warna Plastik</th>
                <th>Warna Cetak</th>
                <th>Jumlah</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th colspan="2" style="text-align: center;">Action</th>
            </thead>
          </table>
        </div>
    </section>
    <section>
      <div id="ModalConversi" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-balance-scale">&nbsp;&nbsp;Form Konversi</i></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
            <div id="form"></div>
            <div class="form-group">
              <button type="submit" onclick="convertKG()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>CONVERT</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="ModalRencana" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1050px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Form Rencana Kerja Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
            <div class="content">
              <div id="form_rencana"></div>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_editRencana" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-edit">&nbsp;&nbsp;Form Edit Rencana</i></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div id="form_editRencana"></div>
              <div class="form-group">
                <button type="submit" onclick="updateRencana()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>UPDATE</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_cariRencanaPIC" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="text-align: center;">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search"></i> Cari Rencana PIC</h3>
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
                <button type="submit" onclick="cariRencanaPIC()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
