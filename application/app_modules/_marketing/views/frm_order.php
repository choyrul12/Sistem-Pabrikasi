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
      <div class="container-fluid">

<!--======================================================== Data Pesanan (Start) ========================================================-->

        <fieldset class="box box-solid">
          <div class="box-header">
            <h4>Data Pesanan</h4>
          </div>
          <?php
          if($Data["KodeCust"]==""){
            $kdCust = "";
            $nmCust = "";
          ?>
          <div class="col-md-6">
            <div class="form-group">
              <label class="text-primary" style="float:left;">Pilih Customer</label>&nbsp;
              <select class="form-control" id="cmb_customer" name="cmb_customer" style="width: 80%;">
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <a href="#" data-toggle="modal" id="btn-note-customer" class="btn btn-info btn-flat btn-md modal_link">Lihat Note Customer</a>
          </div>
          <?php
          }else{
            $kdCust = $Data["KodeCust"];
            $nmCust = str_replace("%20"," ",$Data["NmCust"]);

            $pajak = $DataCustomer[0]["pajak"];
            $jnsOrder = substr($kdCust,strlen($kdCust)-2,2);
            switch ($jnsOrder) {
              case 'DK': $arrJnsOrder = array("DK" => "selected='seleted'",
                                              "LK" => "",
                                              "LN" => "");
                         break;
              case 'LK': $arrJnsOrder = array("DK" => "",
                                               "LK" => "selected='seleted'",
                                               "LN" => "");
                          break;
              case 'LN': $arrJnsOrder = array("DK" => "",
                                              "LK" => "",
                                              "LN" => "selected='seleted'");
                         break;

              default: $arrJnsOrder = array("DK" => "",
                                            "LK" => "",
                                            "LN" => "");
                         break;
            }
            $checked1 = "";
            $checked2 = "";
            if($pajak == "1"){
              $checked1 = "checked='checked'";
            }else{
              $checked2 = "checked='checked'";
            }
          ?>
          <div class="col-md-6">
            <a href="<?php echo base_url(); ?>_marketing/main/show_customer_note/<?php echo $Data['KodeCust']; ?>" data-toggle="modal" class="btn btn-info btn-flat btn-md modal_link">Lihat Note Customer</a>
          </div>
          <?php } ?>
          <div class="col-md-12">
            <div class="form-group has-error">
              <input type="text" name="txt_no_order" id="txt_no_order" class="form-control" required readonly title="No. Order" style="width: 220px; float:left; margin-right:5px;" value="<?php echo $Value['NoOrder']; ?>">
              <input type="text" name="txt_kd_cust" id="txt_kd_cust" class="form-control" required readonly title="Kode Customer" style="width: 220px; float:left; margin-right:5px;" value="<?php echo $kdCust; ?>">
              <input type="text" name="txt_nm_perusahaan" id="txt_nm_perusahaan" class="form-control" readonly title="Nama Perusahaan" style="width: 220px; float:left; margin-right:5px;" value="<?php echo (empty($DataCustomer[0]["nm_perusahaan_update"])) ? $DataCustomer[0]["nm_perusahaan"] : $DataCustomer[0]["nm_perusahaan_update"]; ?>">
              <div class="form-group" style="width: 170px; float:left; margin-right:5px;">
                <div class="input-group date">
                  <input class="form-control pull-right" type="text" name="txt_tgl_pesan" id="txt_tgl_pesan" required readonly placeholder="Tanggal Pesan">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
              <div class="form-group" style="width: 170px; float:left; margin-right:5px;">
                <div class="input-group date">
                  <input class="form-control pull-right" type="text" name="txt_tgl_estimasi" id="txt_tgl_estimasi" required readonly placeholder="Tanggal Estimasi">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group has-success" style="width: 220px; float:left; margin-right:5px;">
              <input type="text" name="txt_no_po" id="txt_no_po" class="form-control" placeholder="No. PO" title="No. PO">
            </div>
            <div class="form-group has-error" style="width: 220px; float:left; margin-right:5px;">
              <input type="text" name="txt_nm_pemesan" id="txt_nm_pemesan" class="form-control" required placeholder="Nama Pemesan" title="Nama Pemesan">
            </div>
            <div class="form-group" style="width: 250px; float:left; margin-right:5px; overflow-x:scroll; height:70px;">
              <div>
                <label class="btn btn-success btn-flat btn-block btn-file" style="margin-bottom:10px;">
                  Pilih File <input type="file" name="file_1" id="file_1" title="Foto Produk 1" onchange="$('#name-file-1').html($(this).val());" style="height:34px;">
                </label>
                <span class="label label-info" id="name-file-1"></span>
              </div>
            </div>
            <div class="form-group has-error" style="width: 220px; float:left; margin-right:5px;">
              <div class="input-group">
                <label>
                  <input type="radio" name="rb_pajak" class="flat-red pajak" value="TRUE" required <?php echo $checked1; ?>> PPN
                </label>
                &nbsp;&nbsp;
                <label>
                  <input type="radio" name="rb_pajak" class="flat-red pajak" value="FALSE" required <?php echo $checked2; ?>> NON PPN
                </label>
              </div>
            </div>
          </div>

          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group has-error" style="width: 220px; float:left; margin-right:5px;">
              <select class="form-control" name="cmb-jns-order" id="cmb-jns-order" required>
                <option value="DK" <?php echo $arrJnsOrder["DK"]; ?>>Dalam Kota</option>
                <option value="LK" <?php echo $arrJnsOrder["LK"]; ?>>Luar Kota</option>
                <option value="LN" <?php echo $arrJnsOrder["LN"]; ?>>Luar Negeri</option>
              </select>
            </div>
            <div class="form-group has-success" style="width: 350px; float:left; margin-right:5px;">
              <input type="text" name="txt_kd_order" id="txt_kd_order" class="form-control" placeholder="Kode Order" title="Kode Order" style="width: 220px; float:left; margin-right:5px;">
              <input type="text" name="txt_uang_muka" id="txt_uang_muka" class="form-control" placeholder="Uang Muka" title="Uang Muka" style="width: 120px; float:left; margin-right:5px;">
            </div>
            <div class="form-group has-error" style="width: 210px; float:left; margin-right:5px;">
              <div class="input-group">
                <label>
                  <input type="radio" name="rb_mata_uang_p" class="flat-red mata_uang_p" value="Rp." required checked> Rupiah
                </label>
                &nbsp;&nbsp;
                <label>
                  <input type="radio" name="rb_mata_uang_p" class="flat-red mata_uang_p" value="USD." required> US Dollar
                </label>
              </div>
            </div>
            <div class="form-group has-success">
              <textarea name="txt_ekspedisi" id="txt_ekspedisi" rows="3" class="form-control" placeholder="Ekspedisi" cols="80" style="width: 220px; float:left; margin-right:5px;"></textarea>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group" style="width: 250px; float:left; margin-right:5px; overflow-x:scroll; height:70px;">
              <label class="btn btn-primary btn-flat btn-block btn-file" style="margin-bottom:10px;">
                Pilih File <input type="file" name="file_2" id="file_2" title="Foto Produk 2" onchange="$('#name-file-2').html($(this).val());" style="height:34px;">
              </label>
              <span class="label label-info" id="name-file-2"></span>
            </div>
            <div class="form-group has-error" id="payment-wrapper" style="width: 200px; float:left; margin-right:5px;">
              <select class="form-control" name="cmb-payment" id="cmb-payment" onchange="changePaymentCustom(this)" onclick="changePaymentCustom(this)" required>
                <option value="">--Pilih Term Payment--</option>
                <option value="Cash 2%">Cash 2%</option>
                <option value="Cash 3%">Cash 3%</option>
                <option value="Cash 4%">Cash 4%</option>
                <option value="Cash 5%">Cash 5%</option>
                <option value="Cash TD">Cash TD</option>
                <option value="COD">COD</option>
                <option value="COD + Cash 2%">COD + Cash 2%</option>
                <option value="Disc 2% Tdk Tercantum">Disc 2% Tdk Tercantum</option>
                <option value="Disc 2% Tdk Tercantum + KU dulu">Disc 2% Tdk Tercantum + KU dulu</option>
                <option value="Disc 2% Tercantum">Disc 2% Tercantum</option>
                <option value="Disc 2% Tercantum + KU dulu">Disc 2% Tercantum + KU dulu</option>
                <option value="Disc 3% Tdk Tercantum">Disc 3% Tdk Tercantum</option>
                <option value="Disc 3% Tdk Tercantum + KU dulu">Disc 3% Tdk Tercantum + KU dulu</option>
                <option value="Disc 3% Tercantum">Disc 3% Tercantum</option>
                <option value="Disc 3% Tercantum + KU dulu">Disc 3% Tercantum + KU dulu</option>
                <option value="DP">DP</option>
                <option value="DP + KU DULU">DP + KU DULU</option>
                <option value="KU Dulu">KU Dulu</option>
                <option value="Potong 1000">Potong 1000</option>
                <option value="Potong 500">Potong 500</option>
                <option value="Tempo 1 Bulan">Tempo 1 Bulan</option>
                <option value="Tempo 14 Hari">Tempo 14 Hari</option>
                <option value="Tempo 2 Minggu">Tempo 2 Minggu</option>
                <option value="Tempo 40 Hari">Tempo 40 Hari</option>
                <option value="Tempo 7 Hari">Tempo 7 Hari</option>
                <option value="Custom">Custom</option>
              </select>
            </div>
            <div class="form-group has-error" style="width: 180px; float:left; margin-right:5px;">
              <select class="form-control" id="cmbSales">
                <option value="">--Pilih Salesman--</option>
     						<option value="Ari">Ari</option>
     						<option value="Didik">Didik</option>
     						<option value="Egha">Egha</option>
     						<option value="Elly">Elly</option>
     						<option value="Farida">Farida</option>
     						<option value="Gaby">Gaby</option>
     						<option value="Nina">Nina</option>
     						<option value="Ibnu">Ibnu</option>
     						<option value="Ian">Ian</option>
              </select>
            </div>
            <div class="form-group has-error" style="width: 180px; float:left; margin-right:5px;">
              <div class="input-group">
                <label>
                  <input type="radio" name="rb_proof" class="flat-red proof" value="PERLU" required> Perlu
                </label>
                &nbsp;&nbsp;
                <label>
                  <input type="radio" name="rb_proof" class="flat-red proof" value="TIDAK" required checked> Tidak Perlu
                </label>
              </div>
            </div>
            <div class="form-group has-success">
              <select class="form-control" name="cmb_ket_proof" id="cmb_ket_proof" disabled="disabled" style="width: 160px; float:left; margin-right:5px;">
                <option value="SETTINGAN">Settingan</option>
                <option value="SABLON">Sablon</option>
                <option value="CETAK">Cetak</option>
                <option value="SETTINGAN+SABLON">Settingan + Sablon</option>
                <option value="SETTINGAN+CETAK">Settingan + Cetak</option>
              </select>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px">
            <div class="form-group has-success" style="width: 400px; float:left; margin-right:50px;">
              <label for="txt_note" class="text-primary">Note Pesanan</label>
              <textarea name="txt_note" id="txt_note" rows="3" cols="80"></textarea>
            </div>
            <div class="form-group">
              <span class="text-danger"><b>Note : </b></span>
              <ul class="text-danger">
                <li>Kolom Berwarna Merah Dan Customer Harus Diisi</li>
                <li>Ukuran File Maks. 1MB</li>
              </ul>
            </div>
          </div>
        </fieldset>

