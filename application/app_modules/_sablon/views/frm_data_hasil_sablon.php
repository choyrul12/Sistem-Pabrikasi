<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $Data['Title']; ?> <span id="tanggal"></span></h1>
    <input type="hidden" name="tgl1" id="tgl1" value=""> <input type="hidden" name="tgl2" id="tgl2" value="">
      <ol class="breadcrumb">
        <i class="fa fa-link" aria-hidden="true"></i>&nbsp;
        <li><?php echo $Link["Segment1"]; ?></li>
        <li><?php echo $Link["Segment2"]; ?></li>
      </ol>
    </section>
    <section class="content" id="hasilSablonPerTgl">
      <div class="box box-success">
        <div class="box-body">
          <button type="button" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#modal_cariHasilSablon"><i class="fa fa-search"></i> Cari Hasil Sablon</button>
          <div class="table-responsive">
            <table class="table table-responsive table-striped" id="tableDataHasilSablonPerTgl" style="display: none;">
              <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Merek</th>
                <th>Ukuran</th>
                <th>Warna Plastik</th>
                <th>Warna Cetak</th>
                <th>Hasil Lembar</th>
                <th>Hasil Berat</th>
                <th>Jenis Barang</th>
                <th colspan="2" style="text-align: center;">Action</th>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </section>
  </section>
  <section>
      <div id="modal_cariHasilSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="text-align: center;">
        <div class="modal-dialog modal-sm">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;"><i class="fa fa-search">&nbsp;&nbsp;Cari Hasil Sablon</i></h3>
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
                <button type="submit" onclick="cariHasilSablon()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>Cari</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="modal_detailHasilSablon" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1050px;margin: auto; padding-top: 20px;">
          <!-- konten modal-->
          <div class="modal-content">
            <!-- heading modal -->
            <div class="modal-header" style="background-color:#00a65a;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Detail Hasil Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body" style="height:500px; overflow-y:scroll;">
              <div class="content">
                <div id="detail_hasil_sablon"></div>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="edit_penggunanBahanSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
        <div class="modal-dialog modal-sm" style="width: 350px;">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Edit Penggunaan Bahan</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group col-md-12">
                <label>Jenis:</label>
                <input type="hidden" class="form-control" value="" name="id_penggunaan_sablon" id="id_penggunaan_sablon" readonly>
                <input type="hidden" class="form-control" value="" name="kd_hasil_sablon" id="kd_hasil_sablon" readonly>
                <input type="text" class="form-control" value="" name="jenis" id="jenis" placeholder="Jenis Bahan" readonly>
              </div>
               <div class="form-group col-md-12">
                <label>Nama Barang:</label>
                <input type="text" class="form-control" value="" name="nm_barang" id="nm_barang" placeholder="Nama Barang" readonly>
              </div>
              <div class="form-group col-md-8" style='padding-right:0px;'>
                <label>Jumlah Pemakaian:</label>
                <input type="text" class="form-control" value="" name="jum_pemakaian" id="jum_pemakaian" placeholder="Jumlah Pemakaian">
              </div>
              <div class='form-group col-md-1' style='width:105px;'>
                <label>&nbsp;</label>
                  <select class='form-control' name='satuan_pemakaian' id='satuan_pemakaian'>
                    <option value='Kg'>Kg</option>
                    <option value='Ons'>Ons</option>
                  </select>
              </div>
              <div class="form-group col-md-8" style='padding-right:0px;'>
                <label>Sisa Pemakaian :</label>
                <input type="text" class="form-control" value="" name="sisa_pemakaian" id="sisa_pemakaian" placeholder="Sisa Pemakaian">
              </div>
              <div class='form-group col-md-1' style='width:105px;'>
                <label>&nbsp;</label>
                  <select class='form-control' name='satuan_sisa' id='satuan_sisa'>
                    <option value='Kg'>Kg</option>
                    <option value='Ons'>Ons</option>
                  </select>
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="updatePenggunaanBahanSablon()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 90%;"><b>UPDATE</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div id="edit_hasilSablon" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
        <div class="modal-dialog modal-sm" style="width: 350px;">
          <!-- konten modal-->
          <div class="modal-content" style="background-color:#00a65a;">
            <!-- heading modal -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align: center; color: black;">&nbsp;&nbsp;Edit Hasil Sablon</h3>
            </div>
            <!-- body modal -->
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Produk :</label>
                <input type="hidden" class="form-control" value="" name="kd_hasil_sablon" id="kd_hasil_sablon" readonly>
                <input type="hidden" class="form-control" value="" name="kd_sablon" id="kd_sablon">
                <input type="hidden" class="form-control" value="" name="hasil_awal" id="hasil_awal">
                <input type="text"   class="form-control" value="" name="nm_produk" id="nm_produk" placeholder="Nama Produk" readonly>
              </div>
               <div class="form-group">
                <label>Warna Cat :</label>
                <input type="text" class="form-control" value="" name="warna_cat" id="warna_cat" placeholder="Warna Cat" readonly>
              </div>
              <div class="form-group">
                <label style='text-align:left;'>Tanggal:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tanggal">
                </div>
              </div>
              <div class="form-group">
                <label>Hasil Lembar :</label>
                <input type="text" class="form-control" value="" name="hasil_lembar" id="hasil_lembar" placeholder="Hasil Lembar">
              </div>
              <div class="form-group">
                <label>Hasil Berat :</label>
                <input type="text" class="form-control" value="" name="hasil_berat" id="hasil_berat" placeholder="Hasil Berat">
              </div>
              <div class="form-group" style="text-align: center;">
                <button type="submit" onclick="updateHasilSablon()" class="btn btn-flat bg-navy margin" style="margin: 0; position: relative; width: 100%;"><b>UPDATE</b></button>
              </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer" style="text-align: center; color: black;"></div>
          </div>
        </div>
      </div>
    </section>
</div>
