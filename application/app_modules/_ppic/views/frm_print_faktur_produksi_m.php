<html>
  <head>
    <meta charset="utf-8">
    <title>Faktur Pesanan Dengan No. Order : <?php echo $this->uri->rsegment(3); ?></title>
    <style>
    body{
      font-family: times;
    }
      .col-md-6{
        width: 50%;
        height: auto;
        float: left;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .col-md-12{
        width: 100%;
        height: auto;
        float: left;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .col-md-11 {
        width: 91.66666667%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-10 {
        width: 80%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-9{
        width: 75%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000; */
      }
      .col-md-3{
        width: 24.8%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-4{
        width: 33.333%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .col-md-2 {
        width: 19.666%;
        height: auto;
        float: left;
        position: relative;
        margin: 0;
        padding: 0;
      }
      .img{
        position: absolute;
        top: 0;
        right: 0;
        width: 40px;
        height: 40px;
      }
      .company-name{
        position: absolute;
        top: 0;
        left: 1;
        height:10px;
        font-size: 12px;
        font-weight: bold;
      }
      .address{
        position: absolute;
        font-size: 9px;
      }
      .text-wrapper{
        position: relative;
        float: left;
        width: 80%;
        margin-top: 10px;
      }
      .img-wrapper{
        position: relative;
        float: left;
        width: 13%;
      }
      hr{
        margin: 5px 0 5px  0;
        padding: 0;
      }
      .table-pesanan tr td{
        border: 1px solid #CCC;
        font-size: 11px;
      }
      .table-pesanan tr th{
        border: 1px solid #CCC;
        font-size: 11px;
        font-weight: bold;
      }
      .rounded-rect{
        height: 100%;
        border: 1px solid #000;
        border-radius: 10px;
        margin-left: 5px;
        position: relative;
        padding: 3px;
      }

      .content-wrapper{
        float: left;
        /* border: 1px solid #000; */
        height: 315px;
        /* page-break-inside:avoid !important; */
      }
      .signature-wrapper{
        float: left;
        position: relative;
        width: 100%;
        height: 50px;
        border: 1px solid #000;
        border-radius: 10px;
      }
      .signature{
        padding-top: 40px;
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: 0;
        width: 100%;
        margin: 0;
        /* border: 1 solid #000; */
      }
      ul {
        margin: 12px;
        padding: 0;
        font-size: 10px;
      }
    </style>
  </head>
  <body>
    <div class="col-md-6">
      <div class="img-wrapper">
        <img src="assets/images/LOGO_KLIP_PLASTIK.jpg" class="img" alt="" width="40px" height="40px">
      </div>
      <div class="text-wrapper">
        <div class="company-name">PT. KLIP PLASTIK</div>
        <div class="address">
          Jl. Yos Sudarso No. 115 A (Daan Mogot Km. 19) Batu Ceper, Tangerang
          Telp.: 5518899 (Hunting), 5404656, 5404657 Fax : 5539999 <br>
          Homepage : http://www.klipplastik.co.id <br>
          Email : sales@klipplastik.co.id
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="col-md-6">
        <h5 style="border: 1px solid #000; padding:3px 5px 3px 5px; text-align:center; margin:0;">SURAT PESANAN</h5>
        <h6 style="margin:0; margin-top:3px; text-align:center;"><?php echo $arrDataPesanan[0]["no_order"]." ".$arrDataPesanan[0]["pajak"]." ".$arrDataPesanan[0]["jns_order"]; ?></h6>
      </div>
      <div class="col-md-6">
        <h6 style="margin-left:5px;">KETERANGAN : </h6>
        <div class="address" style="margin-left:5px;">
          Setiap order selalu ada toleransi ukuran dan jumlah pesanan.<br>
          Approval : <?php echo $arrDataPesanan[0]["proof"]; ?> ( <?php echo $arrDataPesanan[0]["ket_proof"]; ?> )
        </div>
      </div>
    </div>
    <hr>
    <div class="col-md-10">
      <div class="content-wrapper">
        <table width="100%" class="table-pesanan">
          <tr>
            <td width="18%">TANGGAL</td>
            <td width="1%">:</td>
            <td><?php echo $arrDataPesanan[0]["tgl_pesan"]; ?></td>
            <td width="10%">No. PO</td>
            <td width="1%">:</td>
            <td width="25%"><?php echo $arrDataPesanan[0]["no_po"]; ?></td>
          </tr>
          <tr>
            <td>NAMA PEMESAN</td>
            <td>:</td>
            <td><?php echo $arrDataPesanan[0]["nm_perusahaan"]; ?></td>
            <td>Telp.</td>
            <td>:</td>
            <td><?php echo $arrDataPesanan[0]["tlp_kantor"]; ?></td>
          </tr>
          <tr>
            <td>ALAMAT</td>
            <td>:</td>
            <td colspan="4"><?php echo $arrDataPesanan[0]["alamat"]; ?></td>
          </tr>
        </table>

        <table class="table-pesanan" style="margin-top:5px;" width="100%">
          <thead>
            <tr>
              <th rowspan="2" width="7%"><center>QTY</center></th>
              <th rowspan="2" width="7%"><center>SATUAN</center></th>
              <th colspan="2"><center>UKURAN</center></th>
              <th rowspan="2" width="17%"><center>MEREK</center></th>
              <th rowspan="2" width="17%"><center>NAMA PRODUK</center></th>
              <th colspan="4"><center>WARNA</center></th>
            </tr>
            <tr>
              <th width="7%"><center>P</center></th>
              <th width="7%"><center>L</center></th>
              <th width="10%"><center>PLS</center></th>
              <th><center>CETAK</center></th>
              <th><center>STRIP</center></th>
              <th><center>DLL</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($arrDataPesananDetail as $arrData):
                if(strpos($arrData["ukuran"],"/") !== FALSE){
                  $arrUkuran = explode("/",$arrData["ukuran"]);
                  $arrUkuranPrimer = explode("x",strtolower($arrUkuran[0]));
                  $arrUkuranSekunder = explode("x",strtolower($arrUkuran[1]));
                  $panjang = "<u>".$arrUkuranPrimer[0]."</u><br>".$arrUkuranSekunder[0];
                  $lebar = "<u>".$arrUkuranPrimer[1]."</u><br>".$arrUkuranSekunder[1];
                }else{
                  $arrUkuran = explode("x",strtolower($arrData["ukuran"]));
                  $panjang = $arrUkuran[0];
                  $lebar = $arrUkuran[1];
                }
            ?>
              <tr>
                <td>
                  <center>
                    <?php
                      if(substr($arrData["jumlah"],strlen($arrData["jumlah"])-2, 2) == ".0"){
                        echo substr($arrData["jumlah"],0,strlen($arrData["jumlah"])-2);
                      }else{
                        echo $arrData["jumlah"];
                      }
                    ?>
                  </center>
                </td>
                <td><center><?php echo $arrData["satuan"]; ?></center></td>
                <td><center><?php echo $panjang; ?></center></td>
                <td><center><?php echo $lebar; ?></center></td>
                <td><center><?php echo $arrData["merek"]; ?></center></td>
                <td><center><?php echo $arrData["nm_brg"]; ?></center></td>
                <td><center><?php echo $arrData["warna_plastik"]; ?></center></td>
                <td><center><?php echo $arrData["warna_cetak"]; ?></center></td>
                <td><center><?php echo $arrData["sm"]; ?></center></td>
                <td><center><?php echo $arrData["dll"]; ?></center></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <div class="col-md-6">
          <p style="font-size:9px; width:75%;">(Uang muka tidak dapat dikembalikan apabila order dibatalkan oleh pemesan).</p>
        </div>
        <div class="col-md-6">
          <table border="1" width="100%" class="table-pesanan">
            <tr>
              <td style="height:20px; border:0;" width="35%">Tgl. Penyerahan</td>
              <td style="height:20px; border:0;" width="1%">:</td>
              <td style="height:20px; border:0; padding-left:5px;">
                <p><?php echo $arrDataPesanan[0]["tgl_estimasi"]; ?></p>
              </td>
            </tr>
            <tr>
              <td style="height:20px; border:0;">Syarat Pembayaran</td>
              <td style="height:20px; border:0;">:</td>
              <td style="height:20px; border:0; padding-left:5px;">
                <p><?php echo $arrDataPesanan[0]["payment_method"]; ?></p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <div class="signature-wrapper">
          <div class="col-md-4">
            <div class="signature">
              <hr style="margin:0; padding:0;">
              <p style="font-size:10px; font-weight:bold; padding:0; margin:0; text-align:center;">
                <?php echo $arrDataPesanan[0]["nm_pemesan"]; ?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <p></p>
          </div>
          <div class="col-md-4">
            <div class="signature">
              <hr style="margin:0; padding:0;">
              <p style="font-size:10px; font-weight:bold; padding:0; margin:0; text-align:center;">
                Salesman ( <?php echo $arrDataPesanan[0]["sales"]; ?> )
              </p>
            </div>
          </div>
        </div>
        <p style="font-size:9px; margin:0;">Uang muka harap ditulis jika tidak ditanggung sepenuhnya oleh pemesan</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="rounded-rect">
          <p style="text-align:center; margin:0; padding:0; font-size:11px; text-decoration:underline;">Expedisi</p>
          <p style="font-size:10px; margin:0; padding:0;">
            <?php echo $arrDataPesanan[0]["expedisi"]; ?>
          </p>
          <?php
            if(empty($arrDataPesanan[0]["foto_1"]) && empty($arrDataPesanan[0]["foto_2"])){
          ?>
            <div style="width:100px; height:120px; margin-top:10px;">
              <a href='assets/images/klip.jpg'>
                <img src='assets/images/klip.jpg'>
              </a>
            </div>
          <?php
            }else{
              if(!empty($arrDataPesanan[0]["foto_1"])){
          ?>
          <div style="width:100px; height:120px; margin-top:10px;">
            <a href='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_1"]; ?>'>
              <img src='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_1"]; ?>'>
            </a>
          </div>
          <?php
              }else{
          ?>
          <div style="width:100px; height:120px; margin-top:10px;">
            <a href='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_2"]; ?>'>
              <img src='assets/images/upload/<?php echo $arrDataPesanan[0]["foto_2"]; ?>'>
            </a>
          </div>
          <?php
              }
            }
          ?>
          <div style="margin:0; margin-top:10px; padding:0; font-size:10px;">
            <?php echo $arrDataPesanan[0]["note"]; ?>
            <?php foreach ($arrDataPesananDetail as $value) {
              echo "<p>".$value['keterangan']."</p>";
            } ?>
          </div>
      </div>
    </div>
  </body>
</html>