<!--======================================================== Data Pesanan (Finish) ========================================================-->

<!--======================================================== Data Detail Pesanan (Start) ========================================================-->

        <fieldset class="box box-solid">
          <div class="box-header">
            <h4>Tambah Detail Pesanan</h4>
          </div>
          <div class="col-md-12">
            <div class="form-group" style="width: 350px; float:left; margin-right:5px;">
              <select class="form-control" name="cmb_ukuran" id="cmb_ukuran" required></select>
            </div>
            <div class="form-group has-error">
              <input type="text" name="txt_jumlah" id="txt_jumlah" class="form-control" placeholder="Jumlah" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 120px; float:left; margin-right:5px;" required>
              <select class="form-control" name="cmb_satuan" id="cmb_satuan" style="width: 100px; float:left; margin-right:5px;" required>
                <option value="#">--Satuan--</option>
                <option value="BAL">BAL</option>
                <option value="KG">Kilogram</option>
                <option value="KALENG">Kaleng</option>
                <option value="LEMBAR">Lembar</option>
              </select>
              <input type="text" name="txt_harga" id="txt_harga" onkeyup="discount(this,'cmb-payment','txt_hsl_diskon');" class="form-control" placeholder="Harga" style="width: 200px; float:left; margin-right:5px;" required>
              <div class="input-group" style="width: 210px; float:left; margin-right:5px;">
                <label>
                  <input type="radio" name="rb_mata_uang" class="flat-red mata_uang" value="Rp." required checked> Rupiah
                </label>
                <label>
                  <input type="radio" name="rb_mata_uang" class="flat-red mata_uang" value="USD." required> US Dollar
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group has-success" style="margin-top:15px;">
              <input type="text" name="txt_warna_cetak" id="txt_warna_cetak" class="form-control" placeholder="Warna Cetak" style="width: 200px; float:left; margin-right:5px;">
            </div>
            <div class="form-group has-error">
              <input type="text" name="txt_dll" id="txt_dll" class="form-control" placeholder="DLL" style="width: 200px; float:left; margin-right:5px;" required>
              <input type="text" name="txt_strip" id="txt_strip" class="form-control" placeholder="SM" style="width: 100px; float:left; margin-right:5px;" required>
              <input type="text" name="txt_kd_hrg" id="txt_kd_hrg" class="form-control" placeholder="Kode Harga" style="width: 200px; float:left; margin-right:5px;" required>
              <input type="text" name="txt_omset_kg" id="txt_omset_kg" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Omset/Kg" style="width: 100px; float:left; margin-right:5px;" required>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group has-error" style="margin-top:15px;">
              <input type="text" name="txt_omset_lembar" id="txt_omset_lembar" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Omset/Lembar" style="width: 120px; float:left; margin-right:5px;" required>
            </div>
            <div class="form-group has-success">
              <input type="text" name="txt_potongan" id="txt_potongan" class="form-control" placeholder="Potongan" style="width: 200px; float:left; margin-right:5px;">
              <input type="text" name="txt_hsl_diskon" id="txt_hsl_diskon" class="form-control" readonly placeholder="Hasil Diskon" style="width: 200px; float:left; margin-right:5px;">
            </div>
            <div class="form-group has-success" style="width: 150px; float:left; margin-right:5px;">
              <input type="text" name="txt_cn" id="txt_cn" class="form-control" placeholder="CN">
            </div>
            <div class="form-group has-error">
              <textarea name="txt_merek" rows="3" cols="70" id='txt_merek' class='form-control' placeholder='Merek' style='width: 250px; float:left; margin-right:5px;' required></textarea>
            </div>
          </div>
          <div class="col-md-8">
            <span class="text-danger"><b>Note : Kolom Berwarna Merah Dan Ukuran Harus Diisi</b></span>
          </div>
          <div class="col-md-4">
            <button type="submit" name="btn-tambah" id="btn-tambah-pesanan-detail" class="btn btn-md btn-flat btn-warning pull-right"><i class="fa fa-cart-plus" aria-hidden="true"></i> Tambah Ke Keranjang</button>
          </div>
        </fieldset>

