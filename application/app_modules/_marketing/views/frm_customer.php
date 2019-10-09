<?php
if($Header == "ADD"){
  $v1 = $CustCode;
  $v2 = "";
  $v3 = "";
  $v4 = "";
  $v5 = "";
  $v6 = "";
  $v7 = "";
  $v8 = "";
  $v9 = "";
  $v10 = "";
  $v11 = "";
  $v12 = "";
  $v13 = "";
  $v14 = "";
  $v15 = "";
  $v16 = "";
  $v17 = "";
  $v18 = "";
  $v19 = "";
  $v20 = "";
  $v21 = "";
  $v22 = "";
  $jenis =  '
  <td width="20%">Jenis</td>
  <td width="1%">:</td>
  <td>
    <select class="form-control" id="jenis" name="jenis" onchange="jnsCust();"  autofocus style="width:30%;">
      <option value="XX">-- Pilih Jenis Customer --</option>
      <option value="DK">Dalam Kota</option>
      <option value="LK">Luar Kota</option>
      <<option value="LN">Luar Negeri</option>
    </select>
  </td>
  ';
  $v23="";
  $v24="";
  $v25="";
  $v26="";
  $v27="";
  $readonly="";
}elseif($Header == "MODIFY"){
  $jenis = "";
  foreach ($Customer as $arrCustomer) {
    $v1 = $arrCustomer["kd_cust"];
    $v2 = $arrCustomer["nm_perusahaan"];
    $v3 = $arrCustomer["bidang_perusahaan"];
    $v4 = $arrCustomer["nm_owner"];
    $v5 = $arrCustomer["hp_owner"];
    $v6 = $arrCustomer["nm_purchasing"];
    $v7 = $arrCustomer["hp_purchasing"];
    $v8 = $arrCustomer["gender"];
    $v9 = $arrCustomer["tlp_kantor"];
    $v10 = $arrCustomer["tlp_lainnya"];
    $v11 = $arrCustomer["alamat"];
    $v12 = $arrCustomer["alamat_lainnya"];
    $v13 = $arrCustomer["negara"];
    $v14 = $arrCustomer["provinsi"];
    $v15 = $arrCustomer["kota"];
    $v16 = $arrCustomer["no_fax"];
    $v17 = $arrCustomer["kode_pos"];
    $v18 = $arrCustomer["email"];
    $v19 = $arrCustomer["email_lainnya"];
    $v20 = $arrCustomer["pajak"];
    $v21 = $arrCustomer["website"];
    $v22 = $arrCustomer["note"];
    $v23 = $arrCustomer['no_cust'];
    $v24 = $arrCustomer['no_cust_update'];
    $v25 = $arrCustomer['nm_owner_update'];
    $v26 = $arrCustomer['nm_purchasing_update'];
    $v27 = $arrCustomer['nm_perusahaan_update'];
    $readonly="readonly";
  }
}else{
  redirect("_marketing/main/","refresh");
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
        <div class="container">
          <input type="hidden" id="header" name="header" value="<?php echo $Header; ?>">
          <table class="table" style="width:80%">
            <tr>
              <?php echo $jenis; ?>
            </tr>
            <tr>
              <td width="20%">No. Customer</td>
              <td width="1%">:</td>
              <td>
                <div class="input-group">
                  <input type="text" name="txt_no_cust" id="txt_no_cust" class="form-control" maxlength="20" title="No. Customer" value="<?php echo $v1; ?>" readonly style="width:250px">
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                  <?php
                    if($Header == "MODIFY"){
                  ?>
                  <div class="pull-right" style="margin-left:20px;">
                    <a href="<?php echo base_url(); ?>_marketing/main/order_baru/<?php echo $this->uri->rsegment(3); ?>/<?php echo $v2; ?>" class="btn btn-md btn-flat btn-success">Order</a>
                    <button type="button" class="btn btn-md btn-flat btn-info" data-toggle="modal" data-target="#modal-history-order" onclick="showHistoryOrder('<?php echo $this->uri->rsegment(3); ?>')">History</button>
                    <!-- <button type="button" class="btn btn-md btn-flat btn-warning" data-toggle="modal" data-target="#modalProductService">Produk Servis</button> -->
                    <a class="btn btn-md btn-flat btn-warning" href="<?php echo base_url('_marketing/main/product_service/').$this->uri->rsegment(3); ?>">Produk Servis</a>
                  </div>
                  <?php } ?>
                </div>
              </td>
            </tr>
            <tr>
              <td>Kode Customer</td>
              <td>:</td>
              <td>
                <input type="text" name="txt_kd_cust" id="txt_kd_cust" class="form-control" maxlength="20"  title="Kode Customer" value="<?php echo $v23; ?>" style="width:250px" <?php echo $readonly ?>>
              </td>
            </tr>
            <?php if($Header == "MODIFY"){ ?>
            <tr>
              <td>Kode Customer Baru</td>
              <td>:</td>
              <td>
                <input type="text" name="txt_kd_cust_baru" id="txt_kd_cust_baru" class="form-control" maxlength="20"  title="Kode Customer" value="<?php echo $v24; ?>" style="width:250px">
              </td>
            </tr>
          <?php } ?>
            <tr>
              <td>Nama Perusahaan</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <input type="text" name="txt_nm_perusahaan" id="txt_nm_perusahaan" class="form-control" maxlength="100"  value="<?php echo $v2; ?>" placeholder="Masukan Nama Perusahaan" title="Nama Perusahaan" style="width:90%" <?php echo $readonly ?>>
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <?php if($Header == "MODIFY"){ ?>
            <tr>
              <td>Nama Perusahaan Baru</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <input type="text" name="txt_nm_perusahaan_baru" id="txt_nm_perusahaan_baru" class="form-control" maxlength="100"  value="<?php echo $v27; ?>" placeholder="Masukan Nama Perusahaan" title="Nama Perusahaan" style="width:90%">
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <?php } ?>
            <tr>
              <td>Bidang Perusahaan</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%;">
                  <?php
                  $agen = "";$apotik = "";$bank = "";$cv = "";$garment = "";
                  $klinik = "";$perorangan = "";$pt = "";$restaurant = "";
                  $rs = "";$toko = "";$tc = "";
                  $bp = "selected='selected'";
                    switch ($v3) {
                      case 'AGEN': $agen = "selected='selected'"; break;
                      case 'APOTIK': $apotik = "selected='selected'"; break;
                      case 'BANK': $bank = "selected='selected'"; break;
                      case 'CV': $cv = "selected='selected'"; break;
                      case 'GARMENT': $garment = "selected='selected'"; break;
                      case 'KLINIK': $klinik = "selected='selected'"; break;
                      case 'PERORANGAN': $perorangan = "selected='selected'"; break;
                      case 'PT': $pt = "selected='selected'"; break;
                      case 'RESTAURANT': $restaurant = "selected='selected'"; break;
                      case 'RS': $rs = "selected='selected'"; break;
                      case 'TOKO': $toko = "selected='selected'"; break;
                      case 'TRADING_COMPANY': $tc = "selected='selected'"; break;
                      default:
                        $agen = "";break;$apotik = "";break;$bank = "";break;$cv = "";break;$garment = "";break;
                        $klinik = "";break;$perorangan = "";break;$pt = "";break;$restaurant = "";break;
                        $rs = "";break;$toko = "";break;$tc = "";break;
                        $bp = "selected='selected'";
                        break;
                    }
                  ?>
                  <select name="cmb_bidang" id="cmb_bidang" class="form-control"  title="Pilih Bidang Perusahaan" style="width:90%">
                    <option value="" disabled="disabled" <?php echo $bp; ?>>Bidang Perusahaan</option>
                    <option value="AGEN" <?php echo $agen; ?>>Agen</option>
                    <option value="APOTIK" <?php echo $apotik; ?>>Apotik</option>
                    <option value="BANK" <?php echo $bank; ?>>BANK</option>
                    <option value="CV" <?php echo $cv; ?>>CV.</option>
                    <option value="GARMENT" <?php echo $garment; ?>>Garment</option>
                    <option value="KLINIK" <?php echo $klinik; ?>>Klinik</option>
                    <option value="PERORANGAN" <?php echo $perorangan; ?>>Perorangan</option>
                    <option value="PT" <?php echo $pt; ?>>PT.</option>
                    <option value="RESTAURANT" <?php echo $restaurant; ?>>Restaurant</option>
                    <option value="RS" <?php echo $rs; ?>>Rumah Sakit (RS)</option>
                    <option value="TOKO" <?php echo $toko; ?>>Toko</option>
                    <option value="TRADING_COMPANY" <?php echo $tc; ?>>Trading Company</option>
                  </select>
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <tr>
              <td>Nama Owner</td>
              <td>:</td>
              <td>
                <input type="text" name="txt_nm_owner" id="txt_nm_owner" class="form-control" maxlength="70" value="<?php echo $v4; ?>" placeholder="Masukan Nama Owner" title="Nama Owner" <?php echo $readonly ?>>
              </td>
            </tr>
            <?php if($Header == "MODIFY"){ ?>
            <tr>
              <td>Nama Owner Baru</td>
              <td>:</td>
              <td>
                <input type="text" name="txt_nm_owner_baru" id="txt_nm_owner_baru" class="form-control" maxlength="70" value="<?php echo $v25; ?>" placeholder="Masukan Nama Owner" title="Nama Owner">
              </td>
            </tr>
            <?php } ?>
            <tr>
              <td>No. Hp. Owner</td>
              <td>:</td>
              <td>
                <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" name="txt_hp_own" id="txt_hp_own" maxlength="50" value="<?php echo $v5; ?>" title="No. Handphone Owner">
                  </div>
              </td>
            </tr>
            <tr>
              <td>Nama Purchasing</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <input type="text" name="txt_nm_purchasing" id="txt_nm_purchasing" class="form-control" maxlength="70" value="<?php echo $v6; ?>" placeholder="Masukan Nama Purchasing" title="Nama Purchasing" style="width:80%" <?php echo $readonly ?>>
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <?php if($Header == "MODIFY"){ ?>
            <tr>
              <td>Nama Purchasing Baru</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <input type="text" name="txt_nm_purchasing_baru" id="txt_nm_purchasing_baru" class="form-control" maxlength="70" value="<?php echo $v26; ?>" placeholder="Masukan Nama Purchasing" title="Nama Purchasing" style="width:80%">
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <?php } ?>
            <tr>
              <td>No. Hp. Purchasing</td>
              <td>:</td>
              <td>
                <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control" name="txt_hp_purchasing" id="txt_hp_purchasing" maxlength="50"  value="<?php echo $v7; ?>" title="No. Handphone Purchasing" style="width:80%">
                    &nbsp;
                    <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <?php
                  $p = "";
                  $w = "";
                    switch ($v8) {
                      case 'Pria':
                        $p = "checked='checked'";
                        break;
                      case 'Wanita':
                        $w = "checked='checked'";
                        break;

                      default:
                      $p = "";
                      $w = "";
                        break;
                    }
                  ?>
                  <label>
                    <input type="radio" name="rb_jenkel" class="flat-red" value="Pria" <?php echo $p; ?>> Pria
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="rb_jenkel" class="flat-red" value="Wanita" <?php echo $w; ?>> Wanita
                  </label>
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <tr>
              <td>Telp. Kantor (Wajib)</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" style="width:80%" name="txt_telp_primary" id="txt_telp_primary" value="<?php echo $v9; ?>" maxlength="50">
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <tr>
              <td>Telp. Kantor (Optional)</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" name="txt_telp_secondary" id="txt_telp_secondary" value="<?php echo $v10; ?>" maxlength="50">
                </div>
              </td>
            </tr>
            <tr>
              <td>Alamat (Wajib)</td>
              <td>:</td>
              <td>
                <textarea name="txt_alamat" id="txt_alamat"><?php echo $v11; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>Alamat (Optional)</td>
              <td>:</td>
              <td>
                <textarea name="txt_alamat_secondary" id="txt_alamat_second"><?php echo $v12; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>Negara</td>
              <td>:</td>
              <td>
                <div class="form-group">
                  <select class="form-control select2" name="cmb_negara" id="cmb_negara" style="width: 100%;">
                    <option value="">-- Pilih Negara --</option>
                    <?php
                      foreach ($Negara as $arrNegara) {
                        if($arrNegara["nm_negara"] == $v13){
                          $selected = "selected='selected'";
                        }else{
                          $selected = "";
                        }
                    ?>
                    <option value="<?php echo $arrNegara["nm_negara"]; ?>"<?php echo $selected; ?>><?php echo $arrNegara["nm_negara"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td>Provinsi</td>
              <td>:</td>
              <td>
                <div class="form-group">
                  <select class="form-control select2" name="cmb_provinsi" id="cmb_provinsi" style="width: 100%;">
                    <option value="">-- Pilih Provinsi --</option>
                    <?php
                    foreach ($Provinsi as $arrProvinsi) {
                      if ($arrProvinsi["nama"] == $v14) {
                        $selected = "selected='selected'";
                      }else{
                        $selected = "";
                      }
                      ?>
                      <option value="<?php echo $arrProvinsi["nama"]; ?>" <?php echo $selected; ?>><?php echo $arrProvinsi["nama"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </td>
              </tr>
            <tr>
              <td>Kota</td>
              <td>:</td>
              <td>
                <div class="form-group">
                  <select class="form-control select2" name="cmb_kota" id="cmb_kota" style="width: 100%;">
                    <option value="">-- Pilih Kota / Kabupaten --</option>
                    <?php
                      foreach ($Kabupaten as $arrKabupaten) {
                        if ($arrKabupaten["nama"] == $v15) {
                          $selected = "selected = 'selected'";
                        }else{
                          $selected = "";
                        }
                    ?>
                    <option value="<?php echo $arrKabupaten['nama'] ?>" <?php echo $selected; ?>><?php echo $arrKabupaten['nama'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td>No. Fax</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-fax"></i>
                  </div>
                  <input type="text" class="form-control" name="txt_fax" id="txt_fax" maxlength="15" value="<?php echo $v16; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td>Kode Pos</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-home"></i>
                  </div>
                  <input type="text" class="form-control" name="txt_kd_pos" id="txt_kd_pos" maxlength="6" value="<?php echo $v17; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td>E-mail</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input class="form-control" placeholder="Email@domain.com" style="width:80%" maxlength="50" value="<?php echo $v18; ?>" name="txt_email" id="txt_email" type="email"  title="Masukan E-mail Customer">
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <tr>
              <td>E-mail Lainnya</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input class="form-control" placeholder="Email@domain.com" maxlength="50" name="txt_email_secondary" id="txt_email_secondary" value="<?php echo $v19; ?>" type="email" title="Masukan E-mail Customer">
                </div>
              </td>
            </tr>
            <tr>
              <td>Pajak</td>
              <td>:</td>
              <td>
                <div class="input-group" style="width:100%">
                  <?php
                    $t = "";
                    $f = "";
                    switch ($v20) {
                      case '0':
                        $f = "checked='checked'";
                        break;
                      case '1':
                        $t = "checked='checked'";
                      break;

                      default:
                        $t = "";
                        $f = "";
                        break;
                    }
                  ?>
                  <label>
                    <input type="radio" name="rb_pajak" class="flat-red" value="0" <?php echo $f; ?>> Non PPN
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="rb_pajak" class="flat-red" value="1" <?php echo $t; ?>> PPN
                  </label>
                  &nbsp;
                  <label class="text-danger">&lowast;</label>
                </div>
              </td>
            </tr>
            <tr>
              <td>Website</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <input class="form-control" placeholder="www.domain.com" maxlength="100" value="<?php echo $v21; ?>" name="txt_web" id="txt_web" type="text" title="Masukan Alamat Web Customer">
                </div>
              </td>
            </tr>
            <tr>
              <td>Note</td>
              <td>:</td>
              <td>
                <textarea name="txt_note" id="txt_note"><?php echo $v22; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>
                <input type="submit" name="btn_simpan" value="Simpan" onclick="saveCustomerBaru()" class="btn btn-md btn-flat btn-primary">
                &nbsp;
                <input type="reset" name="btn_reset" value="Batal" class="btn btn-md btn-flat btn-danger">
              </td>
            </tr>
          </table>
        </div>
    </section>
</div>
<script type="text/javascript">
CKEDITOR.replace("txt_alamat");
CKEDITOR.replace("txt_alamat_second");
CKEDITOR.replace("txt_note");
</script>
<div class="modal fade" id="modal-history-order" role="dialog">
  <div class="modal-dialog modal-lg" style="width:100%; height:100%; margin:0; padding:0;">
    <div class="modal-content" style="width:100%; height:100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-target="#modal-history-order">&times;</button>
        <h3 class="modal-title">Data History Order</h3>
      </div>
      <div class="modal-body" style="height:83%; overflow-y:scroll;">
        <h4>History Baru</h4>
        <table class="table table-striped table-responsive" id="history-table" style="font-size:14px;">
          <thead>
            <th>Tgl. Pesan</th>
            <th>Tgl. Estimasi</th>
            <th>No.Customer</th>
            <th>Nama Owner</th>
            <th>Nama Purchasing</th>
            <th>Jumlah</th>
            <th>Ukuran</th>
            <th>Term Payment</th>
            <th>Harga</th>
            <th>Merek</th>
            <th>Plastik</th>
            <th>Cetak</th>
            <th>Strip</th>
            <th>Dll</th>
            <th>Kode Harga</th>
            <th>Note Pesanan</th>
          </thead>
        </table>
        <h4>History Lama</h4>
        <table class="table table-striped table-responsive" id="history-table-lama" style="font-size:14px;">
          <thead>
            <th>Tgl. Pesan</th>
            <th>Tgl. Estimasi</th>
            <th>No.Customer</th>
            <th>Nama Owner</th>
            <th>Nama Purchasing</th>
            <th>Jumlah</th>
            <th>Ukuran</th>
            <th>Term Payment</th>
            <th>Harga</th>
            <th>Merek</th>
            <th>Plastik</th>
            <th>Cetak</th>
            <th>Strip</th>
            <th>Dll</th>
            <th>Kode Harga</th>
            <th>Note Produk</th>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalProductService" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-target="#modalProductService">&times;</button>
        <h4 class="text-blue">Produk Servis</h4>
      </div>
      <div class="modal-body" style="height:500px; overflow-y:scroll;">
        <?php echo form_open_multipart(base_url()."_marketing/main/saveProductService/".$this->uri->rsegment(3)); ?>
        <table class="table">
          <tr>
            <td width="20%">Nama Produk</td>
            <td width="1%">:</td>
            <td>
              <input type="text" id="txt_nm_produk" name="txt_nm_produk" class="form-control" placeholder="Masukan Nama Produk">
            </td>
          </tr>
          <tr>
            <td>Ukuran</td>
            <td>:</td>
            <td>
              <input type="text" id="txt_ukuran" name="txt_ukuran" class="form-control" placeholder="Masukan Ukuran Produk">
            </td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td>
              <input type="text" id="txt_harga1" name="txt_harga" class="form-control" placeholder="Masukan Harga Produk">
            </td>
          </tr>
          <tr>
            <td>Term Payment</td>
            <td>:</td>
            <td>
              <input type="text" id="txt_payment" name="txt_payment" class="form-control" placeholder="Masukan Term Payment">
            </td>
          </tr>
          <tr>
            <td>Merek</td>
            <td>:</td>
            <td>
              <input type="text" id="txt_merek" name="txt_merek" class="form-control" placeholder="Masukan Merek Produk">
            </td>
          </tr>
          <tr>
            <td>Gambar</td>
            <td>:</td>
            <td>
              <input type="file" id="txt_file" name="txt_file" class="form-control">
              <p class="text-danger">Max. Size 1MB</p>
            </td>
          </tr>
          <tr>
            <td>Note</td>
            <td>:</td>
            <td>
              <textarea id="txt_note2" name="txt_note"></textarea>
              <script type="text/javascript">
                CKEDITOR.replace("txt_note2");
              </script>
            </td>
          </tr>
        </table>
        <?php echo form_close(); ?>

        <table id="product_service" class="table table-striped table-responsive">
          <thead>
            <th>Produk</th>
            <th>Ukuran</th>
            <th>Harga</th>
            <th>Term Payment</th>
            <th>Merek</th>
            <th>Gambar</th>
            <th>Pilihan</th>
          </thead>

          <tbody>
            <?php
              foreach ($ProductService as $arrProductService) {
            ?>
            <tr>
              <td><?php echo $arrProductService["servis_produk"]; ?></td>
              <td><?php echo $arrProductService["ukuran"]; ?></td>
              <td><?php echo $arrProductService["harga"]; ?></td>
              <td><?php echo $arrProductService["term_payment"]; ?></td>
              <td><?php echo $arrProductService["merek"]; ?></td>
              <td>
                  <img src="<?php echo base_url()."assets/images/upload/".$arrProductService["foto"]; ?>" alt="Gambar Tidak Ada" width="50px" height="50px" class="img-hover">
              </td>
              <td>
                <a href="<?php echo base_url() ?>_marketing/main/show_product_service_note/<?php echo $arrProductService["id_sp"]; ?>" class="btn btn-xs btn-info modal_link" data-toggle="modal"><i class="fa fa-sticky-note-o"></i> Note</a> &nbsp;
                <a href="<?php echo base_url() ?>_marketing/main/edit_product_service/<?php echo $arrProductService["id_sp"]; ?>" class="btn btn-xs btn-warning modal_link" data-toggle="modal"><i class="fa fa-edit"></i> Ubah</a> &nbsp;
                <a href="#" class="btn btn-xs btn-danger" onclick="deleteProductService('<?php echo $arrProductService["id_sp"]; ?>')"><i class="fa fa-trash"></i> Hapus</a> &nbsp;
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-flat btn-primary" onclick="tambahProductService('<?php echo $this->uri->rsegment(3); ?>')"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLihatNotePesanan" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-target="#modalLihatNotePesanan">&times;</button>
        <h4 class="modal-title text-header">Note Pesanan</h4>
      </div>
      <div class="modal-body" style="height:500px; overflow-y:scroll;">
        <div class="row">
          <div class="col-md-12">
            <div id="textNote">

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
