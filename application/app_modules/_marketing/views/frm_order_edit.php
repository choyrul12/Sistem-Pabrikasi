<?php
if(!empty($Header)){
  if($Header == "ADD"){

  }else if($Header == "MODIFY"){

  }else{

  }
}
if(!empty($Value["MataUang"])){
  $mata_uang = array("Rupiah"=>"","Dollar"=>"");
  switch ($Value["MataUang"]) {
    case "Rp.": $mata_uang["Rupiah"] = "checked='checked'";break;
    case "USD.": $mata_uang["Dollar"] = "checked='checked'";break;
    default:$mata_uang = array("Rupiah"=>"","Dollar"=>"");break;
  }
}
if(!empty($Value["Pajak"])){
  $pajak = array("PPN"=>"","NON PPN"=>"");
  switch ($Value["Pajak"]) {
    case "TRUE": $pajak["PPN"] = "checked='checked'";break;
    case "FALSE": $pajak["NON PPN"] = "checked='checked'";break;
    default:$pajak = array("PPN"=>"","NON PPN"=>"");break;
  }
}
if(!empty($Value["Proof"])){
  $proof = array("PERLU"=>"","TIDAK PERLU"=>"");
  switch ($Value["Proof"]) {
    case "PERLU": $proof["PERLU"] = "checked='checked'";break;
    case "TIDAK": $proof["TIDAK PERLU"] = "checked='checked'";break;
    default:$proof = array("PERLU"=>"","TIDAK PERLU"=>"");break;
  }
}
if(!empty($Value["JnsOrder"])){
  $jns_order = array("DK"=>"","LK"=>"","LN"=>"");
  switch ($Value["JnsOrder"]) {
    case 'DK': $jns_order["DK"] = "selected='selected'";break;
    case 'LK': $jns_order["LK"] = "selected='selected'";break;
    case 'LN': $jns_order["LN"] = "selected='selected'";break;
    default:$jns_order = array("DK"=>"","LK"=>"","LN"=>"");break;
  }
}
if(!empty($Value["Payment"])){
  $payment = array("NULL"=>"","A"=>"","B"=>"","C"=>"","D"=>"",
                   "E"=>"","F"=>"","G"=>"","H"=>"","I"=>"",
                   "J"=>"","K"=>"","L"=>"","M"=>"","N"=>"",
                   "O"=>"","P"=>"","Q"=>"","R"=>"","S"=>"",
                   "T"=>"","U"=>"","V"=>"","W"=>"","X"=>"",
                   "Y"=>"","Z"=>"");
  switch ($Value["Payment"]) {
    case "NULL" : $payment["NULL"] = "selected='selected'";break;
    case "Cash 2%" : $payment["A"] = "selected='selected'";break;
    case "Cash 3%" : $payment["B"] = "selected='selected'";break;
    case "Cash 4%" : $payment["C"] = "selected='selected'";break;
    case "Cash 5%" : $payment["D"] = "selected='selected'";break;
    case "Cash TD" : $payment["E"] = "selected='selected'";break;
    case "COD" : $payment["F"] = "selected='selected'";break;
    case "COD + Cash 2%" : $payment["G"] = "selected='selected'";break;
    case "Disc 2% Tdk Tercantum" : $payment["H"] = "selected='selected'";break;
    case "Disc 2% Tdk Tercantum + KU dulu" : $payment["I"] = "selected='selected'";break;
    case "Disc 2% Tercantum" : $payment["J"] = "selected='selected'";break;
    case "Disc 2% Tercantum + KU dulu" : $payment["K"] = "selected='selected'";break;
    case "Disc 3% Tdk Tercantum" : $payment["L"] = "selected='selected'";break;
    case "Disc 3% Tdk Tercantum + KU dulu" : $payment["M"] = "selected='selected'";break;
    case "Disc 3% Tercantum" : $payment["N"] = "selected='selected'";break;
    case "Disc 3% Tercantum + KU dulu" : $payment["O"] = "selected='selected'";break;
    case "DP" : $payment["P"] = "selected='selected'";break;
    case "KU Dulu" : $payment["Q"] = "selected='selected'";break;
    case "DP + KU DULU" : $payment["R"] = "selected='selected'";break;
    case "Potong 1000" : $payment["S"] = "selected='selected'";break;
    case "Potong 500" : $payment["T"] = "selected='selected'";break;
    case "Tempo 1 Bulan" : $payment["U"] = "selected='selected'";break;
    case "Tempo 14 Hari" : $payment["V"] = "selected='selected'";break;
    case "Tempo 2 Minggu" : $payment["W"] = "selected='selected'";break;
    case "Tempo 40 Hari" : $payment["X"] = "selected='selected'";break;
    case "Tempo 7 Hari" : $payment["Y"] = "selected='selected'";break;
    // case "Custom" : $payment["Z"] = "selected='selected'";break;
    default: $payment["Z"] = "selected='selected'";
      break;
  }
}
if(!empty($Value["KetProof"])){
  $ket_proof = array("A"=>"","B"=>"","C"=>"","D"=>"","E"=>"");
  switch($Value["KetProof"]){
    case "SETTINGAN" : $ket_proof["A"]="selected='selected'";break;
    case "SABLON" : $ket_proof["B"]="selected='selected'";break;
    case "CETAK" : $ket_proof["C"]="selected='selected'";break;
    case "SETTINGAN+SABLON" : $ket_proof["D"]="selected='selected'";break;
    case "SETTINGAN+CETAK" : $ket_proof["E"]="selected='selected'";break;
    default : $ket_proof = array("A"=>"","B"=>"","C"=>"","D"=>"","E"=>"");break;
  }
}
if($Value["StsPesanan"] == "PROGRESS"){
  $disable = "disabled='disabled' title='Silahkan Konformasi ke PPIC untuk membuka fitur ini'";
}else{
  $disable = "";
}
?>
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
          <div class="col-md-6 pull-right" style="margin-bottom:10px;">
            <a href="#" data-toggle="modal" id="btn-note-customer-edit" class="btn btn-info btn-flat btn-md modal_link pull-right">Lihat Note Customer</a>
          </div>
          <div class="col-md-12">
            <div class="form-group has-error">
              <input type="text" name="txt_no_order" id="txt_no_order_edit" class="form-control" required readonly title="No. Order" style="width: 220px; float:left; margin-right:5px;" value="<?php echo $Value['NoOrder']; ?>">
              <input type="text" name="txt_kd_cust" id="txt_kd_cust_edit" class="form-control" required readonly title="Kode Customer" style="width: 220px; float:left; margin-right:5px;" value="<?php echo $Value['KodeCust']; ?>">
              <input type="text" name="txt_nm_perusahaan" id="txt_nm_perusahaan_edit" class="form-control" readonly title="Nama Perusahaan" style="width: 220px; float:left; margin-right:5px;" value="<?php echo $Value['NmPerusahaan']; ?>">
              <div class="form-group" style="width: 170px; float:left; margin-right:5px;">
                <div class="input-group date">
                  <input class="form-control pull-right" type="text" name="txt_tgl_pesan" id="txt_tgl_pesan_edit" required readonly placeholder="Tanggal Pesan"  value="<?php echo $Value['TglPesan']; ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
              <div class="form-group" style="width: 170px; float:left; margin-right:5px;">
                <div class="input-group date">
                  <input class="form-control pull-right" type="text" name="txt_tgl_estimasi" id="txt_tgl_estimasi_edit" required readonly placeholder="Tanggal Estimasi"  value="<?php echo $Value['TglEstimasi']; ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group has-success" style="width: 220px; float:left; margin-right:5px;">
              <input type="text" name="txt_no_po" id="txt_no_po_edit" class="form-control" placeholder="No. PO" title="No. PO" value="<?php echo $Value['NoPo']; ?>">
            </div>
            <div class="form-group has-error" style="width: 220px; float:left; margin-right:5px;">
              <input type="text" name="txt_nm_pemesan" id="txt_nm_pemesan_edit" class="form-control" required placeholder="Nama Pemesan" title="Nama Pemesan" value="<?php echo $Value['NmPemesan']; ?>">
            </div>
            <div class="form-group" style="width: 250px; float:left; margin-right:5px; overflow-x:scroll; height:70px;">
              <div>
                <label class="btn btn-success btn-flat btn-block btn-file" style="margin-bottom:10px;">
                  Pilih File <input type="file" name="file_1" id="file_1_edit" title="Foto Produk 1" onchange="$('#name-file-1').html($(this).val());" style="height:34px;">
                </label>
                <span class="label label-info" id="name-file-1-edit"><?php echo $Value['File1']; ?></span>
              </div>
            </div>
            <div class="form-group has-error" style="width: 220px; float:left; margin-right:5px;">
              <div class="input-group">
                <label>
                  <input type="radio" name="rb_pajak" class="flat-red pajak_edit" value="TRUE" required <?php echo $pajak["PPN"]; ?>> PPN
                </label>
                &nbsp;&nbsp;
                <label>
                  <input type="radio" name="rb_pajak" class="flat-red pajak_edit" value="FALSE" required <?php echo $pajak["NON PPN"]; ?>> NON PPN
                </label>
              </div>
            </div>
          </div>

          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group has-error" style="width: 220px; float:left; margin-right:5px;">
              <select class="form-control" name="cmb-jns-order" id="cmb-jns-order-edit" required>
                <option value="DK" <?php echo $jns_order["DK"]; ?>>Dalam Kota</option>
                <option value="LK" <?php echo $jns_order["LK"]; ?>>Luar Kota</option>
                <option value="LN" <?php echo $jns_order["LN"]; ?>>Luar Negeri</option>
              </select>
            </div>
            <div class="form-group has-success" style="width: 350px; float:left; margin-right:5px;">
              <input type="text" name="txt_kd_order" id="txt_kd_order_edit" class="form-control" placeholder="Kode Order" title="Kode Order" style="width: 220px; float:left; margin-right:5px;" value="<?php echo $Value["KodeOrder"]; ?>">
              <input type="text" name="txt_uang_muka" id="txt_uang_muka_edit" class="form-control" placeholder="Uang Muka" title="Uang Muka" style="width: 120px; float:left; margin-right:5px;" value="<?php echo $Value["UangMuka"]; ?>">
            </div>
            <div class="form-group has-error" style="width: 210px; float:left; margin-right:5px;">
              <div class="input-group">
                <label>
                  <input type="radio" name="rb_mata_uang_p" class="flat-red mata_uang_p_edit" value="Rp." required <?php echo $mata_uang["Rupiah"]; ?>> Rupiah
                </label>
                &nbsp;&nbsp;
                <label>
                  <input type="radio" name="rb_mata_uang_p" class="flat-red mata_uang_p_edit" value="USD." required <?php echo $mata_uang["Dollar"]; ?>> US Dollar
                </label>
              </div>
            </div>
            <div class="form-group has-success">
              <textarea name="txt_ekspedisi" id="txt_ekspedisi_edit" rows="3" class="form-control" placeholder="Ekspedisi" cols="80" style="width: 220px; float:left; margin-right:5px;"><?php echo $Value['Ekspedisi']; ?></textarea>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group" style="width: 250px; float:left; margin-right:5px; overflow-x:scroll; height:70px;">
              <label class="btn btn-primary btn-flat btn-block btn-file" style="margin-bottom:10px;">
                Pilih File <input type="file" name="file_2" id="file_2_edit" title="Foto Produk 2" onchange="$('#name-file-2').html($(this).val());" style="height:34px;">
              </label>
              <span class="label label-info" id="name-file-2-edit"><?php echo $Value['File2']; ?></span>
            </div>
            <input type="hidden" id="hiddenPayment" value="<?php echo $Value["Payment"]; ?>">
            <div class="form-group has-error" id="payment-wrapper" style="width: 200px; float:left; margin-right:5px;">
              <select class="form-control" name="cmb-payment" id="cmb-payment-edit" onchange="changePaymentCustom(this)" onclick="changePaymentCustom(this)" required>
                <option value="" <?php echo $payment["NULL"]; ?>>--Pilih Term Payment--</option>
                <option value="Cash 2%" <?php echo $payment["A"]; ?>>Cash 2%</option>
                <option value="Cash 3%" <?php echo $payment["B"]; ?>>Cash 3%</option>
                <option value="Cash 4%" <?php echo $payment["C"]; ?>>Cash 4%</option>
                <option value="Cash 5%" <?php echo $payment["D"]; ?>>Cash 5%</option>
                <option value="Cash TD" <?php echo $payment["E"]; ?>>Cash TD</option>
                <option value="COD" <?php echo $payment["F"]; ?>>COD</option>
                <option value="COD + Cash 2%" <?php echo $payment["G"]; ?>>COD + Cash 2%</option>
                <option value="Disc 2% Tdk Tercantum" <?php echo $payment["H"]; ?>>Disc 2% Tdk Tercantum</option>
                <option value="Disc 2% Tdk Tercantum + KU dulu" <?php echo $payment["I"]; ?>>Disc 2% Tdk Tercantum + KU dulu</option>
                <option value="Disc 2% Tercantum" <?php echo $payment["J"]; ?>>Disc 2% Tercantum</option>
                <option value="Disc 2% Tercantum + KU dulu" <?php echo $payment["K"]; ?>>Disc 2% Tercantum + KU dulu</option>
                <option value="Disc 3% Tdk Tercantum" <?php echo $payment["L"]; ?>>Disc 3% Tdk Tercantum</option>
                <option value="Disc 3% Tdk Tercantum + KU dulu" <?php echo $payment["M"]; ?>>Disc 3% Tdk Tercantum + KU dulu</option>
                <option value="Disc 3% Tercantum" <?php echo $payment["N"]; ?>>Disc 3% Tercantum</option>
                <option value="Disc 3% Tercantum + KU dulu" <?php echo $payment["O"]; ?>>Disc 3% Tercantum + KU dulu</option>
                <option value="DP" <?php echo $payment["P"]; ?>>DP</option>
                <option value="DP + KU DULU" <?php echo $payment["Q"]; ?>>DP + KU DULU</option>
                <option value="KU Dulu" <?php echo $payment["R"]; ?>>KU Dulu</option>
                <option value="Potong 1000" <?php echo $payment["S"]; ?>>Potong 1000</option>
                <option value="Potong 500" <?php echo $payment["T"]; ?>>Potong 500</option>
                <option value="Tempo 1 Bulan" <?php echo $payment["U"]; ?>>Tempo 1 Bulan</option>
                <option value="Tempo 14 Hari" <?php echo $payment["V"]; ?>>Tempo 14 Hari</option>
                <option value="Tempo 2 Minggu" <?php echo $payment["W"]; ?>>Tempo 2 Minggu</option>
                <option value="Tempo 40 Hari" <?php echo $payment["X"]; ?>>Tempo 40 Hari</option>
                <option value="Tempo 7 Hari" <?php echo $payment["Y"]; ?>>Tempo 7 Hari</option>
                <option value="Custom" <?php echo $payment["Z"]; ?>>Custom</option>
              </select>
            </div>
            <div class="form-group has-error" style="width: 180px; float:left; margin-right:5px;">
              <div class="input-group">
                <label>
                  <input type="radio" name="rb_proof" class="flat-red proof_edit" value="PERLU" required <?php echo $proof["PERLU"]; ?>> Perlu
                </label>
                &nbsp;&nbsp;
                <label>
                  <input type="radio" name="rb_proof" class="flat-red proof_edit" value="TIDAK" required <?php echo $proof["TIDAK PERLU"]; ?>> Tidak Perlu
                </label>
              </div>
            </div>
            <div class="form-group has-success">
              <select class="form-control" name="cmb_ket_proof" id="cmb_ket_proof_edit" disabled="disabled" style="width: 160px; float:left; margin-right:5px;">
                <option value="SETTINGAN" <?php echo $ket_proof["A"]; ?>>Settingan</option>
                <option value="SABLON" <?php echo $ket_proof["B"]; ?>>Sablon</option>
                <option value="CETAK" <?php echo $ket_proof["C"]; ?>>Cetak</option>
                <option value="SETTINGAN+SABLON" <?php echo $ket_proof["D"]; ?>>Settingan + Sablon</option>
                <option value="SETTINGAN+CETAK" <?php echo $ket_proof["E"]; ?>>Settingan + Cetak</option>
              </select>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px">
            <div class="form-group has-success" style="width: 400px; float:left; margin-right:50px;">
              <label for="txt_note" class="text-primary">Note Pesanan</label>
              <textarea name="txt_note" id="txt_note_edit" rows="3" cols="80"><?php echo $Value['Note']; ?></textarea>
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
              <select class="form-control" name="cmb_ukuran" id="cmb_ukuran_edit" required></select>
            </div>
            <div class="form-group has-error">
              <input type="text" name="txt_jumlah" id="txt_jumlah_edit" class="form-control" placeholder="Jumlah" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 120px; float:left; margin-right:5px;" required>
              <select class="form-control" name="cmb_satuan" id="cmb_satuan_edit" style="width: 100px; float:left; margin-right:5px;" required>
                <option value="#">--Satuan--</option>
                <option value="BAL">BAL</option>
                <option value="KG">Kilogram</option>
                <option value="KALENG">Kaleng</option>
                <option value="LEMBAR">Lembar</option>
              </select>
              <input type="text" name="txt_harga" id="txt_harga_edit" onkeyup="discount(this,'cmb-payment-edit','txt_hsl_diskon_edit');" class="form-control" placeholder="Harga" style="width: 200px; float:left; margin-right:5px;" required>
              <div class="input-group" style="width: 210px; float:left; margin-right:5px;">
                <label>
                  <input type="radio" name="rb_mata_uang" class="flat-red mata_uang_edit" value="Rp." required checked> Rupiah
                </label>
                <label>
                  <input type="radio" name="rb_mata_uang" class="flat-red mata_uang_edit" value="USD." required> US Dollar
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group has-success" style="margin-top:15px;">
              <input type="text" name="txt_warna_cetak" id="txt_warna_cetak_edit" class="form-control" placeholder="Warna Cetak" style="width: 200px; float:left; margin-right:5px;">
            </div>
            <div class="form-group has-error">
              <input type="text" name="txt_dll" id="txt_dll_edit" class="form-control" placeholder="DLL" style="width: 200px; float:left; margin-right:5px;" required>
              <input type="text" name="txt_strip" id="txt_strip_edit" class="form-control" placeholder="SM" style="width: 100px; float:left; margin-right:5px;" required>
              <input type="text" name="txt_kd_hrg" id="txt_kd_hrg_edit" class="form-control" placeholder="Kode Harga" style="width: 200px; float:left; margin-right:5px;" required>
              <input type="text" name="txt_omset_kg" id="txt_omset_kg_edit" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Omset/Kg" style="width: 100px; float:left; margin-right:5px;" required>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:10px;">
            <div class="form-group has-error" style="margin-top:15px;">
              <input type="text" name="txt_omset_lembar" id="txt_omset_lembar_edit" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Omset/Lembar" style="width: 120px; float:left; margin-right:5px;" required>
            </div>
            <div class="form-group has-success">
              <input type="text" name="txt_potongan" id="txt_potongan_edit" class="form-control" placeholder="Potongan" style="width: 200px; float:left; margin-right:5px;">
              <input type="text" name="txt_hsl_diskon" id="txt_hsl_diskon_edit" class="form-control" readonly placeholder="Hasil Diskon" style="width: 200px; float:left; margin-right:5px;">
            </div>
            <div class="form-group has-success" style="width: 150px; float:left; margin-right:5px;">
              <input type="text" name="txt_cn" id="txt_cn_edit" class="form-control" placeholder="CN">
            </div>
            <div class="form-group has-error">
              <textarea name="txt_merek" rows="3" cols="70" id='txt_merek_edit' class='form-control' placeholder='Merek' style='width: 250px; float:left; margin-right:5px;' required></textarea>
            </div>
          </div>
          <div class="col-md-8">
            <span class="text-danger"><b>Note : Kolom Berwarna Merah Dan Ukuran Harus Diisi</b></span>
          </div>
          <div class="col-md-4">
            <button type="submit" name="btn-tambah" id="btn-tambah-pesanan-detail-edit" class="btn btn-md btn-flat btn-warning pull-right" <?php echo $disable; ?>><i class="fa fa-cart-plus" aria-hidden="true"></i> Tambah Ke Keranjang</button>
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
            <table class="table table-responsive table-striped" id="keranjang-belanja">
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
              <tbody id="pesanan-detail-tbody-edit">
              </tbody>
            </table>
            <center>
              <button type="button" class="btn btn-md btn-flat btn-info" name="btn-checkout" id="btn-checkout-edit" <?php echo $disable; ?>>
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
              <tbody id="produk-service-edit">

              </tbody>
            </table>
          </div>
        </fieldset>