<!--======================================================== Data Detail Pesanan (Finish) ========================================================-->

<!--======================================================== Data Keranjang Belanja (Start) ========================================================-->

        <fieldset class="box box-solid">
          <div class="box-header">
            <div class="col-md-2">
              <h4>Keranjang Belanja</h4>
            </div>
            <div class="col-md-10">
              <div id="notif-detail-pesanan"></div>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-responsive table-striped" id="keranjang-belanja_temp">
              <thead>
                <th>No.</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Mata Uang</th>
                <th>Merek</th>
                <th>Ukuran</th>
                <th>Warna Cetak</th>
                <th>SM</th>
                <th>DLL</th>
                <th>Aksi</th>
              </thead>
              <tbody id="pesanan-detail-tbody">
              </tbody>
            </table>
            <center>
              <button type="button" class="btn btn-md btn-flat btn-info" name="btn-checkout" id="btn-checkout">
                <i class="fa fa-check" aria-hidden="true"></i>
                Selesai Pesanan
              </button>
            </center>
          </div>
        </fieldset>

<!--======================================================== Data Keranjang Belanja (Finish) ========================================================-->

<!--======================================================== Data Produk Servis (Start) ========================================================-->

        <fieldset class="box box-solid">
          <div class="box-header">
            <div class="col-md-2">
              <h4>Produk Servis</h4>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-responsive table-striped">
              <thead>
                <th>Produk Servis</th>
                <th>Term Payment</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Merek</th>
                <th>Foto</th>
                <th>Note</th>
              </thead>
              <tbody id="produk-service">
                <?php
                  if($Data["KodeCust"] != ""){
                    foreach ($ProductService as $arrData) {
                ?>
                <tr>
                  <td><?php echo $arrData["servis_produk"]; ?></td>
                  <td><?php echo $arrData["term_payment"]; ?></td>
                  <td><?php echo $arrData["ukuran"]; ?></td>
                  <td><?php echo $arrData["harga"]; ?></td>
                  <td><?php echo $arrData["merek"]; ?></td>
                  <td><img src='<?php echo base_url(); ?>assets/images/upload/<?php echo $arrData["foto"] ?>' class='img-hover' width='50px' height='50px' alt='Tidak Ada'></td>
                  <td><a href='#' class='btn btn-sm btn-info' onclick="showModalNoteProductServiceJson('<?php echo $arrData['id_sp']; ?>')" data-toggle='modal' data-target='#show-note-modal'>Note</a></td>
                </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </fieldset>

<!--======================================================== Data Produk Servis (Finish) ========================================================-->

      </div>
    </section>

<!--======================================================== Modal Edit Pesanan Detail (Start) ========================================================-->

    <div class='modal fade' role='dialog' id='edit-modal-pesanan-detail-temp'>
     <div class='modal-dialog modal-lg'>
       <div class='modal-content'>
         <div class='modal-header'>
           <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
           <h4 class='modal-title'>Edit Detail Pesanan</h4>
         </div>
         <div class='modal-body'>
           <div class='col-md-12'>
             <input type="hidden" id="id_dp">
             <div class='form-group' style='width: 280px; float:left; margin-right:5px;'>
               <select class='form-control' name='cmb_ukuran' id='cmb_ukuran1' required></select>
             </div>
             <div class='form-group has-error'>
               <input type='text' name='txt_jumlah' id='txt_jumlah1' class='form-control' placeholder='Jumlah' style='width: 100px; float:left; margin-right:5px;' required>
               <select class='form-control' name='cmb_satuan' id='cmb_satuan1' style='width: 100px; float:left; margin-right:5px;' required>
                 <option value='#'>--Satuan--</option>
                 <option value='BAL'>BAL</option>
                 <option value='KG'>Kilogram</option>
                 <option value='KALENG'>Kaleng</option>
                 <option value='LEMBAR'>Lembar</option>
               </select>
               <input type='text' name='txt_harga' id='txt_harga1' class='form-control' placeholder='Harga' style='width: 150px; float:left; margin-right:5px;' required>
               <div class='input-group' style='width: 180px; float:left; margin-right:5px;'>
                 <label>
                   <input type='radio' name='rb_mata_uang1' id='rb_1' class='flat-red mata_uang1' value='Rp.' required> Rupiah
                 </label>
                 <label>
                   <input type='radio' name='rb_mata_uang1' id='rb_2' class='flat-red mata_uang1' value='USD.' required> US Dollar
                 </label>
               </div>
             </div>
           </div>
           <div class='col-md-12'>
             <div class='form-group has-success' style='margin-top:15px;'>
               <input type='text' name='txt_warna_cetak' id='txt_warna_cetak1' class='form-control' placeholder='Warna Cetak' style='width: 200px; float:left; margin-right:5px;'>
             </div>
             <div class='form-group has-error'>
               <input type='text' name='txt_dll' id='txt_dll1' class='form-control' placeholder='DLL' style='width: 200px; float:left; margin-right:5px;' required>
               <input type='text' name='txt_strip' id='txt_strip1' class='form-control' placeholder='SM' style='width: 100px; float:left; margin-right:5px;' required>
               <input type='text' name='txt_kd_hrg' id='txt_kd_hrg1' class='form-control' placeholder='Kode Harga' style='width: 200px; float:left; margin-right:5px;' required>
               <input type='text' name='txt_omset_kg' id='txt_omset_kg1' class='form-control' placeholder='Omset/Kg' style='width: 100px; float:left; margin-right:5px;' required>
             </div>
           </div>
           <div class='col-md-12' style='margin-bottom:10px;'>
             <div class='form-group has-error' style='margin-top:15px;'>
               <input type='text' name='txt_omset_lembar' id='txt_omset_lembar1' class='form-control' placeholder='Omset/Lembar' style='width: 120px; float:left; margin-right:5px;' required>
             </div>
             <div class='form-group has-success'>
               <input type='text' name='txt_potongan' id='txt_potongan1' class='form-control' placeholder='Potongan' style='width: 200px; float:left; margin-right:5px;'>
               <input type='text' name='txt_hsl_diskon' id='txt_hsl_diskon1' class='form-control' readonly placeholder='Hasil Diskon' style='width: 200px; float:left; margin-right:5px;'>
             </div>
             <div class="form-group has-success" style='width: 150px; float:left; margin-right:5px;'>
               <input type='text' name='txt_cn' id='txt_cn1' class='form-control' placeholder='CN'>
             </div>
             <div class='form-group has-error'>
               <textarea name="txt_merek" rows="3" cols="70" id='txt_merek1' class='form-control' placeholder='Merek' style='width: 250px; float:left; margin-right:5px;' required></textarea>
             </div>
           </div>
           <div class='col-md-8'>
             <span class='text-danger'><b>Note : Kolom Berwarna Merah Harus Diisi</b></span>
           </div>
           <div class='col-md-4'>
             <button type='submit' id='btn-edit-pesanan-detail-temp' class='btn btn-md btn-flat btn-warning pull-right'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah Pesanan</button>
           </div>

         </div>
         <div class='modal-footer'>

         </div>
       </div>
     </div>
    </div>

<!--======================================================== Modal Edit Pesanan Detail (Finish) ========================================================-->


<!--======================================================== Modal Note Customer (Start) ========================================================-->

    <div class="modal fade" role="dialog" id="show-note-modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <h4 class="modal-title">Note</h4>
          </div>
          <div class="modal-body" style="height:500px; overflow-y:scroll;">
            <div id="json-wrapper">

            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>
</div>

<!--======================================================== Modal Note Customer (Finish) ========================================================-->
