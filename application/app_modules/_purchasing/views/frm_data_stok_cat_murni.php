<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
    <ol class="breadcrumb">
      <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
      <li><?php echo $Link["Segment1"]; ?></li>
      <li><?php echo $Link["Segment2"]; ?></li>
    </ol>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_inputRencanaPembelianCatMurni" data-backdrop='static'><i class="fa fa-plus"></i> Form Pembelian Cat Murni</button>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_addBahan" data-backdrop='static' onclick="getKdBahan('CAT MURNI')"><i class="fa fa-plus"></i> Tambah Cat Murni</button>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_searchHistoryCatMurni" data-backdrop='static'><i class="fa fa-search"></i> History Cat Murni</button>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow" id="alert_permintaanCatMurni" style="cursor: pointer; display: none;" onclick="listPermintaanPembelianBarang('CAT MURNI')">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-list-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-number">Permintaan Pembelian</span>
            <span class="info-box-text">Cat Murni</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_permintaanCatMurni"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua" id="alert_rencanaPembelianCatMurni" style="cursor: pointer; display: none;" onclick="listRencanaPembelianBarang('CAT MURNI')">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-shopping-cart"></i></span>
          <div class="info-box-content">
            <span class="info-box-number">Rencana Pembelian</span>
            <span class="info-box-text">Cat Murni</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_rencanaPembelianCatMurni"></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content" id="rencanaPIC">
    <table class="table table-responsive table-striped" id="tableMasterCatMurni">
      <thead>
      	<th style="width: 15px;">No</th>
    		<th>Nama Barang</th>
      	<th>Warna</th>
      	<th>Stok</th>
      	<!-- <th colspan="2" style="text-align: center; width: 30px">Action</th> -->
      </thead>
    </table>
  </section>
  <section>
    <div id="modal_inputRencanaPembelianCatMurni" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm">
        <!-- konten modal-->
        <div class="modal-content" style="background-color:#00a65a;">
          <!-- heading modal -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: black;">Form Pembelian Cat Murni</h4>
          </div>
          <!-- body modal -->
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal *">
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="nm_customer" id="nm_customer" placeholder="Customer *"> 
            </div>
            <div class="form-group">
              <select class="form-control" value="" name="nama_catMurni" id="nama_catMurni">
                
                
              </select>
            </div>
            <div class="form-group">
              <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah *">
            </div>
            <div class="form-group" style="text-align: center;">
              <button type="submit" onclick="simpanRencanaPembelianCatMurni()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Simpan</b></button>
            </div>
          </div>
          <!-- footer modal -->
          <div class="modal-footer" style="text-align: center; color: black;"></div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div id="modal_searchHistoryCatMurni" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm">
        <!-- konten modal-->
        <div class="modal-content" style="background-color:#00a65a;">
          <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search">&nbsp;&nbsp;Cari History Cat Murni</i></h4>
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
            <select class="form-control" value="" name="CatMurni" id="CatMurni">
              
              
            </select>
          </div>
          <div class="form-group">
            <button type="submit" onclick="cariHistoryCatMurni('Cat Murni')" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
          </div>
          </div>
          <!-- footer modal -->
          <div class="modal-footer" style="text-align: center; color: black;"></div>
        </div>
      </div>
    </div>
  </section>
</div>