<!--======================================================== Data Produk Servis (Finish) ========================================================-->

      </div>
    </section>

<!--======================================================== Modal Edit Pesanan Detail (Start) ========================================================-->

    <div class='modal fade' role='dialog' id='edit-modal-pesanan-detail'>
     <div class='modal-dialog modal-lg'>
       <div class='modal-content'>
         <div class='modal-header'>
           <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
           <h4 class='modal-title'>Edit Detail Pesanan</h4>
         </div>
         <div class='modal-body'>
           <div class='col-md-12'>
             <input type="hidden" id="id_dp_edit">
             <div class='form-group' style='width: 280px; float:left; margin-right:5px;'>
               <select class='form-control' name='cmb_ukuran' id='cmb_ukuran1_edit' required></select>
             </div>
             <div class='form-group has-error'>
               <input type='text' name='txt_jumlah' id='txt_jumlah1_edit' class='form-control' placeholder='Jumlah' style='width: 100px; float:left; margin-right:5px;' required>
               <select class='form-control' name='cmb_satuan' id='cmb_satuan1_edit' style='width: 100px; float:left; margin-right:5px;' required>
                 <option value='#'>--Satuan--</option>
                 <option value='BAL'>BAL</option>
                 <option value='KG'>Kilogram</option>
                 <option value='KALENG'>Kaleng</option>
                 <option value='LEMBAR'>Lembar</option>
               </select>
               <input type='text' name='txt_harga' id='txt_harga1_edit' class='form-control' placeholder='Harga' style='width: 150px; float:left; margin-right:5px;' required>
               <div class='input-group' style='width: 180px; float:left; margin-right:5px;'>
                 <label>
                   <input type='radio' name='rb_mata_uang1_edit' id='rb_1_edit' class='flat-red mata_uang1_edit' value='Rp.' required> Rupiah
                 </label>
                 <label>
                   <input type='radio' name='rb_mata_uang1_edit' id='rb_2_edit' class='flat-red mata_uang1_edit' value='USD.' required> US Dollar
                 </label>
               </div>
             </div>
           </div>
           <div class='col-md-12'>
             <div class='form-group has-success' style='margin-top:15px;'>
               <input type='text' name='txt_warna_cetak' id='txt_warna_cetak1_edit' class='form-control' placeholder='Warna Cetak' style='width: 200px; float:left; margin-right:5px;'>
             </div>
             <div class='form-group has-error'>
               <input type='text' name='txt_dll' id='txt_dll1_edit' class='form-control' placeholder='DLL' style='width: 200px; float:left; margin-right:5px;' required>
               <input type='text' name='txt_strip' id='txt_strip1_edit' class='form-control' placeholder='SM' style='width: 100px; float:left; margin-right:5px;' required>
               <input type='text' name='txt_kd_hrg' id='txt_kd_hrg1_edit' class='form-control' placeholder='Kode Harga' style='width: 200px; float:left; margin-right:5px;' required>
               <input type='text' name='txt_omset_kg' id='txt_omset_kg1_edit' class='form-control' placeholder='Omset/Kg' style='width: 100px; float:left; margin-right:5px;' required>
             </div>
           </div>
           <div class='col-md-12' style='margin-bottom:10px;'>
             <div class='form-group has-error' style='margin-top:15px;'>
               <input type='text' name='txt_omset_lembar' id='txt_omset_lembar1_edit' class='form-control' placeholder='Omset/Lembar' style='width: 120px; float:left; margin-right:5px;' required>
             </div>
             <div class='form-group has-success'>
               <input type='text' name='txt_potongan' id='txt_potongan1_edit' class='form-control' placeholder='Potongan' style='width: 200px; float:left; margin-right:5px;'>
               <input type='text' name='txt_hsl_diskon' id='txt_hsl_diskon1_edit' class='form-control' readonly placeholder='Hasil Diskon' style='width: 200px; float:left; margin-right:5px;'>
             </div>
             <div class="form-group has-success" style='width: 150px; float:left; margin-right:5px;'>
               <input type='text' name='txt_cn' id='txt_cn1_edit' class='form-control' placeholder='CN'>
             </div>
             <div class='form-group has-error'>
               <textarea name="txt_merek" rows="3" cols="70" id='txt_merek1_edit' class='form-control' placeholder='Merek' style='width: 250px; float:left; margin-right:5px;' required></textarea>
             </div>
           </div>
           <div class='col-md-8'>
             <span class='text-danger'><b>Note : Kolom Berwarna Merah Harus Diisi</b></span>
           </div>
           <div class='col-md-4'>
             <button type='submit' id='btn-edit-pesanan-detail' class='btn btn-md btn-flat btn-warning pull-right'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah Pesanan</button>
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
          <div class="modal-body">
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
