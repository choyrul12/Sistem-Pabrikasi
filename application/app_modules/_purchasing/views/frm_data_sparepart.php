<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?></h1>
    <ol class="breadcrumb">
      <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
      <li><?php echo $Link["Segment1"]; ?></li>
      <li><?php echo $Link["Segment2"]; ?></li>
    </ol>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_InputRencanaPembelianSparePart"><i class="fa fa-plus"></i> Form Pembelian Spare Part</button>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_addSparePart" onclick="getCodeSparePart()"><i class="fa fa-plus"></i> Tambah Spare Part</button>
    <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_searchHistorySparePart" data-backdrop='static'><i class="fa fa-search"></i> History Spare Part</button>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow" id="alert_stokSparePart" style="cursor: pointer; display: none;" onclick="listStokHampirHabisSparePart()">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-list-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-number"><blink> Stok Hampir Habis </blink></span>
            <span class="info-box-text">Spare Part</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_stokSparePart"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow" id="alert_permintaanSparePart" style="cursor: pointer; display: none;" onclick="listPermintaanPembelianSparePart()">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-list-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-number"><blink> Permintaan Pembelian </blink></span>
            <span class="info-box-text">Spare Part</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_permintaanSparePart"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua" id="alert_rencanaPembelianSparePart" style="cursor: pointer; display: none;" onclick="listRencanaPembelianSparePart()">
          <span class="info-box-icon" style="padding-top: 20px;"><i class="fa fa-shopping-cart"></i></span>
          <div class="info-box-content">
            <span class="info-box-number">Rencana Pembelian</span>
            <span class="info-box-text">Spare Part</span>
            <div class="progress">
              <div class="progress-bar"></div>
            </div>
              <span class="info-box-number" id="numList_rencanaPembelianSparePart"></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content" id="rencanaPIC">
    <table class="table table-responsive table-striped" id="tableMasterSparePart">
      <thead>
      	<th style="width: 15px;">No</th>
    		<th style="width: 300px;">Nama</th>
      	<th style="width: 100px;">Ukuran</th>
      	<th style="width: 100px;">Stok Awal</th>
        <th style="width: 101px;">Stok Sekarang</th>
      	<!-- <th colspan="2" style="text-align: center; width: 30px">Action</th> -->
      </thead>
    </table>
  </section>
  <section>
      <div id="modal_lowStockSparePart" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 905px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Stok Spare Part Yang Hampir Habis <span id="title_header_rencana"></span> </h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableListLowStokSparePart">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Stok</th>
                    <th style="text-align: center; width: 30px">Action</th>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_listRencanaPembelianSparePart" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 905px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Daftar Rencana Pembelian Spare Part<span id="title_header_rencana"></span> </h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableListRencanaPembelianSparePart">
                  <thead style="background-color:#E8E8E8;">
                    <th style="width: 15px;">No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th style="text-align: center; width: 20px">Action</th>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_inputRencanaPembelianSparePart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center; color: black;">Form Pembelian Spare Part</h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Barang :</label>
                <input class="form-control" type="hidden" name="kd_spare_part" id="kd_spare_part" readonly="readonly">
                <input class="form-control" type="text" name="nm_sparepart" id="nm_sparepart" readonly="readonly">
              </div>
              <div class="form-group">
                <label>Tanggal Pembelian:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal">
                </div>
              </div>
              <div class="form-group">
                <label>Jumlah :</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah">
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="simpanRencanaPembelianSparePart()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Simpan</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_InputRencanaPembelianSparePart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center; color: black;">Form Pembelian Spare Part</h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Barang :</label>
                <select class="sparepart" id="sparepart" class="form-control">
                  <option></option>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal Pembelian:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_pembelian_sp" id="tgl_pembelian_sp" placeholder="Tanggal">
                </div>
              </div>
              <div class="form-group">
                <label>Jumlah :</label>
                <input type="number" class="form-control" name="jum_pembelian_sp" id="jum_pembelian_sp" placeholder="Jumlah">
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="simpanRencanaPembelianSP()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Simpan</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_inputHasilPembelianSparePart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-shopping-cart">&nbsp;&nbsp;Input Hasil Pembelian Spare Part</i></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group col-md-6">
                <label>Tanggal Permintaan :</label>
                <input type="hidden" name="id" id="id_sparepart">
                <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Nama Barang :</label>
                <input type="text" class="form-control" name="nm_spare_part" id="nm_spare_part" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Ukuran :</label>
                <input type="text" class="form-control" name="ukuran_sparepart" id="ukuran_sparepart" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Jumlah Rencana :</label>
                <input type="text" class="form-control" name="jum_rencana" id="jum_rencana" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Jumlah Pembelian :</label>
                <input type="number" class="form-control" name="jum_pembelian_sparepart" id="jum_pembelian_sparepart" placeholder="Jumlah Pembelian">
              </div>
              <div class="form-group col-md-6">
              <label>Tanggal Pembelian</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_pembelian_sparepart" id="tgl_pembelian_sparepart" placeholder="Tanggal Pembelian">
                </div>
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="kirimHasilPembelianSparePart()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 45%;"><b>Kirim Ke Gudang</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_addSparePart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">Form Tambah Spare Part<span id="title_addBahan"></span></h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group col-md-6">
                <label>ID Acurate :</label>
                <input type="hidden" class="form-control" name="kd_sparepart" id="kd_sparepart" readonly>
                <input type="text" class="form-control" name="kd_accurate_sparepart" id="kd_accurate_sparepart" placeholder="ID Acurate">
              </div>
              <div class="form-group col-md-6">
                <label>Nama Barang :</label>
                <input type="text" class="form-control" name="nm_sparePart" id="nm_sparePart" placeholder="Nama Barang *">
              </div>
              <div class="form-group col-md-6">
                <label>Ukuran :</label>
                <input type="text" class="form-control" name="ukuran_sparePart" id="ukuran_sparePart" placeholder="Ukuran ">
              </div>
              <div class="form-group col-md-6" id="addWarna">
                <label>Kode :</label>
                <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode">
              </div>
              <div class="form-group col-md-6">
                <label>Stok :</label>
                <input type="number" class="form-control" name="stok_sparepart" id="stok_sparepart" placeholder="Stok *">
              </div>
              <div class="form-group col-md-6">
                <label>Tanggal :</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="tgl_input" id="tgl_input_sparepart" placeholder="Tanggal *">
                </div>
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="add_SparePart()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 51%;"><b>Simpan</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_editStokSparePart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">Form Edit Stok Spare Part</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Barang :</label>
                <input type="hidden" name="kdSparePart" id="kdSparePart" value="">
                <input type="text" class="form-control" name="nama_sparePart" id="nama_sparePart" placeholder="Nama Spare Part"> 
              </div>
              <div class="form-group" id="kolom_warna">
                <label>Ukuran :</label>
                <input type="text" class="form-control" name="ukuranSparePart" id="ukuranSparePart" placeholder="Ukuran"> 
              </div>
               <div class="form-group" id="kolom_warna">
                <label>Kode :</label>
                <input type="text" class="form-control" name="kode" id="kodeSP" placeholder="Kode"> 
              </div>
              <div class="form-group">
                <label>Stok Awal :</label>
                <input type="number" class="form-control" name="stok_awal" id="stok_awal" placeholder="Stok Awal">
              </div>
              <div class="form-group">
                <label>Stok Sekarang :</label>
                <input type="number" class="form-control" name="stok_sekarang" id="stok_sekarang" placeholder="Stok Sekarang">
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="updateStokSparePart()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Update</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_searchHistorySparePart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search">&nbsp;&nbsp;Cari History Spare Part</i></h4>
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
              <select class="form-control" value="" name="SparePart" id="SparePart">
                
                
              </select>
            </div>
            <div class="form-group">
              <button type="submit" onclick="cariHistorySparePart()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
            </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_historySparePart" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 1000px; margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;History Spare Part</h3>
              <h4 class="modal-title" style="text-align: center; color: black;"><span id="tgl_history_sp"></span></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <table class="table table-responsive table-striped" id="tableHistorySparePart">
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
                      <td style="text-align: right;"><span id="total_masuk_sp"></span></td>
                    </tr>
                    <tr>
                      <th>Total Keluar:</th>
                      <td style="text-align: right;"><span id="total_keluar_sp"></span></td>
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
